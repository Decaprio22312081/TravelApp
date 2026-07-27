<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemesanan = Pemesanan::count();
        $totalPendapatan = Pemesanan::where('status', 'selesai')->sum('total_harga');
        $totalUser = User::where('role', 'user')->count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();

        $mobilPopuler = Mobil::withCount('pemesanans')
            ->orderBy('pemesanans_count', 'desc')
            ->take(3)
            ->get();

        $pemesananTerbaru = Pemesanan::with(['user', 'mobil'])
            ->latest()
            ->take(5)
            ->get();

        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulanLabel = $date->format('M Y');
            $count = Pemesanan::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $bulanData[] = [
                'bulan' => $bulanLabel,
                'total' => $count,
            ];
        }

        return view('admin.dashboard', compact(
            'totalPemesanan',
            'totalPendapatan',
            'totalUser',
            'mobilTersedia',
            'mobilPopuler',
            'pemesananTerbaru',
            'bulanData'
        ));
    }
}
