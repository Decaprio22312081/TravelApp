@extends('layouts.app')

@section('title', 'Tentang Kami - Cv. Afia Jaya Abadi')

@section('content')
{{-- HERO --}}
<section class="relative h-[500px] md:h-[600px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/hero-pantai-mobil.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#131d24]/80 to-transparent"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full">
        <div class="max-w-2xl">
            <h1 class="font-display-lg text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-white mb-6">
                Tentang Cv. Afia Jaya Abadi
            </h1>
            <p class="font-body-lg text-lg md:text-xl text-white/90 mb-8 leading-relaxed max-w-xl">
                Berkomitmen memberikan pengalaman perjalanan tak terlupakan melalui layanan travel mobil premium yang handal, aman, dan profesional di seluruh wilayah Lampung.
            </p>
            <div class="flex gap-4">
                <a href="#layanan" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-container hover:scale-105 transition-all shadow-lg inline-block">
                    Pelajari Layanan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- VISI & MISI --}}
<section id="layanan" class="py-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <div class="bg-surface-container-lowest p-10 rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-surface-container hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)] transition-all">
            <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary">
                <span class="material-symbols-outlined text-4xl">visibility</span>
            </div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">Visi Kami</h2>
            <p class="text-on-surface-variant leading-relaxed">
                Menjadi penyedia jasa transportasi dan solusi perjalanan terdepan di Lampung yang diakui karena kualitas armada, integritas layanan, dan kontribusi positif terhadap pariwisata daerah.
            </p>
        </div>
        <div class="bg-primary p-10 rounded-[24px] shadow-lg text-white hover:-translate-y-1 transition-all">
            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-4xl">track_changes</span>
            </div>
            <h2 class="font-headline-md text-headline-md mb-4">Misi Kami</h2>
            <ul class="space-y-4 text-white/90">
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                    <span>Menyediakan armada terbaru dengan standar perawatan mekanis tertinggi.</span>
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                    <span>Menjamin keamanan dan kenyamanan pelanggan melalui supir profesional.</span>
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                    <span>Memberikan nilai terbaik dengan harga kompetitif dan transparansi biaya.</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- MENGAPA MEMILIH KAMI --}}
<section class="py-20 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
        <h2 class="font-headline-md text-headline-md text-primary mb-12">Mengapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-md transition-all group">
                <div class="mb-6 inline-block p-4 rounded-full bg-surface-container text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-4xl">directions_car</span>
                </div>
                <h3 class="font-bold text-xl mb-3">Mobil Terawat</h3>
                <p class="text-on-surface-variant">Armada kami selalu dalam kondisi prima melalui servis rutin berkala untuk menjamin keamanan perjalanan Anda.</p>
            </div>
            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-md transition-all group">
                <div class="mb-6 inline-block p-4 rounded-full bg-surface-container text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-4xl">person_pin</span>
                </div>
                <h3 class="font-bold text-xl mb-3">Supir Berpengalaman</h3>
                <p class="text-on-surface-variant">Tim supir kami sangat mengenal medan Lampung dan terlatih secara profesional dalam melayani pelanggan.</p>
            </div>
            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-md transition-all group">
                <div class="mb-6 inline-block p-4 rounded-full bg-surface-container text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-4xl">sell</span>
                </div>
                <h3 class="font-bold text-xl mb-3">Harga Terjangkau</h3>
                <p class="text-on-surface-variant">Tarif kompetitif dengan berbagai pilihan paket sewa yang fleksibel sesuai dengan kebutuhan anggaran Anda.</p>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="py-16 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 text-center">
            <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">map</span>
            </div>
            <p class="text-3xl font-bold text-on-surface">{{ $destinasis->count() }}</p>
            <p class="text-on-surface-variant text-sm">Destinasi Wisata</p>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 text-center">
            <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">directions_car</span>
            </div>
            <p class="text-3xl font-bold text-on-surface">{{ \App\Models\Mobil::count() }}</p>
            <p class="text-on-surface-variant text-sm">Armada Mobil</p>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 text-center">
            <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">handshake</span>
            </div>
            <p class="text-3xl font-bold text-on-surface">{{ $mitras->count() }}</p>
            <p class="text-on-surface-variant text-sm">Mitra Kami</p>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 text-center">
            <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">sentiment_satisfied</span>
            </div>
            <p class="text-3xl font-bold text-on-surface">{{ \App\Models\Ulasan::count() }}</p>
            <p class="text-on-surface-variant text-sm">Testimoni</p>
        </div>
    </div>
</section>

{{-- TIM KAMI --}}
<section class="py-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
    <h2 class="font-headline-md text-headline-md text-primary mb-4">Tim Profesional Kami</h2>
    <p class="text-on-surface-variant mb-12 max-w-2xl mx-auto">Dibalik kenyamanan perjalanan Anda, ada tim berdedikasi yang bekerja sepenuh hati.</p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
        <div class="group">
            <div class="relative overflow-hidden rounded-[24px] mb-4 aspect-square bg-surface-container">
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/40">person</span>
                </div>
            </div>
            <h4 class="font-bold text-lg text-primary">Andi Saputra</h4>
            <p class="text-label-sm text-on-surface-variant">Founder & CEO</p>
        </div>
        <div class="group">
            <div class="relative overflow-hidden rounded-[24px] mb-4 aspect-square bg-surface-container">
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/40">person</span>
                </div>
            </div>
            <h4 class="font-bold text-lg text-primary">Sari Wijaya</h4>
            <p class="text-label-sm text-on-surface-variant">Operations Manager</p>
        </div>
        <div class="group">
            <div class="relative overflow-hidden rounded-[24px] mb-4 aspect-square bg-surface-container">
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/40">person</span>
                </div>
            </div>
            <h4 class="font-bold text-lg text-primary">Budi Santoso</h4>
            <p class="text-label-sm text-on-surface-variant">Fleet Coordinator</p>
        </div>
        <div class="group">
            <div class="relative overflow-hidden rounded-[24px] mb-4 aspect-square bg-surface-container">
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/40">person</span>
                </div>
            </div>
            <h4 class="font-bold text-lg text-primary">Lina Marlina</h4>
            <p class="text-label-sm text-on-surface-variant">Customer Support</p>
        </div>
    </div>
