<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function create(Request $request)
    {
        $destinasis = Destinasi::with(['pakets' => fn ($q) => $q->where('is_aktif', true)])
            ->whereHas('pakets', fn ($q) => $q->where('is_aktif', true))
            ->get();
        $mobils = Mobil::where('status', 'tersedia')->get();

        $destinasi_id = $request->destinasi_id;
        $mobil_id = $request->mobil_id;
        $paket_id = $request->paket_id;

        $selectedDestinasi = null;
        $selectedMobil = null;
        $selectedPaket = null;

        if ($paket_id) {
            $selectedPaket = Paket::with('destinasi')->find($paket_id);
            $selectedDestinasi = $selectedPaket?->destinasi;
        }

        if (! $selectedDestinasi && $destinasi_id) {
            $selectedDestinasi = Destinasi::find($destinasi_id);
        }

        if ($mobil_id) {
            $selectedMobil = Mobil::find($mobil_id);
        }

        return view('pemesanan.create', compact('destinasis', 'mobils', 'selectedDestinasi', 'selectedMobil', 'selectedPaket'));
    }

    public function cancel($id)
    {
        $pemesanan = Pemesanan::with('mobil')->findOrFail($id);

        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

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
            'paket_id' => 'nullable|exists:paket,id',
            'destinasi_id' => 'nullable|exists:destinasi,id',
            'alamat_jemput' => 'required|string',
            'alamat_tujuan' => 'required|string',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'jumlah_hari' => 'nullable|integer|min:1',
            'nama_penumpang' => 'required|string|max:255',
            'no_hp_penumpang' => 'required|string|max:20',
            'jumlah_penumpang' => 'required|integer|min:1',
        ]);

        $mobil = Mobil::findOrFail($data['mobil_id']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_pembayaran';

        if (! empty($data['paket_id'])) {
            $paket = Paket::with('destinasi')->findOrFail($data['paket_id']);

            if (! $paket->is_aktif) {
                return back()->withInput()->with('error', 'Paket wisata yang dipilih sudah tidak tersedia.');
            }

            if ($mobil->kapasitas < $data['jumlah_penumpang']) {
                return back()->withInput()->withErrors([
                    'mobil_id' => 'Kapasitas kendaraan ('.$mobil->kapasitas.' kursi) tidak mencukupi untuk '.$data['jumlah_penumpang'].' peserta.',
                ]);
            }

            $data['destinasi_id'] = $paket->destinasi_id;
            $data['jumlah_hari'] = $paket->durasi_hari;
            $data['alamat_tujuan'] = $paket->destinasi?->nama ?? $data['alamat_tujuan'];
            $data['total_harga'] = $paket->harga + ($mobil->harga_per_hari * $paket->durasi_hari);
        } else {
            $data['jumlah_hari'] = $data['jumlah_hari'] ?? 1;
            $data['total_harga'] = $mobil->harga_per_hari * $data['jumlah_hari'];
        }

        $pemesanan = Pemesanan::create($data);

        return redirect()->route('pemesanan.show', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function riwayat()
    {
        $pemesanans = Auth::user()->pemesanans()
            ->with(['mobil', 'destinasi', 'paket', 'pembayaran'])
            ->latest()
            ->paginate(10);

        return view('pemesanan.riwayat', compact('pemesanans'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil', 'destinasi', 'paket', 'pembayaran', 'ulasan'])
            ->findOrFail($id);

        if ($pemesanan->user_id !== Auth::id() && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('pemesanan.show', compact('pemesanan'));
    }
}
