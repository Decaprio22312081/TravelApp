<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Destinasi;
use App\Models\Mitra;
use App\Models\Mobil;
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
        Setting::create(['key' => 'alamat', 'value' => 'Jl. Raden Intan No. 123, Bandar Lampung']);
        Setting::create(['key' => 'facebook', 'value' => 'travelkulanteng']);
        Setting::create(['key' => 'instagram', 'value' => '@travelku_lampung']);
        Setting::create(['key' => 'tentang_kami', 'value' => 'TravelKu adalah layanan travel dan rental mobil dengan supir profesional yang telah melayani masyarakat Bandar Lampung dan sekitarnya sejak 2020. Kami berkomitmen memberikan pengalaman perjalanan yang nyaman, aman, dan terjangkau.\n\nDengan armada mobil yang terawat dan supir yang berpengalaman serta menguasai rute di seluruh provinsi Lampung, TravelKu menjadi pilihan tepat untuk perjalanan wisata, dinas, atau antar jemput.\n\nVisi kami menjadi layanan travel terdepan di Lampung yang mengutamakan kepuasan dan kenyamanan pelanggan. Misi kami menyediakan transportasi berkualitas dengan harga bersahabat, didukung oleh sumber daya profesional dan armada yang selalu prima.']);
    }
}
