@extends('layouts.app')

@section('title', 'Pilih Mobil & Supir - TravelKu')

@section('content')
{{-- PAGE HEADER --}}
<section class="bg-surface-container-low pt-28 pb-12 md:pt-32 md:pb-16">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-primary mb-2">Pilih Mobil & Supir</h1>
        <p class="font-body-lg text-on-surface-variant">Temukan armada terbaik untuk perjalanan Anda di Lampung</p>
    </div>
</section>

{{-- MAIN CONTENT --}}
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <div class="flex flex-col lg:flex-row gap-gutter">
        {{-- SIDEBAR FILTER --}}
        <aside class="w-full lg:w-64 shrink-0">
            <form action="{{ route('mobil.index') }}" method="GET" id="filterForm">
                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-gutter border border-surface-container">
                    <div class="mb-4">
                        <h3 class="font-headline-md font-bold text-primary mb-1">Filter Mobil</h3>
                        <p class="text-on-surface-variant text-sm">Temukan kendaraan ideal</p>
                    </div>
                    <div class="space-y-6">
                        {{-- Car Type --}}
                        <div>
                            <span class="block font-bold text-sm mb-3 font-label-sm">Tipe Mobil</span>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all {{ !request('tipe') ? 'bg-secondary-fixed text-on-secondary-fixed-variant' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                                    <input type="radio" name="tipe" value="" {{ !request('tipe') ? 'checked' : '' }} class="hidden" onchange="this.form.submit()">
                                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">directions_car</span>
                                    <span class="font-medium">Semua Mobil</span>
                                </label>
                                @foreach($tipes as $t)
                                <label class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all {{ request('tipe') === $t ? 'bg-secondary-fixed text-on-secondary-fixed-variant' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                                    <input type="radio" name="tipe" value="{{ $t }}" {{ request('tipe') === $t ? 'checked' : '' }} class="hidden" onchange="this.form.submit()">
                                    <span class="material-symbols-outlined">{{ $loop->first ? 'airport_shuttle' : 'directions_car' }}</span>
                                    <span>{{ $t }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        {{-- Capacity --}}
                        <div>
                            <span class="block font-bold text-sm mb-3 font-label-sm">Kapasitas</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach([4, 6, 8, 12] as $cap)
                                <button type="button" onclick="setKapasitas({{ $cap }})" class="px-4 py-2 border rounded-full text-sm transition-colors font-body-md {{ request('kapasitas') == $cap ? 'bg-primary text-white border-primary' : 'border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary' }}">{{ $cap <= 6 ? $cap . '-' . ($cap+2) : $cap }}+</button>
                                @endforeach
                                <input type="hidden" name="kapasitas" id="kapasitasInput" value="{{ request('kapasitas') }}">
                            </div>
                        </div>
                        {{-- Price Range --}}
                        <div>
                            <span class="block font-bold text-sm mb-3 font-label-sm">Rentang Harga</span>
                            <input type="range" name="harga_max" min="0" max="5000000" step="50000" value="{{ request('harga_max', 5000000) }}" class="w-full accent-primary" oninput="updatePriceLabel(this.value); document.getElementById('filterForm').submit()">
                            <div class="flex justify-between text-xs text-outline mt-2 font-body-md">
                                <span>Rp 0</span>
                                <span id="priceLabel">Rp {{ request('harga_max') ? number_format(request('harga_max'), 0, ',', '.') : '5.000.000' }}+</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('mobil.index') }}" class="mt-8 text-primary font-bold text-sm w-full block text-center py-3 border border-primary rounded-lg hover:bg-primary hover:text-white transition-all font-label-sm">
                        Hapus Filter
                    </a>
                </div>
            </form>
        </aside>

        {{-- CAR GRID --}}
        <section class="flex-1">
            {{-- Sorting --}}
            <div class="flex justify-between items-center mb-8">
                <span class="text-on-surface-variant font-medium font-body-md">{{ $mobil->total() }} Mobil tersedia</span>
                <div class="flex items-center gap-4">
                    <select name="sort" form="filterForm" onchange="this.form.submit()" class="bg-white border border-outline-variant rounded-lg text-sm font-medium shadow-sm focus:ring-primary outline-none px-4 py-2.5 font-body-md">
                        <option value="terendah" {{ request('sort', 'terendah') === 'terendah' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="tertinggi" {{ request('sort') === 'tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    </select>
                </div>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($mobil as $item)
                <div class="bg-surface-container-lowest rounded-[24px] overflow-hidden card-shadow flex flex-col h-full border border-surface-container">
                    <div class="relative h-48 bg-surface-container-low p-4 overflow-hidden flex items-center justify-center">
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-contain mix-blend-multiply transition-transform duration-500 hover:scale-105">
                        @else
                        <span class="material-symbols-outlined text-outline text-6xl">directions_car</span>
                        @endif
                        <span class="absolute top-4 left-4 text-xs font-bold px-3 py-1 rounded-full border {{ $item->status === 'tersedia' ? 'bg-[#E8F5E9] text-[#2E7D32] border-[#2E7D32]/20' : 'bg-[#F5F5F5] text-[#616161] border-outline-variant' }}">{{ $item->status === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="font-headline-md text-headline-md font-bold text-on-surface mb-2">{{ $item->nama }}</h3>
                        <div class="flex items-center gap-2 text-on-surface-variant mb-6 font-body-md">
                            <span class="material-symbols-outlined text-primary text-xl">person</span>
                            <span class="text-sm font-medium">{{ $item->kapasitas }} Kursi</span>
                            <span class="mx-2 text-outline-variant">|</span>
                            <span class="material-symbols-outlined text-primary text-xl">settings</span>
                            <span class="text-sm font-medium">{{ $item->merk }}</span>
                        </div>
                        <div class="mt-auto pt-6 border-t border-outline-variant/30 flex items-end justify-between">
                            <div>
                                <p class="text-xs text-outline mb-1 font-label-sm">Mulai dari</p>
                                <p class="font-bold text-primary text-lg font-display-lg">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}<span class="text-xs font-normal text-on-surface-variant font-body-md">/hari</span></p>
                            </div>
                            <a href="{{ route('mobil.show', $item->id) }}" class="bg-primary text-white px-5 py-2.5 rounded-lg font-bold text-sm hover:bg-primary-container transition-colors font-label-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20 text-on-surface-variant">
                    <span class="material-symbols-outlined text-5xl mb-4 block">search_off</span>
                    <p class="font-body-lg">Tidak ada mobil yang sesuai filter.</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($mobil->hasPages())
            <nav class="mt-16 flex justify-center items-center gap-2">
                @if($mobil->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-outline cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
                @else
                <a href="{{ $mobil->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
                @endif

                @foreach($mobil->getUrlRange(1, $mobil->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg font-bold text-sm {{ $page == $mobil->currentPage() ? 'bg-primary text-white' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">{{ $page }}</a>
                @endforeach

                @if($mobil->hasMorePages())
                <a href="{{ $mobil->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
                @else
                <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-outline cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
                @endif
            </nav>
            @endif
        </section>
    </div>
</main>

{{-- CTA --}}
<section class="bg-primary text-white py-16">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="text-center md:text-left">
            <h2 class="font-display-lg text-2xl md:text-3xl font-bold mb-2">Butuh bantuan memilih armada?</h2>
            <p class="font-body-lg opacity-90">Tim kami siap membantu merekomendasikan mobil terbaik untuk perjalanan Anda.</p>
        </div>
        <a href="https://wa.me/6282112345678" target="_blank" class="bg-white text-primary px-8 py-4 rounded-xl font-bold flex items-center gap-3 hover:scale-105 transition-transform shadow-lg font-display-lg">
            <span class="material-symbols-outlined">chat</span>
            Hubungi Kami via WhatsApp
        </a>
    </div>
</section>
@endsection

@push('scripts')
<style>
    .card-shadow {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }
    .card-shadow:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transform: translateY(-4px);
    }
</style>
<script>
    function setKapasitas(val) {
        document.getElementById('kapasitasInput').value = val;
        document.getElementById('filterForm').submit();
    }
    function updatePriceLabel(val) {
        document.getElementById('priceLabel').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(val) + '+';
    }
</script>
@endpush
