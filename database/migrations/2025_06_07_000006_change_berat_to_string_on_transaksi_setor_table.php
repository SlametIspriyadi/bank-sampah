<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaksi_setor', function (Blueprint $table) {
            $table->string('berat', 255)->change();
        });
    }
    public function down(): void
    {
        Schema::table('transaksi_setor', function (Blueprint $table) {
            $table->decimal('berat', 10, 2)->change();
        });
    }
};
