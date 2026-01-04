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
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('pendaftaran_id')
                  ->constrained('pendaftaran')
                  ->cascadeOnDelete();

            $table->foreignUuid('question_id')
                  ->constrained('questions')
                  ->cascadeOnDelete();

            $table->text('answer');

            $table->timestamps();

            // 1 pertanyaan = 1 jawaban per pendaftar
            $table->unique(['pendaftaran_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};