@extends('layouts.app')

@section('title', 'Dashboard - TravelKu')

@section('content')
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 pt-28">
    {{-- Welcome Section --}}
    <div class="mb-8">
        <h2 class="text-headline-md font-headline-md font-bold text-primary">Halo, {{ auth()->user()->name }}!</h2>
        <p class="font-body-lg text-on-surface-variant">Siap untuk petualangan berikutnya di Bandar Lampung?</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter mb-10">
        <div class="bg-surface-container-lowest p-6 rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex items-center gap-4 group hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all">
            <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined text-3xl">shopping_cart</span>
            </div>
            <div>
                <p class="font-label-sm text-sm text-on-surface-variant">Total Pesanan</p>
                <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $totalPesanan }}</p>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex items-center gap-4 group hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all">
            <div class="w-14 h-14 rounded-full bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                <span class="material-symbols-outlined text-3xl">map</span>
            </div>
            <div>
                <p class="font-label-sm text-sm text-on-surface-variant">Destinasi Favorit</p>
                <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $destinasiFavorit->nama ?? '-' }}</p>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex items-center gap-4 group hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all">
            <div class="w-14 h-14 rounded-full bg-tertiary/10 flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">stars</span>
            </div>
            <div>
                <p class="font-label-sm text-sm text-on-surface-variant">Total Biaya</p>
                <p class="text-headline-md font-headline-md font-bold text-on-surface">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Pesanan Aktif --}}
    @if($pesananAktifItem)
    <div class="mb-12">
        <div class="flex justify-between items-end mb-6">
            <h3 class="text-headline-md font-headline-md text-on-surface">Pesanan Aktif</h3>
            <a href="{{ route('pemesanan.riwayat') }}" class="text-primary font-label-sm text-sm hover:underline">Lihat Semua</a>
        </div>
        <div class="bg-surface-container-lowest rounded-[24px] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 grid grid-cols-1 lg:grid-cols-12">
            <div class="lg:col-span-5 relative h-64 lg:h-auto bg-surface-container-low">
                @php $mobilFoto = ($pesananAktifItem->paket->foto ?? $pesananAktifItem->mobil->foto) ? asset('storage/' . ($pesananAktifItem->paket->foto ?? $pesananAktifItem->mobil->foto)) : null; @endphp
                @if($mobilFoto)
                <img class="w-full h-full object-cover" src="{{ $mobilFoto }}" alt="{{ $pesananAktifItem->mobil->nama }}">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/40">directions_car</span>
                </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full font-label-sm text-sm">
                        {{ $pesananAktifItem->status === 'berjalan' ? 'Sedang Berjalan' : ($pesananAktifItem->status === 'dikonfirmasi' ? 'Dikonfirmasi' : ($pesananAktifItem->status === 'menunggu_verifikasi' ? 'Menunggu Verifikasi' : 'Menunggu Pembayaran')) }}
                    </span>
                </div>
            </div>
            <div class="lg:col-span-7 p-8 flex flex-col justify-center">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h4 class="text-headline-md font-headline-md text-on-surface mb-1">{{ $pesananAktifItem->paket->nama ?? $pesananAktifItem->mobil->nama ?? 'Perjalanan' }}</h4>
                        <p class="text-on-surface-variant flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-sm">{{ $pesananAktifItem->paket_id ? 'hiking' : 'settings_input_component' }}</span>
                            @if($pesananAktifItem->paket_id)
                            {{ $pesananAktifItem->paket->destinasi->nama ?? $pesananAktifItem->destinasi->nama ?? 'Paket Wisata' }} · {{ $pesananAktifItem->mobil->nama ?? '' }}
                            @else
                            {{ ucfirst($pesananAktifItem->mobil->tipe ?? 'Manual') }} · {{ $pesananAktifItem->mobil->kapasitas ?? $pesananAktifItem->jumlah_penumpang }} Penumpang
                            @endif
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-label-sm text-on-surface-variant uppercase tracking-wider text-xs">ID Pesanan</p>
                        <p class="font-bold text-primary">#TRV-{{ str_pad($pesananAktifItem->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-8 bg-surface p-4 rounded-xl">
                    <div>
                        <p class="text-xs text-on-surface-variant mb-1">Keberangkatan</p>
                        <p class="font-bold text-on-surface">{{ $pesananAktifItem->tanggal_mulai ? $pesananAktifItem->tanggal_mulai->format('d M, H:i') : '-' }}</p>
                        <p class="text-sm text-on-surface-variant">{{ $pesananAktifItem->alamat_jemput }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant mb-1">Tujuan</p>
                        <p class="font-bold text-on-surface">{{ $pesananAktifItem->destinasi->nama ?? $pesananAktifItem->alamat_tujuan }}</p>
                        <p class="text-sm text-on-surface-variant">{{ $pesananAktifItem->jumlah_hari }} Hari</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('pemesanan.show', $pesananAktifItem->id) }}" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold hover:opacity-90 active:scale-95 transition-all shadow-lg shadow-primary/20">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Rekomendasi Destinasi --}}
    <div>
        <div class="flex justify-between items-end mb-6">
            <h3 class="text-headline-md font-headline-md text-on-surface">Rekomendasi Destinasi</h3>
            <a href="{{ route('destinasi.index') }}" class="text-primary font-label-sm text-sm hover:underline">Jelajahi Lampung</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($destinasiPopuler as $destinasi)
            @php $destFoto = $destinasi->foto ? asset('storage/' . $destinasi->foto) : null; @endphp
            <a href="{{ route('destinasi.show', $destinasi->id) }}" class="group relative bg-surface-container-lowest rounded-[24px] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="aspect-[4/5] relative">
                    @if($destFoto)
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $destFoto }}" alt="{{ $destinasi->nama }}">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">landscape</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute bottom-0 left-0 p-6 text-white w-full">
                        <p class="text-xs font-bold text-secondary-container uppercase mb-1">{{ $destinasi->kategori ?? 'Wisata' }}</p>
                        <h4 class="font-bold text-xl mb-1">{{ $destinasi->nama }}</h4>
                    </div>
                </div>
            </a>
            @endforeach
            {{-- CTA Card --}}
            <div class="bg-primary/5 rounded-[24px] border-2 border-dashed border-primary/30 flex flex-col items-center justify-center p-8 text-center group cursor-pointer hover:bg-primary/10 transition-all">
                <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">add</span>
                </div>
                <h4 class="font-bold text-primary mb-2">Punya Destinasi Impian?</h4>
                <p class="text-on-surface-variant text-sm mb-6">Ceritakan rute keinginanmu dan kami siapkan kendaraannya.</p>
                <a href="{{ route('pemesanan.create') }}" class="bg-primary text-white px-6 py-2 rounded-full text-sm font-bold active:scale-95 transition-all">Custom Trip</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<footer class="w-full py-6 mt-auto bg-surface-container-lowest border-t border-outline-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-4">
        <p class="font-label-sm text-sm text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. All rights reserved.</p>
        <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Syarat &amp; Ketentuan</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Kebijakan Privasi</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Bantuan</a>
        </div>
    </div>
</footer>
@endsection
