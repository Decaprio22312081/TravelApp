@extends('admin.layouts.app')

@section('title', 'Kelola Pemesanan - TravelKu')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Pemesanan</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.pemesanan.index', ['status' => '']) }}" class="px-3 py-1 rounded-lg text-sm {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">Semua</a>
            <a href="{{ route('admin.pemesanan.index', ['status' => 'menunggu_pembayaran']) }}" class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'menunggu_pembayaran' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700' }}">Menunggu Bayar</a>
            <a href="{{ route('admin.pemesanan.index', ['status' => 'menunggu_verifikasi']) }}" class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'menunggu_verifikasi' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700' }}">Menunggu Verif</a>
            <a href="{{ route('admin.pemesanan.index', ['status' => 'dikonfirmasi']) }}" class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'dikonfirmasi' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Dikonfirmasi</a>
            <a href="{{ route('admin.pemesanan.index', ['status' => 'berjalan']) }}" class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'berjalan' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700' }}">Berjalan</a>
            <a href="{{ route('admin.pemesanan.index', ['status' => 'selesai']) }}" class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'selesai' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }}">Selesai</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket / Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($pemesanans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-800">{{ $item->paket->nama ?? $item->mobil->nama ?? '-' }}</span>
                            @if($item->paket_id)
                            <span class="block text-xs text-gray-400">{{ $item->mobil->nama ?? '' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 text-sm">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $sc = ['menunggu_pembayaran'=>'bg-yellow-100 text-yellow-800','menunggu_verifikasi'=>'bg-orange-100 text-orange-800','dikonfirmasi'=>'bg-blue-100 text-blue-800','berjalan'=>'bg-purple-100 text-purple-800','selesai'=>'bg-green-100 text-green-800','ditolak'=>'bg-red-100 text-red-800','batal'=>'bg-gray-100 text-gray-800'][$item->status] ?? 'bg-gray-100 text-gray-800';
                                $sl = ['menunggu_pembayaran'=>'Menunggu Bayar','menunggu_verifikasi'=>'Menunggu Verif','dikonfirmasi'=>'Dikonfirmasi','berjalan'=>'Berjalan','selesai'=>'Selesai','ditolak'=>'Ditolak','batal'=>'Batal'][$item->status] ?? $item->status;
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $sc }}">{{ $sl }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada pemesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $pemesanans->links() }}</div>
</div>
@endsection
