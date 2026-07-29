<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - TravelKu</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script>
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "inverse-surface": "#2e3132",
        "background": "#f8f9fa",
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
        "primary-container": "#0056b3",
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
        "primary": "#003f87",
        "on-surface": "#191c1d",
        "surface-container-highest": "#e1e3e4",
        "surface-tint": "#115cb9"
      },
      borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
      spacing: { gutter: "24px", "container-max": "1280px", "margin-mobile": "16px", base: "8px", "margin-desktop": "40px" },
      fontFamily: { "body-lg": ["Inter"], "body-md": ["Inter"], "label-sm": ["Inter"], "headline-md": ["Montserrat"], "display-lg-mobile": ["Montserrat"], "display-lg": ["Montserrat"] },
      fontSize: { "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}], "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}], "label-sm": ["14px", {"lineHeight": "20px", "fontWeight": "600"}], "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}], "display-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "700"}], "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}] }
    },
  },
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
.login-card-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); }
.login-card-shadow:hover { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
.glass-nav { background: rgba(255, 255, 255, 0.90); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
[x-cloak] { display: none !important; }
</style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
{{-- NAVBAR --}}
<header class="fixed top-0 w-full z-50 glass-nav shadow-sm">
    <nav class="flex items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">directions_car</span>
            <a href="{{ url('/') }}" class="font-display-lg text-xl font-bold text-primary">Cv.Afia Jaya Abadi</a>
        </div>
        <div class="flex items-center gap-6 ml-auto">
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->is('/') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Home</a>
                <a href="{{ route('destinasi.index') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('destinasi.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Destinasi</a>
                <a href="{{ route('mobil.index') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('mobil.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Mobil</a>
                <a href="{{ route('tentang-kami') }}" class="text-on-surface-variant hover:text-primary transition-colors font-body-md {{ request()->routeIs('tentang-kami') ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}">Tentang Kami</a>
            </div>
            <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="hidden sm:block text-primary font-semibold hover:opacity-80 transition-opacity active:scale-95 duration-200">Login</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all duration-200">Register</a>
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
                        <span class="material-symbols-outlined text-sm">expand_more</span>
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
                <a href="{{ route('register') }}" class="block px-4 py-2.5 rounded-xl bg-primary text-white font-bold text-center" @click="mobileOpen = false">Register</a>
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
<main class="flex-grow flex items-center justify-center pt-28 pb-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
<div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-xl overflow-hidden login-card-shadow relative z-10">
<div class="hidden lg:block relative min-h-[600px]">
<div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80');"></div>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent flex flex-col justify-end p-12">
<h2 class="font-display-lg text-display-lg text-on-primary mb-4">Travel Wisata Bandar Lampung Cv.Afia Jaya Abadi</h2>
<p class="font-body-lg text-body-lg text-on-primary/90 max-w-md"> Nikmati kemudahan menyewa mobil dengan pilihan lepas kunci atau driver berpengalaman. Harga terjangkau, proses cepat, dan siap menemani perjalanan Anda ke berbagai destinasi di bandar Lampung.</p>
</div>
</div>
<div class="flex flex-col justify-center p-8 sm:p-12 lg:p-16 bg-surface">
<div class="mb-10">
<h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-headline-md text-on-surface mb-2">Selamat Datang</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Masukkan detail Anda untuk mengakses akun.</p>
</div>

@if(session('error'))
<div class="flex items-center gap-3 bg-error/10 text-error px-4 py-3 rounded-lg mb-6 font-label-sm border border-error/20">
    <span class="material-symbols-outlined">error</span>
    <span>{{ session('error') }}</span>
</div>
@endif
@if($errors->any())
<div class="flex items-center gap-3 bg-error/10 text-error px-4 py-3 rounded-lg mb-6 font-label-sm border border-error/20">
    <span class="material-symbols-outlined">error</span>
    <span>{{ $errors->first() }}</span>
</div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-6">
@csrf
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant mb-2" for="email">Email</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline">
<span class="material-symbols-outlined">person</span>
</span>
<input class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-on-surface outline-none @error('email') border-error @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus type="text">
</div>
</div>
<div>
<div class="flex justify-between items-center mb-2">
<label class="font-label-sm text-label-sm text-on-surface-variant" for="password">Password</label>
<a class="font-label-sm text-label-sm text-primary hover:underline" href="{{ route('forgot.password') }}">Lupa password?</a>
</div>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline">
<span class="material-symbols-outlined">lock</span>
</span>
<input class="w-full pl-10 pr-12 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all text-on-surface outline-none @error('password') border-error @enderror" id="password" name="password" placeholder="••••••••" required type="password">
<button class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-primary transition-colors" type="button" onclick="togglePassword()">
<span class="material-symbols-outlined" id="pw-icon">visibility</span>
</button>
</div>
</div>
<div class="flex items-center">
<input class="h-4 w-4 text-primary border-outline-variant rounded focus:ring-primary transition-all" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
<label class="ml-2 font-body-md text-label-sm text-on-surface-variant" for="remember">Ingat saya selama 30 hari</label>
</div>
<button class="w-full bg-primary text-white py-3 px-6 rounded-lg font-bold hover:opacity-90 active:scale-[0.98] transition-all flex justify-center items-center gap-2" type="submit">
Login
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</form>
<p class="mt-8 text-center font-body-md text-body-md text-on-surface-variant">
Belum punya akun?
<a class="text-primary font-bold hover:underline" href="{{ route('register') }}">Daftar sekarang</a>
</p>
</div>
</div>
</main>
<footer class="w-full bottom-0 bg-surface-container-low">
<div class="flex flex-col md:flex-row justify-between items-center px-gutter py-8 max-w-container-max mx-auto space-y-4 md:space-y-0">
<div class="font-body-md text-body-md text-on-surface-variant">&copy; {{ date('Y') }} TravelKu. Premium Car Rental Services.</div>
<div class="flex gap-6">
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all duration-200" href="#">Terms of Service</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all duration-200" href="#">Privacy Policy</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all duration-200" href="{{ route('tentang-kami') }}">Contact Support</a>
</div>
</div>
</footer>
<script>
function togglePassword() {
const pw = document.getElementById('password');
const icon = document.getElementById('pw-icon');
if (pw.type === 'password') { pw.type = 'text'; icon.textContent = 'visibility_off'; }
else { pw.type = 'password'; icon.textContent = 'visibility'; }
}
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
