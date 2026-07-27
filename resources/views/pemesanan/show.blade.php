@extends('layouts.app')

@section('title', 'Detail Pesanan - TravelKu')

@php
    $statusMap = [
        'menunggu_pembayaran' => [
            'class' => 'bg-amber-50 text-amber-700 border-amber-200',
            'icon' => 'pending',
            'label' => 'Menunggu Pembayaran',
        ],
        'menunggu_verifikasi' => [
            'class' => 'bg-amber-50 text-amber-700 border-amber-200',
            'icon' => 'hourglass_top',
            'label' => 'Menunggu Verifikasi',
        ],
        'dikonfirmasi' => [
            'class' => 'bg-blue-50 text-blue-700 border-blue-200',
            'icon' => 'check_circle',
            'label' => 'Dikonfirmasi',
        ],
        'berjalan' => [
            'class' => 'bg-purple-50 text-purple-700 border-purple-200',
            'icon' => 'directions_car',
            'label' => 'Berjalan',
        ],
        'selesai' => [
            'class' => 'bg-green-50 text-green-700 border-green-200',
            'icon' => 'task_alt',
            'label' => 'Selesai',
        ],
        'ditolak' => ['class' => 'bg-red-50 text-red-700 border-red-200', 'icon' => 'cancel', 'label' => 'Ditolak'],
        'batal' => ['class' => 'bg-gray-100 text-gray-600 border-gray-200', 'icon' => 'block', 'label' => 'Batal'],
    ];
    $s = $statusMap[$pemesanan->status] ?? [
        'class' => 'bg-gray-100 text-gray-600 border-gray-200',
        'icon' => 'info',
        'label' => $pemesanan->status,
    ];
    $infoItems = [
        ['icon' => 'directions_car', 'label' => 'Mobil', 'value' => $pemesanan->mobil->nama ?? '-'],
        ['icon' => 'route', 'label' => 'Tujuan', 'value' => $pemesanan->destinasi->nama ?? $pemesanan->alamat_tujuan],
        [
            'icon' => 'location_on',
            'label' => 'Alamat Jemput',
            'value' => $pemesanan->alamat_jemput ?? '-',
            'full' => true,
        ],
        [
            'icon' => 'calendar_today',
            'label' => 'Tanggal Mulai',
            'value' => $pemesanan->tanggal_mulai
                ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d F Y')
                : '-',
        ],
        ['icon' => 'schedule', 'label' => 'Durasi', 'value' => $pemesanan->jumlah_hari . ' Hari'],
        ['icon' => 'groups', 'label' => 'Penumpang', 'value' => $pemesanan->jumlah_penumpang . ' Orang'],
    ];
@endphp

