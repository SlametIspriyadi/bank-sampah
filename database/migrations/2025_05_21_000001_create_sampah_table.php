<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id('sampah_id');
            $table->string('jenis_sampah', 100);
            $table->enum('satuan', ['Kg', 'Pcs']);
            $table->decimal('harga', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sampah');
    }
};
