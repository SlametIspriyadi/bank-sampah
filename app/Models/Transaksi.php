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

    // app/Models/Transaksi.php

/**
 * Accessor untuk memformat kolom detil_sampah menjadi array yang rapi.
 * Sekarang di view, Anda bisa memanggil $transaksi->detail_sampah_formatted
 */
public function getDetailSampahFormattedAttribute()
    {
        // Jika kolom detil_sampah kosong, kembalikan array kosong
        if (empty($this->detil_sampah)) {
            return [];
        }

        // Jika ada isinya, pecah string menjadi array yang bersih
        $items = array_filter(array_map('trim', explode(';', $this->detil_sampah)));
        $formattedItems = [];
        foreach ($items as $item) {
            $subitems = array_filter(array_map('trim', explode(',', $item)));
            foreach($subitems as $subitem) {
                $formattedItems[] = $subitem;
            }
        }
        return $formattedItems;
    }

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id', 'sampah_id');
    }
}
