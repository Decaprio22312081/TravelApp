<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wisata Bandar Lampung - Premium Car Rental')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0056b3',
                        'primary-container': '#003d80',
                        secondary: '#325ea2',
                        'secondary-fixed': '#d7e2ff',
                        'secondary-fixed-dim': '#abc7ff',
                        background: '#f8f9fa',
                        surface: '#f8f9fa',
                        'surface-dim': '#d9dadb',
                        'surface-bright': '#f8f9fa',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f3f4f5',
                        'surface-container': '#edeeef',
                        'surface-container-high': '#e7e8e9',
                        'surface-container-highest': '#e1e3e4',
                        'on-surface': '#191c1d',
                        'on-surface-variant': '#424752',
                        'outline': '#727784',
                        'outline-variant': '#c2c6d4',
                        'on-tertiary-fixed': '#131d24',
                    },
                    borderRadius: {
                        '2xl': '0.75rem',
                        '3xl': '1rem',
                        '4xl': '1.5rem',
                    },
                    fontFamily: {
                        'display-lg': ['Montserrat', 'sans-serif'],
                        'headline-md': ['Montserrat', 'sans-serif'],
                        'body-lg': ['Inter', 'sans-serif'],
                        'body-md': ['Inter', 'sans-serif'],
                        'label-sm': ['Inter', 'sans-serif'],
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
        .glass-nav {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.15) 50%, rgba(248, 249, 250, 1) 100%);
        }
    </style>
</head>
<body class="bg-background font-body-md text-on-surface selection:bg-primary selection:text-white">

    {{-- NAVBAR --}}
    <header class="fixed top-0 w-full z-50 glass-nav shadow-sm">
        <nav class="flex items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">directions_car</span>
                <a href="{{ url('/') }}" class="font-display-lg text-xl font-bold text-primary">TravelKu</a>
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
                <button class="md:hidden text-on-surface-variant hover:text-primary transition-colors" @click="mobileOpen = !mobileOpen" x-data="{ mobileOpen: false }">
                    <span class="material-symbols-outlined text-2xl" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
                </button>
            </div>
            </div>
        </nav>
        {{-- Mobile menu --}}
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="space-y-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">directions_car</span>
                    <h3 class="font-display-lg text-xl font-bold text-white">TravelKu</h3>
                </div>
                <p class="text-surface-container-low font-body-md opacity-80 leading-relaxed">Solusi transportasi terbaik di Bandar Lampung untuk keperluan wisata, bisnis, dan keluarga dengan pelayanan premium.</p>
                <div class="flex gap-4">
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
                    <li><a href="{{ url('/') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Home</a></li>
                    <li><a href="{{ route('destinasi.index') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Destinasi</a></li>
                    <li><a href="{{ route('mobil.index') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Mobil</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 font-display-lg">Layanan</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('pemesanan.create') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Pesan Travel</a></li>
                    <li><a href="{{ route('pemesanan.riwayat') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Riwayat Pemesanan</a></li>
                    <li><a href="{{ route('dashboard') }}" class="text-surface-container-low hover:text-secondary-fixed transition-colors font-body-md">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 font-display-lg">Hubungi Kami</h4>
                <ul class="space-y-4 text-surface-container-low">
                    @php $settings = \App\Models\Setting::all()->keyBy('key'); @endphp
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed">phone</span>
                        <span>{{ $settings['no_telp']->value ?? '+62 812-3456-7890' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed">mail</span>
                        <span>{{ $settings['email']->value ?? 'info@travelku.com' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed">location_on</span>
                        <span>{{ $settings['alamat']->value ?? 'Bandar Lampung, Lampung' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-20 pt-8 border-t border-white/10 text-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <p class="text-surface-container-low opacity-60 font-body-md">&copy; {{ date('Y') }} TravelKu. Premium Car Rental Services.</p>
        </div>
    </footer>
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
