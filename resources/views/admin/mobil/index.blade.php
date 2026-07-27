@extends('admin.layouts.app')

@section('title', 'Kelola Mobil - TravelKu')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Mobil</h1>
        <a href="{{ route('admin.mobil.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition text-sm">
            <i class="fas fa-plus mr-1"></i>Tambah Mobil
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Merk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plat Nomor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($mobil as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $item->nama }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->merk }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->plat_nomor }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->kapasitas }} org</td>
                        <td class="px-6 py-4 text-sm">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $stsClass = $item->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $stsClass }}">{{ $item->status }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.mobil.edit', $item->id) }}" class="text-blue-600 hover:underline"><i class="fas fa-edit mr-1"></i>Edit</a>
                            <form method="POST" action="{{ route('admin.mobil.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"><i class="fas fa-trash mr-1"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-gray-500">Belum ada mobil.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
