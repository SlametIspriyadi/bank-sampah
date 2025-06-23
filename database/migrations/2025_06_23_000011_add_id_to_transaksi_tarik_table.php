<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
        });
    }

    public function down()
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
