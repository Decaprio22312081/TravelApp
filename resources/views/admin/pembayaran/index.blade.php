@extends('admin.layouts.app')

@section('title', 'Verifikasi Pembayaran - TravelKu')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Pembayaran</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemesanan ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($pembayarans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->pemesanan->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">#{{ $item->pemesanan_id }}</td>
                        <td class="px-6 py-4 text-sm">Rp {{ number_format($item->nominal_transfer, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $psc = ['menunggu_verifikasi'=>'bg-yellow-100 text-yellow-800','terverifikasi'=>'bg-green-100 text-green-800','ditolak'=>'bg-red-100 text-red-800'][$item->status] ?? 'bg-gray-100 text-gray-800';
                                $pl = ['menunggu_verifikasi'=>'Menunggu Verifikasi','terverifikasi'=>'Terverifikasi','ditolak'=>'Ditolak'][$item->status] ?? $item->status;
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $psc }}">{{ $pl }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $pembayarans->links() }}</div>
</div>
@endsection
