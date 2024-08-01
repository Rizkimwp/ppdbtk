<?php

namespace App\Models;


use App\Models\Kelas;
use App\Models\CalonSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';

    protected $fillable = [
        'kelas_id', 'calon_siswa_id',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    public function siswa() {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }
}