<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::query();
        $gelombangList = Gelombang::with('tahunAjaran')->get();

        // Cari berdasarkan tahun ajaran aktif
        $activeTahunAjaran = TahunAjaran::where('status', 'aktif')->first();

        if ($activeTahunAjaran) {
            $gelombangId = $request->input('gelombang_id', Gelombang::where('tahun_ajaran_id', $activeTahunAjaran->id)->value('id'));

            if ($gelombangId) {
                // Filter pembayaran berdasarkan gelombang
                $query->whereHas('calonsiswa', function ($q) use ($gelombangId) {
                    $q->where('gelombang_id', $gelombangId);
                });
            }
        } else {
            return response()->view('pages.pembayaran', compact('gelombangList'))->withErrors('Tidak ada tahun ajaran aktif.');
        }

        // Cari berdasarkan nama
        if ($request->filled('nama')) {
            $query->whereHas('calonsiswa', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->input('nama') . '%');
            });
        }

        // Paginate the results
        $pembayaran = $query->paginate($request->input('per_page', 5));

        return view('pages.pembayaran', compact('pembayaran', 'gelombangList', 'gelombangId'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}