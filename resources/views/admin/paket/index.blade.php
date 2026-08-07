@extends('admin.layouts.app')

@section('title', 'Kelola Paket Wisata - TravelKu')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Paket Wisata</h1>
        <a href="{{ route('admin.paket.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition text-sm">
            <i class="fas fa-plus mr-1"></i>Tambah Paket
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Destinasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($pakets as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->destinasi->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $item->nama }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->durasi_hari }} hari</td>
                        <td class="px-6 py-4 text-sm">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $stsClass = $item->is_aktif ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $stsClass }}">{{ $item->is_aktif ? 'Aktif' : 'Nonaktif' }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.paket.edit', $item->id) }}" class="text-blue-600 hover:underline"><i class="fas fa-edit mr-1"></i>Edit</a>
                            <form method="POST" action="{{ route('admin.paket.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"><i class="fas fa-trash mr-1"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada paket wisata.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pakets->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $pakets->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
