<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil', 'destinasi']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $pemesanans = $query->latest()->paginate(15);

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil', 'destinasi', 'pembayaran', 'ulasan'])
            ->findOrFail($id);

        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dikonfirmasi,berjalan,selesai,batal',
        ]);

        $pemesanan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pemesanan.show', $pemesanan->id)
            ->with('success', 'Status pemesanan berhasil diperbarui menjadi ' . $request->status . '.');
    }
}
