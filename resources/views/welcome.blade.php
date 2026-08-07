@extends('layouts.app')

@section('title', 'Wisata Bandar Lampung - CV. Afia Jaya Abadi')

@section('content')
{{-- HERO --}}
<section class="relative h-[78vh] min-h-[580px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/hero-pantai-mobil.png') }}')"></div>
        <div class="absolute inset-0 hero-gradient"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full text-white">
        <div class="max-w-2xl">
            <p class="mb-5 text-sm font-bold uppercase tracking-[0.18em] text-secondary-fixed">Travel &amp; rental mobil Lampung</p>
            <h2 class="font-display-lg text-4xl md:text-5xl lg:text-6xl font-semibold leading-tight mb-6">
               Jelajahi wisata Lampung dengan <span class="text-secondary-fixed">paket perjalanan terbaik.</span>
            </h2>
            <p class="font-body-lg text-lg md:text-xl opacity-90 mb-10 max-w-xl">
                Nikmati paket wisata lengkap dengan kendaraan dan supir profesional, atau sewa mobil untuk perjalanan fleksibel sesuai rencana Anda.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('destinasi.index') }}" class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-primary-container transition-all active:scale-95 shadow-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">hiking</span>
                    Pesan Paket Wisata
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ route('mobil.index') }}" class="bg-white/10 backdrop-blur border border-white/30 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition-all active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined">directions_car</span>
                    Sewa Mobil
                </a>
            </div>
        </div>
    </div>
</section>

{{-- QUICK ACTION WIDGET --}}
<section class="relative z-20 -mt-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto" id="booking">
    <div class="bg-surface-container-lowest p-6 md:p-8 rounded-2xl shadow-xl border border-outline-variant grid grid-cols-1 lg:grid-cols-2 gap-6">
        <a href="{{ route('destinasi.index') }}" class="group flex items-center gap-5 p-6 rounded-2xl border border-primary/15 bg-primary/5 hover:bg-primary/10 transition-all active:scale-[0.99]">
            <div class="w-14 h-14 rounded-2xl bg-primary text-on-primary flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-2xl">hiking</span>
            </div>
            <div class="flex-1">
                <h3 class="font-display-lg text-xl font-bold text-on-surface mb-1">Pesan Paket Wisata</h3>
                <p class="text-on-surface-variant font-body-md text-sm">Pilih destinasi &amp; paket perjalanan lengkap dengan kendaraan.</p>
            </div>
            <span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
        <a href="{{ route('mobil.index') }}" class="group flex items-center gap-5 p-6 rounded-2xl border border-outline-variant bg-surface-container-lowest hover:bg-surface-container-low transition-all active:scale-[0.99]">
            <div class="w-14 h-14 rounded-2xl bg-secondary text-on-secondary flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-2xl">directions_car</span>
            </div>
            <div class="flex-1">
                <h3 class="font-display-lg text-xl font-bold text-on-surface mb-1">Sewa Mobil</h3>
                <p class="text-on-surface-variant font-body-md text-sm">Pilih armada sesuai kebutuhan, fleksibel durasi sewa.</p>
            </div>
            <span class="material-symbols-outlined text-secondary group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
    </div>
</section>

{{-- DESTINASI UNGGULAN --}}
<section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="flex justify-between items-end mb-12">
        <div class="space-y-2">
            <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Destinasi Populer</span>
            <h3 class="font-display-lg text-3xl md:text-4xl font-bold text-on-surface">Wisata Terbaik di Lampung</h3>
        </div>
        <a href="{{ route('destinasi.index') }}" class="hidden md:flex items-center gap-2 text-primary font-bold hover:underline font-body-md">
            Lihat Semua
            <span class="material-symbols-outlined">chevron_right</span>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        @forelse($destinasis as $d)
        <div class="group relative h-[400px] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
            @if($d->foto)
            <img src="{{ asset('storage/'.$d->foto) }}" alt="{{ $d->nama }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            @else
            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary to-primary-container group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-white/40 text-7xl">map</span>
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs bg-white/20 backdrop-blur px-3 py-1 rounded-full font-semibold">{{ $d->kategori }}</span>
                </div>
                <h4 class="font-display-lg text-xl font-bold mb-1">{{ $d->nama }}</h4>
                <p class="text-sm opacity-80 line-clamp-2 font-body-md">{{ Str::limit($d->deskripsi, 80) }}</p>
            </div>
            <a href="{{ route('destinasi.show', $d->id) }}" class="absolute inset-0 z-10"><span class="sr-only">Detail {{ $d->nama }}</span></a>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-on-surface-variant">
            <span class="material-symbols-outlined text-5xl mb-4 block">map</span>
            <p class="font-body-lg">Belum ada destinasi tersedia.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-8 text-center md:hidden">
        <a href="{{ route('destinasi.index') }}" class="inline-flex items-center gap-2 text-primary font-bold font-body-md">
            Lihat Semua Destinasi
            <span class="material-symbols-outlined">chevron_right</span>
        </a>
    </div>
</section>

