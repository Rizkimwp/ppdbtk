<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanPernyataan extends Model
{
    use HasFactory;

    protected $table = 'persetujuan_pernyataan';

    protected $fillable = [
        'calon_siswa_id',
        'pernyataan_id',
        'disetujui',
        'tanggal_persetujuan',
        'ip_address',
    ];

    protected $casts = [
        'disetujui' => 'boolean',
        'tanggal_persetujuan' => 'datetime',
    ];

    // 🔗 Relasi
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    public function pernyataan()
    {
        return $this->belongsTo(Pernyataan::class);
    }
}