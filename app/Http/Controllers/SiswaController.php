<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalonSiswaRequest;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agama;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Models\Gelombang;
use App\Models\Pekerjaan;
use App\Models\CalonSiswa;
use App\Models\ListBerkas;
use App\Models\Pembayaran;
use App\Models\Pendidikan;
use App\Models\BerkasSiswa;
use App\Models\Penghasilan;
use App\Models\TahunAjaran;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahunAjaranList = TahunAjaran::all();
        $activeTahunAjaran = TahunAjaran::current();

        // ✅ DEFINISIKAN DARI AWAL
        $tahunAjaranId = null;

        if (!$activeTahunAjaran) {
            return view('pages.siswa', compact(
                'tahunAjaranList',
                'tahunAjaranId'
            ))->withErrors('Tidak ada tahun ajaran aktif.');
        }

        // Ambil tahun ajaran (fallback ke aktif)
        $tahunAjaranId = $request->input('tahun_ajaran_id');

        if (
            empty($tahunAjaranId) ||
            !TahunAjaran::where('id', $tahunAjaranId)->exists()
        ) {
            $tahunAjaranId = $activeTahunAjaran->id;
        }

        $siswa = CalonSiswa::with([
            'agama',
            'pendaftaran.tahunAjaran'
        ])
            ->whereHas('pendaftaran', function ($q) use ($tahunAjaranId) {
                $q->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->when($request->filled('nama'), function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->nama . '%');
            })
            ->paginate(5)
            ->withQueryString();

        return view('pages.siswa', compact(
            'siswa',
            'tahunAjaranList',
            'tahunAjaranId'
        ));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUser = Auth::user();
        $siswa = null;
        $tahunAjaran = TahunAjaran::current();
        $gelombang = Gelombang::current();


        if ($currentUser && $currentUser->calonSiswa) {
            $siswa = CalonSiswa::where('id', $currentUser->calonSiswa->id)->first();
        }

        // Periksa jika calonSiswa ada sebelum mengakses id-nya
        if ($currentUser && $currentUser->calonSiswa) {
            $berkasTidakValid = BerkasSiswa::where('status', 'TIDAK_VALID')
                ->where('calon_siswa_id', $currentUser->calonSiswa->id)
                ->get();
        } else {
            $berkasTidakValid = collect(); // Mengembalikan koleksi kosong jika calonSiswa tidak ada
        }

        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->first();

        $hasPaid = false;

        if ($pendaftaran) {
            $hasPaid = Pembayaran::where('pendaftaran_id', $pendaftaran->id)
                ->where('status', 'lunas')
                ->exists();
        }

        $hasOpen = $tahunAjaran && $gelombang;
        $listBerkas = ListBerkas::where('aktif', 1)->get();
        $agama = Agama::all();
        $pendidikan = Pendidikan::all();
        $pekerjaan = Pekerjaan::all();
        $penghasilan = Penghasilan::all();

        // Kembalikan tampilan dengan data
        return view('pages.pendaftaran', compact('hasOpen', 'hasPaid', 'listBerkas', 'agama', 'penghasilan', 'pendidikan', 'pekerjaan', 'siswa', 'berkasTidakValid'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalonSiswaRequest $request)
    {
        DB::beginTransaction();
        try {
            $gelombang = Gelombang::current();
            $data = $request->validated();
            $currentUser = Auth::user();

            if (!$currentUser) {
                return back()->withErrors(['auth' => 'Tidak terautentikasi']);
            }

            // ===============================
            // ADMIN / SUPER ADMIN
            // ===============================
            if (in_array($currentUser->role, ['admin', 'super_admin'])) {

                // 1️⃣ BUAT USER BARU
                $user = User::create([
                    'username' => $data['nisn'],
                    'name' => $data['nama_lengkap'],
                    'email' => $data['email'],
                    'phone' => $data['telepon'],
                    'password' => Hash::make($data['nisn']),
                    'role' => 'siswa',
                ]);

                // 2️⃣ CALON SISWA
                $calonSiswa = CalonSiswa::create(array_merge($data, [
                    'user_id' => $user->id,
                ]));

                // 3️⃣ PENDAFTARAN
                $pendaftaran = Pendaftaran::create([
                    'user_id' => $user->id,
                    'calon_siswa_id' => $calonSiswa->id,
                    'tahun_ajaran_id' => TahunAjaran::current()->id,
                    'gelombang_id' => Gelombang::current()?->id,
                    'nomor_registrasi' => Pendaftaran::generateNoPendaftaran(
                        TahunAjaran::current()->id,
                        $gelombang->id
                    ),
                    'status' => 'DAFTAR',
                ]);

                // 4️⃣ PEMBAYARAN (AUTO LUNAS)
                Pembayaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'payment_method' => 'cash',
                    'amount' => $gelombang->registration_fee, // atau biaya formulir
                    'status' => 'LUNAS',
                    'payment_date' => now(),
                ]);

                // 5️⃣ BERKAS → AUTO VALID
                $this->handleBerkasUpload($request, $calonSiswa, 'VALID');

            }
            // ===============================
            // SISWA ISI SENDIRI
            // ===============================
            else {

                // Ambil pendaftaran milik siswa
                $pendaftaran = Pendaftaran::where('user_id', $currentUser->id)
                    ->firstOrFail();

                // Update / buat calon siswa
                $calonSiswa = CalonSiswa::updateOrCreate(
                    ['user_id' => $currentUser->id],
                    $data
                );

                // Update pendaftaran
                $pendaftaran->update([
                    'calon_siswa_id' => $calonSiswa->id
                ]);

                // Berkas → PERIKSA
                $this->handleBerkasUpload($request, $calonSiswa, 'PERIKSA');
            }

            DB::commit();

            return back()->with('success', 'Pendaftaran siswa berhasil diproses.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }




    protected function handleBerkasUpload(
        Request $request,
        CalonSiswa $calonSiswa,
        string $defaultStatus = 'PERIKSA'
    ) {
        $listBerkasIds = ListBerkas::where('aktif', true)->pluck('id');

        foreach ($listBerkasIds as $listBerkasId) {
            $fileInputName = 'file_berkas_' . $listBerkasId;

            if ($request->hasFile($fileInputName)) {

                $file = $request->file($fileInputName);

                BerkasSiswa::updateOrCreate(
                    [
                        'calon_siswa_id' => $calonSiswa->id,
                        'list_berkas_id' => $listBerkasId,
                    ],
                    [
                        'file_path' => $file->store('berkas'),
                        'status' => $defaultStatus,
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $siswa = CalonSiswa::findOrFail($id); // Mengambil siswa berdasarkan ID

            // Jika ingin menampilkan halaman view 'siswa.show' dengan data siswa
            return view('calon-siswa.show', compact('siswa'));

            // Atau langsung kirimkan data JSON jika ingin menampilkan dengan AJAX
            // return response()->json($siswa);

        } catch (\Exception $e) {
            // Tangani jika siswa tidak ditemukan atau terjadi kesalahan lainnya
            return redirect()->back()->with('error', 'Gagal menampilkan detail siswa: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function readNotifikasi(string $id)
    {
        try {
            // Temukan notifikasi berdasarkan ID-nya
            $notification = Notification::findOrFail($id);

            // Tandai notifikasi sebagai sudah dibaca dengan memperbarui timestamp read_at
            $notification->read_at = now();
            $notification->save();

            // Redirect ke rute calon-siswa.create dengan pesan sukses
            return redirect()->route('calon-siswa.create')->with('success', 'Notifikasi sudah dibaca');
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Redirect kembali dengan pesan error jika notifikasi tidak ditemukan
            return redirect()->route('calon-siswa.create')->with('error', 'Notification not found.')->withErrors(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error jika terjadi kesalahan
            return redirect()->route('calon-siswa.create')->with('error', 'An error occurred while marking the notification as read.')->withErrors(['error' => $e->getMessage()]);
        }
    }


}