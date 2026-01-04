<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('calon_siswa_id')
            ->nullable()
            ->constrained('calon_siswa')
            ->nullOnDelete();


            $table->foreignUuid('tahun_ajaran_id')
                ->constrained('tahun_ajaran')
                ->cascadeOnDelete();

            $table->foreignUuid('gelombang_id')
                ->constrained('gelombang')
                ->cascadeOnDelete();

            $table->string('nomor_registrasi')->unique();

            $table->enum('status', [
                'pending',
                'verified',
                'rejected',
                'accepted'
            ])->default('pending');
            $table->timestamps();
            $table->unique(['calon_siswa_id', 'tahun_ajaran_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};