</section>

{{-- MITRA --}}
@if($mitras->count() > 0)
<section class="py-20 bg-surface-container-low">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <h2 class="font-headline-md text-headline-md text-primary mb-4 text-center">Mitra Kami</h2>
        <p class="text-on-surface-variant mb-12 text-center max-w-xl mx-auto">Mitra yang bekerja sama dengan TravelKu untuk memberikan pelayanan terbaik.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter mb-12">
            @foreach($mitras as $m)
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all group">
                @if($m->foto)
                <img src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-44 bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-5xl">store</span>
                </div>
                @endif
                <div class="p-5">
                    <h3 class="font-bold text-on-surface text-lg">{{ $m->nama }}</h3>
                    <p class="text-on-surface-variant text-sm mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>{{ $m->alamat }}
                    </p>
                    @if($m->no_telp)
                    <p class="text-on-surface-variant text-sm mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">call</span>{{ $m->no_telp }}
                    </p>
                    @endif
                    @if($m->deskripsi)
                    <p class="text-on-surface-variant text-sm mt-3">{{ Str::limit($m->deskripsi, 100) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- LOKASI KAMI --}}
<section class="py-20 bg-surface-container-lowest">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">
            <div class="lg:col-span-2">
                <h2 class="font-headline-md text-headline-md text-primary mb-6">Kunjungi Kantor Kami</h2>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                        <div>
                            <h5 class="font-bold mb-1">Alamat Utama</h5>
                            <p class="text-on-surface-variant">{{ $settings['alamat']->value ?? 'Jl. Raden Intan No. 123, Tanjung Karang Pusat, Bandar Lampung, Lampung 35111' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">call</span>
                        <div>
                            <h5 class="font-bold mb-1">Telepon & WhatsApp</h5>
                            <p class="text-on-surface-variant">0853 7915 3783<br>{{ $settings['email']->value ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1">schedule</span>
                        <div>
                            <h5 class="font-bold mb-1">Jam Operasional</h5>
                            <p class="text-on-surface-variant">Senin - Minggu: 08.00 - 22.00 WIB</p>
                        </div>
                    </div>
                    @if($settings['alamat']->value ?? false)
                    <a class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-all shadow-md mt-4" href="https://maps.app.goo.gl/DLiSUxbAr7BZRtTF8" target="_blank" rel="noopener noreferrer">
                        <span class="material-symbols-outlined">near_me</span>
                        Petunjuk Arah
                    </a>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-3 h-[400px] bg-surface-container rounded-[24px] overflow-hidden shadow-inner relative">
                <div id="map" class="w-full h-full"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
    .office-location-marker {
        background: transparent;
        border: 0;
    }

    .office-location-marker .material-symbols-outlined {
        color: #dc2626;
        font-size: 42px;
        line-height: 42px;
        filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.35));
        font-variation-settings: 'FILL' 1;
    }

    .office-location-label {
        color: #991b1b;
        background: #ffffff;
        border: 1px solid #fecaca;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        padding: 4px 8px;
        white-space: nowrap;
    }

    .partner-location-label {
        color: #1d4ed8;
        background: #ffffff;
        border: 1px solid #bfdbfe;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        padding: 4px 8px;
        white-space: nowrap;
    }
</style>
<script>
    // Scroll animations
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, observerOptions);
    document.querySelectorAll('section').forEach(section => {
        section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
        observer.observe(section);
    });

    // Map
    document.addEventListener('DOMContentLoaded', function () {
        const mapEl = document.getElementById('map');
        if (!mapEl) return;

        const mitras = @json($mitras);
        const office = {
            latitude: -5.290991947525421,
            longitude: 105.1909975633846,
            name: 'CV. Afia Jaya Abadi Rental Mobil Lampung'
        };
        const bounds = [[office.latitude, office.longitude]];
        const map = L.map('map').setView([office.latitude, office.longitude], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const officeIcon = L.divIcon({
            className: 'office-location-marker',
            html: '<span class="material-symbols-outlined">location_on</span>',
            iconSize: [42, 42],
            iconAnchor: [21, 42],
            popupAnchor: [0, -42]
        });

        L.marker([office.latitude, office.longitude], { icon: officeIcon })
            .addTo(map)
            .bindPopup(`<b>${office.name}</b>`)
            .bindTooltip(office.name, {
                permanent: true,
                direction: 'top',
                offset: [0, -42],
                className: 'office-location-label'
            });

        mitras.forEach(function (m) {
            const lat = parseFloat(m.latitude);
            const lng = parseFloat(m.longitude);
            if (isNaN(lat) || isNaN(lng)) return;
            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`<b>${m.nama}</b><br>${m.alamat}${m.no_telp ? '<br>Telp: ' + m.no_telp : ''}`);
            marker.bindTooltip(m.nama, {
                permanent: true,
                direction: 'top',
                offset: [0, -36],
                className: 'partner-location-label'
            });
            bounds.push([lat, lng]);
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    });
</script>
@endpush
