<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = TahunAjaran::all();

        // Memeriksa apakah $items kosong
        if ($items->isEmpty()) {
            $items = null; // Set nilai $items menjadi null jika kosong
        } else {
            foreach ($items as $item) {
                $currentDate = strtotime(date('Y-m-d'));
                $startDate = strtotime($item->mulai);
                $endDate = strtotime($item->selesai);

                $item->is_active = ($currentDate >= $startDate) && ($currentDate <= $endDate);
            }
        }

        return view('pages.tahun_ajaran', compact('items'));
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
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak_aktif'])],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah ada tahun ajaran lain yang aktif
        if ($request->status == 'aktif') {
            $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();
            if ($activeTahunAjaran) {
                // Jika ada yang aktif, ubah menjadi tidak aktif
                $activeTahunAjaran->status = 'tidak_aktif';
                $activeTahunAjaran->save();
            }
        }

        // Simpan data tahun ajaran baru
        TahunAjaran::create($request->all());

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Data berhasil disimpan.');
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
            'edit_tahun_ajaran' => ['required', 'string', 'max:255'],
            'edit_status' => ['required',  Rule::in(['aktif', 'tidak_aktif'])],
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
          }

        $tahunAjaran = TahunAjaran::findOrFail($id);

         // Cek apakah status baru adalah aktif
    if ($request->edit_status == 'aktif') {
        // Cari tahun ajaran yang saat ini aktif (kecuali yang sedang diupdate)
        $activeTahunAjaran = TahunAjaran::where('status', 'aktif')
            ->where('id', '!=', $tahunAjaran->id)
            ->first();

        // Jika ada yang aktif, ubah statusnya menjadi tidak aktif
        if ($activeTahunAjaran) {
            $activeTahunAjaran->status = 'tidak_aktif';
            $activeTahunAjaran->save();
        }
    }
        $tahunAjaran->tahun_ajaran = $request->edit_tahun_ajaran;
        $tahunAjaran->status = $request->edit_status;
        $tahunAjaran->save();

        return redirect()->route('tahun-ajaran.index') // Ganti dengan nama route redirect setelah update
                        ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->delete();

        return redirect()->route('tahun-ajaran.index') // Ganti dengan nama route redirect setelah delete
                        ->with('success', 'Data berhasil dihapus.');
    }
}