@section('content')
    <main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 pt-28">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 mb-6 text-on-surface-variant opacity-70 font-label-sm text-sm">
            <a href="{{ route('pemesanan.riwayat') }}" class="hover:text-primary">Riwayat Pemesanan</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-primary font-bold">Detail Pesanan #{{ $pemesanan->id }}</span>
        </nav>

        {{-- Page Header & Status --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h2 class="text-headline-md md:text-[32px] font-headline-md font-bold text-on-surface mb-1">Detail Pesanan
                </h2>
                <p class="text-on-surface-variant font-body-md">Invoice #{{ $pemesanan->id }}</p>
            </div>
            <div
                class="flex items-center gap-2 px-4 py-2 rounded-lg border font-semibold {{ $s['class'] }} {{ $pemesanan->status === 'menunggu_pembayaran' || $pemesanan->status === 'menunggu_verifikasi' ? 'animate-pulse' : '' }}">
                <span class="material-symbols-outlined"
                    style="font-variation-settings: 'FILL' 1;">{{ $s['icon'] }}</span>
                <span>{{ $s['label'] }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            {{-- Main: Informasi Pesanan --}}
            <section class="lg:col-span-2 space-y-gutter">
                <div
                    class="bg-surface-container-lowest p-8 rounded-[24px] card-shadow border border-outline-variant/30 bento-card">
                    <div class="flex items-center gap-3 mb-8 text-primary border-b border-outline-variant/50 pb-4">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">info</span>
                        <h3 class="font-headline-md">Informasi Pesanan</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        @foreach ($infoItems as $item)
                            <div class="flex items-start gap-4 {{ !empty($item['full']) ? 'md:col-span-2' : '' }}">
                                <div class="p-3 bg-surface-container rounded-lg text-primary">
                                    <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                                </div>
                                <div>
                                    <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">
                                        {{ $item['label'] }}</p>
                                    <p class="font-headline-md text-on-surface">{{ $item['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Status banner --}}
                @if (in_array($pemesanan->status, ['selesai', 'ditolak', 'batal']))
                    <div
                        class="rounded-[24px] p-6 {{ $pemesanan->status === 'selesai' ? 'bg-green-50 border border-green-200' : ($pemesanan->status === 'ditolak' ? 'bg-red-50 border border-red-200' : 'bg-gray-100 border border-gray-200') }}">
                        <div class="flex items-center gap-3">
                            <span
                                class="material-symbols-outlined {{ $pemesanan->status === 'selesai' ? 'text-green-700' : ($pemesanan->status === 'ditolak' ? 'text-red-700' : 'text-gray-600') }}"
                                style="font-variation-settings: 'FILL' 1;">
                                {{ $pemesanan->status === 'selesai' ? 'check_circle' : ($pemesanan->status === 'ditolak' ? 'cancel' : 'block') }}
                            </span>
                            <span
                                class="font-semibold {{ $pemesanan->status === 'selesai' ? 'text-green-700' : ($pemesanan->status === 'ditolak' ? 'text-red-700' : 'text-gray-600') }}">
                                {{ $pemesanan->status === 'selesai' ? 'Pesanan telah selesai. Terima kasih telah menggunakan layanan kami!' : ($pemesanan->status === 'ditolak' ? 'Pesanan ditolak. Silakan hubungi admin.' : 'Pesanan dibatalkan.') }}
                            </span>
                        </div>
                        @if ($pemesanan->status === 'selesai' && !$pemesanan->ulasan)
                            <a href="{{ route('ulasan.create', $pemesanan->id) }}"
                                class="mt-4 inline-flex items-center gap-2 text-green-700 font-bold text-sm hover:underline">
                                <span class="material-symbols-outlined text-sm">star</span>
                                Beri Ulasan
                            </a>
                        @endif
                    </div>
                @endif
            </section>

            {{-- Sidebar --}}
            <aside class="space-y-gutter">
                {{-- Rincian Biaya --}}
                <div
                    class="bg-surface-container-lowest p-8 rounded-[24px] card-shadow border border-outline-variant/30 bento-card">
                    <div class="flex items-center gap-3 mb-6 text-primary border-b border-outline-variant/50 pb-4">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings: 'FILL' 1;">receipt_long</span>
                        <h3 class="font-headline-md">Rincian Biaya</h3>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span class="font-body-md">Harga per Hari</span>
                            <span class="font-body-md">Rp
                                {{ number_format($pemesanan->mobil->harga_per_hari ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span class="font-body-md">Jumlah Hari</span>
                            <span class="font-body-md">{{ $pemesanan->jumlah_hari }}x</span>
                        </div>
                        <div class="pt-4 border-t border-outline-variant/50 flex justify-between items-center">
                            <span class="font-headline-md text-on-surface">Total</span>
                            <span class="text-headline-md font-bold text-primary">Rp
                                {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Payment Reminder --}}
                    @if ($pemesanan->status === 'menunggu_pembayaran')
                        <div class="p-4 bg-primary/5 rounded-lg border border-primary/10 mb-8">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">priority_high</span>
                                <p class="text-label-sm text-on-surface-variant">Silakan lakukan pembayaran untuk
                                    mempercepat proses verifikasi oleh tim kami.</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Aksi --}}
                <div class="space-y-4">
                    @if ($pemesanan->status === 'menunggu_pembayaran')
                        <a href="{{ route('pembayaran.create', $pemesanan->id) }}"
                            class="flex items-center justify-center gap-3 w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 active:scale-95 group">
                            <span
                                class="material-symbols-outlined group-hover:scale-110 transition-transform">credit_card</span>
                            <span class="font-headline-md">Bayar Sekarang</span>
                        </a>
                    @endif
                    @if ($pemesanan->status === 'menunggu_pembayaran')
                        <form method="POST" action="{{ route('pemesanan.batal', $pemesanan->id) }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center gap-3 w-full py-4 bg-error text-on-error font-bold rounded-xl hover:opacity-90 transition-all active:scale-95">
                                <span class="material-symbols-outlined">cancel</span>
                                <span class="font-headline-md">Batalkan Pesanan</span>
                            </button>
                        </form>
                    @endif
                    @if ($pemesanan->status === 'menunggu_verifikasi' && $pemesanan->pembayaran)
                        <a href="{{ route('pembayaran.konfirmasi', $pemesanan->id) }}"
                            class="flex items-center justify-center gap-3 w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 active:scale-95 group">
                            <span class="material-symbols-outlined group-hover:scale-110 transition-transform">search</span>
                            <span class="font-headline-md">Lihat Konfirmasi</span>
                        </a>
                    @endif
                    @if ($pemesanan->status === 'selesai' && !$pemesanan->ulasan)
                        <a href="{{ route('ulasan.create', $pemesanan->id) }}"
                            class="flex items-center justify-center gap-3 w-full py-4 bg-green-600 text-white font-bold rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 active:scale-95 group">
                            <span class="material-symbols-outlined group-hover:scale-110 transition-transform">star</span>
                            <span class="font-headline-md">Beri Ulasan</span>
                        </a>
                    @endif
                    <button onclick="window.print()"
                        class="flex items-center justify-center gap-3 w-full py-4 bg-transparent border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary/5 transition-all duration-200 active:scale-95">
                        <span class="material-symbols-outlined">print</span>
                        <span class="font-headline-md">Print</span>
                    </button>
                </div>
            </aside>
        </div>
    </main>
@endsection

@section('footer')
    <footer class="w-full py-6 mt-auto bg-surface-container-lowest border-t border-outline-variant">
        <div
            class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-4">
            <p class="font-label-sm text-sm text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. All rights
                reserved.</p>
            <div class="flex gap-6">
                <a href="#"
                    class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Syarat
                    &amp; Ketentuan</a>
                <a href="#"
                    class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Kebijakan
                    Privasi</a>
                <a href="#"
                    class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Bantuan</a>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')
    <style>
        .card-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .bento-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .bento-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        @media print {

            header,
            footer,
            nav {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .card-shadow {
                box-shadow: none !important;
            }

            .bento-card:hover {
                transform: none !important;
                box-shadow: none !important;
            }
        }
    </style>
@endpush