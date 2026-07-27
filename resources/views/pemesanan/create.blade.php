@extends('layouts.app')

@section('title', 'Pesan Travel - TravelKu')

@section('content')
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-10">
    {{-- STEP INDICATOR --}}
    <div class="flex justify-center items-center mb-12 overflow-x-auto whitespace-nowrap pb-4 md:pb-0">
        <div class="flex items-center space-x-4 md:space-x-8">
            <div class="flex items-center gap-2 text-on-surface-variant opacity-60">
                <span class="w-8 h-8 rounded-full border-2 border-on-surface-variant flex items-center justify-center text-label-sm font-label-sm">1</span>
                <span class="font-label-sm">Detail Mobil</span>
            </div>
            <div class="w-12 h-px bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-primary font-bold relative">
                <span class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center text-label-sm font-label-sm">2</span>
                <span class="font-label-sm">Data Pemesanan</span>
                <div class="absolute -bottom-2 left-0 w-full h-1 bg-primary rounded-full"></div>
            </div>
            <div class="w-12 h-px bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-on-surface-variant opacity-60">
                <span class="w-8 h-8 rounded-full border-2 border-on-surface-variant flex items-center justify-center text-label-sm font-label-sm">3</span>
                <span class="font-label-sm">Konfirmasi</span>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('pemesanan.store') }}" id="bookingForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- LEFT: Forms --}}
            <div class="lg:col-span-8 space-y-8">
                {{-- Mobile car summary --}}
                @if($selectedMobil)
                <div class="lg:hidden ambient-card bg-surface-container-lowest rounded-[24px] p-6 border border-surface-container">
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-surface-container flex items-center justify-center">
                            @if($selectedMobil->foto)
                            <img src="{{ asset('storage/'.$selectedMobil->foto) }}" alt="{{ $selectedMobil->nama }}" class="w-full h-full object-cover">
                            @else
                            <span class="material-symbols-outlined text-outline text-3xl">directions_car</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-primary font-bold">{{ $selectedMobil->nama }}</h3>
                            <p class="text-on-surface-variant font-body-md">Rp {{ number_format($selectedMobil->harga_per_hari, 0, ',', '.') }}/hari</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- SECTION: Pilih Mobil --}}
                <section class="ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">directions_car</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Pilih Mobil</h2>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant">Mobil</label>
                        <select name="mobil_id" id="mobilSelect" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none focus:ring-2 focus:ring-primary @error('mobil_id') border-red-500 @enderror">
                            <option value="" disabled {{ !$selectedMobil ? 'selected' : '' }}>-- Pilih Mobil --</option>
                            @foreach($mobils as $m)
                            <option value="{{ $m->id }}" {{ $selectedMobil && $selectedMobil->id == $m->id ? 'selected' : '' }} data-harga="{{ $m->harga_per_hari }}" data-nama="{{ $m->nama }}" data-kapasitas="{{ $m->kapasitas }}" data-merk="{{ $m->merk }}" data-foto="{{ $m->foto ?? '' }}">
                                {{ $m->nama }} - {{ $m->merk }} ({{ $m->kapasitas }} kursi) - Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        @error('mobil_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </section>

                {{-- SECTION: Lokasi & Waktu --}}
                <section class="ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">distance</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Lokasi &amp; Waktu</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 md:col-span-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Alamat Jemput</label>
                            <textarea name="alamat_jemput" rows="3" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md resize-none @error('alamat_jemput') border-red-500 @enderror" placeholder="Masukkan alamat lengkap penjemputan...">{{ old('alamat_jemput') }}</textarea>
                            @error('alamat_jemput')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Alamat Tujuan</label>
                            <div class="relative">
                                <textarea name="alamat_tujuan" id="alamatTujuan" rows="2" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md resize-none @error('alamat_tujuan') border-red-500 @enderror" placeholder="Masukkan alamat tujuan...">{{ old('alamat_tujuan', $selectedDestinasi ? $selectedDestinasi->nama : '') }}</textarea>
                                @error('alamat_tujuan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Atau pilih destinasi</label>
                            <div class="relative">
                                <select id="destinasiSelect" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none">
                                    <option value="">-- Pilih Destinasi --</option>
                                    @foreach($destinasis as $d)
                                    <option value="{{ $d->nama }}" {{ $selectedDestinasi && $selectedDestinasi->id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('tanggal_mulai') border-red-500 @enderror">
                            @error('tanggal_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Jumlah Hari</label>
                            <input type="number" name="jumlah_hari" id="jumlahHari" value="{{ old('jumlah_hari', 1) }}" min="1" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('jumlah_hari') border-red-500 @enderror">
                            @error('jumlah_hari')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: Informasi Penyewa --}}
                <section class="ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Informasi Penyewa</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Nama Lengkap</label>
                            <input type="text" name="nama_penumpang" value="{{ old('nama_penumpang', auth()->user()->name ?? '') }}" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('nama_penumpang') border-red-500 @enderror" placeholder="Sesuai KTP">
                            @error('nama_penumpang')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Nomor HP / WhatsApp</label>
                            <input type="tel" name="no_hp_penumpang" value="{{ old('no_hp_penumpang', auth()->user()->no_hp ?? '') }}" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('no_hp_penumpang') border-red-500 @enderror" placeholder="0812-xxxx-xxxx">
                            @error('no_hp_penumpang')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Jumlah Penumpang</label>
                            <div class="relative">
                                <input type="number" name="jumlah_penumpang" value="{{ old('jumlah_penumpang', 1) }}" min="1" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('jumlah_penumpang') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-sm">Orang</span>
                            </div>
                            @error('jumlah_penumpang')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>
            </div>

            {{-- RIGHT: Summary Sidebar --}}
            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-6">
                    {{-- Desktop Car Summary --}}
                    <div id="carSummaryDesktop" class="hidden lg:block ambient-card bg-surface-container-lowest rounded-[24px] overflow-hidden border border-surface-container">
                        @if($selectedMobil)
                        <div class="h-48 bg-surface-container overflow-hidden relative flex items-center justify-center">
                            @if($selectedMobil->foto)
                            <img src="{{ asset('storage/'.$selectedMobil->foto) }}" alt="{{ $selectedMobil->nama }}" class="w-full h-full object-contain mix-blend-multiply">
                            @else
                            <span class="material-symbols-outlined text-outline text-6xl">directions_car</span>
                            @endif
                            <div class="absolute top-4 right-4 bg-primary text-on-primary px-3 py-1 rounded-lg text-label-sm font-label-sm">{{ $selectedMobil->tipe ?? 'Mobil' }}</div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-headline-md text-headline-md text-primary font-bold mb-1" id="sidebarCarName">{{ $selectedMobil->nama }}</h3>
                            <div class="flex items-center gap-4 text-on-surface-variant mb-4">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">group</span>
                                    <span class="text-label-sm" id="sidebarCarKapasitas">{{ $selectedMobil->kapasitas }} Kursi</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">settings</span>
                                    <span class="text-label-sm" id="sidebarCarMerk">{{ $selectedMobil->merk }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center border-t border-surface-container pt-4">
                                <span class="text-on-surface-variant">Harga Sewa</span>
                                <span class="font-bold text-primary" id="sidebarHarga">Rp {{ number_format($selectedMobil->harga_per_hari, 0, ',', '.') }}/hari</span>
                            </div>
                        </div>
                        @else
                        <div class="p-6 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl mb-2 block">directions_car</span>
                            <p class="font-body-md">Pilih mobil terlebih dahulu</p>
                        </div>
                        @endif
                    </div>

                    {{-- Price Calculation --}}
                    <div class="ambient-card bg-surface-container-highest rounded-[24px] p-8">
                        <h4 class="font-headline-md text-headline-md font-bold mb-6">Ringkasan Biaya</h4>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-on-surface-variant font-body-md">
                                <span>Harga Sewa</span>
                                <span id="hargaPerHariDisplay">Rp {{ $selectedMobil ? number_format($selectedMobil->harga_per_hari, 0, ',', '.') : '0' }} / hari</span>
                            </div>
                            <div class="flex justify-between text-on-surface-variant font-body-md">
                                <span>Durasi</span>
                                <span id="jumlahHariDisplay">{{ old('jumlah_hari', 1) }} Hari</span>
                            </div>
                            <div class="flex justify-between text-on-surface-variant font-body-md">
                                <span>Biaya Layanan</span>
                                <span>Gratis</span>
                            </div>
                            <div class="pt-4 border-t border-outline-variant flex justify-between items-end">
                                <div>
                                    <span class="text-on-surface-variant block text-label-sm mb-1">Total Pembayaran</span>
                                    <span class="text-headline-md text-2xl font-bold text-primary" id="totalDisplay">Rp {{ $selectedMobil ? number_format($selectedMobil->harga_per_hari * old('jumlah_hari', 1), 0, ',', '.') : '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="total_harga" id="totalHargaInput" value="{{ $selectedMobil ? $selectedMobil->harga_per_hari * old('jumlah_hari', 1) : 0 }}">
                        <button type="submit" class="w-full py-4 bg-primary text-on-primary rounded-xl font-bold text-body-lg transition-all duration-300 hover:bg-primary-container shadow-lg shadow-primary/20 flex items-center justify-center gap-2 group">
                            Lanjutkan ke Pembayaran
                            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                        <p class="text-center text-label-sm text-on-surface-variant mt-4 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">verified_user</span>
                            Pembayaran Aman &amp; Terjamin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@push('scripts')
<style>
    .ambient-card { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); transition: box-shadow 0.3s ease; }
    .ambient-card:hover { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
</style>
<script>
    const mobilSelect = document.getElementById('mobilSelect');
    const jumlahHariInput = document.getElementById('jumlahHari');
    const hargaPerHariDisplay = document.getElementById('hargaPerHariDisplay');
    const jumlahHariDisplay = document.getElementById('jumlahHariDisplay');
    const totalDisplay = document.getElementById('totalDisplay');
    const totalHargaInput = document.getElementById('totalHargaInput');
    const destinasiSelect = document.getElementById('destinasiSelect');
    const alamatTujuan = document.getElementById('alamatTujuan');
    const sidebarCarName = document.getElementById('sidebarCarName');
    const sidebarCarKapasitas = document.getElementById('sidebarCarKapasitas');
    const sidebarCarMerk = document.getElementById('sidebarCarMerk');
    const sidebarHarga = document.getElementById('sidebarHarga');
    const carSummaryDesktop = document.getElementById('carSummaryDesktop');

    function formatRp(n) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
    }

    function hitungTotal() {
        const selected = mobilSelect.options[mobilSelect.selectedIndex];
        const harga = selected ? parseInt(selected.dataset.harga) || 0 : 0;
        const hari = parseInt(jumlahHariInput.value) || 1;
        const total = harga * hari;

        hargaPerHariDisplay.textContent = formatRp(harga) + ' / hari';
        jumlahHariDisplay.textContent = hari + ' Hari';
        totalDisplay.textContent = formatRp(total);
        totalHargaInput.value = total;
    }

    function updateSidebar(option) {
        if (!option || !option.value) {
            if (carSummaryDesktop) {
                carSummaryDesktop.innerHTML = `
                    <div class="p-6 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-4xl mb-2 block">directions_car</span>
                        <p class="font-body-md">Pilih mobil terlebih dahulu</p>
                    </div>
                `;
            }
            return;
        }
        const nama = option.dataset.nama;
        const kapasitas = option.dataset.kapasitas;
        const merk = option.dataset.merk;
        const harga = option.dataset.harga;
        const foto = option.dataset.foto;

        if (sidebarCarName) sidebarCarName.textContent = nama;
        if (sidebarCarKapasitas) sidebarCarKapasitas.textContent = kapasitas + ' Kursi';
        if (sidebarCarMerk) sidebarCarMerk.textContent = merk;
        if (sidebarHarga) sidebarHarga.textContent = formatRp(parseInt(harga)) + '/hari';

        if (carSummaryDesktop) {
            const imgHtml = foto
                ? `<img src="{{ asset('storage/') }}/${foto}" alt="${nama}" class="w-full h-full object-contain mix-blend-multiply">`
                : `<span class="material-symbols-outlined text-outline text-6xl">directions_car</span>`;
            carSummaryDesktop.innerHTML = `
                <div class="h-48 bg-surface-container overflow-hidden relative flex items-center justify-center">
                    ${imgHtml}
                    <div class="absolute top-4 right-4 bg-primary text-on-primary px-3 py-1 rounded-lg text-label-sm font-label-sm">${merk}</div>
                </div>
                <div class="p-6">
                    <h3 class="font-headline-md text-headline-md text-primary font-bold mb-1">${nama}</h3>
                    <div class="flex items-center gap-4 text-on-surface-variant mb-4">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">group</span>
                            <span class="text-label-sm">${kapasitas} Kursi</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">settings</span>
                            <span class="text-label-sm">${merk}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center border-t border-surface-container pt-4">
                        <span class="text-on-surface-variant">Harga Sewa</span>
                        <span class="font-bold text-primary">${formatRp(parseInt(harga))}/hari</span>
                    </div>
                </div>
            `;
        }
    }

    mobilSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        updateSidebar(option);
        hitungTotal();
    });

    jumlahHariInput.addEventListener('input', hitungTotal);
    hitungTotal();

    destinasiSelect.addEventListener('change', function() {
        if (this.value) {
            alamatTujuan.value = this.value;
        }
    });
</script>
@endpush
