<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUploadBukti;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Gelombang;
use App\Models\Pembayaran;
use App\Models\BerkasSiswa;
use App\Models\TahunAjaran;
use Date;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ValidasiSelesaiNotification;
use Illuminate\Support\Str;
class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pembayaranSiswa()
    {
        $user = Auth::user();


        $tahunAjaran = TahunAjaran::current();
        $gelombang = Gelombang::current();

        // Default
        $pendaftaran = null;
        $pembayaran = null;

        // Jika sudah punya calon siswa
        if ($tahunAjaran && $gelombang) {

            $pendaftaran = Pendaftaran::where('user_id', $user->id)
                ->where('tahun_ajaran_id', $tahunAjaran->id)
                ->where('gelombang_id', $gelombang->id)
                ->first();

            if ($pendaftaran) {
                $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)
                    ->latest()
                    ->first();
            }
        }

        return view('pages.pembayaran_siswa', compact(
            'pembayaran',
            'pendaftaran',
            'tahunAjaran',
            'gelombang'
        ));
    }



    public function index(Request $request)
    {
        $query = Pembayaran::query();

        /**
         * =========================
         * FILTER TAHUN AJARAN
         * =========================
         */
        if ($request->filled('tahun_ajaran_id')) {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('tahun_ajaran_id', $request->tahun_ajaran_id);
            });
        }

        /**
         * =========================
         * FILTER BULAN
         * =========================
         */
        if ($request->filled('bulan')) {
            $query->whereMonth('payment_date', $request->bulan);
        }

        /**
         * =========================
         * FILTER NAMA
         * - Jika calon siswa SUDAH ADA → filter ke nama calon siswa
         * - Jika BELUM ADA → tetap tampil
         * =========================
         */
        if ($request->filled('nama')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('pendaftaran.calonSiswa', function ($cs) use ($request) {
                    $cs->where('nama_lengkap', 'like', '%' . $request->nama . '%');
                });
            });
        }

        /**
         * =========================
         * FILTER STATUS
         * =========================
         */
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /**
         * =========================
         * LOAD RELASI (NULL SAFE)
         * =========================
         */
        $pembayaran = $query
            ->with([
                'pendaftaran:id,user_id,calon_siswa_id,tahun_ajaran_id',
                'pendaftaran.calonSiswa:id,nama_lengkap',
                'pendaftaran.user:id,name,phone',
            ])
            ->latest('payment_date')
            ->paginate(10)
            ->withQueryString();

        return view('pages.pembayaran', compact('pembayaran'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'status' => 'required', // Adjust validation as needed
            ]);

            // Find the Pembayaran record by ID
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update($validatedData);
            $pendaftaran = Pendaftaran::find($pembayaran->pendaftaran_id);
            // Assume you want to notify the user associated with this payment
            $user = User::find($pendaftaran->user_id); // Adjust based on your relationship


            if ($user) {
                // Determine the notification title based on the payment status
                $title = $pembayaran->status === 'lunas' ? 'Bukti Pembayaran Valid' : ($pembayaran->status === 'gagal' ? 'Bukti Pembayaran Tidak Valid' : 'Pembayaran Diperbarui');

                // Prepare notification data
                $data = [
                    'nama_berkas' => 'Pendaftaran', // Adjust as needed
                    'status' => $pembayaran->status,
                    'title' => $title,
                    'message' => 'Status Pembayaran telah diperbarui.',
                ];

                // Send notification
                Notification::send($user, new ValidasiSelesaiNotification($data));
            }


            // Redirect back with success message
            return redirect()->back()->with('success', 'Pembayaran Berhasil Di Perbarui');
        } catch (\Throwable $e) {
            // Redirect back with error message in case of exception
            return redirect()->back()->with('error', 'Gagal Memperbarui Pembayaran: ' . $e->getMessage());
        }
    }


    public function uploadsiswa(ValidateUploadBukti $request)
    {
        try {
            $validatedData = $request->validated();

            DB::beginTransaction();
            $tahunAjaran = TahunAjaran::active()->firstOrFail();
            $gelombang = Gelombang::current();

            // 1️⃣ BUAT PENDAFTARAN DULU
            $pendaftaran = Pendaftaran::create([
                'tahun_ajaran_id' => $tahunAjaran->id,
                'gelombang_id' => $gelombang->id,
                'nomor_registrasi' => Pendaftaran::generateNoPendaftaran(
                    $tahunAjaran->id,
                    $gelombang->id
                ),
                'status' => 'pending',
                'user_id' => Auth::id(),
                'calon_siswa_id' => null,
            ]);

            // 2️⃣ UPLOAD FILE
            $filePath = null;

            if ($request->hasFile('file_path')) {

                $file = $request->file('file_path');

                $extension = $file->getClientOriginalExtension();

                $fileName = 'bukti-transfer-'
                    . $pendaftaran->nomor_registrasi
                    . '-' . time()
                    . '.' . $extension;

                $filePath = $file->storeAs(
                    'berkas_siswa',
                    $fileName,
                    'public'
                );
            }

            // 3️⃣ SIMPAN PEMBAYARAN (TERHUBUNG KE PENDAFTARAN)
            Pembayaran::create([
                'pendaftaran_id' => $pendaftaran->id,
                'payment_method' => 'Transfer',
                'amount' => $validatedData['amount'],
                'status' => 'pending',
                'payment_date' => Date::now(),
                'file_path' => $filePath,
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(
                'error',
                'Gagal upload pembayaran: ' . $e->getMessage()
            );
        }
    }


    public function uploadUlangPembayaran(ValidateUploadBukti $request)
    {
        try {
            $validatedData = $request->validated();

            // Ambil pendaftaran terbaru user
            $pendaftaran = Pendaftaran::where('user_id', Auth::id())
                ->whereHas('pembayaran', function ($q) {
                    $q->where('status', 'gagal'); // hanya yang gagal
                })
                ->latest()
                ->firstOrFail();

            // Ambil pembayaran terkait
            $pembayaran = $pendaftaran->pembayaran()->where('status', 'gagal')->firstOrFail();

            DB::beginTransaction();

            // 1️⃣ Upload file baru
            if ($request->hasFile('file_path')) {

                // Hapus file lama jika ada
                if ($pembayaran->file_path && \Storage::disk('public')->exists($pembayaran->file_path)) {
                    \Storage::disk('public')->delete($pembayaran->file_path);
                }

                $file = $request->file('file_path');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'bukti-transfer-' . $pendaftaran->nomor_registrasi . '-' . time() . '.' . $extension;

                $filePath = $file->storeAs('berkas_siswa', $fileName, 'public');

                // 2️⃣ Update pembayaran
                $pembayaran->update([
                    'file_path' => $filePath,
                    'status' => 'pending', // reset ke pending
                    'payment_date' => now(),
                ]);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Bukti pembayaran berhasil diupload ulang, menunggu verifikasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(
                'error',
                'Gagal upload ulang pembayaran: ' . $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}