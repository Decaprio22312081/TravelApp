<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Mobil;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function create(Request $request)
    {
        $destinasis = Destinasi::all();
        $mobils = Mobil::where('status', 'tersedia')->get();

        $destinasi_id = $request->destinasi_id;
        $mobil_id = $request->mobil_id;

        $selectedDestinasi = null;
        $selectedMobil = null;

        if ($destinasi_id) {
            $selectedDestinasi = Destinasi::find($destinasi_id);
        }

        if ($mobil_id) {
            $selectedMobil = Mobil::find($mobil_id);
        }

        return view('pemesanan.create', compact('destinasis', 'mobils', 'selectedDestinasi', 'selectedMobil'));
    }

    public function cancel($id)
    {
        $pemesanan = Pemesanan::with('mobil')->findOrFail($id);

        if ($pemesanan->user_id !== Auth::id())
            abort(403);

        if ($pemesanan->status !== 'menunggu_pembayaran') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $pemesanan->update(['status' => 'batal']);
        $pemesanan->mobil->update(['status' => 'tersedia']);

        return redirect()->route('pemesanan.riwayat')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mobil_id' => 'required|exists:mobil,id',
            'destinasi_id' => 'nullable|exists:destinasi,id',
            'alamat_jemput' => 'required|string',
            'alamat_tujuan' => 'required|string',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'jumlah_hari' => 'required|integer|min:1',
            'nama_penumpang' => 'required|string|max:255',
            'no_hp_penumpang' => 'required|string|max:20',
            'jumlah_penumpang' => 'required|integer|min:1',
        ]);

        $mobil = Mobil::findOrFail($data['mobil_id']);
        $data['total_harga'] = $data['jumlah_hari'] * $mobil->harga_per_hari;
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_pembayaran';

        $pemesanan = Pemesanan::create($data);

        return redirect()->route('pemesanan.show', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function riwayat()
    {
        $pemesanans = Auth::user()->pemesanans()
            ->with(['mobil', 'destinasi', 'pembayaran'])
            ->latest()
            ->paginate(10);

        return view('pemesanan.riwayat', compact('pemesanans'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil', 'destinasi', 'pembayaran', 'ulasan'])
            ->findOrFail($id);

        if ($pemesanan->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('pemesanan.show', compact('pemesanan'));
    }
}
