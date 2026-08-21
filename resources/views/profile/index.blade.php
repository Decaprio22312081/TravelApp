@extends('layouts.app')

@section('title', 'Profil Saya - TravelKu')

@section('content')
<div class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop pt-28 pb-12 space-y-8">
    @if(session('success'))
    <div class="flex items-center gap-3 bg-primary/10 text-primary px-5 py-4 rounded-xl font-label-md border border-primary/20">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if($errors->any())
    <div class="flex items-center gap-3 bg-error/10 text-error px-5 py-4 rounded-xl font-label-md border border-error/20">
        <span class="material-symbols-outlined">error</span>
        <span>@foreach($errors->all() as $err) {{ $err }} @endforeach</span>
    </div>
    @endif

    {{-- Profile Header Card --}}
    <section class="bg-surface-container-lowest rounded-[24px] p-6 md:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <div class="relative">
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary/10 p-1">
                    @if(Auth::user()->foto)
                        <img src="{{ asset('storage/'.Auth::user()->foto) }}" alt="Foto" class="w-full h-full object-cover rounded-full">
                    @else
                        <div class="w-full h-full rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-primary">person</span>
                        </div>
                    @endif
                </div>
                <label class="absolute bottom-1 right-1 bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                    <input type="file" name="foto" form="form-profil" class="hidden" accept="image/*">
                </label>
            </div>
            <div class="text-center md:text-left flex-1">
                <h3 class="font-display text-display-lg-mobile md:text-headline-md text-primary">{{ Auth::user()->name }}</h3>
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mt-2">
                    <span class="px-3 py-1 bg-primary text-white text-label-sm rounded-full flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        Member Premium
                    </span>
                    <span class="text-on-surface-variant font-body-md">Bergabung sejak {{ Auth::user()->created_at->format('Y') }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Personal Information --}}
            <div class="bg-surface-container-lowest rounded-[24px] p-6 md:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/10">
                <h4 class="font-display text-headline-md text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined">contact_page</span>
                    Informasi Pribadi
                </h4>
                <form id="form-profil" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-label-sm text-on-surface-variant ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md @error('name') border-error @enderror">
                            @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-label-sm text-on-surface-variant ml-1">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant outline-none bg-surface-container-low font-body-md text-on-surface-variant cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-label-sm text-on-surface-variant ml-1">No. HP</label>
                            <input type="tel" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md @error('no_hp') border-error @enderror">
                            @error('no_hp')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-label-sm text-on-surface-variant ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md @error('alamat') border-error @enderror">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                            @error('alamat')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <button type="submit" class="hidden"></button>
                </form>
            </div>

            {{-- Security --}}
            <div class="bg-surface-container-lowest rounded-[24px] p-6 md:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/10">
                <h4 class="font-display text-headline-md text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined">security</span>
                    Keamanan
                </h4>
                <div class="space-y-4">
                    <button type="button" onclick="document.getElementById('form-ganti-sandi').classList.toggle('hidden')"
                        class="w-full flex items-center justify-between p-4 rounded-xl border border-outline-variant hover:border-primary hover:bg-primary/5 transition-all group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">password</span>
                            <span class="font-body-md">Ganti Kata Sandi</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" id="chevron-sandi">chevron_right</span>
                    </button>

                    <div id="form-ganti-sandi" class="hidden p-5 rounded-xl border border-primary/20 bg-primary/5 space-y-5">
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-label-sm text-on-surface-variant ml-1">Kata Sandi Saat Ini</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-xl">lock</span>
                                        </span>
                                        <input type="password" name="password_sekarang" required
                                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md @error('password_sekarang') border-error @enderror">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-label-sm text-on-surface-variant ml-1">Kata Sandi Baru</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-xl">lock_open</span>
                                        </span>
                                        <input type="password" name="password" required
                                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md @error('password') border-error @enderror">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-label-sm text-on-surface-variant ml-1">Konfirmasi Kata Sandi Baru</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-xl">lock_open</span>
                                        </span>
                                        <input type="password" name="password_confirmation" required
                                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-surface-container-low font-body-md">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold hover:bg-primary/90 transition-all active:scale-95 inline-flex items-center gap-2">
                                    <span class="material-symbols-outlined">key</span>Ubah Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="p-4 rounded-xl border border-outline-variant bg-surface-container-low">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">phonelink_lock</span>
                                <span class="font-body-md font-bold">Autentikasi 2 Faktor</span>
                            </div>
                            <div class="relative inline-block w-12 h-6 rounded-full bg-outline-variant p-1 cursor-pointer transition-colors" id="toggle-2fa">
                                <div class="w-4 h-4 rounded-full bg-white transition-transform"></div>
                            </div>
                        </div>
                        <p class="text-label-sm text-on-surface-variant leading-tight">Sangat direkomendasikan untuk keamanan akun.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-error/20 bg-error/5">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-error">warning</span>
                            <span class="font-body-md font-bold text-error">Zona Berbahaya</span>
                        </div>
                        <p class="text-label-sm text-on-surface-variant mb-3">Menonaktifkan akun akan menghapus semua data Anda.</p>
                        <button class="text-error font-body-md font-bold hover:underline" onclick="alert('Fitur ini belum tersedia.')">Nonaktifkan Akun</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-8">
            <div class="bg-primary/5 rounded-[24px] p-6 md:p-8 border border-primary/10 space-y-4 sticky top-28">
                <p class="text-body-md text-on-surface-variant text-center mb-2">Pastikan semua informasi sudah benar sebelum menyimpan.</p>
                <button type="submit" form="form-profil"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl transition-all shadow-lg active:scale-[0.98] flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}"
                    class="w-full bg-white hover:bg-surface-variant text-on-surface-variant font-bold py-4 rounded-xl transition-all border border-outline-variant flex items-center justify-center gap-2">
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="w-full py-6 mt-auto bg-surface-container-lowest border-t border-outline-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-4">
        <p class="font-label-sm text-sm text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. All rights reserved.</p>
        <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Syarat &amp; Ketentuan</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Kebijakan Privasi</a>
            <a href="#" class="font-label-sm text-sm text-on-surface-variant hover:text-primary underline opacity-80 hover:opacity-100 transition-all">Bantuan</a>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<style>
    .custom-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
</style>
<script>
    document.getElementById('toggle-2fa')?.addEventListener('click', function() {
        const knob = this.querySelector('div');
        const isActive = this.classList.contains('bg-primary');
        if (isActive) {
            this.classList.replace('bg-primary', 'bg-outline-variant');
            knob.classList.remove('translate-x-6');
        } else {
            this.classList.replace('bg-outline-variant', 'bg-primary');
            knob.classList.add('translate-x-6');
        }
    });

    document.querySelector('[onclick*="form-ganti-sandi"]')?.addEventListener('click', function() {
        const chevron = document.getElementById('chevron-sandi');
        const form = document.getElementById('form-ganti-sandi');
        chevron.style.transform = form.classList.contains('hidden') ? 'rotate(90deg)' : 'rotate(0deg)';
    });
</script>
@endpush
