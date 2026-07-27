@extends('admin.layouts.app')

@section('title', 'Tambah Mitra - TravelKu')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.mitra.index') }}" class="text-gray-600 hover:text-gray-800 mr-4"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Mitra</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.mitra.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Nama Mitra</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('nama') border-red-500 @enderror">
                @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                <textarea name="alamat" rows="3" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Latitude</label>
                    <input type="text" name="latitude" value="{{ old('latitude') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('latitude') border-red-500 @enderror">
                    @error('latitude')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Longitude</label>
                    <input type="text" name="longitude" value="{{ old('longitude') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('longitude') border-red-500 @enderror">
                    @error('longitude')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">No. Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('no_telp') border-red-500 @enderror">
                @error('no_telp')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('foto') border-red-500 @enderror">
                @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_aktif" value="1" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Simpan</button>
        </form>
    </div>
</div>
@endsection
