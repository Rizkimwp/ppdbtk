<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\CalonSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil semua daftar tahun ajaran
    $tahunAjaranList = TahunAjaran::get();

    // Ambil tahun ajaran ID dari request atau gunakan yang aktif secara default
    $tahunAjaranId = $request->input('tahun_ajaran_id') ?: TahunAjaran::where('status', 'aktif')->first()->id;

    // Ambil data ruangan berdasarkan tahun ajaran
    $ruangan = Ruangan::with('kelas')
        ->whereHas('siswa', function($query) use ($tahunAjaranId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId);
        })
        ->get();

    // Hitung jumlah siswa per kelas
    $kelasCounts = $ruangan->groupBy('kelas_id')->map(function($group) {
        return $group->count();
    });

    // Kirim data ke view
    return view('pages.ruangan', compact('tahunAjaranList', 'tahunAjaranId', 'ruangan', 'kelasCounts'));
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
        $req = $request->validate([
            'tahun_ajaran_id' => 'required',
            'jumlah' => 'required|min:1'
        ]);

        try {
            $calonSiswas = CalonSiswa::where('tahun_ajaran_id', $request->tahun_ajaran_id)
                          ->whereHas('pembayaran', function($query) {
                              $query->where('status', 'lunas');
                          })
                          ->get();

            $jumlahCalonSiswa = $calonSiswas->count();
            $jumlahKapasitas = $request->jumlah;
            // Ambil semua ruangan
            $ruanganList = Ruangan::all();
                          // Periksa apakah ada ruangan yang sudah digenerate pada tahun ajaran ini
            foreach ($ruanganList as $ruangan) {
        if ($ruangan->calon_siswa_id) {
            $calonSiswa = CalonSiswa::find($ruangan->calon_siswa_id);
            if ($calonSiswa && $calonSiswa->tahun_ajaran_id == $request->tahun_ajaran_id) {
                return redirect()->back()->with('error', 'Kelas Sudah Digenerate Pada Tahun Ajaran Ini');
            }
        }
    }

            // Ambil kelas yang sudah dibuat sebelumnya
            $kelasList = Kelas::all();
            $jumlahKelas = $kelasList->count();

            if ($jumlahCalonSiswa == 0) {
                return redirect()->back()->with('error', 'Tidak ada Calon Siswa Pada Tahun Ajaran Ini.');
            }

            if ($jumlahKelas == 0) {
                return redirect()->back()->with('error', 'Tidak ada kelas yang tersedia.');
            }

            // Periksa apakah jumlah kelas cukup untuk menampung semua calon siswa
            if ($jumlahKelas * $jumlahKapasitas < $jumlahCalonSiswa) {
                return redirect()->back()->with('error', 'Jumlah kelas tidak cukup untuk menampung semua calon siswa.');
            }

            // Distribusikan calon siswa ke dalam kelas yang ada
            $calonSiswaIndex = 0;
            foreach ($kelasList as $kelas) {
                for ($j = 0; $j < $jumlahKapasitas && $calonSiswaIndex < $jumlahCalonSiswa; $j++) {
                    $calonSiswa = $calonSiswas[$calonSiswaIndex];
                    $ruangan = new Ruangan();
                    $ruangan->calon_siswa_id = $calonSiswa->id;
                    $ruangan->kelas_id = $kelas->id;
                    // Set atribut lain yang diperlukan
                    $ruangan->save();
                    $calonSiswaIndex++;
                }
            }

            return redirect()->route('ruangan.index')->with('success', 'Ruangan Berhasil Di Generate');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Ruangan Tidak Berhasil Di Generate'. $e);
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

    public function findSiswaByKelas(string $id)
    {
        // Ambil data ruangan berdasarkan kelas_id
        $ruangan = Ruangan::with('siswa')
        ->where('kelas_id', $id)
        ->get();

    $siswa = $ruangan->map(function($item) {
        return $item->siswa;
    })->flatten(); // Use flatten if you have nested collections

    return response()->json($siswa);
    }

    public function generateRuang()
    {
        // Ambil semua ruangan beserta siswa yang memiliki siswa
        $ruangan = Ruangan::with(['siswa', 'kelas'])->whereHas('siswa')->get();

        // Load view dengan data yang diperlukan
        $view = view('utils.pdf', compact('ruangan'))->render();

        // Buat instance Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($view);

        // Setup ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'portrait');

        // Render HTML menjadi PDF
        $pdf->render();

        // Outputkan PDF yang dihasilkan (inline view atau download)
        return $pdf->stream('calon_siswa.pdf');
    }
}
