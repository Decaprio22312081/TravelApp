<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function create($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['mobil', 'destinasi'])->findOrFail($pemesanan_id);

        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pemesanan->status !== 'menunggu_pembayaran') {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Pemesanan ini sudah tidak memerlukan pembayaran.');
        }

        $bankAccounts = BankAccount::where('is_aktif', true)->get();
        $settingTelpon = \App\Models\Setting::where('key', 'no_telp')->first();
        $noTelp = $settingTelpon ? $settingTelpon->value : '-';
        $instruksiTransfer = BankAccount::where('is_aktif', true)->get();

        return view('pembayaran.create', compact('pemesanan', 'bankAccounts', 'noTelp', 'instruksiTransfer'));
    }

    public function store(Request $request, $pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);

        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pemesanan->status !== 'menunggu_pembayaran') {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Pemesanan ini sudah tidak memerlukan pembayaran.');
        }

        $data = $request->validate([
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
            'nominal_transfer' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data['pemesanan_id'] = $pemesanan->id;
        $data['status'] = 'menunggu_verifikasi';
        $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('pembayaran', 'public');

        Pembayaran::create($data);

        $pemesanan->update(['status' => 'menunggu_verifikasi']);

        return redirect()->route('pemesanan.show', $pemesanan->id)
            ->with('success', 'Pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.');
    }

    public function konfirmasi($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['pembayaran'])->findOrFail($pemesanan_id);

        if ($pemesanan->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if (!$pemesanan->pembayaran) {
            return redirect()->route('pemesanan.show', $pemesanan->id)
                ->with('error', 'Belum ada pembayaran untuk pemesanan ini.');
        }

        return view('pembayaran.konfirmasi', compact('pemesanan'));
    }
}
