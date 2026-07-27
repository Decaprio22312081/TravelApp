<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id', 'nama_pengirim', 'bank_pengirim', 'tanggal_transaksi',
        'nominal_transfer', 'bukti_pembayaran', 'status', 'catatan_admin',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
