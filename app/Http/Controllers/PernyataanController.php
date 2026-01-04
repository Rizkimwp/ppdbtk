<?php

namespace App\Http\Controllers;

use App\Models\Pernyataan;
use Illuminate\Http\Request;

class PernyataanController extends Controller
{
    //

    public function index()
    {
        $pernyataan = Pernyataan::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.pernyataan', compact('pernyataan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'wajib' => 'nullable|boolean',
            'aktif' => 'nullable|boolean',
        ]);

        Pernyataan::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'wajib' => $request->boolean('wajib'),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pernyataan berhasil ditambahkan.');
    }
    public function update(Request $request, Pernyataan $pernyataan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'wajib' => 'nullable|boolean',
            'aktif' => 'nullable|boolean',
        ]);

        $pernyataan->update([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'wajib' => $request->boolean('wajib'),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pernyataan berhasil diperbarui.');
    }
    public function destroy(Pernyataan $pernyataan)
    {
        $pernyataan->delete();

        return redirect()
            ->back()
            ->with('success', 'Pernyataan berhasil dihapus.');
    }

}