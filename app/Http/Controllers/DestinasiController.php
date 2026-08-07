<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Mobil;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Destinasi::query()->with(['pakets' => fn ($q) => $q->where('is_aktif', true)]);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $destinasi = $query->latest()->paginate(12);
        $kategoris = Destinasi::select('kategori')->distinct()->pluck('kategori');

        return view('destinasi.index', compact('destinasi', 'kategoris'));
    }

    public function show($id)
    {
        $destinasi = Destinasi::with('pemesanans.mobil')->findOrFail($id);

        $ulasans = $destinasi->pemesanans()
            ->whereHas('ulasan')
            ->with('ulasan.user')
            ->get()
            ->pluck('ulasan')
            ->filter();

        $pakets = $destinasi->pakets()
            ->where('is_aktif', true)
            ->latest()
            ->get();

        $mobils = Mobil::where('status', 'tersedia')->latest()->take(3)->get();

        return view('destinasi.show', compact('destinasi', 'ulasans', 'mobils', 'pakets'));
    }

    public function getByDestinasi($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return redirect()->route('pemesanan.create', ['destinasi_id' => $destinasi->id]);
    }
}
