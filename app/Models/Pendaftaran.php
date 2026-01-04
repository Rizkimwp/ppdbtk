<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class Pendaftaran extends Model
{
    use HasFactory, HasUuids;

    protected $table = "pendaftaran";
    protected $fillable = ['calon_siswa_id', 'gelombang_id', 'nomor_registrasi', 'status', 'tahun_ajaran_id', 'user_id'];


    /**
     * Relasi ke calon siswa
     * Nullable (diisi setelah bayar & isi form)
     */

     public static function generateNoPendaftaran(
        int $tahunAjaranId,
        int $gelombangId
    ): string {
        return DB::transaction(function () use ($tahunAjaranId, $gelombangId) {

            // Lock biar tidak dobel saat concurrent request
            $count = self::where('tahun_ajaran_id', $tahunAjaranId)
                ->where('gelombang_id', $gelombangId)
                ->lockForUpdate()
                ->count() + 1;

            $tahun = TahunAjaran::findOrFail($tahunAjaranId);
            $tahunLabel = str_replace('/', '', $tahun->tahun_ajaran);

            $noUrut = str_pad($count, 5, '0', STR_PAD_LEFT);

            return "PPDB-{$tahunLabel}-G{$gelombangId}-{$noUrut}";
        });
    }
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }

    /**
     * Relasi ke gelombang PPDB
     */
    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'gelombang_id');
    }

    /**
     * Relasi ke tahun ajaran
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    /**
     * Relasi ke pembayaran
     * 1 pendaftaran = 1 pembayaran
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}