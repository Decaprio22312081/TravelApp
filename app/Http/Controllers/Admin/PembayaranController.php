<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::where('status', 'menunggu_verifikasi')
            ->with(['pemesanan.user', 'pemesanan.mobil'])
            ->latest()
            ->paginate(15);

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['pemesanan.user', 'pemesanan.mobil', 'pemesanan.destinasi'])
            ->findOrFail($id);

        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);

        $pembayaran->update(['status' => 'terverifikasi']);
        $pembayaran->pemesanan->update(['status' => 'dikonfirmasi']);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diverifikasi. Pemesanan telah dikonfirmasi.');
    }

    public function tolak(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);

        $request->validate([
            'catatan_admin' => 'nullable|string',
        ]);

        $pembayaran->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);
        $pembayaran->pemesanan->update(['status' => 'ditolak']);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran ditolak.');
    }
}
