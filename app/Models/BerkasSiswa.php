<?php

namespace App\Models;

use App\Models\CalonSiswa;
use App\Models\ListBerkas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasSiswa extends Model
{
    use HasFactory;
    protected $table = 'berkas_calon_siswa';
    protected $fillable = [
       'calon_siswa_id', 'list_berkas_id', 'file_path', 'status',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    public function listBerkas()
    {
        return $this->belongsTo(ListBerkas::class, 'list_berkas_id');
    }

    public function uploadFile($file)
    {
        if ($file) {
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas_siswa', $fileName, 'public');

            $this->file_path = $filePath;
            $this->save();

            return $filePath;
        }

        return null;
    }
}