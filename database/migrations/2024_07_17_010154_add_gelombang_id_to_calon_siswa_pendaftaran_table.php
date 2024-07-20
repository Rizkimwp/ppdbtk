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
        Schema::table('calon_siswa_pendaftaran', function (Blueprint $table) {
            $table->unsignedBigInteger('gelombang_id')->nullable()->after('pekerjaan_wali_id');

            // Jika Anda ingin menambahkan foreign key constraint
            $table->foreign('gelombang_id')->references('id')->on('gelombang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswa_pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['gelombang_id']);
            $table->dropColumn('gelombang_id');
        });
    }
};