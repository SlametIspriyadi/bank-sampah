<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sampahs')->insert([
            [
                'jenis_sampah' => 'Plastik',
                'satuan' => 'Kg',
                'harga' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'Logam',
                'satuan' => 'Kg',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'Kaca',
                'satuan' => 'Kg',
                'harga' => 4000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'Kertas',
                'satuan' => 'Kg',
                'harga' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_sampah' => 'Botol Kaca',
                'satuan' => 'Pcs',
                'harga' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain jika perlu
        ]);
    }
}
