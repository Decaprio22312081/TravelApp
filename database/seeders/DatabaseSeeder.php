<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Destinasi;
use App\Models\Mitra;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin TravelKu',
            'email' => 'admin@travelku.com',
            'password' => bcrypt('admin123'),
            'no_hp' => '081234567890',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Demo',
            'email' => 'user@travelku.com',
            'password' => bcrypt('user123'),
            'no_hp' => '085678901234',
            'alamat' => 'Jl. Raden Intan No. 10, Bandar Lampung',
            'role' => 'user',
        ]);

        Destinasi::create([
            'nama' => 'Pantai Tanjung Setia',
            'deskripsi' => 'Pantai eksotis dengan pemandangan indah dan ombak yang cocok untuk berselancar. Terletak di pesisir barat Lampung.',
            'kategori' => 'Pantai',
            'foto' => null,
            'latitude' => '-5.4958',
            'longitude' => '104.5264',
        ]);

        Destinasi::create([
            'nama' => 'Tanggamus',
            'deskripsi' => 'Gunung Tanggamus menawarkan pemandangan alam yang menakjubkan dengan trek pendakian yang menantang.',
            'kategori' => 'Alam',
            'foto' => null,
            'latitude' => '-5.4312',
            'longitude' => '104.6745',
        ]);

        Destinasi::create([
            'nama' => 'Pulau Pahawang',
            'deskripsi' => 'Pulau dengan keindahan bawah laut yang memukau, cocok untuk snorkeling dan diving.',
            'kategori' => 'Pantai',
            'foto' => null,
            'latitude' => '-5.6712',
            'longitude' => '105.2341',
        ]);

        Destinasi::create([
            'nama' => 'Lampung Walk',
            'deskripsi' => 'Kawasan kuliner dan hiburan modern di pusat Kota Bandar Lampung dengan berbagai pilihan makanan.',
            'kategori' => 'Kuliner',
            'foto' => null,
            'latitude' => '-5.4211',
            'longitude' => '105.2673',
        ]);

        Mobil::create([
            'nama' => 'Toyota Avanza',
            'merk' => 'Toyota',
            'tipe' => 'MPV',
            'plat_nomor' => 'BE 1234 AB',
            'kapasitas' => 7,
            'harga_per_hari' => 350000,
            'foto' => null,
            'fasilitas' => 'AC, Audio, USB Charger, Bagasi luas',
            'nama_supir' => 'Supriyadi',
            'no_hp_supir' => '081122334455',
            'status' => 'tersedia',
        ]);

        Mobil::create([
            'nama' => 'Daihatsu Xenia',
            'merk' => 'Daihatsu',
            'tipe' => 'MPV',
            'plat_nomor' => 'BE 5678 CD',
            'kapasitas' => 7,
            'harga_per_hari' => 300000,
            'foto' => null,
            'fasilitas' => 'AC, Audio, USB Charger',
            'nama_supir' => 'Ahmad',
            'no_hp_supir' => '081122336655',
            'status' => 'tersedia',
        ]);

        Mobil::create([
            'nama' => 'Honda Brio',
            'merk' => 'Honda',
            'tipe' => 'Hatchback',
            'plat_nomor' => 'BE 9012 EF',
            'kapasitas' => 5,
            'harga_per_hari' => 250000,
            'foto' => null,
            'fasilitas' => 'AC, Audio, Hemat BBM',
            'nama_supir' => 'Bambang',
            'no_hp_supir' => '081122337755',
            'status' => 'tersedia',
        ]);

        Mobil::create([
            'nama' => 'Toyota Innova',
            'merk' => 'Toyota',
            'tipe' => 'MVP Premium',
            'plat_nomor' => 'BE 3456 GH',
            'kapasitas' => 8,
            'harga_per_hari' => 500000,
            'foto' => null,
            'fasilitas' => 'AC Dual Blower, Audio Premium, USB Charger, Bagasi besar, Kursi nyaman',
            'nama_supir' => 'Slamet',
            'no_hp_supir' => '081122338855',
            'status' => 'tersedia',
        ]);

        Mitra::create([
            'nama' => 'Hotel Grand Mercure Lampung',
            'alamat' => 'Jl. Raden Intan No. 88, Bandar Lampung',
            'latitude' => '-5.4256',
            'longitude' => '105.2612',
            'no_telp' => '0721-123456',
            'deskripsi' => 'Hotel bintang 4 dengan fasilitas lengkap di pusat kota Bandar Lampung. Tersedia kolam renang, restoran, dan ruang pertemuan.',
            'is_aktif' => true,
        ]);

        Mitra::create([
            'nama' => 'Wisata Bahari Teluk Lampung',
            'alamat' => 'Dermaga Panjang, Bandar Lampung',
            'latitude' => '-5.4589',
            'longitude' => '105.3128',
            'no_telp' => '0721-789012',
            'deskripsi' => 'Penyedia layanan wisata bahari dan snorkeling di perairan Teluk Lampung dengan pemandu berpengalaman.',
            'is_aktif' => true,
        ]);

        Mitra::create([
            'nama' => 'RM Padang Suci',
            'alamat' => 'Jl. Diponegoro No. 45, Bandar Lampung',
            'latitude' => '-5.4187',
            'longitude' => '105.2715',
            'no_telp' => '0721-345678',
            'deskripsi' => 'Restoran Padang legendaris dengan cita rasa autentik. Menyediakan berbagai menu khas Minangkabau.',
            'is_aktif' => true,
        ]);

        Mitra::create([
            'nama' => 'Taman Wisata Lembah Hijau',
            'alamat' => 'Jl. Raya Pringsewu KM 12, Bandar Lampung',
            'latitude' => '-5.3891',
            'longitude' => '105.1986',
            'no_telp' => '0721-901234',
            'deskripsi' => 'Taman wisata alam dengan area camping, tracking, dan flying fox. Cocok untuk liburan keluarga dan outbound.',
            'is_aktif' => true,
        ]);

        Mitra::create([
            'nama' => 'Mall Boemi Kedaton',
            'alamat' => 'Jl. Soekarno Hatta No. 1, Bandar Lampung',
            'latitude' => '-5.3997',
            'longitude' => '105.2778',
            'no_telp' => '0721-567890',
            'deskripsi' => 'Pusat perbelanjaan terbesar di Bandar Lampung dengan berbagai tenant, bioskop, dan area bermain anak.',
            'is_aktif' => true,
        ]);

        BankAccount::create([
            'nama_bank' => 'Bank Mandiri',
            'nomor_rekening' => '1234567890',
            'atas_nama' => 'TravelKu Indonesia',
            'is_aktif' => true,
        ]);

        BankAccount::create([
            'nama_bank' => 'Bank BCA',
            'nomor_rekening' => '0987654321',
            'atas_nama' => 'TravelKu Indonesia',
            'is_aktif' => true,
        ]);

        BankAccount::create([
            'nama_bank' => 'Bank BRI',
            'nomor_rekening' => '5556667777',
            'atas_nama' => 'TravelKu Indonesia',
            'is_aktif' => true,
        ]);

        Setting::create(['key' => 'no_whatsapp', 'value' => '6282112345678']);
        Setting::create(['key' => 'no_telp', 'value' => '0853 7915 3783']);
        Setting::create(['key' => 'email', 'value' => 'info@travelku.com']);
        Setting::create(['key' => 'alamat', 'value' => 'Jl. Lintas Sumatera No.162, Bumisari, Kec. Natar, Kabupaten Lampung Selatan']);
        Setting::create(['key' => 'facebook', 'value' => 'travelkulanteng']);
        Setting::create(['key' => 'instagram', 'value' => '@travelku_lampung']);
        Setting::create(['key' => 'tentang_kami', 'value' => 'TravelKu adalah layanan travel dan rental mobil dengan supir profesional yang telah melayani masyarakat Bandar Lampung dan sekitarnya sejak 2020. Kami berkomitmen memberikan pengalaman perjalanan yang nyaman, aman, dan terjangkau.\n\nDengan armada mobil yang terawat dan supir yang berpengalaman serta menguasai rute di seluruh provinsi Lampung, TravelKu menjadi pilihan tepat untuk perjalanan wisata, dinas, atau antar jemput.\n\nVisi kami menjadi layanan travel terdepan di Lampung yang mengutamakan kepuasan dan kenyamanan pelanggan. Misi kami menyediakan transportasi berkualitas dengan harga bersahabat, didukung oleh sumber daya profesional dan armada yang selalu prima.']);

        $paketData = [
            [
                'destinasi' => 'Pantai Tanjung Setia',
                'nama' => 'Paket Pesona Tanjung Setia',
                'deskripsi' => 'Nikmati keindahan pantai eksotis dengan ombak kelas dunia. Cocok untuk liburan keluarga maupun pecinta selancar.',
                'durasi_hari' => 2,
                'harga' => 1500000,
                'fasilitas' => "Transportasi mobil + supir\nTour guide lokal\nTiket masuk wisata\nPenginapan 1 malam\nSarapan pagi\nDokumentasi foto",
                'itinerary' => "Hari 1: Penjemputan di titik jemput\nHari 1: Tiba di Pantai Tanjung Setia, check-in penginapan\nHari 2: Sunrise & bebas berenang/selancar\nHari 2: Kembali ke Bandar Lampung",
            ],
            [
                'destinasi' => 'Pantai Tanjung Setia',
                'nama' => 'Paket Eksplorasi Pantai Barat',
                'deskripsi' => 'Jelajahi dua pantai terindah di pesisir barat Lampung dalam satu perjalanan seru.',
                'durasi_hari' => 3,
                'harga' => 2200000,
                'fasilitas' => "Transportasi mobil + supir\nTour guide berpengalaman\nTiket masuk wisata\nPenginapan 2 malam\nMakan 3x sehari\nAsuransi perjalanan",
                'itinerary' => "Hari 1: Penjemputan & perjalanan ke pantai barat\nHari 2: Pantai Tanjung Setia & area sekitar\nHari 3: Free time pagi, kembali ke Bandar Lampung",
            ],
            [
                'destinasi' => 'Tanggamus',
                'nama' => 'Paket Gunung Tanggamus',
                'deskripsi' => 'Trekking ke Gunung Tanggamus dengan pemandangan alam yang memukau dan udara segar pegunungan.',
                'durasi_hari' => 2,
                'harga' => 1200000,
                'fasilitas' => "Transportasi mobil + supir\nPorter lokal\nTiket masuk kawasan\nTenda & perlengkapan camping\nMakan selama perjalanan",
                'itinerary' => "Hari 1: Perjalanan ke basecamp Tanggamus\nHari 1: Setup camp & api unggun\nHari 2: Trekking pagi, kembali ke Bandar Lampung",
            ],
            [
                'destinasi' => 'Pulau Pahawang',
                'nama' => 'Paket Snorkeling Pahawang',
                'deskripsi' => 'Snorkeling dan diving di keindahan bawah laut Pulau Pahawang yang memukau.',
                'durasi_hari' => 2,
                'harga' => 1750000,
                'fasilitas' => "Transportasi mobil + supir\nPerahu menuju pulau\nPeralatan snorkeling\nTour guide lokal\nMakan laut segar\nPenginapan homestay",
                'itinerary' => "Hari 1: Menuju dermaga & naik perahu ke Pahawang\nHari 1: Snorkeling sore di spot indah\nHari 2: Snorkeling pagi & kembali ke Bandar Lampung",
            ],
            [
                'destinasi' => 'Lampung Walk',
                'nama' => 'Paket Kuliner Kota',
                'deskripsi' => 'Wisata kuliner menyusuri pusat Kota Bandar Lampung dengan berbagai pilihan makanan khas.',
                'durasi_hari' => 1,
                'harga' => 450000,
                'fasilitas' => "Transportasi mobil + supir\nTour guide kuliner\nFood tasting 5 spot\nMinuman lokal\nDokumentasi foto",
                'itinerary' => "Hari 1: Mulai dari Lampung Walk\nHari 1: Jelajah kuliner Pahoman & sekitarnya\nHari 1: Antarkata jemput kembali",
            ],
        ];

        foreach ($paketData as $p) {
            $destinasi = Destinasi::where('nama', $p['destinasi'])->first();

            if ($destinasi) {
                Paket::create([
                    'destinasi_id' => $destinasi->id,
                    'nama' => $p['nama'],
                    'deskripsi' => $p['deskripsi'],
                    'durasi_hari' => $p['durasi_hari'],
                    'harga' => $p['harga'],
                    'fasilitas' => $p['fasilitas'],
                    'itinerary' => $p['itinerary'],
                    'is_aktif' => true,
                ]);
            }
        }
    }
}
