<?php

namespace App\Models;

use App\Models\Gelombang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $fillable = [
        'tahun_ajaran', 'status',
    ];

    public function gelombang()
    {
        return $this->hasMany(Gelombang::class);
    }
}