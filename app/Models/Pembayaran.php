<?php

namespace App\Models;

use App\Models\CalonSiswa;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory, HasUuids;
    protected $table = "pembayaran";
    protected $fillable = ['payment_method', 'amount', 'status', 'pendaftaran_id', 'file_path', 'payment_date'];

    public function calonsiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}