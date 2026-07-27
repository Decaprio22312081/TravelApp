@extends('admin.layouts.app')

@section('title', 'Pengaturan - TravelKu')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="border-b">
            <div class="flex">
                <button onclick="showSettingsTab('rekening')" id="stab-rekening-btn" class="px-6 py-3 font-medium text-blue-600 border-b-2 border-blue-600 focus:outline-none" type="button">Rekening Bank</button>
                <button onclick="showSettingsTab('kontak')" id="stab-kontak-btn" class="px-6 py-3 font-medium text-gray-600 hover:text-blue-600 focus:outline-none" type="button">Info Kontak</button>
                <button onclick="showSettingsTab('promo')" id="stab-promo-btn" class="px-6 py-3 font-medium text-gray-600 hover:text-blue-600 focus:outline-none" type="button">Banner Promo</button>
            </div>
        </div>

        <div id="stab-rekening" class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-gray-800">Daftar Rekening Bank</h2>
                <button onclick="document.getElementById('formRekening').classList.toggle('hidden')" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-1"></i>Tambah Rekening
                </button>
            </div>

            <div id="formRekening" class="hidden bg-gray-50 rounded-lg p-4 mb-4">
                <form method="POST" action="{{ route('admin.pengaturan.bank.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                        <input type="text" name="nama_bank" placeholder="Nama Bank" required class="px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="nomor_rekening" placeholder="No. Rekening" required class="px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="atas_nama" placeholder="Atas Nama" required class="px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">Simpan</button>
                </form>
            </div>

            @if(isset($bankAccounts) && count($bankAccounts) > 0)
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Bank</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Rekening</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Atas Nama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($bankAccounts as $b)
                    <tr>
                        <td class="px-4 py-2">{{ $b->nama_bank }}</td>
                        <td class="px-4 py-2 font-mono">{{ $b->nomor_rekening }}</td>
                        <td class="px-4 py-2">{{ $b->atas_nama }}</td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('admin.pengaturan.bank.destroy', $b->id) }}" onsubmit="return confirm('Hapus rekening ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-gray-500 text-sm">Belum ada rekening bank.</p>
            @endif
        </div>

        <div id="stab-kontak" class="p-6 hidden">
            <h2 class="font-bold text-gray-800 mb-4">Info Kontak</h2>
            <form method="POST" action="{{ route('admin.pengaturan.setting.update') }}">
                @csrf
                <div class="space-y-4 max-w-md">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">WhatsApp</label>
                        <input type="text" name="no_whatsapp" value="{{ isset($settings['no_whatsapp']) ? $settings['no_whatsapp']->value : '' }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ isset($settings['email']) ? $settings['email']->value : '' }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ isset($settings['alamat']) ? $settings['alamat']->value : '' }}</textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition text-sm">Simpan</button>
                </div>
            </form>
        </div>

        <div id="stab-promo" class="p-6 hidden">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-gray-800">Banner Promo</h2>
                <button onclick="document.getElementById('formPromo').classList.toggle('hidden')" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-1"></i>Tambah Promo
                </button>
            </div>

            <div id="formPromo" class="hidden bg-gray-50 rounded-lg p-4 mb-4">
                <form method="POST" action="{{ route('admin.pengaturan.banner.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                        <input type="text" name="judul" placeholder="Judul Promo" required class="px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="link" placeholder="Link (opsional)" class="px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-3">
                        <textarea name="deskripsi" rows="2" placeholder="Deskripsi" required class="w-full px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="gambar" accept="image/*" required class="w-full px-4 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">Simpan</button>
                </form>
            </div>

            @if(isset($promoBanners) && count($promoBanners) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($promoBanners as $p)
                <div class="border rounded-lg overflow-hidden">
                    @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}" class="w-full h-32 object-cover">
                    @endif
                    <div class="p-3">
                        <h3 class="font-bold text-gray-800 text-sm">{{ $p->judul }}</h3>
                        <p class="text-gray-600 text-xs">{{ Str::limit($p->deskripsi, 80) }}</p>
                        @if($p->link)<a href="{{ $p->link }}" class="text-blue-600 text-xs hover:underline">Link</a>@endif
                        <form method="POST" action="{{ route('admin.pengaturan.banner.destroy', $p->id) }}" onsubmit="return confirm('Hapus promo ini?')" class="mt-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-sm">Belum ada banner promo.</p>
            @endif
        </div>
    </div>
</div>

<script>
function showSettingsTab(tab) {
    ['rekening', 'kontak', 'promo'].forEach(t => {
        document.getElementById('stab-'+t).classList.add('hidden');
        document.getElementById('stab-'+t+'-btn').classList.remove('text-blue-600', 'border-blue-600');
        document.getElementById('stab-'+t+'-btn').classList.add('text-gray-600');
    });
    document.getElementById('stab-'+tab).classList.remove('hidden');
    document.getElementById('stab-'+tab+'-btn').classList.add('text-blue-600', 'border-blue-600');
    document.getElementById('stab-'+tab+'-btn').classList.remove('text-gray-600');
}
</script>
@endsection
