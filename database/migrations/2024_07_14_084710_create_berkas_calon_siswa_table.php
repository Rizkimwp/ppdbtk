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
        Schema::create('berkas_calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa_pendaftaran');
            $table->foreignId('list_berkas_id');
            $table->string('file_path');
            $table->enum('status', ['PERIKSA', 'VALID', 'TIDAK_VALID'])->default('PERIKSA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_calon_siswa');
    }
};