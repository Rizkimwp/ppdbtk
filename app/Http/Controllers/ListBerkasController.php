<?php

namespace App\Http\Controllers;


use App\Models\ListBerkas;
use Illuminate\Http\Request;

class ListBerkasController extends Controller
{
    //
    public function index()
    {
        $items = ListBerkas::paginate(10); // Ubah sesuai dengan jumlah data yang ingin ditampilkan per halaman

        return view('pages.list_berkas', compact('items'));
    }

    public function findById() {
        $items = ListBerkas::all();
        return response()->json($items);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'aktif' => 'required|boolean',
            'wajib' => 'required|boolean',
        ]);

        try {
            ListBerkas::create($validated);

            return redirect()
                ->route('list-berkas.index')
                ->with('success', 'Berkas berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.', $e->getMessage());
        }


}
public function update(Request $request, $id)
{
    $request->validate([
        'edit_nama_berkas' => 'required|string|max:255',
        'edit_aktif' => 'required|boolean',
        'edit_wajib' => 'required|boolean',
    ]);

    try {
        $berkas = ListBerkas::findOrFail($id);
        $berkas->nama_berkas = $request->edit_nama_berkas;
        $berkas->aktif = $request->edit_aktif;
        $berkas->wajib = $request->edit_wajib;
        $berkas->update(); // Perubahan disini

        return redirect()->route('list-berkas.index')
                        ->with('success', 'Berkas berhasil diperbarui.');
    } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
    }
}


public function destroy($id)
{
    $berkas = BerkasSiswa::findOrFail($id);
    $berkas->delete();

    return redirect()->route('list-berkas.index')
                    ->with('success', 'Berkas berhasil dihapus.');
}

}