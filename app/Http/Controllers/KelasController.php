<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('pages.kelas', compact('kelas'));
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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'limit' => 'required|integer',
        ]);

        try{
        $kelas = Kelas::create($validatedData);

        return redirect()->back()->with('succcess', 'Kelas Berhasil Di Buat'); }
     catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
    }
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
    $validatedData = $request->validate([
        'edit_nama' => 'required|string|max:255',
        'edit_limit' => 'required|integer',
    ]);

    try {
        $kelas = Kelas::findOrFail($id);
        $kelas->nama = $request->edit_nama;
        $kelas->limit = $request->edit_limit;
        $kelas->update();

        return redirect()->back()->with('success', 'Kelas Berhasil Diperbarui');
    } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $kelas = Kelas::findOrFail($id);
    $kelas->delete();

    return redirect()->route('kelas.index')
                    ->with('success', 'Berkas berhasil dihapus.');
}
}