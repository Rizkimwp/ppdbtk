<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\CalonSiswa;
use App\Models\BerkasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = CalonSiswa::query();
    $gelombangList = Gelombang::with('tahunAjaran')->get();

    // Cari berdasarkan gelombang
    $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();

    if ($activeTahunAjaran) {
        $gelombangId = $request->input('gelombang_id', Gelombang::where('tahun_ajaran_id', $activeTahunAjaran->id)->value('id'));
        $query->where('gelombang_id', $gelombangId);
    } else {

        return response()->view('pages.validasi', compact('gelombangList'))->withErrors('Tidak ada tahun ajaran aktif.');
    }

    // Cari berdasarkan nama
    if ($request->filled('nama')) {
        $query->where('nama_lengkap', 'like', '%' . $request->input('nama') . '%');
    }

    $siswa = $query->paginate(5);

    return view('pages.validasi', compact('siswa', 'gelombangList', 'gelombangId'));
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
        // Validasi input status
        $request->validate([
            'status' => 'required|string',
        ]);

        // Cari berkas berdasarkan ID
        $berkas = BerkasSiswa::findOrFail($id);

        // Update status
        $berkas->status = $request->input('status');
        $berkas->save();

        // Mengembalikan respons
        return response()->json([
            'message' => 'Status updated successfully',
            'berkas' => $berkas
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}