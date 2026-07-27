@extends('admin.layouts.app')

@section('title', 'Kelola Users - TravelKu')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Users</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($users as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->email }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->no_hp ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $item->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($item->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $item->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
</div>
@endsection
