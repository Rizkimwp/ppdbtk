<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function siswa()
    {
        $tahunAjaran = TahunAjaran::current();
        $gelombang   = Gelombang::current();

        return view('pages.dashboard_siswa', compact('tahunAjaran', 'gelombang'));
    }

    public function admin()
    {
        $tahunAjaran = TahunAjaran::current();
        $gelombang   = Gelombang::current();

        return view('pages.dashboard_admin', compact('tahunAjaran', 'gelombang'));
    }
}