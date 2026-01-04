<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pernyataan extends Model
{
    use HasFactory;

    protected $table = 'pernyataan';

    protected $fillable = [
        'judul',
        'isi',
        'wajib',
        'aktif',
    ];

    protected $casts = [
        'wajib' => 'boolean',
        'aktif' => 'boolean',
    ];

    // 🔗 Relasi ke persetujuan
    public function persetujuan()
    {
        return $this->hasMany(PersetujuanPernyataan::class);
    }

    // 🔎 Helper: pernyataan aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}