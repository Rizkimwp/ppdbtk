<?php

namespace App\Models;

use App\Models\CalonSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'agama';
    protected $fillable = [
        'nama_agama',
    ];

    public function calonSiswa()
    {
        return $this->hasMany(CalonSiswa::class, 'id_agama');
    }
}