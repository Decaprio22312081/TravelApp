@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran - TravelKu')

@php $pembayaran = $pemesanan->pembayaran; @endphp

@section('content')
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 pt-28">
    {{-- Breadcrumbs --}}
    <nav class="flex items-center gap-2 mb-6 text-on-surface-variant opacity-70 font-label-sm text-sm">
        <a href="{{ route('pemesanan.riwayat') }}" class="hover:text-primary">Riwayat Pemesanan</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a href="{{ route('pemesanan.show', $pemesanan->id) }}" class="hover:text-primary">Detail Pesanan #{{ $pemesanan->id }}</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-primary font-bold">Verifikasi Pembayaran</span>
    </nav>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div class="space-y-1">
            <h2 class="text-headline-md font-headline-md text-primary">Verifikasi Pembayaran</h2>
            <p class="text-on-surface-variant font-body-md">Tinjau status dan detail bukti transfer yang Anda unggah.</p>
        </div>
        @php
            $payStatusClass = [
                'menunggu_verifikasi' => 'bg-amber-50 text-amber-700 border-amber-200',
                'terverifikasi' => 'bg-green-50 text-green-700 border-green-200',
                'ditolak' => 'bg-red-50 text-red-700 border-red-200',
            ][$pembayaran->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
            $payStatusIcon = [
                'menunggu_verifikasi' => 'pending',
                'terverifikasi' => 'check_circle',
                'ditolak' => 'cancel',
            ][$pembayaran->status] ?? 'info';
            $payStatusLabel = [
                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                'terverifikasi' => 'Terverifikasi',
                'ditolak' => 'Ditolak',
            ][$pembayaran->status] ?? $pembayaran->status;
        @endphp
        <div class="flex items-center gap-2 px-4 py-2 rounded-lg border {{ $payStatusClass }}">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">{{ $payStatusIcon }}</span>
            <span class="font-label-sm text-sm uppercase tracking-wide">{{ $payStatusLabel }}</span>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        {{-- Left: Detail Pembayaran --}}
        <div class="lg:col-span-7 space-y-gutter">
            <div class="bg-surface-container-lowest rounded-[24px] p-8 card-shadow border border-outline-variant/30">
                <div class="flex items-center gap-3 mb-8 pb-4 border-b border-outline-variant/50">
                    <span class="material-symbols-outlined text-primary">receipt_long</span>
                    <h3 class="font-headline-md text-xl text-on-surface">Detail Pembayaran</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12">
                    <div class="space-y-1">
                        <p class="text-on-surface-variant font-label-sm text-xs uppercase tracking-wider opacity-60">Nama Pengirim</p>
                        <p class="font-body-lg text-body-lg text-on-surface font-semibold">{{ $pembayaran->nama_pengirim }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-on-surface-variant font-label-sm text-xs uppercase tracking-wider opacity-60">Bank Pengirim</p>
                        <p class="font-body-lg text-body-lg text-on-surface font-semibold">{{ $pembayaran->bank_pengirim }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-on-surface-variant font-label-sm text-xs uppercase tracking-wider opacity-60">Tanggal Transfer</p>
                        <p class="font-body-lg text-body-lg text-on-surface font-semibold">{{ $pembayaran->tanggal_transaksi ? \Carbon\Carbon::parse($pembayaran->tanggal_transaksi)->format('d/m/Y') : '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-on-surface-variant font-label-sm text-xs uppercase tracking-wider opacity-60">Nominal Transfer</p>
                        <p class="font-body-lg text-body-lg text-primary font-bold text-xl">Rp {{ number_format($pembayaran->nominal_transfer, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($pembayaran->status === 'menunggu_verifikasi')
                <div class="mt-10 p-4 bg-secondary-fixed/30 rounded-lg border border-secondary-fixed flex items-start gap-4">
                    <span class="material-symbols-outlined text-secondary">info</span>
                    <p class="font-body-md text-sm text-on-secondary-fixed-variant leading-relaxed">
                        Tim kami akan memverifikasi pembayaran Anda dalam waktu maksimal 1x24 jam. Anda akan menerima notifikasi melalui WhatsApp setelah proses selesai.
                    </p>
                </div>
                @endif

                @if($pembayaran->status === 'ditolak' && $pembayaran->catatan_admin)
                <div class="mt-10 p-4 bg-red-50 rounded-lg border border-red-200 flex items-start gap-4">
                    <span class="material-symbols-outlined text-error">warning</span>
                    <div>
                        <p class="font-bold text-on-surface">Pembayaran Ditolak</p>
                        <p class="text-sm text-on-surface-variant mt-1">{{ $pembayaran->catatan_admin }}</p>
                        <a href="{{ route('pembayaran.create', $pemesanan->id) }}" class="inline-flex items-center gap-2 mt-3 text-error font-bold text-sm hover:underline">
                            <span class="material-symbols-outlined text-sm">upload</span>
                            Upload Ulang
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a href="{{ route('pemesanan.show', $pemesanan->id) }}" class="flex-1 flex items-center justify-center gap-2 py-4 px-6 bg-primary text-on-primary font-bold rounded-xl hover:opacity-90 transition-all active:scale-95 shadow-sm">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali ke Detail Pesanan
                </a>
                <button onclick="window.print()" class="flex items-center justify-center gap-2 py-4 px-8 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary/5 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Unduh Invoice
                </button>
            </div>
        </div>

        {{-- Right: Bukti Transfer --}}
        <div class="lg:col-span-5">
            <div class="bg-surface-container-lowest rounded-[24px] p-8 card-shadow border border-outline-variant/30 h-full">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-outline-variant/50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">image</span>
                        <h3 class="font-headline-md text-xl text-on-surface">Bukti Transfer</h3>
                    </div>
                </div>

                @if($pembayaran->bukti_pembayaran)
                    @php $ext = pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION); @endphp
                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                    <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank" class="block relative group cursor-pointer overflow-hidden rounded-xl border border-outline-variant bg-surface-container-low">
                        <img src="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" alt="Bukti Transfer" class="w-full object-cover transition-transform duration-500 group-hover:scale-105" style="aspect-ratio: 3/4;">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white font-bold bg-primary/80 px-4 py-2 rounded-full flex items-center gap-2">
                                <span class="material-symbols-outlined">visibility</span>
                                Lihat Gambar
                            </span>
                        </div>
                    </a>
                    <p class="mt-4 text-center text-on-surface-variant font-label-sm text-xs italic">Klik gambar untuk melihat resolusi penuh</p>
                    @else
                    <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank" class="flex flex-col items-center justify-center p-12 rounded-xl border border-dashed border-outline-variant bg-surface-container-low hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined text-5xl text-primary mb-3">picture_as_pdf</span>
                        <span class="font-bold text-primary">Lihat File PDF</span>
                    </a>
                    @endif
                @else
                <div class="flex flex-col items-center justify-center p-12 rounded-xl border border-dashed border-outline-variant bg-surface-container-low">
                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/30 mb-3">image_not_supported</span>
                    <p class="text-on-surface-variant">Bukti transfer belum tersedia</p>
                </div>
                @endif

                <div class="mt-8 pt-6 border-t border-outline-variant/30">
                    <h4 class="font-label-sm text-label-sm text-on-surface mb-3">Butuh bantuan?</h4>
                    @php $noTelpSetting = \App\Models\Setting::where('key', 'no_telp')->first(); @endphp
                    <a href="tel:{{ $noTelpSetting->value ?? '+6282112345678' }}" class="flex items-center gap-3 p-4 bg-surface-container-high rounded-xl hover:bg-surface-container-highest transition-colors">
                        <span class="material-symbols-outlined text-secondary">support_agent</span>
                        <div class="text-left">
                            <p class="font-body-md text-sm font-bold text-on-surface">Hubungi Customer Service</p>
                            <p class="text-xs text-on-surface-variant">Tersedia 24/7 untuk bantuan pembayaran</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer')
<footer class="w-full py-6 mt-auto bg-surface-container-lowest border-t border-outline-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-4">
        <p class="font-label-sm text-sm text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. All rights reserved.</p>
        <div class="flex gap-6">
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Syarat &amp; Ketentuan</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Kebijakan Privasi</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Bantuan</a>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<style>
    .card-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
    @media print {
        header, footer, nav { display: none !important; }
        body { background: white !important; }
        .card-shadow { box-shadow: none !important; }
    }
</style>
@endpush
