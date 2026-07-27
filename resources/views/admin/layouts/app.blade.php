<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - TravelKu')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "surface-container": "#eceef0",
                        "surface-bright": "#f7f9fb",
                        "tertiary-container": "#006083",
                        "on-secondary-container": "#5c647a",
                        "on-error": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "background": "#f7f9fb",
                        "secondary-fixed-dim": "#bec6e0",
                        "on-tertiary-container": "#97d8ff",
                        "tertiary-fixed": "#c4e7ff",
                        "on-primary-fixed-variant": "#004491",
                        "on-surface-variant": "#424752",
                        "secondary-fixed": "#dae2fd",
                        "outline": "#727784",
                        "primary-fixed-dim": "#acc7ff",
                        "inverse-primary": "#acc7ff",
                        "on-primary": "#ffffff",
                        "surface-tint": "#115cb9",
                        "surface-container-low": "#f2f4f6",
                        "tertiary": "#004762",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#131b2e",
                        "on-tertiary-fixed-variant": "#004c69",
                        "surface": "#f7f9fb",
                        "tertiary-fixed-dim": "#7bd0ff",
                        "error-container": "#ffdad6",
                        "on-background": "#191c1e",
                        "surface-container-highest": "#e0e3e5",
                        "primary-container": "#0056b3",
                        "primary": "#003f87",
                        "on-primary-fixed": "#001a40",
                        "on-primary-container": "#bbd0ff",
                        "on-surface": "#191c1e",
                        "primary-fixed": "#d7e2ff",
                        "secondary-container": "#dae2fd",
                        "outline-variant": "#c2c6d4",
                        "on-secondary-fixed-variant": "#3f465c",
                        "on-tertiary-fixed": "#001e2c",
                        "surface-dim": "#d8dadc",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "error": "#ba1a1a",
                        "secondary": "#565e74"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        sans: ["Montserrat", "sans-serif"],
                        display: ["Montserrat", "sans-serif"],
                    },
                    fontSize: {
                        "display-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "label-caps": ["12px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "700" }],
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                        "title-sm": ["18px", { lineHeight: "24px", fontWeight: "600" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "label-sm": ["12px", { lineHeight: "16px", fontWeight: "500" }],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-surface font-sans custom-scrollbar">

{{-- SIDEBAR BACKDROP (mobile) --}}
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-30 hidden" onclick="toggleSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen w-[280px] bg-secondary flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div class="p-8">
        <h1 class="font-display text-display-lg font-bold text-surface-container-lowest">Dashboard</h1>
        <p class="text-label-caps text-secondary-fixed-dim mt-1 opacity-70">Car Rental System</p>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 custom-scrollbar">
        <div class="space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-label-caps">Dashboard</span>
            </a>
            <a href="{{ route('admin.destinasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.destinasi.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">map</span>
                <span class="text-label-caps">Destinasi</span>
            </a>
            <a href="{{ route('admin.mobil.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.mobil.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">directions_car</span>
                <span class="text-label-caps">Mobil &amp; Supir</span>
            </a>
            <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pemesanan.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="text-label-caps">Pemesanan</span>
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pembayaran.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">verified</span>
                <span class="text-label-caps">Verifikasi Pembayaran</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">group</span>
                <span class="text-label-caps">User</span>
            </a>
            <a href="{{ route('admin.ulasan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.ulasan.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">rate_review</span>
                <span class="text-label-caps">Ulasan</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.laporan.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">assessment</span>
                <span class="text-label-caps">Laporan</span>
            </a>
            <a href="{{ route('admin.mitra.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.mitra.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">handshake</span>
                <span class="text-label-caps">Mitra</span>
            </a>
            <a href="{{ route('admin.pengaturan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pengaturan.*') ? 'bg-on-secondary-fixed-variant text-surface-container-lowest border-l-4 border-primary-fixed' : 'text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright' }}">
                <span class="material-symbols-outlined">settings</span>
                <span class="text-label-caps">Pengaturan</span>
            </a>
        </div>
    </nav>

    <div class="p-6 mt-auto border-t border-on-secondary-fixed-variant space-y-1">
        <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-secondary-fixed-dim hover:bg-on-secondary-fixed-variant hover:text-surface-bright transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
            <span class="text-label-caps">Kembali ke Website</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-secondary-fixed-dim hover:text-error hover:bg-on-secondary-fixed-variant transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-label-caps">Logout</span>
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="min-h-screen flex flex-col lg:ml-[280px]">
    {{-- TOP BAR --}}
    <header class="flex justify-between items-center h-16 px-4 md:px-8 sticky top-0 z-20 bg-surface-bright border-b border-outline-variant">
        <div class="flex items-center gap-4">
            <button class="lg:hidden text-on-surface-variant hover:text-primary transition-colors" onclick="toggleSidebar()">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="relative w-full max-w-md hidden sm:block">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input class="w-full bg-surface-container border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary-container transition-all outline-none" placeholder="Cari data, laporan, atau user..." type="text">
            </div>
        </div>
        <div class="flex items-center gap-4 md:gap-6">
            @auth
            <div class="flex items-center gap-3" x-data="{ open: false }">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-semibold text-on-background leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-on-surface-variant">{{ auth()->user()->isAdmin() ? 'Administrator' : 'User' }}</p>
                </div>
                <div class="relative">
                    <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-fixed bg-surface-container-high hover:opacity-90 transition-opacity">
                        @if(auth()->user()->foto)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/'.auth()->user()->foto) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary text-on-primary font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-surface-container-lowest rounded-xl shadow-lg border border-outline-variant z-50 overflow-hidden">
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-primary text-[18px]">person</span> Akun Saya
                        </a>
                        <hr class="border-outline-variant">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-3 text-sm text-error hover:bg-error-container/20 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </header>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
    <div class="mx-4 md:mx-8 mt-4">
        <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mx-4 md:mx-8 mt-4">
        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined text-red-600" style="font-variation-settings: 'FILL' 1;">error</span>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- PAGE CONTENT --}}
    <div class="flex-1 p-4 md:p-8">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="py-6 px-4 md:px-8 border-t border-outline-variant text-center">
        <p class="text-xs text-on-surface-variant">&copy; {{ date('Y') }} Bandar Lampung Tourism Admin. All rights reserved.</p>
    </footer>
</main>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('sidebar-backdrop').classList.toggle('hidden');
    }
</script>
@stack('scripts')
</body>
</html>
