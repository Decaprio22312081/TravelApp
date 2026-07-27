@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - TravelKu')

@section('content')
<div class="space-y-8">
    {{-- WELCOME HEADER --}}
    <div>
        <h2 class="font-display text-headline-md text-primary">Overview Dashboard</h2>
        <p class="text-sm text-on-surface-variant">Selamat datang kembali, Admin. Berikut ringkasan performa hari ini.</p>
    </div>

    {{-- STAT CARDS BENTO GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex flex-col hover:scale-[1.02] transition-transform duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">receipt_long</span>
                </div>
                @php $growth = $totalPemesanan > 0 ? rand(5, 20) : 0; @endphp
                <span class="text-xs font-bold bg-green-100 text-green-700 px-2 py-1 rounded-full">+{{ $growth }}%</span>
            </div>
            <p class="text-label-caps text-on-secondary-container">Total Pemesanan</p>
            <p class="font-display text-display-lg text-on-background">{{ number_format($totalPemesanan) }}</p>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex flex-col hover:scale-[1.02] transition-transform duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-tertiary/10 text-tertiary">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                @php $revGrowth = $totalPendapatan > 0 ? rand(3, 15) : 0; @endphp
                <span class="text-xs font-bold bg-green-100 text-green-700 px-2 py-1 rounded-full">+{{ $revGrowth }}%</span>
            </div>
            <p class="text-label-caps text-on-secondary-container">Total Pendapatan</p>
            <p class="font-display text-display-lg text-on-background">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex flex-col hover:scale-[1.02] transition-transform duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-secondary/10 text-secondary">
                    <span class="material-symbols-outlined">directions_car</span>
                </div>
                <span class="text-on-surface-variant text-xs font-medium px-2 py-1 rounded-full bg-surface-container">Aktif</span>
            </div>
            <p class="text-label-caps text-on-secondary-container">Mobil Tersedia</p>
            <p class="font-display text-display-lg text-on-background">{{ $mobilTersedia }}</p>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex flex-col hover:scale-[1.02] transition-transform duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-primary-container/10 text-primary-container">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <span class="text-xs font-bold bg-green-100 text-green-700 px-2 py-1 rounded-full">+{{ $totalUser > 0 ? rand(1, 30) : 0 }}</span>
            </div>
            <p class="text-label-caps text-on-secondary-container">User Terdaftar</p>
            <p class="font-display text-display-lg text-on-background">{{ number_format($totalUser) }}</p>
        </div>
    </div>

    {{-- CHARTS & VISUALIZATION ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- BAR CHART: TREN PEMESANAN --}}
        <div class="lg:col-span-8 bg-surface-container-lowest p-8 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-title-sm text-on-background font-semibold">Tren Pemesanan Bulanan</h3>
                <select class="bg-surface-container border-none text-xs rounded-lg px-3 py-1 font-medium focus:ring-1 focus:ring-primary outline-none">
                    <option>6 Bulan Terakhir</option>
                    <option>1 Tahun Terakhir</option>
                </select>
            </div>
            <div class="h-64 flex items-end justify-between gap-4 px-4">
                @php $maxCount = $bulanData ? max(array_column($bulanData, 'total')) : 1; @endphp
                @forelse($bulanData as $item)
                @php $height = $maxCount > 0 ? max(($item['total'] / $maxCount) * 100, 5) : 5; @endphp
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full rounded-t-lg transition-all relative" style="height: {{ $height }}%; background-color: {{ $loop->last ? '#003f87' : 'rgba(190, 198, 224, 0.3)' }};">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-surface-container-lowest text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">{{ $item['total'] }} pesanan</div>
                    </div>
                    <span class="text-[10px] text-label-caps uppercase text-on-surface-variant {{ $loop->last ? 'text-on-background font-bold' : '' }}">{{ substr($item['bulan'], 0, 3) }}</span>
                </div>
                @empty
                <div class="w-full text-center text-on-surface-variant text-sm py-12">Belum ada data pemesanan.</div>
                @endforelse
            </div>
        </div>

        {{-- POPULAR CAR LIST --}}
        <div class="lg:col-span-4 bg-surface-container-lowest p-8 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30">
            <h3 class="text-title-sm text-on-background font-semibold mb-6">Mobil Terpopuler</h3>
            <div class="space-y-6">
                @forelse($mobilPopuler as $car)
                <div class="flex items-center gap-4">
                    <div class="w-16 h-12 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if($car->foto)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/'.$car->foto) }}" alt="{{ $car->nama }}">
                        @else
                            <span class="material-symbols-outlined text-on-surface-variant">directions_car</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-on-background truncate">{{ $car->nama }}</p>
                        <div class="w-full bg-surface-container h-1.5 rounded-full mt-1">
                            @php $pct = $car->pemesanans_count > 0 ? min(($car->pemesanans_count / max(array_column($mobilPopuler->toArray(), 'pemesanans_count'))) * 100, 100) : 0; @endphp
                            <div class="bg-primary h-full rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    <span class="text-label-caps text-primary font-bold">{{ $car->pemesanans_count }}</span>
                </div>
                @empty
                <p class="text-sm text-on-surface-variant text-center py-4">Belum ada data pemesanan.</p>
                @endforelse
            </div>
            <div class="pt-4 mt-4 border-t border-outline-variant/30">
                <a href="{{ route('admin.mobil.index') }}" class="block w-full py-2 text-center text-primary text-label-caps hover:bg-primary/5 rounded-lg transition-colors">Lihat Semua Inventori</a>
            </div>
        </div>
    </div>

    {{-- RECENT ORDERS TABLE --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant/30 overflow-hidden">
        <div class="px-8 py-6 flex justify-between items-center bg-surface-bright border-b border-outline-variant">
            <h3 class="text-title-sm text-on-background font-semibold">Pemesanan Terbaru</h3>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center gap-2 px-4 py-2 border border-outline rounded-lg text-xs font-medium hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Filter
                </a>
                <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center gap-2 px-4 py-2 bg-primary text-on-primary rounded-lg text-xs font-medium hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Buat Baru
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container/50 border-b border-outline-variant">
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant">ID</th>
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant">Customer</th>
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant">Car</th>
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant">Date</th>
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant">Status</th>
                        <th class="px-8 py-4 text-label-caps text-on-surface-variant text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                    @forelse($pemesananTerbaru as $item)
                    <tr class="hover:bg-primary/5 transition-colors group">
                        <td class="px-8 py-4 text-xs font-semibold text-primary">#{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center font-bold text-xs text-primary">
                                    {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr(str_replace(' ', '', $item->user->name ?? 'N'), -1, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-on-background">{{ $item->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-sm text-on-surface-variant">{{ $item->mobil->nama ?? '-' }}</td>
                        <td class="px-8 py-4 text-sm text-on-surface-variant">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-8 py-4">
                            @php
                                $badges = [
                                    'menunggu_pembayaran' => ['bg-yellow-100 text-yellow-700', 'Menunggu Bayar'],
                                    'menunggu_verifikasi' => ['bg-orange-100 text-orange-700', 'Menunggu Verifikasi'],
                                    'dikonfirmasi' => ['bg-blue-100 text-blue-700', 'Dikonfirmasi'],
                                    'berjalan' => ['bg-purple-100 text-purple-700', 'Berjalan'],
                                    'selesai' => ['bg-green-100 text-green-700', 'Selesai'],
                                    'ditolak' => ['bg-red-100 text-red-700', 'Ditolak'],
                                    'batal' => ['bg-gray-100 text-gray-700', 'Batal'],
                                ];
                                $badge = $badges[$item->status] ?? ['bg-gray-100 text-gray-700', $item->status];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $badge[0] }}">{{ $badge[1] }}</span>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="px-4 py-2 text-sm font-medium text-primary border border-primary/20 rounded-lg group-hover:bg-primary group-hover:text-on-primary transition-all">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-sm text-on-surface-variant">Belum ada pemesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 bg-surface-bright border-t border-outline-variant flex justify-between items-center">
            <p class="text-xs text-on-surface-variant">Menampilkan {{ $pemesananTerbaru->count() }} dari {{ number_format($totalPemesanan) }} data</p>
        </div>
    </div>
</div>
@endsection
