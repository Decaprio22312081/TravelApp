<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id', 'mobil_id', 'destinasi_id', 'alamat_jemput', 'alamat_tujuan',
        'tanggal_mulai', 'jumlah_hari', 'total_harga', 'nama_penumpang',
        'no_hp_penumpang', 'jumlah_penumpang', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }
}
