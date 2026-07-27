<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = [
        'pemesanan_id', 'user_id', 'rating', 'komentar',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
