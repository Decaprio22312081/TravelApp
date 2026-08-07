<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';

    protected $fillable = [
        'destinasi_id', 'nama', 'deskripsi', 'durasi_hari', 'harga',
        'fasilitas', 'itinerary', 'foto', 'is_aktif',
    ];

    protected function casts(): array
    {
        return [
            'is_aktif' => 'boolean',
        ];
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function fasilitasList()
    {
        return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->fasilitas)));
    }

    public function itineraryList()
    {
        return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->itinerary)));
    }
}
