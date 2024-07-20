<?php

namespace App\Models;

use App\Models\BerkasSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_berkas', 'aktif', 'wajib',
    ];
    public function berkasSiswa()
    {
        return $this->hasMany(BerkasSiswa::class, 'list_berkas_id');
    }
}
