<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';

    protected $fillable = [
        'kelas_id', 'calon_siswa_id',
    ];


}
