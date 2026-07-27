@extends('layouts.app')

@section('title', $destinasi->nama . ' - TravelKu')

@section('content')
<main class="max-w-container-max mx-auto pb-20">
    {{-- HERO --}}
    <div class="relative w-full h-[50vh] md:h-[70vh] overflow-hidden">
        @if($destinasi->foto)
        <img src="{{ asset('storage/'.$destinasi->foto) }}" alt="{{ $destinasi->nama }}" class="w-full h-full object-cover">
        @else
        <div class="w-full h-full bg-gradient-to-br from-primary/30 to-primary/10 flex items-center justify-center">
            <span class="material-symbols-outlined text-outline text-8xl">map</span>
        </div>
        @endif
        <a href="{{ route('destinasi.index') }}" class="absolute top-24 left-6 z-10 w-12 h-12 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-primary shadow-lg hover:bg-white transition-all active:scale-90">
            <span class="material-symbols-outlined text-xl">arrow_back</span>
        </a>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end px-margin-mobile md:px-margin-desktop">
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-primary text-white px-4 py-1.5 rounded-full text-label-sm font-label-sm uppercase tracking-wider">{{ $destinasi->kategori }}</span>
            </div>
            <h1 class="text-white font-display-lg text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">{{ $destinasi->nama }}</h1>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="px-margin-mobile md:px-margin-desktop grid grid-cols-1 lg:grid-cols-12 gap-12 mt-12">
        {{-- LEFT: Main Content --}}
        <div class="lg:col-span-8">
            {{-- Description --}}
            <section class="mb-16">
                <h2 class="font-headline-md text-2xl font-bold text-primary mb-6">Tentang {{ $destinasi->nama }}</h2>
                <p class="font-body-lg text-on-surface-variant leading-relaxed">{{ $destinasi->deskripsi }}</p>
            </section>

            {{-- Gallery --}}
            @if($destinasi->foto)
            <section class="mb-16">
                <h2 class="font-headline-md text-2xl font-bold text-primary mb-6">Galeri</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="aspect-square rounded-3xl overflow-hidden editorial-shadow hover:scale-[1.02] transition-transform cursor-pointer">
                        <img src="{{ asset('storage/'.$destinasi->foto) }}" alt="{{ $destinasi->nama }}" class="w-full h-full object-cover">
                    </div>
                </div>
            </section>
            @endif

            {{-- Map --}}
            @if($destinasi->latitude && $destinasi->longitude)
            <section class="mb-16">
                <h2 class="font-headline-md text-2xl font-bold text-primary mb-6">Lokasi &amp; Akses</h2>
                <div class="bg-surface-container rounded-3xl overflow-hidden h-80 relative editorial-shadow">
                    <iframe
                        width="100%"
                        height="100%"
                        style="border:0; filter: grayscale(0.3);"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q={{ $destinasi->latitude }},{{ $destinasi->longitude }}&output=embed">
                    </iframe>
                </div>
            </section>
            @endif

            {{-- Reviews --}}
            @if($ulasans->isNotEmpty())
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-headline-md text-2xl font-bold text-primary">Apa Kata Mereka?</h2>
                </div>
                <div class="space-y-6">
                    @foreach($ulasans as $u)
                    <div class="bg-white p-8 rounded-2xl editorial-shadow border border-surface-variant">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary-fixed rounded-full flex items-center justify-center font-bold text-primary font-display-lg">
                                {{ strtoupper(substr($u->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-headline-md text-sm font-bold">{{ $u->user->name ?? 'User' }}</h4>
                                <div class="flex text-amber-500 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $u->rating ? 1 : 0 }};">star</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="font-body-md text-on-surface-variant italic">"{{ $u->komentar }}"</p>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>

        {{-- RIGHT: Sticky Sidebar --}}
        <div class="lg:col-span-4">
            <aside class="sticky top-28 bg-white rounded-3xl p-8 border border-surface-variant editorial-shadow space-y-8">
                @php $mobil = $mobils->first(); @endphp
                @if($mobil)
                <div>
                    <span class="font-label-sm text-on-surface-variant block mb-1">Mulai dari</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-headline-md text-3xl font-extrabold text-primary">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span>
                        <span class="text-on-surface-variant text-sm font-body-md">/ hari</span>
                    </div>
                </div>
                @endif

                <div class="space-y-4">
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">directions_car</span>
                        <span>Mobil dengan Supir Profesional</span>
                    </div>
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">local_gas_station</span>
                        <span>Bahan Bakar Termasuk</span>
                    </div>
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <span>Asuransi Perjalanan</span>
                    </div>
                </div>

                <div class="pt-4 space-y-3">
                    <a href="{{ route('pemesanan.create', ['destinasi_id' => $destinasi->id]) }}" class="block w-full bg-primary text-white text-center py-4 rounded-2xl font-bold text-lg hover:bg-primary-container transition-all active:scale-[0.98] font-display-lg">
                        Pesan Travel ke Sini
                    </a>
                    <p class="text-center text-label-sm text-on-surface-variant">Konfirmasi instan via WhatsApp</p>
                </div>

                @if($mobils->count() > 0)
                <hr class="border-surface-variant">
                <div>
                    <h4 class="font-headline-md font-bold text-primary mb-4">Armada Tersedia</h4>
                    <div class="space-y-3">
                        @foreach($mobils as $m)
                        <div class="flex items-center justify-between py-3 border-b border-surface-variant last:border-0">
                            <div>
                                <p class="font-bold text-on-surface font-body-md">{{ $m->nama }}</p>
                                <p class="text-sm text-on-surface-variant font-body-md">{{ $m->kapasitas }} Kursi</p>
                            </div>
                            <span class="font-bold text-primary font-display-lg">Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<style>
    .editorial-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
</style>
@endpush
