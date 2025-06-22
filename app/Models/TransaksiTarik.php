<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTarik extends Model
{
    protected $table = 'transaksi_tarik';
    protected $primaryKey = 'id_tarik';
    protected $fillable = [
        'nasabah_id',
        'tgl_tarik',
        'jumlah_tarik',
        'keterangan',
    ];

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }
}
