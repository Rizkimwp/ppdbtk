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
        Schema::table('calon_siswa', function (Blueprint $table) {
            //
            $table->string('nisn')->unique()->after('nik');
            $table->string('asal_sekolah')->after('nama_panggilan');
            $table->integer('riwayat_hafalan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            //
            $table->dropColumn([
                'nisn',
                'asal_sekolah',
                'riwayat_hafalan',
            ]);
        });
    }
};