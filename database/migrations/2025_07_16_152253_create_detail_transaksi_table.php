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
        Schema::create('detail_transaksi', function (Blueprint $table) {
           $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi_setor')->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained('sampahs', 'sampah_id')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->unsignedInteger('harga_saat_transaksi');
            $table->unsignedInteger('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
