<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGelombangRequest;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GelombangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = TahunAjaran::all();
        $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();
        $tahunAjaranId = $request->query('tahun_ajaran_id', $activeTahunAjaran ? $activeTahunAjaran->id : null);

        $gelombangs = Gelombang::where('tahun_ajaran_id', $tahunAjaranId)->get();

        return view('pages.gelombang', compact('items', 'gelombangs', 'tahunAjaranId'));
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
    public function store(StoreGelombangRequest $request)
    {
        try {
            Gelombang::create($request->validated());

            return redirect()->back()
                ->with('success', 'Data gelombang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan gelombang: ' . $e->getMessage());
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
    $validator = Validator::make($request->all(), [
        'edit_mulai' => ['required', 'date'],
        'edit_selesai' => ['required', 'date', 'after_or_equal:edit_mulai'],
    ]);

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

    $tahunAjaran = Gelombang::findOrFail($id);
    $tahunAjaran->mulai = $request->edit_mulai;
    $tahunAjaran->selesai = $request->edit_selesai;
    $tahunAjaran->save();

    return redirect()->route('gelombang.index') // Ganti dengan nama route redirect setelah update
                    ->with('success', 'Data berhasil diperbarui.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    try {
        // Cari data berdasarkan ID
        $item = Gelombang::findOrFail($id);

        // Hapus data
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}

}