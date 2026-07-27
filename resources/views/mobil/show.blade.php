@extends('layouts.app')

@section('title', $mobil->nama . ' - TravelKu')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('mobil.index') }}" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>

    <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
        @if($mobil->foto)
        <img src="{{ asset('storage/'.$mobil->foto) }}" alt="{{ $mobil->nama }}" class="w-full h-64 md:h-96 object-cover">
        @else
        <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-car text-6xl"></i></div>
        @endif

        <div class="p-6 md:p-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $mobil->nama }}</h1>
                @php
                    $statusColor = $mobil->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                @endphp
                <span class="text-sm px-3 py-1 rounded-full {{ $statusColor }}">{{ $mobil->status }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <table class="w-full text-sm">
                        <tr class="border-b"><td class="py-2 text-gray-500 font-medium">Merk</td><td class="py-2 text-gray-800">{{ $mobil->merk }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500 font-medium">Tipe</td><td class="py-2 text-gray-800">{{ $mobil->tipe }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500 font-medium">Plat Nomor</td><td class="py-2 text-gray-800">{{ $mobil->plat_nomor }}</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500 font-medium">Kapasitas</td><td class="py-2 text-gray-800">{{ $mobil->kapasitas }} Orang</td></tr>
                        <tr class="border-b"><td class="py-2 text-gray-500 font-medium">Harga</td><td class="py-2 text-gray-800 font-bold text-lg">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}/hari</td></tr>
                    </table>
                </div>
                <div>
                    @if($mobil->fasilitas)
                    <h3 class="font-bold text-gray-700 mb-2">Fasilitas</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $mobil->fasilitas) as $f)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ trim($f) }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            @if($mobil->nama_supir)
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="font-bold text-gray-700 mb-2"><i class="fas fa-user-tie mr-2 text-blue-600"></i>Informasi Supir</h3>
                <div class="flex items-center space-x-4">
                    @if($mobil->foto_supir)
                    <img src="{{ asset('storage/'.$mobil->foto_supir) }}" alt="Supir" class="w-16 h-16 rounded-full object-cover">
                    @else
                    <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center text-gray-500"><i class="fas fa-user text-2xl"></i></div>
                    @endif
                    <div>
                        <p class="font-semibold text-gray-800">{{ $mobil->nama_supir }}</p>
                        <p class="text-gray-600 text-sm"><i class="fab fa-whatsapp text-green-500 mr-1"></i>{{ $mobil->no_hp_supir }}</p>
                    </div>
                </div>
            </div>
            @endif

            <a href="{{ route('pemesanan.create', ['mobil_id' => $mobil->id]) }}" class="block w-full text-center bg-blue-600 text-white px-6 py-3 rounded-lg font-bold text-lg hover:bg-blue-700 transition">
                <i class="fas fa-calendar-check mr-2"></i>Pesan Sekarang
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="font-bold text-gray-800"><i class="fas fa-star text-yellow-400 mr-2"></i>Ulasan</h2>
        </div>
        <div class="p-6">
            @forelse($ulasan ?? [] as $ulasanItem)
            <div class="border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-600">{{ substr($ulasanItem->pemesanan->user->name ?? 'U', 0, 1) }}</div>
                        <span class="font-medium text-gray-800">{{ $ulasanItem->pemesanan->user->name ?? 'User' }}</span>
                    </div>
                    <div class="flex text-yellow-400 text-sm">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= $ulasanItem->rating ? '' : '-o text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-600 text-sm">{{ $ulasanItem->komentar }}</p>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Belum ada ulasan untuk mobil ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
