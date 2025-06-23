<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi_tarik', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('nasabah_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_tarik', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
