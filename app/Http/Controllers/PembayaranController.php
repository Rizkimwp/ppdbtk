<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pembayaranSiswa() {
        $currentUser = Auth::user();
        $pembayaran = Pembayaran::where('calon_siswa_id', $currentUser->calonsiswa->id)->first();
        return view('pages.pembayaran_siswa', compact('pembayaran'));
    }

    public function index(Request $request)
    {
        $query = Pembayaran::query();
        $tahunAjaranList = TahunAjaran::get();

        // Cari berdasarkan tahun ajaran aktif
        $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();

        if ($activeTahunAjaran) {
            $tahunAjaranId = $request->input('tahun_ajaran_id', TahunAjaran::where('id', $activeTahunAjaran->id)->value('id'));

            if ($tahunAjaranId) {
                // Filter pembayaran berdasarkan gelombang
                $query->whereHas('calonsiswa', function ($q) use ($tahunAjaranId) {
                    $q->where('tahun_ajaran_id', $tahunAjaranId);
                });
            }
        } else {
            return response()->view('pages.pembayaran', compact('tahunAjaranList'))->withErrors('Tidak ada tahun ajaran aktif.');
        }

        // Cari berdasarkan nama
        if ($request->filled('nama')) {
            $query->whereHas('calonsiswa', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->input('nama') . '%');
            });
        }

        // Paginate the results
        $pembayaran = $query->paginate($request->input('per_page', 5));

        return view('pages.pembayaran', compact('pembayaran', 'tahunAjaranList', 'tahunAjaranId'));
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
    public function update(Request $request, $id){
        try {
            $validatedData = $request->validate([
                'status' => 'required', // Adjust validation as needed
            ]);

            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update($validatedData);
            return redirect()->back()->with('success', 'Pembayaran Berhasil Di Perbarui');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal Memperbarui Pembayaran: ' . $e->getMessage());
        }
    }

    public function uploadsiswa(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'file_path' => 'required|file|mimes:pdf,jpeg,png|max:2048', // Adjust validation as needed
            ]);

            // Find the pembayaran record by ID
            $pembayaran = Pembayaran::findOrFail($id);

            // Handle file upload
if ($request->hasFile('file_path')) {
    // Delete the old file if it exists
    if ($pembayaran->file_path && Storage::exists($pembayaran->file_path)) {
        Storage::delete($pembayaran->file_path);
    }
    // Store the new file
    $uploadedFile = $request->file('file_path');
    $filePath = $uploadedFile->storeAs('berkas_siswa', $uploadedFile->getClientOriginalName(), 'public');
    // Update file_path in validated data
    $validatedData['file_path'] = $filePath;
}
            // Update the pembayaran record with validated data
            $pembayaran->update($validatedData);

            // Set additional fields
            $pembayaran->payment_method = 'Transfer';
            $pembayaran->status = 'pending';
            $pembayaran->save();

            // Redirect or respond as needed
            return redirect()->back()->with('success', 'Upload Bukti Pembayaran Berhasil');

        } catch (Exception $e) {
            // Handle exception and return error response
            return redirect()->back()->with('error', 'Failed to update pembayaran: ' . $e->getMessage());
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
