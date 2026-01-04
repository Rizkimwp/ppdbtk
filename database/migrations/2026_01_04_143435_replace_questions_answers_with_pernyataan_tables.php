<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 🔴 HAPUS TABEL LAMA
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');

        // 🟢 TABEL MASTER PERNYATAAN
        Schema::create('pernyataan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->boolean('wajib')->default(true);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 🟢 TABEL PERSETUJUAN PERNYATAAN
        Schema::create('persetujuan_pernyataan', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('calon_siswa_id')
                ->constrained('calon_siswa')
                ->cascadeOnDelete();

            $table->foreignId('pernyataan_id')
                ->constrained('pernyataan')
                ->cascadeOnDelete();

            $table->boolean('disetujui')->default(false);
            $table->timestamp('tanggal_persetujuan')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            $table->unique(['calon_siswa_id', 'pernyataan_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('persetujuan_pernyataan');
        Schema::dropIfExists('pernyataan');

        // (Opsional) Balikin tabel lama kalau rollback
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->boolean('answer');
            $table->timestamps();
        });
    }
};