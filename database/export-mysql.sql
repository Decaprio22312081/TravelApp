-- Dump dibuat oleh db:push-to-mysql pada 2026-08-21 07:07:58
-- Sumber: SQLite lokal | Target: MySQL hosting

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

DELETE FROM `ulasan`;
INSERT INTO `ulasan` (`id`, `pemesanan_id`, `user_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
  (1, 1, 2, 5, 'bagus', '2026-08-07 12:49:14', '2026-08-07 12:49:14');

ALTER TABLE `ulasan` AUTO_INCREMENT = 1;

DELETE FROM `pembayaran`;
INSERT INTO `pembayaran` (`id`, `pemesanan_id`, `nama_pengirim`, `bank_pengirim`, `tanggal_transaksi`, `nominal_transfer`, `bukti_pembayaran`, `status`, `catatan_admin`, `created_at`, `updated_at`) VALUES
  (1, 1, 'User Demo', 'Bank Mandiri', '2026-08-07', 2450000, 'pembayaran/fgXJ5IoiJmiDD341lAmjGE0hkTrzQ2z7pzC4XYdt.png', 'terverifikasi', NULL, '2026-08-07 12:47:50', '2026-08-07 12:48:24'),
  (2, 3, 'User Demo', 'Bank Mandiri', '2026-08-08', 2200000, 'pembayaran/ZEN8tjk0zPFTGg6yZfWWlg5HhZtxIwGAm3dvHa5Q.jpg', 'terverifikasi', NULL, '2026-08-08 04:51:10', '2026-08-08 04:51:48'),
  (3, 5, 'User Demo', 'Bank Mandiri', '2026-08-13', 2200000, 'pembayaran/Rz38tfmhoMfhpczTXKpvioFnt20D8io2WODSVp0c.jpg', 'terverifikasi', NULL, '2026-08-12 14:13:25', '2026-08-12 14:15:05'),
  (4, 6, 'User Demo', 'Bank Mandiri', '2026-08-12', 2200000, 'pembayaran/telOPnIgoZowfKt8KZ9wskCPiQAarwEd4ZgxUYIW.jpg', 'terverifikasi', NULL, '2026-08-12 14:21:54', '2026-08-12 14:22:28');

ALTER TABLE `pembayaran` AUTO_INCREMENT = 1;

DELETE FROM `pemesanan`;
INSERT INTO `pemesanan` (`id`, `user_id`, `mobil_id`, `destinasi_id`, `alamat_jemput`, `alamat_tujuan`, `tanggal_mulai`, `jumlah_hari`, `total_harga`, `nama_penumpang`, `no_hp_penumpang`, `jumlah_penumpang`, `status`, `created_at`, `updated_at`, `paket_id`) VALUES
  (1, 2, 1, 3, 'DSN TANJUNG SARI IV', 'Pulau Pahawang', '2026-08-08 00:00:00', 2, 2450000, 'User Demo', '085678901234', 2, 'selesai', '2026-08-07 12:43:33', '2026-08-07 12:48:50', 4),
  (2, 2, 1, 1, 'DSN TANJUNG SARI IV', 'Pantai Tanjung Setia', '2026-08-08 00:00:00', 3, 3600000, 'User Demo', '085678901234', 1, 'batal', '2026-08-08 03:19:31', '2026-08-08 03:19:43', 1),
  (3, 2, 5, 5, 'DSN TANJUNG SARI IV', 'Lembah Hijau', '2026-08-09 00:00:00', 1, 2200000, 'User Demo', '085678901234', 10, 'selesai', '2026-08-08 04:39:32', '2026-08-08 04:52:32', 7),
  (4, 2, 5, 7, 'DSN TANJUNG SARI IV', 'Bukit Aslan', '2026-08-08 00:00:00', 2, 2200000, 'User Demo', '085678901234', 10, 'menunggu_pembayaran', '2026-08-08 07:53:01', '2026-08-08 07:53:01', 8),
  (5, 2, 5, 7, 'bumisari', 'Bukit Aslan', '2026-08-13 00:00:00', 2, 2200000, 'User Demo', '085678901234', 10, 'selesai', '2026-08-12 14:12:37', '2026-08-12 14:15:49', 8),
  (6, 2, 5, 7, 'bumi sari', 'Bukit Aslan', '2026-08-13 00:00:00', 2, 2200000, 'User Demo', '085678901234', 10, 'selesai', '2026-08-12 14:21:08', '2026-08-12 14:22:58', 8);

ALTER TABLE `pemesanan` AUTO_INCREMENT = 1;

DELETE FROM `paket`;
INSERT INTO `paket` (`id`, `destinasi_id`, `nama`, `deskripsi`, `durasi_hari`, `harga`, `fasilitas`, `itinerary`, `foto`, `is_aktif`, `created_at`, `updated_at`) VALUES
  (1, 1, 'Paket trip haice pantai mutun', 'Pantai dengan suasana laut yang menarik untuk liburan dan bersantai. Pantai Mutun juga dapat menjadi titik keberangkatan menuju Pulau Tangkil dan cocok dimasukkan ke dalam paket wisata bahari.', 1, 2000000, 'Transportasi mobil + supir\r\nTour guide \r\nTiket masuk wisata\r\nmakanan ringan \r\nSarapan pagi\r\nDokumentasi foto', 'Hari 1: Penjemputan di titik jemput\r\nHari 1: Tiba di Pantai Tanjung Setia, check-in penginapan\r\nHari 2: Sunrise & bebas berenang/selancar\r\nHari 2: Kembali ke Bandar Lampung', 'paket/48eZGZBanMThX4QITpnVZS797L3pvCGJeNeQIhR3.jpg', 1, '2026-08-07 12:31:43', '2026-08-08 05:04:11'),
  (3, 2, 'paket trip haice puncak mas', 'Destinasi wisata di kawasan perbukitan Bandar Lampung yang menawarkan pemandangan kota dan Teluk Lampung dari ketinggian. Tersedia berbagai spot foto, area bersantai, gazebo, serta fasilitas', 2, 2300000, 'Transportasi mobil + supir\r\ntour guide\r\nTiket masuk kawasan\r\nTenda & perlengkapan camping\r\nMakan selama perjalanan', 'Hari 1: Perjalanan ke basecamp Tanggamus\nHari 1: Setup camp & api unggun\nHari 2: Trekking pagi, kembali ke Bandar Lampung', 'paket/F1dhwLdk08WE3XspLmv1hXJ2Jcof3VjAp9Y6JKTc.jpg', 1, '2026-08-07 12:31:43', '2026-08-08 05:06:58'),
  (4, 3, 'paket trip haice pulau pahawang', 'Pulau Pahawang merupakan salah satu destinasi wisata bahari populer di Provinsi Lampung. Pulau ini memiliki air laut yang jernih, pemandangan alam yang indah, serta kawasan perairan yang cocok untuk snorkeling dan menikmati keindahan bawah laut. Wisatawan juga dapat menikmati suasana pantai yang tenang dan pemandangan pulau-pulau kecil di sekitarnya.', 3, 2500000, 'Transportasi mobil + supir\r\nPerahu menuju pulau\r\nPeralatan snorkeling\r\nTour guide \r\nMakan laut segar\r\nPenginapan homestay', 'Hari 1: Menuju dermaga & naik perahu ke Pahawang\nHari 1: Snorkeling sore di spot indah\nHari 2: Snorkeling pagi & kembali ke Bandar Lampung', 'paket/I6TMQRoOhLC0i3Dl07WMd1GzVO48UvjUUfWJsBrV.jpg', 1, '2026-08-07 12:31:43', '2026-08-08 05:10:11'),
  (5, 4, 'paket trip haice taman kupu-kupu', 'Kawasan wisata alam dan edukasi yang menjadi tempat untuk mengenal berbagai jenis kupu-kupu dan lingkungan alamnya. Suasananya hijau dan cocok untuk wisata keluarga, edukasi, serta fotografi.', 1, 1800000, 'Transportasi mobil + supir\r\nTour guide \r\nmakan berat\r\nmakan ringan\r\nDokumentasi foto', 'Hari 1: Mulai dari Lampung Walk\nHari 1: Jelajah kuliner Pahoman & sekitarnya\nHari 1: Antarkata jemput kembali', 'paket/tTQQ5zBSGu35e4E0RHkbSpag23GiHBnOv3UiZzrD.jpg', 1, '2026-08-07 12:31:43', '2026-08-08 05:23:03'),
  (6, 6, 'paket trip haice museum lampung', 'Museum yang dapat menjadi pilihan wisata edukasi untuk mengenal sejarah, budaya, dan berbagai peninggalan masyarakat Lampung.\r\nCocok untuk City Tour, Paket Edukasi, Paket Sejarah & Budaya', 1, 1800000, 'Transportasi mobil + supir\r\nTour guide \r\nTiket masuk wisata\r\nmakanan ringan\r\nSarapan pagi\r\nDokumentasi foto', NULL, 'paket/AhMZTUm6qqZkG3SbT8d4QPgy5BracclzEQsp6cMH.jpg', 1, '2026-08-08 03:16:55', '2026-08-08 05:04:25'),
  (7, 5, 'paket trip haice lembah hijau', 'Tempat wisata keluarga yang menyediakan berbagai aktivitas seperti taman satwa, waterboom, outbound, wahana permainan, camping ground, restoran, dan cottage.\r\nCocok untuk paket: Paket Keluarga, Paket Liburan Anak, Paket Full Day', 1, 2200000, 'Transportasi mobil + supir\r\nTour guide lokal\r\nTiket masuk wisata\r\nmakanan ringan\r\nmakan siang\r\nDokumentasi foto\r\n14 seats', NULL, 'paket/sVoXxBBh48TfIZO59q58fHscGTqvsGzTYJCvwA5h.jpg', 1, '2026-08-08 04:29:04', '2026-08-08 04:38:33'),
  (8, 7, 'paket trip haice bukit aslan', 'Bukit Aslan merupakan destinasi wisata alam di Bandar Lampung yang berada di kawasan perbukitan. Tempat ini menawarkan pemandangan Kota Bandar Lampung dari ketinggian dengan suasana yang asri. Bukit Aslan cocok untuk menikmati pemandangan, bersantai, berfoto, dan menikmati suasana sore atau matahari terbenam.', 2, 2200000, 'Transportasi mobil + supir\r\nTour guide \r\nTiket masuk wisata\r\nmakanan ringan\r\nmakan berat\r\ncamping dan alat gril\r\nDokumentasi foto\r\n14 seats', NULL, 'paket/DVhklPFlxegUDJtD0iII3wrFKuEB9so7sCzQXC6Y.jpg', 1, '2026-08-08 05:24:57', '2026-08-08 05:26:04');

ALTER TABLE `paket` AUTO_INCREMENT = 1;

DELETE FROM `mitra`;
INSERT INTO `mitra` (`id`, `nama`, `alamat`, `latitude`, `longitude`, `no_telp`, `deskripsi`, `foto`, `is_aktif`, `created_at`, `updated_at`) VALUES
  (1, 'Hotel Grand Mercure Lampung', 'Jl. Raden Intan No. 88, Bandar Lampung', '-5.4256', '105.2612', '0721-123456', 'Hotel bintang 4 dengan fasilitas lengkap di pusat kota Bandar Lampung. Tersedia kolam renang, restoran, dan ruang pertemuan.', 'mitra/3lXgpblB8n3xdiESrqv0aWQjAz4U9RQ82QJqjsK0.jpg', 1, '2026-08-07 12:31:41', '2026-08-08 05:18:34'),
  (2, 'Sambal Seruit Buk Lin', 'Jl. Ryacudu Jalur 2 Korpri, Bandar Lampung.', '-5.4134', '105.2555', '0721-789012', 'Sambal Seruit Buk Lin merupakan salah satu tempat kuliner yang cocok untuk menikmati makanan khas Lampung di Bandar Lampung. Menu andalannya berupa seruit dengan cita rasa khas yang memadukan ikan, sambal, dan berbagai pelengkap. Tempat ini cocok dikunjungi wisatawan yang ingin mencoba kuliner tradisional Lampung dalam suasana santai', 'mitra/IlCj5G76WdSknzU2IDd6ROQEnFdP7xjWiTNxYELA.jpg', 1, '2026-08-07 12:31:41', '2026-08-08 05:17:27'),
  (5, 'Mall Boemi Kedaton', 'Jl. Teuku Umar No. 1, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35132, Indonesia.', '-5.3808', '105.2506', '0721-567890', 'Pusat perbelanjaan terbesar di Bandar Lampung dengan berbagai tenant, bioskop, dan area bermain anak.', 'mitra/YlNeKjJhai02DyDzF53LzPhMv6yf3ItylBLuXAZh.jpg', 1, '2026-08-07 12:31:42', '2026-08-08 05:20:59');

ALTER TABLE `mitra` AUTO_INCREMENT = 1;

DELETE FROM `mobil`;
INSERT INTO `mobil` (`id`, `nama`, `merk`, `tipe`, `plat_nomor`, `kapasitas`, `harga_per_hari`, `foto`, `fasilitas`, `nama_supir`, `no_hp_supir`, `foto_supir`, `status`, `created_at`, `updated_at`) VALUES
  (1, 'Toyota Avanza', 'Toyota', 'MPV', 'BE 1234 AB', 6, 600000, 'mobil/VmiaQmCbeHTjjnvggpo02jQCWIP7NeT6R0ZJS56a.jpg', 'AC, Audio, USB Charger, Bagasi luas', 'Supriyadi', '081122334455', NULL, 'tersedia', '2026-08-07 12:31:41', '2026-08-08 02:35:54'),
  (2, 'Daihatsu Xenia', 'Daihatsu', 'MPV', 'BE 5678 CD', 6, 600000, 'mobil/4kMM507KRJu96t22w6GEi7Fzl86RVscHTMdFcccz.jpg', 'AC, Audio, USB Charger', 'Ahmad', '081122336655', NULL, 'tersedia', '2026-08-07 12:31:41', '2026-08-08 02:36:30'),
  (3, 'Toyota Alphard', 'Toyota', 'Hatchback', 'BE 9012 EF', 5, 4500000, 'mobil/NkYdARWHMe1xa55YPBLeAnR8yCHJQrpXZaziHlJE.png', 'AC, Audio, Hemat BBM', 'Bambang', '081122337755', NULL, 'tersedia', '2026-08-07 12:31:41', '2026-08-08 02:38:55'),
  (4, 'Toyota Innova', 'Toyota', 'MVP Premium', 'BE 3456 GH', 6, 850000, 'mobil/EBwJEIrzpOUOlowuKYdrv5QN5ByTF36bX8c3uovh.jpg', 'AC Dual Blower, Audio Premium, USB Charger, Bagasi besar, Kursi nyaman', 'Slamet', '081122338855', NULL, 'tersedia', '2026-08-07 12:31:41', '2026-08-08 02:39:56'),
  (5, 'Toyota Haice', 'Toyota', 'MPV', 'BE 9043 EF', 14, 1300000, 'mobil/2W016akO6ApD3ohB4NKKfruvdtfhHfWM2gh0Qsjq.jpg', 'ac,bagasi luas,karoke', 'sukanto', '0899288173', NULL, 'tersedia', '2026-08-08 02:42:08', '2026-08-08 02:42:08');

ALTER TABLE `mobil` AUTO_INCREMENT = 1;

DELETE FROM `destinasi`;
INSERT INTO `destinasi` (`id`, `nama`, `deskripsi`, `kategori`, `foto`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
  (1, 'Pantai Mutun', 'Pantai dengan suasana laut yang menarik untuk liburan dan bersantai. Pantai Mutun juga dapat menjadi titik keberangkatan menuju Pulau Tangkil dan cocok dimasukkan ke dalam paket wisata bahari.', 'Pantai', 'destinasi/Vn49PV4LlUrcDBU4LrEUDModfM3f5Cvu7xMXOpEl.jpg', '-5.5075', '105.2588', '2026-08-07 12:31:40', '2026-08-08 04:56:19'),
  (2, 'Puncak Mas', 'Puncak Mas merupakan destinasi wisata di Bandar Lampung yang menawarkan pemandangan kota dan kawasan Teluk Lampung dari ketinggian. Tempat ini memiliki berbagai area untuk bersantai dan menikmati suasana, sehingga cocok untuk wisatawan yang ingin menikmati pemandangan, berfoto, dan menghabiskan waktu bersama keluarga atau teman.', 'Alam', 'destinasi/vWk55XxNMqeDtP0LT2ZIICceGOYIRFSTbvdxTWW9.jpg', '-5.4298', '105.2298', '2026-08-07 12:31:40', '2026-08-08 03:03:03'),
  (3, 'Pulau Pahawang', 'Pulau Pahawang merupakan salah satu destinasi wisata bahari yang terkenal di Kabupaten Pesawaran, Lampung. Tempat ini menawarkan pemandangan laut yang jernih, pasir pantai, serta suasana alam yang masih asri. Pahawang juga dikenal sebagai lokasi yang cocok untuk aktivitas snorkeling dan menikmati keindahan terumbu karang serta ikan-ikan di sekitar perairan. Wisatawan dapat menikmati suasana pantai yang tenang sambil melihat pemandangan pulau-pulau kecil di sekitarnya. Cocok untuk liburan bersama keluarga, teman, maupun perjalanan wisata dengan paket travel.', 'Pantai', 'destinasi/OWDBoWdbI28znxDdCRRHX9EI5lNNxsm8l26qxQZ0.jpg', '-5.6686', '105.2397', '2026-08-07 12:31:41', '2026-08-08 02:53:26'),
  (4, 'Taman Kupu-Kupu Gita Persada', 'Kawasan wisata alam dan edukasi yang menjadi tempat untuk mengenal berbagai jenis kupu-kupu dan lingkungan alamnya. Suasananya hijau dan cocok untuk wisata keluarga, edukasi, serta fotografi.', 'Alam', 'destinasi/sBn7jGwURdTadFiv4npw5vvzae1id5zErsEMwMW6.jpg', '-5.4238', '105.2104', '2026-08-07 12:31:41', '2026-08-08 03:04:25'),
  (5, 'Lembah Hijau', 'Tempat wisata keluarga yang menyediakan berbagai aktivitas seperti taman satwa, waterboom, outbound, wahana permainan, camping ground, restoran, dan cottage.\r\nCocok untuk paket: Paket Keluarga, Paket Liburan Anak, Paket Full Day', 'Alam', 'destinasi/Nyw7n3RZnhBCmXacImdgEqUGvdy1j3kFouiHJ3HH.jpg', '-5.4255', '105.2058', '2026-08-08 03:06:49', '2026-08-08 03:06:49'),
  (6, 'Museum Lampung', 'Museum yang dapat menjadi pilihan wisata edukasi untuk mengenal sejarah, budaya, dan berbagai peninggalan masyarakat Lampung.', 'Budaya', 'destinasi/LByQpxmvE0LxtkEBQiK6JRxj7qGjW55RcJqDn5ZG.jpg', '-5.3797', '105.2437', '2026-08-08 03:14:42', '2026-08-08 04:54:44'),
  (7, 'Bukit Aslan', 'Destinasi wisata di kawasan perbukitan yang menawarkan pemandangan alam dan suasana yang sejuk. Cocok untuk menikmati panorama Bandar Lampung dan bersantai.', 'Alam', 'destinasi/vMIrknV1cObBbuqIZDXfuIxaSdCtIIWX4HI3SEsg.jpg', '-5.4135', '105.2845', '2026-08-08 04:58:44', '2026-08-08 04:58:44');

ALTER TABLE `destinasi` AUTO_INCREMENT = 1;

DELETE FROM `bank_accounts`;
INSERT INTO `bank_accounts` (`id`, `nama_bank`, `nomor_rekening`, `atas_nama`, `is_aktif`, `created_at`, `updated_at`) VALUES
  (1, 'Bank Mandiri', '1234567890', 'TravelKu Indonesia', 1, '2026-08-07 12:31:42', '2026-08-07 12:31:42'),
  (2, 'Bank BCA', '0987654321', 'TravelKu Indonesia', 1, '2026-08-07 12:31:42', '2026-08-07 12:31:42'),
  (3, 'Bank BRI', '5556667777', 'TravelKu Indonesia', 1, '2026-08-07 12:31:42', '2026-08-07 12:31:42');

ALTER TABLE `bank_accounts` AUTO_INCREMENT = 1;

DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
  (1, 'no_whatsapp', '6282112345678', '2026-08-07 12:31:42', '2026-08-07 12:31:42'),
  (2, 'no_telp', '0853 7915 3783', '2026-08-07 12:31:42', '2026-08-07 12:31:42'),
  (3, 'email', 'info@travelku.com', '2026-08-07 12:31:42', '2026-08-07 12:31:42'),
  (4, 'alamat', 'Jl. Lintas Sumatera No.162, Bumisari, Kec. Natar, Kabupaten Lampung Selatan', '2026-08-07 12:31:42', '2026-08-08 05:34:19'),
  (5, 'facebook', 'travelkulanteng', '2026-08-07 12:31:43', '2026-08-07 12:31:43'),
  (6, 'instagram', '@travelku_lampung', '2026-08-07 12:31:43', '2026-08-07 12:31:43'),
  (7, 'tentang_kami', 'TravelKu adalah layanan travel dan rental mobil dengan supir profesional yang telah melayani masyarakat Bandar Lampung dan sekitarnya sejak 2020. Kami berkomitmen memberikan pengalaman perjalanan yang nyaman, aman, dan terjangkau.\\n\\nDengan armada mobil yang terawat dan supir yang berpengalaman serta menguasai rute di seluruh provinsi Lampung, TravelKu menjadi pilihan tepat untuk perjalanan wisata, dinas, atau antar jemput.\\n\\nVisi kami menjadi layanan travel terdepan di Lampung yang mengutamakan kepuasan dan kenyamanan pelanggan. Misi kami menyediakan transportasi berkualitas dengan harga bersahabat, didukung oleh sumber daya profesional dan armada yang selalu prima.', '2026-08-07 12:31:43', '2026-08-07 12:31:43');

ALTER TABLE `settings` AUTO_INCREMENT = 1;

DELETE FROM `promo_banners`;
ALTER TABLE `promo_banners` AUTO_INCREMENT = 1;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `no_hp`, `alamat`, `foto`, `ktp`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
  (1, 'Admin TravelKu', 'admin@travelku.com', NULL, '$2y$12$ioirhRYoK4BgkB6QC2mBievcHiI0jXjPHYhChA0wDgI7UKtqiHbNO', '081234567890', NULL, NULL, NULL, 'admin', NULL, '2026-08-07 12:31:40', '2026-08-07 12:31:40'),
  (2, 'User Demo', 'user@travelku.com', NULL, '$2y$12$R70ggiNe55sEq0v8s27p.OM6Tm1N36mExQDq1TFcZek4jEsSFyYE.', '085678901234', 'Jl. Raden Intan No. 10, Bandar Lampung', NULL, NULL, 'user', NULL, '2026-08-07 12:31:40', '2026-08-07 12:31:40'),
  (3, 'vergiawan', 'vergiawan@gmail.com', NULL, '$2y$12$vwiH4mk6w/oiKdcsQg96Ku0.Nfud3R6T3lKrRw6ZvPbmzrwaIF3KW', '89927666172', NULL, NULL, NULL, 'user', NULL, '2026-08-08 05:49:11', '2026-08-08 05:49:11');

ALTER TABLE `users` AUTO_INCREMENT = 1;

DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (1, '0001_01_01_000000_create_users_table', 1),
  (2, '0001_01_01_000001_create_cache_table', 1),
  (3, '0001_01_01_000002_create_jobs_table', 1),
  (4, '2025_01_01_000001_create_destinasi_table', 1),
  (5, '2025_01_01_000002_create_mobil_table', 1),
  (6, '2025_01_01_000003_create_pemesanan_table', 1),
  (7, '2025_01_01_000004_create_pembayaran_table', 1),
  (8, '2025_01_01_000005_create_ulasan_table', 1),
  (9, '2025_01_01_000006_create_bank_accounts_table', 1),
  (10, '2025_01_01_000007_create_settings_table', 1),
  (11, '2025_01_01_000008_create_promo_banners_table', 1),
  (12, '2025_01_01_000009_create_mitra_table', 1),
  (13, '2025_01_01_000010_create_paket_table', 1),
  (14, '2025_01_01_000011_add_paket_id_to_pemesanan_table', 1);

ALTER TABLE `migrations` AUTO_INCREMENT = 1;

SET FOREIGN_KEY_CHECKS=1;
