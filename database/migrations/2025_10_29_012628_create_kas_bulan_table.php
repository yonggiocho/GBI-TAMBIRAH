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
        Schema::create('kas_bulan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_id')
                  ->constrained('kas_tahun')
                  ->onDelete('cascade');
            $table->tinyInteger('bulan');
            $table->decimal('saldo_awal', 15, 2)->default(0);
            $table->decimal('saldo_akhir', 15, 2)->default(0);
            $table->enum('status', ['selesai','berjalan'])->default('berjalan');
            $table->timestamps();
            $table->unique(['tahun_id', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_bulan');
    }
};
