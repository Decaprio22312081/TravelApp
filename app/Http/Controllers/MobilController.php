<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::query()->where('status', 'tersedia');

        if ($request->filled('kapasitas')) {
            $query->where('kapasitas', '>=', $request->kapasitas);
        }

        if ($request->filled('harga_min')) {
            $query->where('harga_per_hari', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga_per_hari', '<=', $request->harga_max);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $sort = $request->get('sort', 'terendah');
        if ($sort === 'terendah') {
            $query->orderBy('harga_per_hari');
        } elseif ($sort === 'tertinggi') {
            $query->orderBy('harga_per_hari', 'desc');
        } else {
            $query->latest();
        }

        $mobil = $query->paginate(12)->withQueryString();
        $tipes = Mobil::select('tipe')->distinct()->pluck('tipe');
        $total = Mobil::where('status', 'tersedia')->count();

        return view('mobil.index', compact('mobil', 'tipes', 'total'));
    }

    public function show($id)
    {
        $mobil = Mobil::with(['pemesanans.ulasan.user'])->findOrFail($id);

        $ulasans = $mobil->pemesanans()
            ->whereHas('ulasan')
            ->with('ulasan.user')
            ->get()
            ->pluck('ulasan')
            ->filter();

        return view('mobil.show', compact('mobil', 'ulasans'));
    }
}
