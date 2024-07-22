<?php

namespace App\Http\Controllers;

use App\Models\Agama;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = CalonSiswa::query();
    // $gelombangList = Gelombang::with('tahunAjaran')->get();

    // // Cari berdasarkan gelombang
    // $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();

    // if ($activeTahunAjaran) {
    //     $gelombangId = $request->input('gelombang_id', Gelombang::where('tahun_ajaran_id', $activeTahunAjaran->id)->value('id'));
    //     $query->where('gelombang_id', $gelombangId);
    // } else {

    //     return response()->view('pages.siswa', compact('gelombangList'))->withErrors('Tidak ada tahun ajaran aktif.');
    // }

    // Cari berdasarkan nama
    if ($request->filled('nama')) {
        $query->where('nama_lengkap', 'like', '%' . $request->input('nama') . '%');
    }

    $siswa = $query->paginate(5);

    return view('pages.siswa', compact('siswa'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listBerkas = ListBerkas::where('aktif', 1)->get();
        $agama = Agama::all();
        $pendidikan = Pendidikan::all();
        $pekerjaan = Pekerjaan::all();
        $penghasilan = Penghasilan::all();
    return view('pages.pendaftaran', compact('listBerkas', 'agama', 'penghasilan', 'pendidikan', 'pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'umur' => 'required|string',
            'id_agama' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'tinggi_badan' => 'required|string',
            'berat_badan' => 'required|string',
            'anak_ke' => 'required|string|min:1',
            'status_dalam_keluarga' => 'required|string|max:50',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah_id' => 'required|integer',
            'pendidikan_ayah_id' => 'required|integer',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu_id' => 'required|integer',
            'pendidikan_ibu_id' => 'required|integer',
            'penghasilan_orang_tua_id' => 'required|integer',
            'nama_wali' => 'nullable|string|max:255',
            'nomor_wali' => 'nullable|string|max:15',
            'pekerjaan_wali_id' => 'nullable|integer',
            'tahun_lahir_ayah' => 'required',
            'tahun_lahir_ibu' => 'required',
        ]);

        try {
            $tahun = TahunAjaran::where('status', 'aktif')->first();

            if (!$tahun) {
                return back()->with('error', 'Tidak ada tahun ajaran tersedia');
            }

            // Ambil tahun ajaran dan gelombang
            $idGelombang = $tahun->id; // Ambil nama gelombang pertama
            $noPendaftaran = CalonSiswa::generateNoPendaftaran();

            // Dapatkan pengguna yang sedang login
            $currentUser = Auth::user();
            $userId = null;

            if ($currentUser->role === 'siswa') {
                // Jika perannya siswa, gunakan user_id dari pengguna yang sedang login
                $userId = $currentUser->id;
            } elseif (in_array($currentUser->role, ['admin', 'super_admin'])) {
                // Jika perannya admin atau super_admin, buat pengguna baru
                $newUser = User::create([
                    'username' => $validator['nik'],
                    'name' => $validator['nama_lengkap'],
                    'email' => $validator['email'],
                    'password' => Hash::make('12345678'),
                    'role' => 'siswa',
                ]);

                $userId = $newUser->id;
            } else {
                // Jika perannya tidak sesuai, kembalikan respon error
                return redirect()->back()->withErrors(['role' => 'Invalid role.']);
            }

            // Simpan data calon siswa
            $calonSiswa = new CalonSiswa($validator);
            $calonSiswa->nomor_pendaftaran = $noPendaftaran;
            $calonSiswa->tahun_ajaran_id = $idGelombang;
            $calonSiswa->user_id = $userId;
            $calonSiswa->save();

            // Handle file uploads for documents (BerkasSiswa)
            $this->handleBerkasUpload($request, $calonSiswa);
            $uuid = Uuid::uuid4()->toString();
            $pembayaran = new Pembayaran();
            $pembayaran->payment_method = '';
            $pembayaran->status = 'belum_lunas'; // Or any default status you want
            $pembayaran->transaction_id = $uuid; // Update this with actual transaction ID if available
            $pembayaran->calon_siswa_id = $calonSiswa->id;
            $pembayaran->save();

            Session::flash('success', 'Data siswa berhasil ditambahkan.');

            return redirect()->route('calon-siswa.create');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }





protected function handleBerkasUpload(Request $request, CalonSiswa $calonSiswa)
{
    $listBerkasIds = ListBerkas::where('aktif', true)->pluck('id');

    foreach ($listBerkasIds as $listBerkasId) {
        $fileInputName = 'file_berkas_' . $listBerkasId;

        if ($request->hasFile($fileInputName)) {
            $berkas = new BerkasSiswa();
            $berkas->calon_siswa_id = $calonSiswa->id;
            $berkas->list_berkas_id = $listBerkasId;
            $berkas->uploadFile($request->file($fileInputName));
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
}