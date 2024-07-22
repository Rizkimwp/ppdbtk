<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calon_siswa_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->date('tanggal_lahir');
            $table->integer('umur');
            $table->foreignId('id_agama');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->integer('anak_ke');
            $table->string('status_dalam_keluarga');
            $table->string('nama_ayah');
            $table->year('tahun_lahir_ayah');
            $table->foreignId('pekerjaan_ayah_id')->nullable();
            $table->foreignId('pendidikan_ayah_id')->nullable();
            $table->string('nama_ibu');
            $table->year('tahun_lahir_ibu');
            $table->foreignId('pekerjaan_ibu_id')->nullable();
            $table->foreignId('pendidikan_ibu_id')->nullable();
            $table->foreignId('penghasilan_orang_tua_id')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('nomor_wali')->nullable();
            $table->foreignId('pekerjaan_wali_id')->nullable();
            $table->foreignId('tahun_ajaran_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswa_pendaftaran');
    }
};