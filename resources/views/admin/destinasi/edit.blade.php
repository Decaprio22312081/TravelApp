@extends('admin.layouts.app')

@section('title', 'Edit Destinasi - TravelKu')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.destinasi.index') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
            <span class="font-label-caps text-label-caps">Kembali</span>
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 overflow-hidden">
        <div class="px-8 py-6 border-b border-outline-variant">
            <h3 class="font-title-sm text-title-sm text-on-surface">Edit Destinasi</h3>
            <p class="text-sm text-on-surface-variant mt-1">Perbarui informasi destinasi wisata.</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('admin.destinasi.update', $destinasi->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="space-y-6">
                    {{-- NAMA --}}
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Nama Destinasi</label>
                        <input type="text" name="nama" value="{{ old('nama', $destinasi->nama) }}" required
                            class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all @error('nama') border-error @enderror"
                            placeholder="Masukkan nama destinasi">
                        @error('nama')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="5" required
                            class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all @error('deskripsi') border-error @enderror"
                            placeholder="Deskripsikan destinasi wisata ini">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                        @error('deskripsi')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Kategori</label>
                        <select name="kategori" required
                            class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all @error('kategori') border-error @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Alam" {{ (old('kategori', $destinasi->kategori) == 'Alam') ? 'selected' : '' }}>Alam</option>
                            <option value="Pantai" {{ (old('kategori', $destinasi->kategori) == 'Pantai') ? 'selected' : '' }}>Pantai</option>
                            <option value="Budaya" {{ (old('kategori', $destinasi->kategori) == 'Budaya') ? 'selected' : '' }}>Budaya</option>
                            <option value="Kuliner" {{ (old('kategori', $destinasi->kategori) == 'Kuliner') ? 'selected' : '' }}>Kuliner</option>
                            <option value="Hiburan" {{ (old('kategori', $destinasi->kategori) == 'Hiburan') ? 'selected' : '' }}>Hiburan</option>
                            <option value="Lainnya" {{ (old('kategori', $destinasi->kategori) == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- FOTO --}}
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Foto</label>
                        @if($destinasi->foto)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$destinasi->foto) }}" alt="{{ $destinasi->nama }}" class="w-32 h-20 object-cover rounded-lg border border-outline-variant">
                        </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="foto" accept="image/*"
                                class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:text-sm file:font-semibold hover:file:opacity-90 @error('foto') border-error @enderror">
                        </div>
                        <p class="text-xs text-on-surface-variant mt-1">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, GIF. Maks: 5MB.</p>
                        @error('foto')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- LAT/LNG --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-on-surface mb-2">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude', $destinasi->latitude) }}"
                                class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all @error('latitude') border-error @enderror"
                                placeholder="-5.4211">
                            @error('latitude')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-on-surface mb-2">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude', $destinasi->longitude) }}"
                                class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all @error('longitude') border-error @enderror"
                                placeholder="105.2673">
                            @error('longitude')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-outline-variant flex items-center justify-end gap-4">
                    <a href="{{ route('admin.destinasi.index') }}" class="px-6 py-3 rounded-lg border border-outline text-sm font-semibold hover:bg-surface-container-low transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-primary text-on-primary rounded-lg font-semibold text-sm hover:bg-primary-container transition-all shadow-md">
                        Update Destinasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
