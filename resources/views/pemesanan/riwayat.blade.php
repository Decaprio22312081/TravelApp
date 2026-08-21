@extends('layouts.app')

@section('title', 'Riwayat Pesanan - TravelKu')

@section('content')
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 pt-28">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-primary mb-1">Riwayat Pemesanan</h2>
            <p class="text-on-surface-variant">Pantau status paket wisata &amp; penyewaan kendaraan Anda di sini.</p>
        </div>
        <div class="flex items-center gap-1 sm:gap-2 bg-surface-container-low p-1 rounded-xl border border-outline-variant/30 w-full sm:w-auto" x-data="{ tab: 'semua' }">
            <button @click="tab = 'semua'" :class="tab === 'semua' ? 'bg-surface-container-lowest text-primary font-bold shadow-sm' : 'text-on-surface-variant'" class="flex-1 sm:flex-none px-2 sm:px-6 py-2 rounded-lg transition-all text-xs sm:text-body-md text-center whitespace-nowrap">Semua</button>
            <button @click="tab = 'menunggu'" :class="tab === 'menunggu' ? 'bg-surface-container-lowest text-primary font-bold shadow-sm' : 'text-on-surface-variant'" class="flex-1 sm:flex-none px-2 sm:px-6 py-2 rounded-lg transition-all text-xs sm:text-body-md text-center whitespace-nowrap">Menunggu</button>
            <button @click="tab = 'aktif'" :class="tab === 'aktif' ? 'bg-surface-container-lowest text-primary font-bold shadow-sm' : 'text-on-surface-variant'" class="flex-1 sm:flex-none px-2 sm:px-6 py-2 rounded-lg transition-all text-xs sm:text-body-md text-center whitespace-nowrap">Aktif</button>
            <button @click="tab = 'selesai'" :class="tab === 'selesai' ? 'bg-surface-container-lowest text-primary font-bold shadow-sm' : 'text-on-surface-variant'" class="flex-1 sm:flex-none px-2 sm:px-6 py-2 rounded-lg transition-all text-xs sm:text-body-md text-center whitespace-nowrap">Selesai</button>
        </div>
    </div>

    {{-- Booking List --}}
    <div class="space-y-6">
        @forelse($pemesanans as $item)
        @php
        $isCancelled = in_array($item->status, ['ditolak', 'batal']);
        $isActive = in_array($item->status, ['berjalan', 'dikonfirmasi']);
        $isWaiting = in_array($item->status, ['menunggu_pembayaran', 'menunggu_verifikasi']);
        $filterTab = $isCancelled ? 'selesai' : ($isActive ? 'aktif' : ($isWaiting ? 'menunggu' : 'selesai'));
        $mobilFoto = $item->mobil->foto ? asset('storage/' . $item->mobil->foto) : null;
        $endDate = $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->addDays($item->jumlah_hari - 1)->format('d M Y') : '';
        $startDate = $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') : $item->created_at->format('d M Y');
        $statusBadge = function() use ($item) {
            $map = [
                'menunggu_pembayaran' => ['class' => 'bg-amber-100 text-amber-700', 'icon' => 'schedule', 'label' => 'Menunggu Pembayaran'],
                'menunggu_verifikasi' => ['class' => 'bg-amber-100 text-amber-700', 'icon' => 'schedule', 'label' => 'Menunggu Verifikasi'],
                'dikonfirmasi' => ['class' => 'bg-secondary-fixed/30 text-secondary', 'icon' => 'check_circle', 'label' => 'Dikonfirmasi', 'pulse' => true],
                'berjalan' => ['class' => 'bg-secondary-fixed/30 text-secondary', 'icon' => '', 'label' => 'Aktif', 'pulse' => true],
                'selesai' => ['class' => 'bg-emerald-100 text-emerald-700', 'icon' => 'check_circle', 'label' => 'Selesai'],
                'ditolak' => ['class' => 'bg-error-container text-on-error-container', 'icon' => 'cancel', 'label' => 'Ditolak'],
                'batal' => ['class' => 'bg-error-container text-on-error-container', 'icon' => 'cancel', 'label' => 'Dibatalkan'],
            ];
            return $map[$item->status] ?? ['class' => 'bg-gray-100 text-gray-600', 'icon' => 'info', 'label' => $item->status];
        };
        $badge = $statusBadge();
        @endphp
        <div class="bg-surface-container-lowest rounded-[24px] p-6 shadow-[0px_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all group border border-transparent hover:border-primary/10"
             x-show="tab === 'semua' || tab === '{{ $filterTab }}'"
             x-transition:enter.duration.300ms>
            <div class="flex flex-col lg:flex-row items-center gap-6 {{ $isCancelled ? 'opacity-60 grayscale' : '' }}">
                <div class="w-full lg:w-48 h-32 rounded-xl overflow-hidden bg-surface-container-low flex-shrink-0 relative">
                    @if($mobilFoto)
                    <img class="w-full h-full object-cover {{ $isCancelled ? 'grayscale' : '' }}" src="{{ $mobilFoto }}" alt="{{ $item->mobil->nama }}">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-on-surface-variant/40">directions_car</span>
                    </div>
                    @endif
                </div>
                <div class="flex-1 w-full">
                    <div class="flex flex-wrap justify-between items-start mb-4 gap-2">
                        <div>
                            <span class="text-primary font-bold text-sm tracking-wide">#TRV-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="font-headline-md text-xl font-bold text-on-surface">{{ $item->paket->nama ?? $item->mobil->nama ?? 'Perjalanan' }}</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-primary/10 text-primary text-[11px] font-bold uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-sm">{{ $item->paket_id ? 'hiking' : 'directions_car' }}</span>
                                    {{ $item->paket_id ? 'Paket Wisata' : 'Sewa Mobil' }}
                                </span>
                            </div>
                            <p class="flex items-center gap-1 text-on-surface-variant text-sm mt-1">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                {{ $startDate }}{{ $endDate ? ' - ' . $endDate : '' }}
                            </p>
                        </div>
                        <span class="px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider flex items-center gap-1 {{ $badge['class'] }}">
                            @if(!empty($badge['pulse']))
                            <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                            @elseif(!empty($badge['icon']))
                            <span class="material-symbols-outlined text-sm">{{ $badge['icon'] }}</span>
                            @endif
                            {{ $badge['label'] }}
                        </span>
                    </div>
                    <div class="flex flex-wrap items-center gap-x-8 gap-y-2 border-t border-outline-variant/30 pt-4">
                        <div>
                            <p class="text-xs text-on-surface-variant">Tujuan</p>
                            <p class="font-bold text-on-surface flex items-center gap-1">
                                <span class="material-symbols-outlined text-primary text-sm">location_on</span>
                                {{ $item->destinasi->nama ?? $item->alamat_tujuan }}
                            </p>
                        </div>
                        @if(!$isCancelled)
                        <div>
                            <p class="text-xs text-on-surface-variant">Total Biaya</p>
                            <p class="font-bold text-primary text-lg">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                        </div>
                        @endif
                        <div class="ml-auto">
                            <a href="{{ route('pemesanan.show', $item->id) }}" class="inline-flex items-center gap-2 bg-surface-container-low text-primary px-6 py-2.5 rounded-xl font-bold hover:bg-primary hover:text-white transition-all active:scale-95">
                                Lihat Detail
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">calendar_month</span>
            <p class="text-on-surface-variant font-body-lg mb-4">Belum ada pemesanan</p>
            <a href="{{ route('pemesanan.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary font-bold px-6 py-3 rounded-xl hover:opacity-90 active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                Pesan Sekarang
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($pemesanans->hasPages())
    <div class="mt-8">
        {{ $pemesanans->links() }}
    </div>
    @endif
</main>
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

@push('scripts')
<style>
    .booking-card {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .booking-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
</style>
@endpush
