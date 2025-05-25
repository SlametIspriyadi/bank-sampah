<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_setor', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->unsignedBigInteger('sampah_id');
            $table->unsignedBigInteger('nasabah_id'); // relasi ke users (role=nasabah)
            $table->unsignedBigInteger('admin_id')->nullable(); // relasi ke users (role=admin)
            $table->decimal('berat', 10, 2);
            $table->decimal('total_pendapatan', 12, 2);
            $table->enum('status', ['pending', 'selesai', 'batal'])->default('pending');
            $table->date('tgl_setor');
            $table->timestamps();

            $table->foreign('sampah_id')->references('sampah_id')->on('sampahs');
            $table->foreign('nasabah_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_setor');
    }
};
