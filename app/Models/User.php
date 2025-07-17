<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'no_reg',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
        'alamat',
        'saldo',
        'role',
        'tgl_registrasi',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tgl_registrasi' => 'datetime',
            'tgl_lahir' => 'date',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function saldoTersedia(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Ambil total pendapatan dari semua transaksi setor
                $totalSetor = $this->transaksiSetor()->sum('total_pendapatan');

                // Ambil total penarikan dari semua transaksi tarik
                $totalTarik = $this->transaksiTarik()->sum('jumlah_tarik');
                
                // Hitung saldo akhir (dengan potongan admin 2% jika ada)
                // Anda bisa menghapus * 0.98 jika tidak ada potongan
                return ($totalSetor * 0.98) - $totalTarik;
            }
        );
    }

    public function transaksiSetor()
    {
        return $this->hasMany(\App\Models\Transaksi::class, 'nasabah_id');
    }
    public function transaksiTarik()
    {
        return $this->hasMany(\App\Models\TransaksiTarik::class, 'nasabah_id');
    }
}
