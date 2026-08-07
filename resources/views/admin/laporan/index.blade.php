@extends('admin.layouts.app')

@section('title', 'Laporan - TravelKu')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan</h1>

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                <i class="fas fa-search mr-1"></i>Filter
            </button>
            @if(request('start_date') || request('end_date'))
            <a href="{{ route('admin.laporan.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-300 transition">Reset</a>
            @endif
            <button type="button" onclick="window.print()" class="bg-green-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-700 transition">
                <i class="fas fa-print mr-1"></i>Print
            </button>
        </form>
    </div>

    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6">
        <div class="flex items-center justify-between">
            <span class="font-bold text-gray-800">Total Pendapatan:</span>
            <span class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</span>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($laporan as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->paket->nama ?? $item->mobil->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ Str::limit($item->alamat_tujuan, 30) }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $sc = ['menunggu_pembayaran'=>'bg-yellow-100 text-yellow-800','menunggu_verifikasi'=>'bg-orange-100 text-orange-800','dikonfirmasi'=>'bg-blue-100 text-blue-800','berjalan'=>'bg-purple-100 text-purple-800','selesai'=>'bg-green-100 text-green-800','ditolak'=>'bg-red-100 text-red-800','batal'=>'bg-gray-100 text-gray-800'][$item->status] ?? 'bg-gray-100 text-gray-800';
                                $sl = ['menunggu_pembayaran'=>'Menunggu Bayar','menunggu_verifikasi'=>'Menunggu Verif','dikonfirmasi'=>'Dikonfirmasi','berjalan'=>'Berjalan','selesai'=>'Selesai','ditolak'=>'Ditolak','batal'=>'Batal'][$item->status] ?? $item->status;
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $sc }}">{{ $sl }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada data laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $laporan->links() }}</div>
</div>
@endsection
