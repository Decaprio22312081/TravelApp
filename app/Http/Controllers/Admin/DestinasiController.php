<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::latest()->paginate(10);

        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('admin.destinasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('destinasi', 'public');
        }

        Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return view('admin.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($destinasi->foto) {
                Storage::disk('public')->delete($destinasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('destinasi', 'public');
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        if ($destinasi->foto) {
            Storage::disk('public')->delete($destinasi->foto);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}
