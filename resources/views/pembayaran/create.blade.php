@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran - TravelKu')

@section('content')
<main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 pt-28">
    {{-- Step Indicator --}}
    <div class="mb-12 flex justify-center items-center">
        <div class="flex items-center w-full max-w-2xl">
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold mb-2">1</div>
                <span class="text-sm font-medium text-on-surface-variant">Pilih Mobil</span>
            </div>
            <div class="h-1 flex-1 bg-primary/20 mx-2 mb-6">
                <div class="h-full bg-primary w-full"></div>
            </div>
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold mb-2">2</div>
                <span class="text-sm font-medium text-on-surface-variant">Detail Pesanan</span>
            </div>
            <div class="h-1 flex-1 bg-primary/20 mx-2 mb-6">
                <div class="h-full bg-primary w-full"></div>
            </div>
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold mb-2">3</div>
                <span class="text-sm font-bold text-primary">Konfirmasi</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        {{-- Left Column --}}
        <div class="lg:col-span-7 space-y-gutter">
            {{-- Status Pembayaran Card --}}
            <div class="bg-surface-container-lowest rounded-[24px] p-8 card-shadow transition-all duration-300">
                <div class="flex justify-between items-start mb-6 border-b border-surface-variant pb-6">
                    <div>
                        <h2 class="text-headline-md font-headline-md text-primary mb-1">Status Pembayaran</h2>
                        <p class="text-on-surface-variant">Order #TRV-{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <span class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-sm font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">pending</span>
                        Menunggu Verifikasi
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">directions_car</span>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Unit Mobil</p>
                                <p class="font-bold">{{ $pemesanan->mobil->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">route</span>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Rute Perjalanan</p>
                                <p class="font-bold">{{ $pemesanan->alamat_jemput ? \Illuminate\Support\Str::limit($pemesanan->alamat_jemput, 20) : '-' }} - {{ $pemesanan->destinasi->nama ?? ($pemesanan->alamat_tujuan ? \Illuminate\Support\Str::limit($pemesanan->alamat_tujuan, 20) : '-') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Tanggal Sewa</p>
                                <p class="font-bold">{{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d F Y') : '-' }} ({{ $pemesanan->jumlah_hari }} Hari)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">payments</span>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Total Tagihan</p>
                                <p class="font-bold text-xl text-primary">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Instruksi Pembayaran Card --}}
            <div class="bg-surface-container-lowest rounded-[24px] p-8 card-shadow transition-all duration-300">
                <h2 class="text-headline-md font-headline-md text-primary mb-6">Instruksi Pembayaran</h2>
                <div class="space-y-6">
                    <ol class="space-y-4 list-decimal list-inside text-on-surface-variant font-medium">
                        <li>Transfer ke salah satu rekening di bawah ini sesuai dengan total tagihan.</li>
                        <li>Simpan bukti transfer dalam format foto (JPG/PNG) atau PDF.</li>
                        <li>Isi formulir konfirmasi di samping dan unggah bukti transfer.</li>
                    </ol>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        @forelse($bankAccounts ?? [] as $bank)
                        <div class="p-5 border-2 border-surface-container rounded-xl bg-surface-container-low flex flex-col justify-between">
                            <div class="flex justify-between items-start mb-4">
                                <div class="h-8 w-16 bg-white rounded flex items-center justify-center shadow-sm">
                                    <span class="font-bold italic text-primary text-xs">{{ $bank->nama_bank }}</span>
                                </div>
                                <button type="button" class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-all" onclick="copyToClipboard('{{ $bank->nomor_rekening }}')">
                                    <span class="material-symbols-outlined">content_copy</span>
                                </button>
                            </div>
                            <div>
                                <p class="text-lg font-bold tracking-wider">{{ $bank->nomor_rekening }}</p>
                                <p class="text-sm text-on-surface-variant">a/n {{ $bank->atas_nama }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2 p-5 rounded-xl bg-surface-container-low text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-3xl mb-2">info</span>
                            <p>Informasi rekening belum tersedia. Silakan hubungi客服 untuk bantuan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="lg:col-span-5">
            <div class="bg-surface-container-lowest rounded-[24px] p-8 card-shadow transition-all duration-300 border-2 border-primary-container/10">
                <h2 class="text-headline-md font-headline-md text-primary mb-8">Konfirmasi Pembayaran</h2>
                <form method="POST" action="{{ route('pembayaran.store', $pemesanan->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim', auth()->user()->name) }}" required class="w-full bg-surface-container-low border-surface-variant rounded-xl p-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('nama_pengirim') border-error @enderror" placeholder="Contoh: Budi Santoso">
                        @error('nama_pengirim')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Bank Pengirim</label>
                        <select name="bank_pengirim" required class="w-full bg-surface-container-low border-surface-variant rounded-xl p-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none">
                            <option disabled {{ old('bank_pengirim') ? '' : 'selected' }}>Pilih Bank</option>
                            <option value="Bank BCA" {{ old('bank_pengirim') == 'Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                            <option value="Bank Mandiri" {{ old('bank_pengirim') == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                            <option value="Bank BNI" {{ old('bank_pengirim') == 'Bank BNI' ? 'selected' : '' }}>Bank BNI</option>
                            <option value="Bank BRI" {{ old('bank_pengirim') == 'Bank BRI' ? 'selected' : '' }}>Bank BRI</option>
                            <option value="Lainnya" {{ old('bank_pengirim') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('bank_pengirim')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-on-surface-variant mb-2">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi') }}" required class="w-full bg-surface-container-low border-surface-variant rounded-xl p-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('tanggal_transaksi') border-error @enderror">
                            @error('tanggal_transaksi')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-on-surface-variant mb-2">Nominal Transfer</label>
                            <div class="relative">
                                <span class="absolute left-4 top-4 font-bold text-on-surface-variant">Rp</span>
                                <input type="number" name="nominal_transfer" value="{{ old('nominal_transfer', $pemesanan->total_harga) }}" readonly class="w-full bg-surface-container-low border-surface-variant rounded-xl p-4 pl-12 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-bold text-on-surface @error('nominal_transfer') border-error @enderror">
                            </div>
                            @error('nominal_transfer')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Upload Bukti Transfer</label>
                        <div class="border-2 border-dashed border-primary-container/30 rounded-[24px] p-8 bg-primary/5 hover:bg-primary/10 transition-all text-center cursor-pointer group" id="drop-zone">
                            <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" class="hidden" id="file-input">
                            <div class="flex flex-col items-center">
                                <span class="material-symbols-outlined text-5xl text-primary mb-4 group-hover:scale-110 transition-transform">cloud_upload</span>
                                <p class="font-bold text-on-surface mb-1">Drag & drop atau klik untuk upload</p>
                                <p class="text-xs text-on-surface-variant">JPG, PNG, atau PDF (Maks. 5MB)</p>
                                <div class="flex gap-2 mt-4">
                                    <span class="material-symbols-outlined text-primary/60">image</span>
                                    <span class="material-symbols-outlined text-primary/60">picture_as_pdf</span>
                                </div>
                            </div>
                        </div>
                        @error('bukti_pembayaran')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full bg-primary text-on-primary font-bold py-4 rounded-xl shadow-lg hover:shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span>Kirim Bukti Pembayaran</span>
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection


@section('footer')
<footer class="w-full py-6 mt-auto bg-surface-container-lowest border-t border-outline-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-4">
        <p class="font-label-sm text-sm text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. All rights reserved.</p>
        <div class="flex gap-6">
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Syarat &amp; Ketentuan</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Kebijakan Privasi</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Bantuan</a>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<style>
    .card-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
    .card-hover:hover { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
</style>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor rekening disalin: ' + text);
        });
    }

    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');

    if (dropZone && fileInput) {
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-primary/20');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-primary/20');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-primary/20');
            const files = e.dataTransfer.files;
            if (files.length) handleFile(files[0]);
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) handleFile(e.target.files[0]);
        });
    }

    function handleFile(file) {
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimum 5MB.');
            return;
        }
        const dropZoneContent = dropZone.querySelector('div');
        dropZoneContent.innerHTML = `
            <span class="material-symbols-outlined text-5xl text-primary mb-4">check_circle</span>
            <p class="font-bold text-on-surface mb-1">${file.name}</p>
            <p class="text-xs text-on-surface-variant">File siap diunggah</p>
            <button type="button" class="mt-4 text-error text-xs font-bold underline" onclick="resetUpload(event)">Ganti File</button>
        `;
    }

    function resetUpload(e) {
        e.stopPropagation();
        const dropZoneContent = dropZone.querySelector('div');
        dropZoneContent.innerHTML = `
            <span class="material-symbols-outlined text-5xl text-primary mb-4 group-hover:scale-110 transition-transform">cloud_upload</span>
            <p class="font-bold text-on-surface mb-1">Drag & drop atau klik untuk upload</p>
            <p class="text-xs text-on-surface-variant">JPG, PNG, atau PDF (Maks. 5MB)</p>
            <div class="flex gap-2 mt-4">
                <span class="material-symbols-outlined text-primary/60">image</span>
                <span class="material-symbols-outlined text-primary/60">picture_as_pdf</span>
            </div>
        `;
        fileInput.value = '';
    }
</script>
@endpush
