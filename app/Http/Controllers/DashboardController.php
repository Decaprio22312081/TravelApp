<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalPesanan = $user->pemesanans()->count();
        $pesananAktif = $user->pemesanans()
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'dikonfirmasi', 'berjalan'])
            ->count();
        $pesananSelesai = $user->pemesanans()
            ->where('status', 'selesai')
            ->count();

        $destinasiFavorit = Destinasi::withCount('pemesanans')
            ->orderBy('pemesanans_count', 'desc')
            ->first();

        $totalBiaya = $user->pemesanans()->sum('total_harga');

        $pesananAktifItem = $user->pemesanans()
            ->with(['mobil', 'paket', 'destinasi'])
            ->whereIn('status', ['berjalan', 'dikonfirmasi', 'menunggu_verifikasi', 'menunggu_pembayaran'])
            ->latest()
            ->first();

        $destinasiPopuler = Destinasi::inRandomOrder()->take(4)->get();

        $pesananTerbaru = $user->pemesanans()
            ->with(['mobil', 'paket', 'destinasi'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPesanan', 'pesananAktif', 'pesananSelesai',
            'destinasiFavorit', 'totalBiaya',
            'pesananAktifItem', 'destinasiPopuler', 'pesananTerbaru'
        ));
    }
}
