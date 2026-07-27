@extends('admin.layouts.app')

@section('title', 'Kelola Mitra - TravelKu')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Mitra</h1>
        <a href="{{ route('admin.mitra.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition text-sm">
            <i class="fas fa-plus mr-1"></i>Tambah Mitra
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Telp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($mitras as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $item->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $item->alamat }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->no_telp ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($item->is_aktif)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.mitra.edit', $item->id) }}" class="text-blue-600 hover:underline"><i class="fas fa-edit mr-1"></i>Edit</a>
                            <form method="POST" action="{{ route('admin.mitra.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"><i class="fas fa-trash mr-1"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada mitra.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
