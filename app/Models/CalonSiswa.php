<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agama;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;
use App\Models\Ruangan;
use App\Models\Gelombang;
use App\Models\Pekerjaan;
use App\Models\Pembayaran;
use App\Models\Pendidikan;
use App\Models\BerkasSiswa;
use App\Models\Penghasilan;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalonSiswa extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'calon_siswa';

    protected $fillable = [
        'nik',
        'nisn',
        'nomor_pendaftaran',
        'nama_lengkap',
        'nama_panggilan',
        'asal_sekolah',
        'tempat_lahir',
        'tanggal_lahir',
        'riwayat_hafalan',
        'umur',
        'id_agama',
        'jenis_kelamin',
        'alamat',
        'telepon',
        'email',
        'tinggi_badan',
        'berat_badan',
        'anak_ke',
        'status_dalam_keluarga',
        'nama_ayah',
        'tahun_lahir_ayah',
        'pekerjaan_ayah_id',
        'pendidikan_ayah_id',
        'nama_ibu',
        'tahun_lahir_ibu',
        'pekerjaan_ibu_id',
        'pendidikan_ibu_id',
        'penghasilan_orang_tua_id',
        'nama_wali',
        'nomor_wali',
        'pekerjaan_wali_id',
        'user_id',
    ];



    public function persetujuanPernyataan()
    {
        return $this->hasMany(PersetujuanPernyataan::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    public function ruangan()
    {
        return $this->belongsToMany(Ruangan::class, 'calon_siswa_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
    public function berkas()
    {
        return $this->hasMany(BerkasSiswa::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }
    public function pekerjaanAyah()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_ayah_id');
    }

    public function pendidikanAyah()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_ayah_id');
    }

    public function pekerjaanIbu()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_ibu_id');
    }

    public function pendidikanIbu()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_ibu_id');
    }

    public function penghasilanOrangTua()
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_orang_tua_id');
    }

    public function pekerjaanWali()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_wali_id');
    }


}