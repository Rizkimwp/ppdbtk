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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // null = berlaku untuk semua gelombang

            $table->string('question');
            $table->enum('type', [
                'text',
                'textarea',
                'number',
                'select',
                'radio',
                'checkbox',
                'date'
            ]);

            $table->json('options')->nullable(); // untuk select/radio/checkbox
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};