{{-- PAKET WISATA POPULER --}}
<section class="py-24 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="flex justify-between items-end mb-12">
            <div class="space-y-2">
                <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Paket Unggulan</span>
                <h3 class="font-display-lg text-3xl md:text-4xl font-bold text-on-surface">Paket Wisata Populer</h3>
            </div>
            <a href="{{ route('destinasi.index') }}" class="hidden md:flex items-center gap-2 text-primary font-bold hover:underline font-body-md">
                Jelajahi Semua
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @forelse($pakets as $p)
            <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="relative h-48 overflow-hidden bg-surface-container-low">
                    @if($p->foto)
                    <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @elseif($p->destinasi && $p->destinasi->foto)
                    <img src="{{ asset('storage/'.$p->destinasi->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-outline text-6xl">hiking</span>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-primary/90 text-white px-3 py-1 rounded-full text-label-sm font-label-sm backdrop-blur-md">{{ $p->durasi_hari }} Hari</div>
                </div>
                <div class="p-6">
                    <p class="text-xs font-bold text-secondary uppercase tracking-wider mb-1">{{ $p->destinasi->nama ?? 'Wisata' }}</p>
                    <h4 class="font-display-lg text-lg font-bold text-on-surface mb-2">{{ $p->nama }}</h4>
                    <p class="text-sm text-on-surface-variant font-body-md mb-4 line-clamp-2">{{ Str::limit($p->deskripsi, 90) }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-surface-variant">
                        <div>
                            <span class="text-xs text-on-surface-variant font-bold uppercase font-label-sm">Mulai Dari</span>
                            <p class="text-2xl font-bold text-primary font-display-lg">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('pemesanan.create', ['paket_id' => $p->id]) }}" class="bg-primary text-white p-3 rounded-2xl hover:bg-primary-container transition-all active:scale-95">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl mb-4 block">hiking</span>
                <p class="font-body-lg">Belum ada paket wisata tersedia.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-10 md:hidden">
            <a href="{{ route('destinasi.index') }}" class="inline-flex items-center gap-2 text-primary font-bold font-body-md">
                Jelajahi Semua Paket
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
    </div>
</section>

{{-- ARMADA MOBIL --}}
<section class="py-24">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-16 space-y-4">
            <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Armada Kami</span>
            <h3 class="font-display-lg text-3xl md:text-5xl font-bold text-on-surface">Pilih Mobil Sesuai Kebutuhan</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @forelse($mobils as $m)
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="rounded-3xl overflow-hidden aspect-[3/2] mb-6 bg-surface-container-low">
                    @if($m->foto)
                    <img src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-outline text-6xl">directions_car</span>
                    </div>
                    @endif
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-display-lg text-xl font-bold text-on-surface">{{ $m->nama }}</h4>
                            <p class="text-on-surface-variant text-sm font-body-md">{{ $m->merk }} &middot; {{ $m->tipe }}</p>
                        </div>
                        @if($loop->first)
                        <div class="bg-secondary-fixed text-on-secondary-fixed px-3 py-1 rounded-lg text-xs font-bold uppercase">Popular</div>
                        @endif
                    </div>
                    <div class="flex items-center gap-6 py-4 border-y border-surface-variant">
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-md">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <span class="text-sm font-semibold">{{ $m->kapasitas }} Kursi</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-md">
                            <span class="material-symbols-outlined text-primary">luggage</span>
                            <span class="text-sm font-semibold">{{ $m->kapasitas >= 7 ? '3' : '2' }} Bagasi</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <div>
                            <span class="text-xs text-on-surface-variant font-bold uppercase font-label-sm">Mulai Dari</span>
                            <p class="text-2xl font-bold text-primary font-display-lg">Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant font-body-md">/hari</span></p>
                        </div>
                        <a href="{{ route('pemesanan.create', ['mobil_id' => $m->id]) }}" class="bg-primary text-white p-3 rounded-2xl hover:bg-primary-container transition-all active:scale-95">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl mb-4 block">directions_car</span>
                <p class="font-body-lg">Belum ada mobil tersedia.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('mobil.index') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-xl font-bold hover:bg-primary-container transition-all active:scale-95 shadow-md font-display-lg">
                Lihat Semua Armada
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

{{-- TESTIMONIAL --}}
<section class="py-24 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16 space-y-4">
        <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Apa Kata Mereka</span>
        <h3 class="font-display-lg text-3xl md:text-5xl font-bold text-on-surface">Kepuasan Pelanggan</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
        @forelse($ulasans as $u)
        <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-surface-variant hover:shadow-md transition-shadow">
            <div class="flex gap-1 text-yellow-500 mb-6">
                @for($i = 1; $i <= 5; $i++)
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">{{ $i <= $u->rating ? 'star' : 'star_border' }}</span>
                @endfor
            </div>
            <p class="font-body-lg italic text-on-surface-variant mb-8 leading-relaxed">"{{ $u->komentar }}"</p>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-secondary-fixed-dim flex items-center justify-center text-primary font-bold font-display-lg">
                    {{ strtoupper(substr($u->user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h5 class="font-bold font-body-md">{{ $u->user->name ?? 'User' }}</h5>
                    <p class="text-sm text-on-surface-variant font-body-md">{{ $u->pemesanan->paket->nama ?? $u->pemesanan->mobil->nama ?? 'Pelanggan' }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-on-surface-variant">
            <span class="material-symbols-outlined text-5xl mb-4 block">star</span>
            <p class="font-body-lg">Belum ada testimoni.</p>
        </div>
        @endforelse
    </div>
    </div>
</section>
@endsection

@push('scripts')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush
