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
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaat_id')
                  ->constrained('jemaat')
                  ->onDelete('cascade');
            $table->foreignId('keluarga_id')
                  ->constrained('keluarga')
                  ->onDelete('cascade');
            $table->enum('hubungan', ['Istri', 'Anak','Lainnya'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga');
    }
};
