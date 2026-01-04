<?php

namespace App\Models;

use App\Models\CalonSiswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Gelombang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'gelombang';

    protected $fillable = [
        'tahun_ajaran_id',
        'name',
        'start_date',
        'end_date',
        'quota',
        'registered_count',
        'registration_fee',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_fee' => 'decimal:2',
    ];

    /* ================= RELATION ================= */

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'gelombang_id');
    }

    /* ================= SCOPE ================= */

    /**
     * Gelombang dibuka manual
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Gelombang berjalan berdasarkan tanggal
     */
    public function scopeRunning($query)
    {
        return $query->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    /**
     * Gelombang aktif & tersedia
     */
    public function scopeAvailable($query)
    {
        return $query->open()
            ->running()
            ->whereColumn('registered_count', '<', 'quota');
    }

    /* ================= HELPER ================= */

    /**
     * Gelombang aktif saat ini
     */
    public static function current()
    {
        return self::available()->first();
    }

    /**
     * Cek apakah kuota penuh
     */
    public function isFull(): bool
    {
        return $this->registered_count >= $this->quota
            || $this->status === 'full';
    }
}