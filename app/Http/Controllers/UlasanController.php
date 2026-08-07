<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function create($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['mobil', 'destinasi', 'paket'])->findOrFail($pemesanan_id);

        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pemesanan->status !== 'selesai') {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Ulasan hanya dapat diberikan untuk pemesanan yang sudah selesai.');
        }

        if ($pemesanan->ulasan) {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Anda sudah memberikan ulasan untuk pemesanan ini.');
        }

        return view('ulasan.create', compact('pemesanan'));
    }

    public function store(Request $request, $pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);

        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pemesanan->status !== 'selesai') {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Ulasan hanya dapat diberikan untuk pemesanan yang sudah selesai.');
        }

        if ($pemesanan->ulasan) {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Anda sudah memberikan ulasan untuk pemesanan ini.');
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        $data['pemesanan_id'] = $pemesanan->id;
        $data['user_id'] = Auth::id();

        Ulasan::create($data);

        return redirect()->route('pemesanan.show', $pemesanan->id)
            ->with('success', 'Ulasan berhasil diberikan. Terima kasih!');
    }
}
