@extends('layouts.app')

@section('title', 'Wisata Bandar Lampung - CV. Afia Jaya Abadi')

@section('content')
{{-- HERO --}}
<section class="relative h-[90vh] min-h-[700px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&q=80')"></div>
        <div class="absolute inset-0 hero-gradient"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full text-white">
        <div class="max-w-2xl">
            <h2 class="font-display-lg text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
               Travel Wisata Bandar Lampung  <span class="text-secondary-fixed">Cv.Afia Jaya Abadi</span>
            </h2>
            <p class="font-body-lg text-lg md:text-xl opacity-90 mb-10 max-w-xl">
                Nikmati kemudahan menyewa mobil dengan pilihan lepas kunci atau driver berpengalaman. Harga terjangkau, proses cepat, dan siap menemani perjalanan Anda ke berbagai destinasi di bandar Lampung.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('pemesanan.create') }}" class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-primary-container transition-all active:scale-95 shadow-lg flex items-center gap-2">
                    Pesan Sekarang
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- BOOKING WIDGET --}}
<section class="relative z-20 -mt-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto" id="booking">
    <div class="bg-white/85 backdrop-blur-xl p-8 md:p-10 rounded-4xl shadow-2xl border border-white/20">
        <form action="{{ route('pemesanan.create') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 items-end">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-primary/80 px-1 font-label-sm">Lokasi Penjemputan</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">location_on</span>
                        <input type="text" name="alamat_jemput" placeholder="Bandara Radin Inten II" class="w-full pl-12 pr-4 py-3.5 bg-white border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all font-body-md">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-primary/80 px-1 font-label-sm">Destinasi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">map</span>
                        <select name="destinasi_id" class="w-full pl-12 pr-4 py-3.5 bg-white border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all appearance-none font-body-md">
                            <option value="">Ke mana tujuan Anda?</option>
                            @foreach($destinasis as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-primary/80 px-1 font-label-sm">Tanggal Mulai</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">calendar_today</span>
                        <input type="date" name="tanggal_mulai" class="w-full pl-12 pr-4 py-3.5 bg-white border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all font-body-md">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-primary/80 px-1 font-label-sm">Durasi (Hari)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">schedule</span>
                        <select name="jumlah_hari" class="w-full pl-12 pr-4 py-3.5 bg-white border border-outline-variant rounded-2xl focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all appearance-none font-body-md">
                            <option value="1">1 Hari</option>
                            <option value="3">3 Hari</option>
                            <option value="7">7 Hari</option>
                            <option value="14">14 Hari</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-2xl font-bold hover:bg-primary-container transition-all active:scale-95 shadow-md flex justify-center items-center gap-2 font-display-lg">
                        <span class="material-symbols-outlined">search</span>
                        Cari Mobil
                    </button>
                </div>
            </div>
        </form>
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
        <div class="group relative h-[400px] rounded-4xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
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

{{-- ARMADA MOBIL --}}
<section class="py-24 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-16 space-y-4">
            <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Armada Kami</span>
            <h3 class="font-display-lg text-3xl md:text-5xl font-bold text-on-surface">Pilih Mobil Sesuai Kebutuhan</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @forelse($mobils as $m)
            <div class="bg-surface-container-lowest rounded-4xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
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
<section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16 space-y-4">
        <span class="text-primary font-bold tracking-widest uppercase text-sm font-label-sm">Apa Kata Mereka</span>
        <h3 class="font-display-lg text-3xl md:text-5xl font-bold text-on-surface">Kepuasan Pelanggan</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
        @forelse($ulasans as $u)
        <div class="bg-surface-container-lowest p-8 rounded-4xl shadow-sm border border-surface-variant hover:shadow-md transition-shadow">
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
                    <p class="text-sm text-on-surface-variant font-body-md">{{ $u->pemesanan->mobil->nama ?? 'Pelanggan' }}</p>
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
</section>
@endsection

@push('scripts')
<style>
    [x-cloak] { display: none !important; }
</style>
<script>
    // Scroll reveal animation
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('section').forEach(section => {
        if (!section.closest('.fixed')) {
            section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(section);
        }
    });

    // Instant visibility for hero
    const hero = document.querySelector('section');
    if (hero) {
        hero.classList.remove('opacity-0', 'translate-y-10');
        hero.classList.add('opacity-100', 'translate-y-0');
    }
</script>
@endpush
