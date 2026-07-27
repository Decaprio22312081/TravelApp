<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::latest()->paginate(10);
        return view('admin.mobil.index', compact('mobil'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:20|unique:mobil,plat_nomor',
            'kapasitas' => 'required|integer|min:1',
            'harga_per_hari' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'nama_supir' => 'nullable|string|max:255',
            'no_hp_supir' => 'nullable|string|max:20',
            'status' => 'required|in:tersedia,disewa,maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'foto_supir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        if ($request->hasFile('foto_supir')) {
            $data['foto_supir'] = $request->file('foto_supir')->store('mobil/supir', 'public');
        }

        Mobil::create($data);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:20|unique:mobil,plat_nomor,' . $id,
            'kapasitas' => 'required|integer|min:1',
            'harga_per_hari' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'nama_supir' => 'nullable|string|max:255',
            'no_hp_supir' => 'nullable|string|max:20',
            'status' => 'required|in:tersedia,disewa,maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'foto_supir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($mobil->foto) {
                Storage::disk('public')->delete($mobil->foto);
            }
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        if ($request->hasFile('foto_supir')) {
            if ($mobil->foto_supir) {
                Storage::disk('public')->delete($mobil->foto_supir);
            }
            $data['foto_supir'] = $request->file('foto_supir')->store('mobil/supir', 'public');
        }

        $mobil->update($data);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto);
        }

        if ($mobil->foto_supir) {
            Storage::disk('public')->delete($mobil->foto_supir);
        }

        $mobil->delete();

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil dihapus.');
    }
}
