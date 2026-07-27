<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';

    protected $fillable = [
        'nama', 'merk', 'tipe', 'plat_nomor', 'kapasitas', 'harga_per_hari',
        'foto', 'fasilitas', 'nama_supir', 'no_hp_supir', 'foto_supir', 'status',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
