<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{

    protected $fillable = [
        'jenis_sampah',
        'satuan',
        'harga',
        'status',
    ];
}
