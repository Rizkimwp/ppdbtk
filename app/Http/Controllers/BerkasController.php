<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\CalonSiswa;
use App\Models\BerkasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ValidasiSelesaiNotification;
use Illuminate\Support\Facades\Log;
class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = CalonSiswa::query();
    $tahunAjaranList = TahunAjaran::get();

    // Cari berdasarkan gelombang
    $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();

    if ($activeTahunAjaran) {
        $tahunAjaranId = $request->input('tahun_ajaran_id', TahunAjaran::where('id', $activeTahunAjaran->id)->value('id'));
        $query->where('tahun_ajaran_id', $tahunAjaranId);
    } else {

        return view('pages.validasi', compact('tahunAjaranList'))->withErrors('Tidak ada tahun ajaran aktif.');
    }

    // Cari berdasarkan nama
    if ($request->filled('nama')) {
        $query->where('nama_lengkap', 'like', '%' . $request->input('nama') . '%');
    }

    $siswa = $query->paginate(5);

    return view('pages.validasi', compact('siswa', 'tahunAjaranList', 'tahunAjaranId'));
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
    public function uploadUlang(Request $request, $id)
    {
        $berkas = BerkasSiswa::findOrFail($id);

        if ($request->hasFile('file_berkas')) {
            // Hapus file lama jika ada
            if ($berkas->file_path && file_exists(public_path($berkas->file_path))) {
                unlink(public_path($berkas->file_path));
            }

            // Simpan file baru
            $file = $request->file('file_berkas');
            $filePath = $file->store('berkas_siswa', 'public');

            // Update path dan status berkas
            $berkas->file_path = $filePath;
            $berkas->status = 'PERIKSA'; // Ubah status menjadi diperiksa atau sesuai kebutuhan
            $berkas->save();
        }

        return redirect()->back()->with('success', 'Berkas berhasil diunggah ulang.');
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
            // Validasi input status
            $request->validate([
                'status' => 'required|string', // Add validation for allowed values
            ]);

            // Cari berkas berdasarkan ID
            $berkas = BerkasSiswa::findOrFail($id);

            // Update status
            $berkas->status = $request->input('status');
            $berkas->save();

            // Cari calon siswa berdasarkan ID
            $calonSiswa = CalonSiswa::find($berkas->calon_siswa_id);

            if ($calonSiswa && $calonSiswa->user) {
                $user = $calonSiswa->user;

                // Menentukan title dan message berdasarkan status validasi
                if ($berkas->status === 'VALID') {
                    $title = 'Validasi Berkas Selesai';
                    $message = 'Berkas Anda telah divalidasi dan dianggap valid.';
                } else {
                    $title = 'Validasi Berkas Gagal';
                    $message = 'Berkas Anda tidak valid. Silakan periksa kembali dan unggah ulang.';
                }

                $data = [
                    'nama_berkas' => $berkas->listBerkas->nama_berkas ?? 'Berkas Tidak Ditemukan', // Ensure this relationship is defined
                    'status' => $berkas->status,
                    'title' => $title,
                    'message' => $message,
                ];

                Notification::send($user, new ValidasiSelesaiNotification($data));
            }

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Berkas atau calon siswa tidak ditemukan.' . $e);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Validasi gagal.' . $e);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.' . $e);
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