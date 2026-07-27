@extends('admin.layouts.app')

@section('title', 'Kelola Ulasan - TravelKu')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Ulasan</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($ulasans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->pemesanan->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->pemesanan->mobil->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $item->rating ? '' : '-o text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm max-w-xs truncate">{{ $item->komentar }}</td>
                        <td class="px-6 py-4 text-sm">
                            <form method="POST" action="{{ route('admin.ulasan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"><i class="fas fa-trash mr-1"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada ulasan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $ulasans->links() }}</div>
</div>
@endsection
