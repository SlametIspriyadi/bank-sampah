<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi_setor';

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

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id', 'sampah_id');
    }
}
