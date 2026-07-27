@extends('admin.layouts.app')

@section('title', 'Edit Mobil - TravelKu')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.mobil.index') }}" class="text-gray-600 hover:text-gray-800 mr-4"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Mobil</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.mobil.update', $mobil->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Mobil</label>
                    <input type="text" name="nama" value="{{ old('nama', $mobil->nama) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('nama') border-red-500 @enderror">
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Merk</label>
                    <input type="text" name="merk" value="{{ old('merk', $mobil->merk) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('merk') border-red-500 @enderror">
                    @error('merk')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tipe</label>
                    <input type="text" name="tipe" value="{{ old('tipe', $mobil->tipe) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('tipe') border-red-500 @enderror">
                    @error('tipe')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Plat Nomor</label>
                    <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $mobil->plat_nomor) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('plat_nomor') border-red-500 @enderror">
                    @error('plat_nomor')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kapasitas (Orang)</label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas', $mobil->kapasitas) }}" min="1" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('kapasitas') border-red-500 @enderror">
                    @error('kapasitas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Harga per Hari</label>
                    <input type="number" name="harga_per_hari" value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}" min="0" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('harga_per_hari') border-red-500 @enderror">
                    @error('harga_per_hari')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Fasilitas</label>
                <textarea name="fasilitas" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas', $mobil->fasilitas) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Pisahkan dengan koma, contoh: AC, TV, WiFi</p>
                @error('fasilitas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Foto Mobil</label>
                @if($mobil->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$mobil->foto) }}" alt="" class="w-32 h-20 object-cover rounded">
                </div>
                @endif
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('foto') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="tersedia" {{ (old('status', $mobil->status) == 'tersedia') ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak_tersedia" {{ (old('status', $mobil->status) == 'tidak_tersedia') ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <hr class="my-6">

            <h3 class="font-bold text-gray-700 mb-4">Informasi Supir</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Supir</label>
                    <input type="text" name="nama_supir" value="{{ old('nama_supir', $mobil->nama_supir) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('nama_supir') border-red-500 @enderror">
                    @error('nama_supir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">No. HP Supir</label>
                    <input type="text" name="no_hp_supir" value="{{ old('no_hp_supir', $mobil->no_hp_supir) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('no_hp_supir') border-red-500 @enderror">
                    @error('no_hp_supir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Foto Supir</label>
                @if($mobil->foto_supir)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$mobil->foto_supir) }}" alt="" class="w-16 h-16 object-cover rounded-full">
                </div>
                @endif
                <input type="file" name="foto_supir" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('foto_supir') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                @error('foto_supir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Update</button>
        </form>
    </div>
</div>
@endsection
