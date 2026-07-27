<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::latest()->get();
        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
            'no_telp' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_aktif' => 'nullable|boolean',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mitra', 'public');
        }

        Mitra::create($data);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
            'no_telp' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_aktif' => 'nullable|boolean',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($request->hasFile('foto')) {
            if ($mitra->foto) {
                Storage::disk('public')->delete($mitra->foto);
            }
            $data['foto'] = $request->file('foto')->store('mitra', 'public');
        }

        $mitra->update($data);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);

        if ($mitra->foto) {
            Storage::disk('public')->delete($mitra->foto);
        }

        $mitra->delete();

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil dihapus.');
    }
}
