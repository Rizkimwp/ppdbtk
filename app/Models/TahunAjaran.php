<?php

namespace App\Models;

use App\Models\Gelombang;
use App\Models\CalonSiswa;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tahun_ajaran';
    protected $fillable = [
        'tahun_ajaran', 'status', 'mulai', 'selesai',
    ];

    public function gelombang()
    {
        return $this->hasMany(Gelombang::class, 'tahun_ajaran_id');
    }


    public function siswa()
    {
        return $this->hasMany(CalonSiswa::class, 'tahun_ajaran_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * 🔥 Helper method (opsional)
     * Tahun ajaran aktif saat ini
     */
    public static function current()
    {
        return self::active()->first();
    }
}