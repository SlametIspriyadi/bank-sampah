<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_transaksi',
        'sampah_id',
        'nasabah_id', // relasi ke users (role=nasabah)
        'admin_id', // relasi ke users (role=admin)
        'berat',
        'harga',
        'jenis_sampah', // jenis sampah yang disetor
        'tgl_setor',
        'total_pendapatan',
        'status',
    ];
}
