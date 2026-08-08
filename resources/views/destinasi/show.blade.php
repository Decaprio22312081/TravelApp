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
                @if($pakets->isNotEmpty())
                <span class="bg-white/20 backdrop-blur text-white px-4 py-1.5 rounded-full text-label-sm font-label-sm">{{ $pakets->count() }} Paket Wisata</span>
                @endif
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

            {{-- PACKAGES --}}
            <section class="mb-16" id="paket">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-headline-md text-2xl font-bold text-primary">Paket Wisata</h2>
                    <span class="text-label-sm text-on-surface-variant">Harga paket per perjalanan</span>
                </div>

                @forelse($pakets as $paket)
                <article class="bg-white rounded-3xl border border-surface-variant editorial-shadow overflow-hidden mb-6 group hover:border-primary/30 transition-all">
                    <div class="grid grid-cols-1 md:grid-cols-12">
                        <div class="md:col-span-4 relative h-52 md:h-auto overflow-hidden bg-surface-container-low">
                            @if($paket->foto)
                            <img src="{{ asset('storage/'.$paket->foto) }}" alt="{{ $paket->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-outline text-6xl">hiking</span>
                            </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-primary/90 text-white px-3 py-1 rounded-full text-label-sm font-label-sm backdrop-blur-md">
                                {{ $paket->durasi_hari }} Hari {{ $paket->durasi_hari > 1 ? $paket->durasi_hari - 1 . ' Malam' : '' }}
                            </div>
                        </div>
                        <div class="md:col-span-8 p-6 md:p-8 flex flex-col">
                            <div class="flex flex-wrap items-start justify-between gap-4 mb-3">
                                <h3 class="font-headline-md text-headline-md font-bold text-on-surface">{{ $paket->nama }}</h3>
                                <div class="text-right">
                                    <p class="text-label-sm text-on-surface-variant">Mulai dari</p>
                                    <p class="font-display-lg font-extrabold text-primary text-2xl">Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="font-body-md text-on-surface-variant mb-5">{{ $paket->deskripsi }}</p>

                            @if($paket->fasilitasList())
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($paket->fasilitasList() as $f)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary/5 border border-primary/10 text-primary text-label-sm font-label-sm">
                                    <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    {{ $f }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                            <div class="mt-auto flex flex-wrap items-center justify-between gap-4">
                                <a href="{{ route('pemesanan.create', ['paket_id' => $paket->id]) }}" class="px-8 py-3 rounded-xl bg-primary text-white font-label-sm text-label-sm hover:bg-primary-container transition-all active:scale-95 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                                    Pilih Paket Ini
                                </a>
                                <span class="text-label-sm text-on-surface-variant flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px] text-primary">verified</span>
                                    Termasuk mobil + supir
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="bg-surface-container-low rounded-3xl border border-dashed border-outline p-10 text-center">
                    <span class="material-symbols-outlined text-5xl text-outline mb-4 block">explore_off</span>
                    <h3 class="font-headline-md font-bold text-on-surface mb-2">Belum ada paket wisata</h3>
                    <p class="text-on-surface-variant font-body-md mb-6">Hubungi kami untuk merancang perjalanan custom ke {{ $destinasi->nama }}.</p>
                    <a href="{{ route('pemesanan.create', ['destinasi_id' => $destinasi->id]) }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-lg">hiking</span>
                        Buat Perjalanan Custom
                    </a>
                </div>
                @endforelse
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
                @if($pakets->isNotEmpty())
                <div>
                    <span class="font-label-sm text-on-surface-variant block mb-1">Paket termurah mulai dari</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-headline-md text-3xl font-extrabold text-primary">Rp {{ number_format($pakets->min('harga'), 0, ',', '.') }}</span>
                    </div>
                    <p class="text-on-surface-variant text-sm font-body-md mt-1">per perjalanan, termasuk kendaraan</p>
                </div>
                <a href="#paket" class="block w-full bg-primary text-white text-center py-4 rounded-2xl font-bold text-lg hover:bg-primary-container transition-all active:scale-[0.98] font-display-lg">
                    Lihat Paket Wisata
                </a>
                @endif

                <div class="space-y-4">
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">tour</span>
                        <span>Paket wisata lengkap &amp; terorganisir</span>
                    </div>
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">directions_car</span>
                        <span>Kendaraan + Supir Profesional</span>
                    </div>
                    <div class="flex items-center gap-3 font-body-md">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <span>Konfirmasi instan via WhatsApp</span>
                    </div>
                </div>

                @if($mobils->count() > 0)
                <hr class="border-surface-variant">
                <div>
                    <h4 class="font-headline-md font-bold text-primary mb-2">Kendaraan Pendukung</h4>
                    <p class="text-sm text-on-surface-variant font-body-md mb-4">Butuh sewa mobil terpisah?</p>
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
                    <a href="{{ route('mobil.index') }}" class="mt-4 block w-full border-2 border-primary text-primary text-center py-3 rounded-2xl font-bold hover:bg-primary hover:text-white transition-all active:scale-[0.98]">
                        Lihat Armada Sewa
                    </a>
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
