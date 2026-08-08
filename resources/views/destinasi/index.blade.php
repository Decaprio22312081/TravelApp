@extends('layouts.app')

@section('title', 'Destinasi Wisata Bandar Lampung - CV. Afia Jaya Abadi')

@section('content')
<main class="pt-32 pb-20 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    {{-- HEADER --}}
    <header class="mb-12 text-center md:text-left">
        <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm mb-2 block">CV. Afia Jaya Abadi</span>
        <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-on-surface mb-6">Destinasi Wisata Bandar Lampung</h1>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="relative w-full md:max-w-md">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                <form action="{{ route('destinasi.index') }}" method="GET" id="searchForm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi impian Anda..." class="w-full pl-12 pr-4 py-4 bg-white border border-outline-variant rounded-full focus:ring-2 focus:ring-primary focus:border-transparent outline-none shadow-sm transition-all font-body-md">
                </form>
            </div>
            <div class="flex flex-wrap gap-2 overflow-x-auto pb-2 scrollbar-hide" id="categoryFilters">
                <a href="{{ route('destinasi.index') }}" class="px-6 py-2 rounded-full font-label-sm whitespace-nowrap shadow-sm {{ !request('kategori') ? 'bg-primary text-white' : 'bg-white border border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary transition-colors' }}">Semua</a>
                @foreach($kategoris as $k)
                <a href="{{ route('destinasi.index', array_merge(request()->except('kategori', 'page'), ['kategori' => $k])) }}" class="px-6 py-2 rounded-full font-label-sm whitespace-nowrap shadow-sm {{ request('kategori') === $k ? 'bg-primary text-white' : 'bg-white border border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary transition-colors' }}">{{ ucfirst($k) }}</a>
                @endforeach
            </div>
        </div>
    </header>

    {{-- GRID --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @forelse($destinasi as $item)
        <article class="bg-white rounded-[24px] overflow-hidden card-hover-effect flex flex-col h-full border border-surface-container">
            <div class="relative h-64 overflow-hidden">
                @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                @else
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-outline text-6xl">map</span>
                </div>
                @endif
                <div class="absolute top-4 left-4 bg-primary/90 text-white px-3 py-1 rounded-full text-label-sm font-label-sm backdrop-blur-md">{{ $item->kategori }}</div>
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="font-headline-md text-headline-md font-bold text-on-surface mb-2">{{ $item->nama }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mb-4 line-clamp-3">{{ Str::limit($item->deskripsi, 120) }}</p>
                @if($item->pakets->isNotEmpty())
                <div class="flex items-baseline gap-1 mb-6">
                    <span class="text-label-sm text-on-surface-variant">Mulai dari</span>
                    <span class="font-display-lg font-extrabold text-primary text-xl">Rp {{ number_format($item->pakets->min('harga'), 0, ',', '.') }}</span>
                </div>
                @else
                <div class="mb-6"></div>
                @endif
                <div class="mt-auto flex items-center justify-between">
                    <a href="{{ route('destinasi.show', $item->id) }}" class="px-6 py-2.5 rounded-lg border-2 border-primary text-primary font-label-sm text-label-sm hover:bg-primary hover:text-white transition-all active:scale-95">Lihat Paket</a>
                    <a href="{{ route('pemesanan.create', ['destinasi_id' => $item->id]) }}" class="px-6 py-2.5 rounded-lg bg-primary text-white font-label-sm text-label-sm hover:bg-primary-container transition-all active:scale-95 flex items-center gap-1">
                        <span class="material-symbols-outlined text-lg">hiking</span>
                        Pesan Wisata
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-20 text-on-surface-variant">
            <span class="material-symbols-outlined text-5xl mb-4 block">search_off</span>
            <p class="font-body-lg">Destinasi tidak ditemukan.</p>
        </div>
        @endforelse
    </section>

    {{-- PAGINATION --}}
    @if($destinasi->hasPages())
    <nav class="mt-16 flex justify-center items-center gap-2">
        @if($destinasi->onFirstPage())
        <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-outline cursor-not-allowed">
            <span class="material-symbols-outlined">chevron_left</span>
        </span>
        @else
        <a href="{{ $destinasi->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-colors active:scale-95">
            <span class="material-symbols-outlined">chevron_left</span>
        </a>
        @endif

        @foreach($destinasi->getUrlRange(1, $destinasi->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg font-label-sm text-label-sm active:scale-95 {{ $page == $destinasi->currentPage() ? 'bg-primary text-white' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-colors' }}">{{ $page }}</a>
        @endforeach

        @if($destinasi->hasMorePages())
        <a href="{{ $destinasi->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-colors active:scale-95">
            <span class="material-symbols-outlined">chevron_right</span>
        </a>
        @else
        <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-outline cursor-not-allowed">
            <span class="material-symbols-outlined">chevron_right</span>
        </span>
        @endif
    </nav>
    @endif
</main>
@endsection

@push('scripts')
<style>
    .card-hover-effect { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease; }
    .card-hover-effect:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0, 63, 135, 0.08); }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
</style>
<script>
    const searchInput = document.querySelector('input[name="search"]');
    let searchTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);
    });
</script>
@endpush
