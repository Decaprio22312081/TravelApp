@extends('admin.layouts.app')

@section('title', 'Edit Paket Wisata - TravelKu')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.paket.index') }}" class="text-gray-600 hover:text-gray-800 mr-4"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Paket Wisata</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.paket.update', $paket->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Destinasi</label>
                <select name="destinasi_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('destinasi_id') border-red-500 @enderror">
                    <option value="">Pilih Destinasi</option>
                    @foreach($destinasis as $d)
                    <option value="{{ $d->id }}" {{ ($paket->destinasi_id == $d->id || old('destinasi_id') == $d->id) ? 'selected' : '' }}>{{ $d->nama }}</option>
                    @endforeach
                </select>
                @error('destinasi_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Paket</label>
                    <input type="text" name="nama" value="{{ old('nama', $paket->nama) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('nama') border-red-500 @enderror">
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari" value="{{ old('durasi_hari', $paket->durasi_hari) }}" min="1" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('durasi_hari') border-red-500 @enderror">
                    @error('durasi_hari')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Harga Paket</label>
                <input type="number" name="harga" value="{{ old('harga', $paket->harga) }}" min="0" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('harga') border-red-500 @enderror">
                @error('harga')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Fasilitas</label>
                <textarea name="fasilitas" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas', $paket->fasilitas) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Satu baris per fasilitas.</p>
                @error('fasilitas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Itinerary</label>
                <textarea name="itinerary" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('itinerary') border-red-500 @enderror">{{ old('itinerary', $paket->itinerary) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Satu baris per kegiatan/agenda.</p>
                @error('itinerary')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Foto Paket</label>
                @if($paket->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$paket->foto) }}" alt="{{ $paket->nama }}" class="w-40 h-28 object-cover rounded-lg">
                </div>
                @endif
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('foto') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Kosongkan untuk memakai foto yang ada.</p>
                @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                <select name="is_aktif" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="1" {{ old('is_aktif', $paket->is_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_aktif', $paket->is_aktif) === 0 || old('is_aktif', $paket->is_aktif) === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Perbarui</button>
        </form>
    </div>
</div>
@endsection
