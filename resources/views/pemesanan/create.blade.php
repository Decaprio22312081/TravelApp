@extends('layouts.app')

@section('title', 'Pesan Perjalanan - TravelKu')

@section('content')
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-10">
    {{-- STEP INDICATOR --}}
    <div class="flex justify-center items-center mb-12 overflow-x-auto whitespace-nowrap pb-4 md:pb-0">
        <div class="flex items-center space-x-4 md:space-x-8">
            <div class="flex items-center gap-2 text-primary font-bold relative">
                <span class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center text-label-sm font-label-sm">1</span>
                <span class="font-label-sm">Pilih Paket / Kendaraan</span>
                <div class="absolute -bottom-2 left-0 w-full h-1 bg-primary rounded-full"></div>
            </div>
            <div class="w-12 h-px bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-on-surface-variant opacity-60">
                <span class="w-8 h-8 rounded-full border-2 border-on-surface-variant flex items-center justify-center text-label-sm font-label-sm">2</span>
                <span class="font-label-sm">Data Pemesanan</span>
            </div>
            <div class="w-12 h-px bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-on-surface-variant opacity-60">
                <span class="w-8 h-8 rounded-full border-2 border-on-surface-variant flex items-center justify-center text-label-sm font-label-sm">3</span>
                <span class="font-label-sm">Konfirmasi</span>
            </div>
        </div>
    </div>

    {{-- MODE TOGGLE --}}
    <div class="flex justify-center mb-10">
        <div class="inline-flex bg-surface-container-low p-1.5 rounded-2xl border border-outline-variant/40 gap-1" id="modeToggle">
            <button type="button" data-mode="paket" class="mode-btn px-8 py-3.5 rounded-xl font-bold font-display-lg flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined">hiking</span>
                Paket Wisata
            </button>
            <button type="button" data-mode="mobil" class="mode-btn px-8 py-3.5 rounded-xl font-bold font-display-lg flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined">directions_car</span>
                Sewa Mobil
            </button>
        </div>
    </div>

    <form method="POST" action="{{ route('pemesanan.store') }}" id="bookingForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- LEFT: Forms --}}
            <div class="lg:col-span-8 space-y-8">
                {{-- ============ PAKET MODE ============ --}}
                {{-- SECTION: Pilih Paket Wisata --}}
                <section class="paket-mode ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">hiking</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Pilih Paket Wisata</h2>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Destinasi</label>
                            <div class="relative">
                                <select id="paketDestinasi" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none focus:ring-2 focus:ring-primary">
                                    <option value="">-- Pilih Destinasi --</option>
                                    @foreach($destinasis as $d)
                                    <option value="{{ $d->id }}" {{ $selectedDestinasi && $selectedDestinasi->id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Paket Wisata</label>
                            <div class="relative">
                                <select name="paket_id" id="paketSelect" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none focus:ring-2 focus:ring-primary @error('paket_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Paket --</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                            @error('paket_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            <input type="hidden" name="destinasi_id" id="paketDestinasiId" value="{{ $selectedDestinasi ? $selectedDestinasi->id : '' }}">
                            <input type="hidden" name="jumlah_hari" id="paketJumlahHari" value="{{ $selectedPaket ? $selectedPaket->durasi_hari : '' }}">
                        </div>
                    </div>
                </section>

                {{-- SECTION: Lokasi & Waktu (Paket) --}}
                <section class="paket-mode ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">event</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Lokasi &amp; Waktu Keberangkatan</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_mulai" id="paketTanggalMulai" value="{{ old('tanggal_mulai') }}" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('tanggal_mulai') border-red-500 @enderror">
                            @error('tanggal_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Alamat Jemput</label>
                            <textarea name="alamat_jemput" id="paketAlamatJemput" rows="3" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md resize-none @error('alamat_jemput') border-red-500 @enderror" placeholder="Masukkan alamat lengkap penjemputan...">{{ old('alamat_jemput') }}</textarea>
                            @error('alamat_jemput')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Alamat Tujuan</label>
                            <textarea name="alamat_tujuan" id="paketAlamatTujuan" rows="2" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md resize-none @error('alamat_tujuan') border-red-500 @enderror" placeholder="Tujuan perjalanan...">{{ old('alamat_tujuan', $selectedDestinasi ? $selectedDestinasi->nama : '') }}</textarea>
                            @error('alamat_tujuan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: Pilih Kendaraan (Paket) --}}
                <section class="paket-mode ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-primary">directions_car</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Pilih Kendaraan</h2>
                    </div>
                    <p class="font-body-md text-on-surface-variant mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-lg">lightbulb</span>
                        Kendaraan HiAce + supir sudah termasuk dalam harga paket wisata.
                    </p>
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant">Kendaraan</label>
                        <div class="relative">
                            <select name="mobil_id" id="paketMobilSelect" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none focus:ring-2 focus:ring-primary @error('mobil_id') border-red-500 @enderror">
                                <option value="">-- Pilih Kendaraan --</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                        </div>
                        @error('mobil_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        <p id="rekomendasiInfo" class="text-label-sm text-primary font-semibold mt-2"></p>
                    </div>
                </section>

                {{-- ============ MOBIL MODE ============ --}}
                {{-- SECTION: Pilih Mobil --}}
                <section class="mobil-mode hidden ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">directions_car</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Pilih Mobil</h2>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant">Mobil</label>
                        <div class="relative">
                            <select name="mobil_id" id="mobilSelect" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none focus:ring-2 focus:ring-primary @error('mobil_id') border-red-500 @enderror">
                                <option value="" disabled {{ !$selectedMobil ? 'selected' : '' }}>-- Pilih Mobil --</option>
                                @foreach($mobils as $m)
                                <option value="{{ $m->id }}" {{ $selectedMobil && $selectedMobil->id == $m->id ? 'selected' : '' }} data-harga="{{ $m->harga_per_hari }}" data-nama="{{ $m->nama }}" data-kapasitas="{{ $m->kapasitas }}" data-merk="{{ $m->merk }}" data-foto="{{ $m->foto ?? '' }}">
                                    {{ $m->nama }} - {{ $m->merk }} ({{ $m->kapasitas }} kursi) - Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                        </div>
                        @error('mobil_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </section>

                {{-- SECTION: Lokasi & Waktu (Mobil) --}}
                <section class="mobil-mode hidden ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
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
                                <textarea name="alamat_tujuan" id="mobilAlamatTujuan" rows="2" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md resize-none @error('alamat_tujuan') border-red-500 @enderror" placeholder="Masukkan alamat tujuan...">{{ old('alamat_tujuan', $selectedDestinasi && !$selectedPaket ? $selectedDestinasi->nama : '') }}</textarea>
                                @error('alamat_tujuan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Atau pilih destinasi</label>
                            <div class="relative">
                                <select id="destinasiSelect" class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md appearance-none">
                                    <option value="">-- Pilih Destinasi --</option>
                                    @foreach(\App\Models\Destinasi::all() as $d)
                                    <option value="{{ $d->nama }}" {{ $selectedDestinasi && !$selectedPaket && $selectedDestinasi->id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="mobilTanggalMulai" value="{{ old('tanggal_mulai') }}" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('tanggal_mulai') border-red-500 @enderror">
                            @error('tanggal_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant">Jumlah Hari</label>
                            <input type="number" name="jumlah_hari" id="jumlahHari" value="{{ old('jumlah_hari', 1) }}" min="1" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('jumlah_hari') border-red-500 @enderror">
                            @error('jumlah_hari')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: Informasi Pemesan --}}
                <section class="ambient-card bg-surface-container-lowest rounded-[24px] p-8 border border-surface-container">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h2 class="text-headline-md font-headline-md font-bold">Informasi Pemesan</h2>
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
                            <label class="font-label-sm text-label-sm text-on-surface-variant">{{ $selectedPaket ? 'Jumlah Peserta' : 'Jumlah Penumpang' }}</label>
                            <div class="relative">
                                <input type="number" name="jumlah_penumpang" id="jumlahPenumpang" value="{{ old('jumlah_penumpang', 1) }}" min="1" required class="w-full p-4 rounded-xl border border-outline-variant bg-surface-container-low font-body-md @error('jumlah_penumpang') border-red-500 @enderror">
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
                    {{-- Price Calculation --}}
                    <div class="ambient-card bg-surface-container-highest rounded-[24px] p-8">
                        <h4 class="font-headline-md text-headline-md font-bold mb-6">Ringkasan Biaya</h4>
                        <div class="space-y-4 mb-8">
                            {{-- Paket breakdown --}}
                            <div class="paket-mode space-y-4">
                                <div class="flex justify-between text-on-surface-variant font-body-md">
                                    <span>Harga Paket Wisata</span>
                                    <span id="paketHargaDisplay">Rp {{ $selectedPaket ? number_format($selectedPaket->harga, 0, ',', '.') : '0' }}</span>
                                </div>
                                <div class="flex justify-between text-on-surface-variant font-body-md">
                                    <span>Kendaraan + Supir (HiAce)</span>
                                    <span class="text-green-600 font-semibold">Termasuk</span>
                                </div>
                            </div>
                            {{-- Mobil breakdown --}}
                            <div class="mobil-mode hidden space-y-4">
                                <div class="flex justify-between text-on-surface-variant font-body-md">
                                    <span>Harga Sewa</span>
                                    <span id="hargaPerHariDisplay">Rp {{ $selectedMobil ? number_format($selectedMobil->harga_per_hari, 0, ',', '.') : '0' }} / hari</span>
                                </div>
                                <div class="flex justify-between text-on-surface-variant font-body-md">
                                    <span>Biaya Supir</span>
                                    <span class="text-green-600 font-semibold">Gratis</span>
                                </div>
                                <div class="flex justify-between text-on-surface-variant font-body-md">
                                    <span>Durasi</span>
                                    <span id="jumlahHariDisplay">{{ old('jumlah_hari', 1) }} Hari</span>
                                </div>
                            </div>
                            <div class="flex justify-between text-on-surface-variant font-body-md">
                                <span>Biaya Layanan</span>
                                <span>Gratis</span>
                            </div>
                            <div class="pt-4 border-t border-outline-variant flex justify-between items-end">
                                <div>
                                    <span class="text-on-surface-variant block text-label-sm mb-1">Total Pembayaran</span>
                                    <span class="text-headline-md text-2xl font-bold text-primary" id="totalDisplay">Rp 0</span>
                                </div>
                            </div>
                        </div>
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
    const PAKETS = @json($paketJson);
    const MOBILS = @json($mobilJson);

    const selectedPaketId = {{ $selectedPaket ? $selectedPaket->id : 'null' }};
    const selectedMobilId = {{ $selectedMobil ? $selectedMobil->id : 'null' }};

    const paketDestinasi = document.getElementById('paketDestinasi');
    const paketSelect = document.getElementById('paketSelect');
    const paketDestinasiId = document.getElementById('paketDestinasiId');
    const paketJumlahHari = document.getElementById('paketJumlahHari');
    const paketAlamatTujuan = document.getElementById('paketAlamatTujuan');
    const paketMobilSelect = document.getElementById('paketMobilSelect');
    const mobilSelect = document.getElementById('mobilSelect');
    const jumlahPenumpang = document.getElementById('jumlahPenumpang');
    const jumlahHariInput = document.getElementById('jumlahHari');
    const rekomendasiInfo = document.getElementById('rekomendasiInfo');

    const paketHargaDisplay = document.getElementById('paketHargaDisplay');
    const hargaPerHariDisplay = document.getElementById('hargaPerHariDisplay');
    const jumlahHariDisplay = document.getElementById('jumlahHariDisplay');
    const totalDisplay = document.getElementById('totalDisplay');

    let currentMode = selectedPaketId || (paketDestinasi.value && !selectedMobilId) ? 'paket' : (selectedMobilId ? 'mobil' : 'paket');

    function formatRp(n) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
    }

    // ---------- MODE TOGGLE ----------
    function setMode(mode) {
        currentMode = mode;
        document.querySelectorAll('.mode-btn').forEach(btn => {
            const active = btn.dataset.mode === mode;
            btn.classList.toggle('bg-primary', active);
            btn.classList.toggle('text-on-primary', active);
            btn.classList.toggle('shadow-md', active);
            btn.classList.toggle('text-on-surface-variant', !active);
        });
        document.querySelectorAll('.paket-mode').forEach(s => {
            s.classList.toggle('hidden', mode !== 'paket');
            s.querySelectorAll('input,select,textarea').forEach(f => f.disabled = mode !== 'paket');
        });
        document.querySelectorAll('.mobil-mode').forEach(s => {
            s.classList.toggle('hidden', mode !== 'mobil');
            s.querySelectorAll('input,select,textarea').forEach(f => f.disabled = mode !== 'mobil');
        });
        hitungTotal();
    }
    document.querySelectorAll('.mode-btn').forEach(btn => {
        btn.addEventListener('click', () => setMode(btn.dataset.mode));
    });

    // ---------- PAKET ----------
    function filterPakets() {
        const did = paketDestinasi.value;
        paketSelect.innerHTML = '<option value="">-- Pilih Paket --</option>';
        PAKETS.filter(p => p.destinasi_id == did).forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;
            opt.textContent = p.nama + ' - ' + p.durasi + ' hari - ' + formatRp(p.harga);
            opt.dataset.harga = p.harga;
            opt.dataset.durasi = p.durasi;
            opt.dataset.destinasiNama = p.destinasi_nama;
            paketSelect.appendChild(opt);
        });
        paketDestinasiId.value = did || '';
        paketJumlahHari.value = '';
        paketAlamatTujuan.value = paketDestinasi.options[paketDestinasi.selectedIndex]?.text || '';
        hitungTotal();
    }
    paketDestinasi.addEventListener('change', filterPakets);

    paketSelect.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (opt.value) {
            paketJumlahHari.value = opt.dataset.durasi || '';
            paketDestinasiId.value = paketDestinasi.value;
            paketAlamatTujuan.value = opt.dataset.destinasiNama || '';
        } else {
            paketJumlahHari.value = '';
        }
        hitungTotal();
    });

    // ---------- KENDARAAN ----------
    function populatePaketMobils() {
        const peserta = parseInt(jumlahPenumpang.value) || 1;
        paketMobilSelect.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';
        let recommended = null;
        MOBILS.forEach(m => {
            const fits = m.kapasitas >= peserta;
            const opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = m.nama + ' - ' + m.merk + ' (' + m.kapasitas + ' kursi)' + (fits ? ' ✓' : '');
            opt.dataset.kapasitas = m.kapasitas;
            opt.dataset.nama = m.nama;
            if (fits && !recommended) recommended = opt;
            paketMobilSelect.appendChild(opt);
        });
        if (recommended) {
            recommended.selected = true;
            rekomendasiInfo.textContent = 'Rekomendasi untuk ' + peserta + ' peserta: ' + recommended.dataset.nama;
        } else {
            rekomendasiInfo.textContent = 'Tidak ada kendaraan dengan kapasitas ' + peserta + ' orang.';
        }
        hitungTotal();
    }
    jumlahPenumpang.addEventListener('input', populatePaketMobils);
    paketMobilSelect.addEventListener('change', hitungTotal);

    mobilSelect.addEventListener('change', hitungTotal);
    jumlahHariInput.addEventListener('input', hitungTotal);

    // ---------- TOTAL ----------
    function hitungTotal() {
        if (currentMode === 'paket') {
            const pOpt = paketSelect.options[paketSelect.selectedIndex];
            const p = pOpt.value ? (parseInt(pOpt.dataset.harga) || 0) : 0;
            paketHargaDisplay.textContent = formatRp(p);
            totalDisplay.textContent = formatRp(p);
        } else {
            const opt = mobilSelect.options[mobilSelect.selectedIndex];
            const harga = opt.value ? (parseInt(opt.dataset.harga) || 0) : 0;
            const hari = parseInt(jumlahHariInput.value) || 1;
            hargaPerHariDisplay.textContent = formatRp(harga) + ' / hari';
            jumlahHariDisplay.textContent = hari + ' Hari';
            totalDisplay.textContent = formatRp(harga * hari);
        }
    }

    // ---------- INIT ----------
    setMode(currentMode);
    filterPakets();

    if (selectedPaketId) {
        paketSelect.value = String(selectedPaketId);
        paketSelect.dispatchEvent(new Event('change'));
    }

    if (selectedMobilId) {
        mobilSelect.value = String(selectedMobilId);
    }

    populatePaketMobils();
    hitungTotal();

    const destinasiSelect = document.getElementById('destinasiSelect');
    const mobilAlamatTujuan = document.getElementById('mobilAlamatTujuan');
    if (destinasiSelect) {
        destinasiSelect.addEventListener('change', function() {
            if (this.value) {
                mobilAlamatTujuan.value = this.value;
            }
        });
    }
</script>
@endpush
