<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil', 'destinasi', 'paket']);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $laporan = $query->latest()->paginate(20);
        $totalPendapatan = Pemesanan::where('status', 'selesai')
            ->when($request->filled('start_date'), fn ($q) => $q->whereDate('created_at', '>=', $request->start_date))
            ->when($request->filled('end_date'), fn ($q) => $q->whereDate('created_at', '<=', $request->end_date))
            ->sum('total_harga');

        return view('admin.laporan.index', compact('laporan', 'totalPendapatan'));
    }

    public function export(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil', 'destinasi', 'paket']);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $laporan = $query->latest()->get();
        $totalPendapatan = $laporan->where('status', 'selesai')->sum('total_harga');

        $filename = 'laporan-'.Carbon::now()->format('Ymd-His').'.csv';

        return response()
            ->view('admin.laporan.export', compact('laporan', 'totalPendapatan'))
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
