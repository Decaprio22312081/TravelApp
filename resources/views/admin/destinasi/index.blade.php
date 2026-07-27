@extends('admin.layouts.app')

@section('title', 'Kelola Destinasi - TravelKu')

@section('content')
<div class="space-y-8">
    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h3 class="font-headline-md text-headline-md text-on-surface">Manajemen Destinasi</h3>
            <p class="font-body-md text-body-md text-on-surface-variant">Kelola daftar lokasi wisata di Bandar Lampung.</p>
        </div>
        <a href="{{ route('admin.destinasi.create') }}" class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-lg font-label-caps text-label-caps hover:bg-primary-container transition-all shadow-md">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tambah Destinasi
        </a>
    </div>

    {{-- FILTER ROW --}}
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 bg-surface-container-lowest p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex items-center gap-6">
            <div class="flex flex-col gap-1 flex-1">
                <label class="text-[10px] font-bold text-outline uppercase tracking-wider">Kategori</label>
                <select class="bg-transparent border-none p-0 text-lg font-semibold text-primary focus:ring-0 cursor-pointer outline-none">
                    <option>Semua Kategori</option>
                    <option>Alam</option>
                    <option>Pantai</option>
                    <option>Budaya</option>
                    <option>Kuliner</option>
                    <option>Hiburan</option>
                    <option>Lainnya</option>
                </select>
            </div>
            <div class="w-px h-10 bg-outline-variant"></div>
            <div class="flex flex-col gap-1 flex-1">
                <label class="text-[10px] font-bold text-outline uppercase tracking-wider">Urutkan</label>
                <select class="bg-transparent border-none p-0 text-lg font-semibold text-primary focus:ring-0 cursor-pointer outline-none">
                    <option>Terbaru</option>
                    <option>Nama A-Z</option>
                    <option>Nama Z-A</option>
                </select>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4 bg-primary text-on-primary p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.1)] relative overflow-hidden">
            <div class="relative z-10">
                <p class="font-label-caps text-label-caps opacity-80">Total Destinasi</p>
                <h4 class="font-display-lg text-display-lg mt-2">{{ number_format($destinasi->total()) }} <span class="text-lg font-normal opacity-70">Lokasi</span></h4>
            </div>
            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-9xl opacity-10 rotate-12">explore</span>
        </div>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] overflow-hidden border border-outline-variant/30">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-high">
                <tr>
                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant">Nama Destinasi</th>
                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant">Kategori</th>
                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($destinasi as $item)
                <tr class="hover:bg-primary-fixed/20 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-surface-container-highest flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($item->foto)
                                <img class="w-full h-full object-cover" src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}">
                                @else
                                <span class="material-symbols-outlined text-on-surface-variant">image</span>
                                @endif
                            </div>
                            <span class="font-semibold text-on-surface">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @php
                            $catStyles = [
                                'pantai' => 'bg-tertiary-fixed text-on-tertiary-fixed',
                                'alam' => 'bg-primary-fixed text-on-primary-fixed',
                                'budaya' => 'bg-secondary-container text-on-secondary-container',
                                'sejarah' => 'bg-secondary-container text-on-secondary-container',
                                'kuliner' => 'bg-tertiary-fixed text-on-tertiary-fixed',
                                'hiburan' => 'bg-primary-fixed text-on-primary-fixed',
                            ];
                            $catClass = $catStyles[strtolower($item->kategori)] ?? 'bg-surface-container-high text-on-surface-variant';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $catClass }}">{{ $item->kategori }}</span>
                    </td>
                    <td class="px-6 py-5 text-right space-x-1">
                        <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="inline-flex p-2 text-outline hover:text-primary transition-colors" title="Edit">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.destinasi.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus destinasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex p-2 text-outline hover:text-error transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-sm text-on-surface-variant">Belum ada destinasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="bg-surface-container-low px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-on-surface-variant">
                Menampilkan <span class="font-semibold text-on-surface">{{ $destinasi->firstItem() ?? 0 }}</span> -
                <span class="font-semibold text-on-surface">{{ $destinasi->lastItem() ?? 0 }}</span> dari
                <span class="font-semibold text-on-surface">{{ number_format($destinasi->total()) }}</span> destinasi
            </p>
            <div class="flex items-center gap-2">
                @if ($destinasi->onFirstPage())
                <button class="p-2 rounded-lg border border-outline-variant opacity-50 cursor-not-allowed">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </button>
                @else
                <a href="{{ $destinasi->previousPageUrl() }}" class="p-2 rounded-lg border border-outline-variant hover:bg-surface-container-highest transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </a>
                @endif

                @foreach ($destinasi->getUrlRange(1, $destinasi->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold transition-colors {{ $page == $destinasi->currentPage() ? 'bg-primary text-on-primary' : 'hover:bg-surface-container-highest' }}">
                    {{ $page }}
                </a>
                @endforeach

                @if ($destinasi->hasMorePages())
                <a href="{{ $destinasi->nextPageUrl() }}" class="p-2 rounded-lg border border-outline-variant hover:bg-surface-container-highest transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </a>
                @else
                <button class="p-2 rounded-lg border border-outline-variant opacity-50 cursor-not-allowed">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
