<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert([
            'no_reg' => 'ADM001', // hanya gunakan no_reg
        ], [
            'name' => 'Administrator',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Kota',
            'tgl_lahir' => '1990-01-01',
            'no_hp' => '08123456789',
            'alamat' => 'Alamat Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'tgl_registrasi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
