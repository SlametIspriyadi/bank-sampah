<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NasabahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'no_reg' => '2411450001',
                'name' => 'Sri Bidayah',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Malang',
                'tgl_lahir' => '1967-11-28',
                'alamat' => 'Tanjung, Banjararum 01/07',
                'no_hp' => '085607328266',
                'role' => 'nasabah',
                'tgl_registrasi' => '2025-06-07',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_reg' => '2411450002',
                'name' => 'Fauziah',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Surabaya',
                'tgl_lahir' => '1980-05-15',
                'alamat' => 'Jl. Merdeka No. 10, Surabaya',
                'no_hp' => '081234567890',
                'role' => 'nasabah',
                'tgl_registrasi' => '2025-06-07',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_reg' => '2411450003',
                'name' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Yogyakarta',
                'tgl_lahir' => '1990-03-20',
                'alamat' => 'Jl. Malioboro No. 5, Yogyakarta',
                'no_hp' => '082345678901',
                'role' => 'nasabah',
                'tgl_registrasi' => '2025-06-07',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_reg' => '2411450004',
                'name' => 'Siti Aminah',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1975-08-10',
                'alamat' => 'Jl. Asia Afrika No. 20, Bandung',
                'no_hp' => '083456789012',
                'role' => 'nasabah',
                'tgl_registrasi' => '2025-06-07',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_reg' => '2411450005',
                'name' => 'Joko Widodo',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Solo',
                'tgl_lahir' => '1961-06-21',
                'alamat' => 'Jl. Slamet Riyadi No. 15, Solo',
                'no_hp' => '084567890123',
                'role' => 'nasabah',
                'tgl_registrasi' => '2025-06-07',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Tambahkan data lain jika perlu
        ]);
    }
}
