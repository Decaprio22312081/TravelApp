@extends('admin.layouts.app')

@section('title', 'Detail Pembayaran - TravelKu')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.pembayaran.index') }}" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-gray-800 mb-4">Informasi Pembayaran</h2>
            <table class="w-full text-sm">
                <tr class="border-b"><td class="py-2 text-gray-500">Nama Pengirim</td><td class="py-2 text-gray-800 font-medium">{{ $pembayaran->nama_pengirim }}</td></tr>
                <tr class="border-b"><td class="py-2 text-gray-500">Bank Pengirim</td><td class="py-2 text-gray-800">{{ $pembayaran->bank_pengirim }}</td></tr>
                <tr class="border-b"><td class="py-2 text-gray-500">Tanggal Transfer</td><td class="py-2 text-gray-800">{{ $pembayaran->tanggal_transaksi ? \Carbon\Carbon::parse($pembayaran->tanggal_transaksi)->format('d/m/Y') : '-' }}</td></tr>
                <tr class="border-b"><td class="py-2 text-gray-500">Nominal</td><td class="py-2 text-gray-800 font-bold">Rp {{ number_format($pembayaran->nominal_transfer, 0, ',', '.') }}</td></tr>
                <tr><td class="py-2 text-gray-500">Status</td>
                    <td class="py-2">
                        @php
                            $psc = ['menunggu_verifikasi'=>'bg-yellow-100 text-yellow-800','terverifikasi'=>'bg-green-100 text-green-800','ditolak'=>'bg-red-100 text-red-800'][$pembayaran->status] ?? 'bg-gray-100 text-gray-800';
                            $label = ['menunggu_verifikasi'=>'Menunggu Verifikasi','terverifikasi'=>'Terverifikasi','ditolak'=>'Ditolak'][$pembayaran->status] ?? $pembayaran->status;
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $psc }}">{{ $label }}</span>
                    </td>
                </tr>
            </table>

            @if($pembayaran->bukti_pembayaran)
            <div class="mt-4">
                <p class="text-gray-700 font-medium mb-2">Bukti Transfer:</p>
                @php $ext = pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION); @endphp
                @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" alt="Bukti" class="max-w-full rounded-lg border">
                @else
                    <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:underline"><i class="fas fa-file-pdf mr-1"></i>Lihat PDF</a>
                @endif
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-gray-800 mb-4">Informasi Pesanan</h2>
                @if($pembayaran->pemesanan)
                <table class="w-full text-sm">
                    <tr class="border-b"><td class="py-2 text-gray-500">ID Pesanan</td><td class="py-2 text-gray-800">#{{ $pembayaran->pemesanan->id }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">User</td><td class="py-2 text-gray-800">{{ $pembayaran->pemesanan->user->name ?? '-' }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Paket / Mobil</td><td class="py-2 text-gray-800">{{ $pembayaran->pemesanan->paket->nama ?? $pembayaran->pemesanan->mobil->nama ?? '-' }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Total Pesanan</td><td class="py-2 text-gray-800">Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td></tr>
                </table>
                @endif
            </div>

            @if($pembayaran->status === 'menunggu_verifikasi')
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-gray-800 mb-4">Aksi Verifikasi</h2>

                <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}" class="mb-4">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition" onclick="return confirm('Verifikasi pembayaran ini?')">
                        <i class="fas fa-check mr-1"></i>Verifikasi Pembayaran
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Catatan (jika ditolak)</label>
                        <textarea name="catatan_admin" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition" onclick="return confirm('Tolak pembayaran ini?')">
                        <i class="fas fa-times mr-1"></i>Tolak Pembayaran
                    </button>
                </form>
            </div>
            @endif

            @if($pembayaran->status === 'ditolak' && $pembayaran->catatan_admin)
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <p class="font-medium text-red-800">Catatan Penolakan:</p>
                <p class="text-red-600 text-sm">{{ $pembayaran->catatan_admin }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
