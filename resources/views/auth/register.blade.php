<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buat Akun | TravelKu</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script>
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "inverse-surface": "#2e3132",
        "background": "#f7f6f1",
        "on-secondary": "#ffffff",
        "on-tertiary-container": "#c7d1db",
        "secondary-container": "#8bb4fe",
        "tertiary-container": "#505a62",
        "surface-bright": "#f8f9fa",
        "outline": "#727784",
        "secondary": "#325ea2",
        "on-tertiary-fixed": "#131d24",
        "inverse-on-surface": "#f0f1f2",
        "on-primary-fixed-variant": "#004491",
        "on-primary-fixed": "#001a40",
        "tertiary-fixed-dim": "#bec8d1",
        "surface-variant": "#e1e3e4",
        "secondary-fixed": "#d7e2ff",
        "surface-container-lowest": "#ffffff",
        "error": "#ba1a1a",
        "on-secondary-fixed": "#001b3f",
        "on-background": "#191c1d",
        "on-primary": "#ffffff",
        "primary-fixed": "#d7e2ff",
        "surface-dim": "#d9dadb",
        "outline-variant": "#c2c6d4",
        "on-primary-container": "#bbd0ff",
        "primary-fixed-dim": "#acc7ff",
        "on-error": "#ffffff",
        "error-container": "#ffdad6",
        "secondary-fixed-dim": "#abc7ff",
        "surface-container-high": "#e7e8e9",
        "surface-container-low": "#f3f4f5",
        "inverse-primary": "#acc7ff",
        "primary-container": "#2e6b54",
        "on-tertiary": "#ffffff",
        "on-surface-variant": "#424752",
        "on-error-container": "#93000a",
        "tertiary-fixed": "#dae4ee",
        "tertiary": "#39434a",
        "surface-container": "#edeeef",
        "surface": "#f8f9fa",
        "on-tertiary-fixed-variant": "#3e4850",
        "on-secondary-fixed-variant": "#124589",
        "on-secondary-container": "#0f4487",
        "primary": "#1f4d3d",
        "on-surface": "#1e2924",
        "surface-container-highest": "#e1e3e4",
        "surface-tint": "#115cb9"
      },
      borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
      spacing: { gutter: "24px", "container-max": "1280px", "margin-mobile": "16px", base: "8px", "margin-desktop": "40px" },
      fontFamily: { "body-lg": ["DM Sans"], "body-md": ["DM Sans"], "label-sm": ["DM Sans"], "headline-md": ["Fraunces"], "display-lg-mobile": ["Fraunces"], "display-lg": ["Fraunces"] },
      fontSize: { "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}], "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}], "label-sm": ["14px", {"lineHeight": "20px", "fontWeight": "600"}], "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}], "display-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "700"}], "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}] }
    },
  },
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
.form-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
.glass-nav { background: rgba(255, 255, 255, 0.90); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
[x-cloak] { display: none !important; }
</style>
</head>
<body class="bg-background text-on-background font-body-md antialiased">
{{-- NAVBAR --}}
<header class="fixed top-0 w-full z-50 glass-nav shadow-sm">
    <nav class="flex items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="flex items-center gap-1.5 sm:gap-2 min-w-0">
            <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl flex-shrink-0" style="font-variation-settings: 'FILL' 1;">directions_car</span>
            <a href="{{ url('/') }}" class="font-display-lg text-base sm:text-xl font-bold text-primary whitespace-nowrap truncate">CV. Afia Jaya Abadi</a>
        </div>
        <div class="flex items-center gap-2 sm:gap-6 ml-auto flex-shrink-0">
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->is('/') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Home</a>
                <a href="{{ route('destinasi.index') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('destinasi.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Destinasi</a>
                <a href="{{ route('mobil.index') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('mobil.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Mobil</a>
                <a href="{{ route('tentang-kami') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('tentang-kami') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Tentang Kami</a>
            </div>
            <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="hidden sm:block text-primary font-semibold hover:opacity-80 transition-opacity active:scale-95 duration-200">Login</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all duration-200">Buat Akun</a>
            @else
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-1 text-primary font-semibold text-sm hover:opacity-80 transition-opacity">
                        <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">shield</span>
                        Admin
                    </a>
                @endif
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors active:scale-95 duration-200">
                        <span class="material-symbols-outlined">account_circle</span>
                        <span class="hidden sm:inline font-semibold">{{ auth()->user()->name }}</span>
                        <span class="material-symbols-outlined text-sm hidden sm:inline">expand_more</span>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-surface-container-lowest rounded-2xl shadow-lg border border-outline-variant z-50 overflow-hidden">
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface hover:bg-surface-container-low transition-colors font-body-md">
                            <span class="material-symbols-outlined text-primary">person</span> Akun Saya
                        </a>
                        <a href="{{ route('pemesanan.riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface hover:bg-surface-container-low transition-colors font-body-md">
                            <span class="material-symbols-outlined text-primary">history</span> Riwayat
                        </a>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface hover:bg-surface-container-low transition-colors font-body-md">
                            <span class="material-symbols-outlined text-primary">dashboard</span> Dashboard
                        </a>
                        <hr class="border-outline-variant">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition-colors font-body-md">
                                <span class="material-symbols-outlined">logout</span> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
            <button class="md:hidden text-on-surface-variant hover:text-primary transition-colors" @click="mobileOpen = !mobileOpen" x-data="{ mobileOpen: false }">
                <span class="material-symbols-outlined text-2xl" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
            </button>
        </div>
        </div>
    </nav>
    <div class="md:hidden border-t border-outline-variant bg-surface-container-lowest" x-data="{ mobileOpen: false }" x-show="mobileOpen" @click.away="mobileOpen = false" x-cloak>
        <div class="px-margin-mobile py-4 space-y-3">
            <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-xl font-body-md {{ request()->is('/') ? 'bg-primary text-white' : 'text-on-surface hover:bg-surface-container-low' }}" @click="mobileOpen = false">Home</a>
            <a href="{{ route('destinasi.index') }}" class="block px-4 py-2.5 rounded-xl font-body-md {{ request()->routeIs('destinasi.*') ? 'bg-primary text-white' : 'text-on-surface hover:bg-surface-container-low' }}" @click="mobileOpen = false">Destinasi</a>
            <a href="{{ route('mobil.index') }}" class="block px-4 py-2.5 rounded-xl font-body-md {{ request()->routeIs('mobil.*') ? 'bg-primary text-white' : 'text-on-surface hover:bg-surface-container-low' }}" @click="mobileOpen = false">Mobil</a>
            <a href="{{ route('tentang-kami') }}" class="block px-4 py-2.5 rounded-xl font-body-md {{ request()->routeIs('tentang-kami') ? 'bg-primary text-white' : 'text-on-surface hover:bg-surface-container-low' }}" @click="mobileOpen = false">Tentang Kami</a>
            @guest
                <hr class="border-outline-variant">
                <a href="{{ route('login') }}" class="block px-4 py-2.5 rounded-xl text-primary font-semibold text-center" @click="mobileOpen = false">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2.5 rounded-xl bg-primary text-white font-bold text-center" @click="mobileOpen = false">Buat Akun</a>
            @else
                <hr class="border-outline-variant">
                <a href="{{ route('profile') }}" class="block px-4 py-2.5 rounded-xl text-on-surface hover:bg-surface-container-low" @click="mobileOpen = false">Akun Saya</a>
                <a href="{{ route('pemesanan.riwayat') }}" class="block px-4 py-2.5 rounded-xl text-on-surface hover:bg-surface-container-low" @click="mobileOpen = false">Riwayat</a>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-on-surface hover:bg-surface-container-low" @click="mobileOpen = false">Dashboard</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-primary font-semibold" @click="mobileOpen = false">Admin Panel</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 rounded-xl text-red-600 font-semibold">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</header>
<main class="min-h-screen flex items-center justify-center relative overflow-hidden pt-28 pb-12">
<div class="container max-w-container-max mx-auto px-gutter relative z-10">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
<div class="hidden lg:flex flex-col lg:col-span-6 space-y-8">
<div class="space-y-4">
<h1 class="font-display-lg text-display-lg text-primary leading-tight">Mulai Perjalanan Premium Anda di Lampung.</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-md">
Bergabunglah dengan TravelKu dan dapatkan akses ke armada kendaraan premium kami serta pengalaman perjalanan terkurasi di seluruh Lampung.
</p>
</div>
<div class="grid grid-cols-2 gap-6">
<div class="p-6 rounded-xl bg-surface-container-lowest form-shadow border border-outline-variant/30">
<span class="material-symbols-outlined text-primary text-4xl mb-3">verified_user</span>
<h3 class="font-headline-md text-body-md font-bold mb-1">Keamanan Premium</h3>
<p class="text-on-surface-variant text-sm">Setiap pemesanan dilindungi oleh asuransi berstandar tinggi.</p>
</div>
<div class="p-6 rounded-xl bg-surface-container-lowest form-shadow border border-outline-variant/30">
<span class="material-symbols-outlined text-primary text-4xl mb-3">loyalty</span>
<h3 class="font-headline-md text-body-md font-bold mb-1">Hadiah Eksklusif</h3>
<p class="text-on-surface-variant text-sm">Kumpulkan poin untuk setiap perjalanan Anda.</p>
</div>
</div>
<div class="relative h-64 rounded-xl overflow-hidden shadow-xl">
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent z-10"></div>
<div class="absolute inset-0 p-4 flex flex-col justify-end z-20">
<p class="font-bold text-sm text-white">ARMADA PILIHAN</p>
<p class="text-xs text-white/80">Beberapa armada terbaik kami</p>
</div>
<div class="absolute inset-0 p-3 grid grid-cols-3 gap-2">
@forelse($mobils->take(6) as $m)
@if($m->foto)
<img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}">
@else
<div class="w-full h-full rounded-lg bg-surface-container-low flex items-center justify-center text-outline">
<span class="material-symbols-outlined text-2xl">directions_car</span>
</div>
@endif
@empty
<div class="col-span-3 h-full rounded-lg bg-surface-container-low flex items-center justify-center text-outline">
<span class="material-symbols-outlined text-2xl">directions_car</span>
</div>
@endforelse
</div>
</div>
</div>
<div class="lg:col-span-6 flex justify-center">
<div class="w-full max-w-[520px] bg-white p-8 md:p-12 rounded-[24px] form-shadow border border-outline-variant/20 transition-all duration-300 hover:shadow-2xl">
<div class="mb-10 text-center lg:text-left">
<h2 class="font-headline-md text-headline-md text-on-background mb-2">Buat Akun</h2>
<p class="font-body-md text-on-surface-variant">Daftar untuk memulai pengalaman sewa mobil premium.</p>
</div>

