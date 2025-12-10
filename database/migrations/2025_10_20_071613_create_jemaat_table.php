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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('email', 100)->nullable();
            $table->string('no_hp',20)->nullable();
            $table->text('alamat');
            $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan']);
            $table->enum('status_baptis',['Sudah', 'Belum']);
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaat');
    }
};
