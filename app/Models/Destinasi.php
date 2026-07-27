<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    protected $table = 'destinasi';

    protected $fillable = [
        'nama', 'deskripsi', 'kategori', 'foto', 'latitude', 'longitude',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