@if($errors->any())
<div class="flex items-center gap-3 bg-error/10 text-error px-4 py-3 rounded-lg mb-6 font-label-sm border border-error/20">
    <span class="material-symbols-outlined">error</span>
    <span>{{ $errors->first() }}</span>
</div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-5">
@csrf
<div class="space-y-2">
<label class="block font-label-sm text-on-surface-variant ml-1" for="name">Nama Lengkap</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">person</span>
<input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-outline-variant @error('name') border-error @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required type="text">
</div>
</div>
<div class="space-y-2">
<label class="block font-label-sm text-on-surface-variant ml-1" for="email">Email</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">mail</span>
<input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-outline-variant @error('email') border-error @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required type="email">
</div>
</div>
<div class="space-y-2">
<label class="block font-label-sm text-on-surface-variant ml-1" for="no_hp">No. HP</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">phone</span>
<input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-outline-variant @error('no_hp') border-error @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="+62 812 3456 7890" type="tel">
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="space-y-2">
<label class="block font-label-sm text-on-surface-variant ml-1" for="password">Password</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">lock</span>
<input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-outline-variant @error('password') border-error @enderror" id="password" name="password" placeholder="••••••••" required type="password">
</div>
</div>
<div class="space-y-2">
<label class="block font-label-sm text-on-surface-variant ml-1" for="password_confirmation">Konfirmasi Password</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">verified</span>
<input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-outline-variant" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required type="password">
</div>
</div>
</div>
<div class="flex items-start pt-2">
<div class="flex items-center h-5">
<input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface-container-low transition-colors" id="terms" required type="checkbox">
</div>
<label class="ml-3 text-sm text-on-surface-variant" for="terms">
Saya setuju dengan <a class="text-primary font-semibold hover:underline" href="#">Syarat & Ketentuan</a> dan <a class="text-primary font-semibold hover:underline" href="#">Kebijakan Privasi</a>.
</label>
</div>
<button class="w-full bg-primary text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl hover:opacity-90 active:scale-[0.98] transition-all transform flex justify-center items-center gap-2 mt-4" type="submit">
<span class="material-symbols-outlined">person_add</span>
Buat Akun
</button>
</form>
<div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
<p class="text-on-surface-variant font-body-md">
Sudah punya akun?
<a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Login di sini</a>
</p>
</div>
</div>
</div>
</div>
</div>
</main>
<footer class="w-full bottom-0 bg-surface-container-low">
<div class="flex flex-col md:flex-row justify-between items-center px-gutter py-8 max-w-container-max mx-auto text-center md:text-left">
<div class="mb-4 md:mb-0">
<p class="font-body-md text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. Premium Car Rental Services.</p>
</div>
<div class="flex space-x-6">
<a class="text-on-surface-variant hover:text-primary transition-all duration-200 underline" href="#">Terms of Service</a>
<a class="text-on-surface-variant hover:text-primary transition-all duration-200 underline" href="#">Privacy Policy</a>
<a class="text-on-surface-variant hover:text-primary transition-all duration-200 underline" href="{{ route('tentang-kami') }}">Contact Support</a>
</div>
</div>
</footer>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
