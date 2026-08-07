<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wisata &amp; Rental Mobil Bandar Lampung')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1f4d3d',
                        'primary-container': '#14382d',
                        secondary: '#b7793d',
                        'secondary-fixed': '#f5dfbe',
                        'secondary-fixed-dim': '#e5bf83',
                        background: '#f7f6f1',
                        surface: '#f7f6f1',
                        'surface-dim': '#deded7',
                        'surface-bright': '#f7f6f1',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#efeee8',
                        'surface-container': '#e8e7df',
                        'surface-container-high': '#e1e0d7',
                        'surface-container-highest': '#d9d8cf',
                        'on-surface': '#1e2924',
                        'on-surface-variant': '#59635d',
                        'outline': '#7a837d',
                        'outline-variant': '#d1d2c9',
                        'on-tertiary-fixed': '#18261f',
                        'surface-variant': '#dfded6',
                        'primary-fixed': '#dbeadf',
                        'primary-fixed-dim': '#b9d2c4',
                        'on-primary-fixed': '#123126',
                        'on-primary-fixed-variant': '#1f4d3d',
                        'secondary-container': '#f7e2c3',
                        'on-secondary-container': '#6b3f14',
                        'on-secondary-fixed': '#4a2c10',
                        'on-secondary-fixed-variant': '#5c3a18',
                        'tertiary': '#2e6b54',
                        'on-tertiary': '#ffffff',
                        'tertiary-container': '#cfe9dd',
                        'on-tertiary-container': '#16382c',
                        'error': '#ba1a1a',
                        'on-error': '#ffffff',
                        'error-container': '#ffdad6',
                        'on-error-container': '#93000a',
                    },
                    borderRadius: {
                        '2xl': '0.875rem',
                        '3xl': '1rem',
                        '4xl': '1.25rem',
                    },
                    fontFamily: {
                        'display-lg': ['Fraunces', 'serif'],
                        'headline-md': ['Fraunces', 'serif'],
                        'body-lg': ['DM Sans', 'sans-serif'],
                        'body-md': ['DM Sans', 'sans-serif'],
                        'label-sm': ['DM Sans', 'sans-serif'],
                    },
                    fontSize: {
                        'display-lg': ['32px', { lineHeight: '40px', letterSpacing: '-0.02em', fontWeight: '700' }],
                        'headline-md': ['24px', { lineHeight: '32px', fontWeight: '600' }],
                        'title-sm': ['18px', { lineHeight: '24px', fontWeight: '600' }],
                        'body-lg': ['18px', { lineHeight: '28px', fontWeight: '400' }],
                        'body-md': ['14px', { lineHeight: '20px', fontWeight: '400' }],
                        'label-sm': ['12px', { lineHeight: '16px', fontWeight: '500' }],
                        'label-caps': ['12px', { lineHeight: '16px', letterSpacing: '0.05em', fontWeight: '700' }],
                    },
                    maxWidth: {
                        'container-max': '1280px',
                    },
                    spacing: {
                        'gutter': '24px',
                        'margin-desktop': '40px',
                        'margin-mobile': '16px',
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        html { scroll-behavior: smooth; }
        .glass-nav {
            background: rgba(247, 246, 241, 0.94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(31, 77, 61, 0.10);
        }
        .hero-gradient {
            background: linear-gradient(90deg, rgba(18, 38, 30, 0.82) 0%, rgba(18, 38, 30, 0.42) 48%, rgba(18, 38, 30, 0.08) 100%);
        }
        .rounded-4xl { border-radius: 1.25rem !important; }
        .rounded-3xl { border-radius: 1rem !important; }
        .rounded-\[24px\] { border-radius: 1rem !important; }
        .shadow-xl, .shadow-2xl { box-shadow: 0 18px 42px rgba(30, 41, 36, 0.12) !important; }
        input, select, textarea { box-shadow: none !important; }
    </style>
</head>
<body class="bg-background font-body-md text-on-surface selection:bg-primary selection:text-white">

    {{-- NAVBAR --}}
    <header class="fixed top-0 w-full z-50 glass-nav" x-data="{ mobileOpen: false }">
        <nav class="flex items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">explore</span>
                <a href="{{ url('/') }}" class="font-display-lg text-xl font-bold text-primary">Afia Jaya Abadi</a>
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
                {{-- Mobile menu toggle --}}
                <button class="md:hidden text-on-surface-variant hover:text-primary transition-colors" @click="mobileOpen = !mobileOpen">
                    <span class="material-symbols-outlined text-2xl" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
                </button>
            </div>
            </div>
        </nav>
        {{-- Mobile menu --}}
        <div class="md:hidden border-t border-outline-variant bg-surface-container-lowest" x-show="mobileOpen" @click.away="mobileOpen = false" x-cloak>
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

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-40 w-full max-w-md px-margin-mobile">
            <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-2xl shadow-lg flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="font-body-md">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-40 w-full max-w-md px-margin-mobile">
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-lg flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600" style="font-variation-settings: 'FILL' 1;">error</span>
                <span class="font-body-md">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Main content --}}
    @yield('content')

    @hasSection('footer')
        @yield('footer')
    @else
    <footer class="w-full py-20 bg-on-tertiary-fixed">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">explore</span>
                    <h3 class="font-display-lg text-xl font-bold text-white">Cv.Afia Jaya Abadi</h3>
                </div>
                <p class="text-surface-container-low font-body-md opacity-80 leading-relaxed">Perjalanan menjadi lebih mudah bersama layanan travel 
                    profesional di Bandar Lampung. Armada bersih dan nyaman, pengemudi berpengalaman, serta pelayanan yang mengutamakan keamanan dan kepuasan pelanggan.</p>
                <div class="flex gap-3 pt-2">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-primary transition-colors">
                        <span class="material-symbols-outlined">public</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-primary transition-colors">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 font-display-lg">Quick Links</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Home</a></li>
                    <li><a href="{{ route('destinasi.index') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Destinasi</a></li>
                    <li><a href="{{ route('mobil.index') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Mobil</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 font-display-lg">Layanan</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('pemesanan.create') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Pesan Travel</a></li>
                    <li><a href="{{ route('pemesanan.riwayat') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Riwayat Pemesanan</a></li>
                    <li><a href="{{ route('dashboard') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Dashboard</a></li>
                    <li><a href="{{ route('login') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md flex items-center gap-2"><span class="material-symbols-outlined text-sm text-secondary-fixed">chevron_right</span>Login / Register</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 font-display-lg">Hubungi Kami</h4>
                @php $settings = \App\Models\Setting::all()->keyBy('key'); @endphp
                <ul class="space-y-4 text-surface-container-low">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed mt-0.5">phone</span>
                        <span class="font-body-md">{{ $settings['no_telp']->value ?? '+62 812-3456-7890' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed mt-0.5">chat</span>
                        <span class="font-body-md">{{ $settings['no_whatsapp']->value ?? '+62 821-1234-5678' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed mt-0.5">mail</span>
                        <span class="font-body-md">{{ $settings['email']->value ?? 'info@travelku.com' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed mt-0.5">location_on</span>
                        <span class="font-body-md">{{ $settings['alamat']->value ?? 'Bandar Lampung, Lampung' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-16 pt-8 border-t border-white/10 text-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <p class="text-surface-container-low font-body-md">&copy; {{ date('Y') }} TravelKu. All rights reserved.</p>
        </div>
    </footer>
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
