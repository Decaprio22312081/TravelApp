<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with('destinasi')->latest()->paginate(10);

        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        $destinasis = Destinasi::orderBy('nama')->get();

        return view('admin.paket.create', compact('destinasis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'destinasi_id' => 'required|exists:destinasi,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'is_aktif' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        $data['is_aktif'] = $request->boolean('is_aktif');

        Paket::create($data);

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        $destinasis = Destinasi::orderBy('nama')->get();

        return view('admin.paket.edit', compact('paket', 'destinasis'));
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $data = $request->validate([
            'destinasi_id' => 'required|exists:destinasi,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'is_aktif' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($paket->foto) {
                Storage::disk('public')->delete($paket->foto);
            }
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        $data['is_aktif'] = $request->boolean('is_aktif');

        $paket->update($data);

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);

        if ($paket->foto) {
            Storage::disk('public')->delete($paket->foto);
        }

        $paket->delete();

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata berhasil dihapus.');
    }
}
