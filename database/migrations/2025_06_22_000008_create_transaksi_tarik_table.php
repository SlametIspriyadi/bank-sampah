<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transaksi_tarik', function (Blueprint $table) {
            $table->id('id_tarik');
            $table->unsignedBigInteger('nasabah_id');
            $table->date('tgl_tarik');
            $table->decimal('jumlah_tarik', 15, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('nasabah_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_tarik');
    }
};
