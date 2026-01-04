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
        Schema::create('gelombang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tahun_ajaran_id')
                  ->constrained('tahun_ajaran')
                  ->cascadeOnDelete();

            $table->string('name'); // Gelombang 1 / Early Bird
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quota');
            $table->integer('registered_count')->default(0);

            $table->decimal('registration_fee', 12, 2)->default(0);

            $table->enum('status', ['open', 'closed', 'full'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelombang');
    }
};