<?php

namespace App\Models;

use App\Models\CalonSiswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gelombang extends Model
{
    use HasFactory;
    protected $table = 'gelombang';
    protected $fillable = [
        'tahun_ajaran_id', 'gelombang', 'mulai', 'selesai',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
    public function siswa()
    {
        return $this->hasMany(CalonSiswa::class, 'gelombang_id');
    }
}