@extends('admin.layouts.app')

@section('title', 'Detail Pemesanan - TravelKu')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan #{{ $pemesanan->id }}</h1>
                @php
                    $sc = ['menunggu_pembayaran'=>'bg-yellow-100 text-yellow-800','menunggu_verifikasi'=>'bg-orange-100 text-orange-800','dikonfirmasi'=>'bg-blue-100 text-blue-800','berjalan'=>'bg-purple-100 text-purple-800','selesai'=>'bg-green-100 text-green-800','ditolak'=>'bg-red-100 text-red-800','batal'=>'bg-gray-100 text-gray-800'][$pemesanan->status] ?? 'bg-gray-100 text-gray-800';
                    $sl = ['menunggu_pembayaran'=>'Menunggu Bayar','menunggu_verifikasi'=>'Menunggu Verif','dikonfirmasi'=>'Dikonfirmasi','berjalan'=>'Berjalan','selesai'=>'Selesai','ditolak'=>'Ditolak','batal'=>'Batal'][$pemesanan->status] ?? $pemesanan->status;
                @endphp
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $sc }}">{{ $sl }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 mb-3">Informasi Pesanan</h3>
                    <table class="w-full text-sm">
                        <tr class="border-b"><td class="py-2 text-gray-500">User</td><td class="py-2 text-gray-800">{{ $pemesanan->user->name ?? '-' }} ({{ $pemesanan->user->email ?? '-' }})</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Mobil</td><td class="py-2 text-gray-800">{{ $pemesanan->mobil->nama ?? '-' }} ({{ $pemesanan->mobil->plat_nomor ?? '-' }})</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Supir</td><td class="py-2 text-gray-800">{{ $pemesanan->mobil->nama_supir ?? '-' }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Alamat Jemput</td><td class="py-2 text-gray-800">{{ $pemesanan->alamat_jemput }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Tujuan</td><td class="py-2 text-gray-800">{{ $pemesanan->alamat_tujuan }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Tanggal Mulai</td><td class="py-2 text-gray-800">{{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d/m/Y') : '-' }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Durasi</td><td class="py-2 text-gray-800">{{ $pemesanan->jumlah_hari }} Hari</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">Penumpang</td><td class="py-2 text-gray-800">{{ $pemesanan->jumlah_penumpang }} Orang</td></tr>
                        <tr><td class="py-2 text-gray-500 font-bold">Total</td><td class="py-2 text-blue-600 font-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td></tr>
                    </table>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700 mb-3">Data Pemesan</h3>
                    <table class="w-full text-sm">
                        <tr class="border-b"><td class="py-2 text-gray-500">Nama</td><td class="py-2 text-gray-800">{{ $pemesanan->nama_penumpang }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500">No HP</td><td class="py-2 text-gray-800">{{ $pemesanan->no_hp_penumpang }}</td></tr>
                    </table>
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="font-bold text-gray-700 mb-4">Aksi</h3>
                <div class="flex flex-wrap gap-3">
                    @if($pemesanan->status === 'menunggu_pembayaran')
                    <form method="POST" action="{{ route('admin.pemesanan.status', $pemesanan->id) }}" onsubmit="return confirm('Yakin ingin membatalkan?')">
                        @csrf
                        <input type="hidden" name="status" value="batal">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-red-600 transition">
                            <i class="fas fa-times mr-1"></i>Batalkan
                        </button>
                    </form>
                    @endif

                    @if($pemesanan->status === 'menunggu_verifikasi' && $pemesanan->pembayaran)
                    <a href="{{ route('admin.pembayaran.show', $pemesanan->pembayaran->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-orange-600 transition">
                        <i class="fas fa-credit-card mr-1"></i>Lihat Pembayaran
                    </a>
                    @endif

                    @if($pemesanan->status === 'dikonfirmasi')
                    <form method="POST" action="{{ route('admin.pemesanan.status', $pemesanan->id) }}" onsubmit="return confirm('Mulai perjalanan ini?')">
                        @csrf
                        <input type="hidden" name="status" value="berjalan">
                        <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-purple-600 transition">
                            <i class="fas fa-play mr-1"></i>Mulai Perjalanan
                        </button>
                    </form>
                    @endif

                    @if($pemesanan->status === 'berjalan')
                    <form method="POST" action="{{ route('admin.pemesanan.status', $pemesanan->id) }}" onsubmit="return confirm('Selesaikan perjalanan ini?')">
                        @csrf
                        <input type="hidden" name="status" value="selesai">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-green-600 transition">
                            <i class="fas fa-check mr-1"></i>Selesaikan
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
