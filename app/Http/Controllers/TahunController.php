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
    try {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak_aktif'])],
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Custom validation rules
        if (TahunAjaran::where('selesai', '>', $request->mulai)->where('mulai', '<=', $request->mulai)->exists()) {
            return back()->with('error' ,'Tanggal mulai tidak boleh dalam range tahun ajaran yang belum selesai.');
        }

        if (TahunAjaran::whereBetween('mulai', [$request->mulai, $request->selesai])->orWhereBetween('selesai', [$request->mulai, $request->selesai])->exists()) {
            return back()->with('error' ,'Tanggal mulai dan selesai tidak boleh bersinggungan dengan tahun ajaran yang sudah ada.');
        }

        if ($request->mulai > $request->selesai) {
            return back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
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
    } catch (\Exception $e) {
        return redirect()->route('tahun-ajaran.index')->with('error', 'Terjadi kesalahan');
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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'edit_tahun_ajaran' => ['required', 'string', 'max:255'],
            'edit_status' => ['required', Rule::in(['aktif', 'tidak_aktif'])],
            'edit_mulai' => 'required|date',
            'edit_selesai' => 'required|date|after_or_equal:edit_mulai', // Validasi tanggal selesai harus setelah atau sama dengan tanggal mulai
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Custom validation rules
        // 1. Tanggal mulai tidak boleh dalam range tahun ajaran yang belum selesai
        if (TahunAjaran::where('selesai', '>', $request->edit_mulai)
            ->where('mulai', '<=', $request->edit_mulai)
            ->where('id', '!=', $id) // Mengecualikan tahun ajaran yang sedang diupdate
            ->exists()) {
            return back()->with('error', 'Tanggal mulai tidak boleh dalam range tahun ajaran yang belum selesai.');
        }

        // 2. Cek jika tanggal mulai dan selesai bersinggungan dengan tahun ajaran lain
        if (TahunAjaran::where(function ($query) use ($request) {
                $query->whereBetween('mulai', [$request->edit_mulai, $request->edit_selesai])
                      ->orWhereBetween('selesai', [$request->edit_mulai, $request->edit_selesai])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('mulai', '<=', $request->edit_mulai)
                            ->where('selesai', '>=', $request->edit_selesai);
                      });
            })
            ->where('id', '!=', $id) // Mengecualikan tahun ajaran yang sedang diupdate
            ->exists()) {
            return back()->with('error', 'Tanggal mulai dan selesai tidak boleh bersinggungan dengan tahun ajaran yang sudah ada.');
        }

        // 3. Update data tahun ajaran
        try {
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

            // Update data tahun ajaran
            $tahunAjaran->tahun_ajaran = $request->edit_tahun_ajaran;
            $tahunAjaran->status = $request->edit_status;
            $tahunAjaran->mulai = $request->edit_mulai;
            $tahunAjaran->selesai = $request->edit_selesai;
            $tahunAjaran->save();

            return redirect()->route('tahun-ajaran.index')
                ->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
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
