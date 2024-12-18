<?php

namespace App\Models;

use App\Models\Gelombang;
use App\Models\CalonSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $fillable = [
        'tahun_ajaran', 'status', 'mulai', 'selesai',
    ];

    public function siswa()
    {
        return $this->hasMany(CalonSiswa::class, 'tahun_ajaran_id');
    }
}