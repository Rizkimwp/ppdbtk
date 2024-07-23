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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method');
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamp('payment_date')->useCurrent();
            $table->string('transaction_id')->unique();
            $table->enum('status', ['belum_lunas', 'lunas', 'gagal', 'pending']);
            $table->string('file_path')->nullable();
            $table->timestamps();
            $table->foreignId('calon_siswa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
