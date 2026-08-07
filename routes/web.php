<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\MitraController as AdminMitraController;
use App\Http\Controllers\Admin\MobilController as AdminMobilController;
use App\Http\Controllers\Admin\PaketController as AdminPaketController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\PemesananController as AdminPemesananController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;
use App\Http\Controllers\Admin\UlasanController as AdminUlasanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\UlasanController;
use App\Models\Destinasi;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\PromoBanner;
use App\Models\Setting;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $promos = PromoBanner::where('is_aktif', true)->get();
    $destinasis = Destinasi::latest()->take(6)->get();
    $mobils = Mobil::where('status', 'tersedia')->latest()->take(3)->get();
    $pakets = Paket::with('destinasi')->where('is_aktif', true)->latest()->take(6)->get();
    $ulasans = Ulasan::with(['user', 'pemesanan.mobil', 'pemesanan.paket'])->latest()->take(6)->get();
    $settings = Setting::all()->keyBy('key');

    return view('welcome', compact('promos', 'destinasis', 'mobils', 'pakets', 'ulasans', 'settings'));
});

// About
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister']);
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public routes
Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');
Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
Route::get('/mobil/{id}', [MobilController::class, 'show'])->name('mobil.show');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/profile/password', [AuthController::class, 'ubahPassword'])->name('profile.password');

    // Pemesanan
    Route::get('/pesan', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pesan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::post('/pesanan/{id}/batal', [PemesananController::class, 'cancel'])->name('pemesanan.batal');
    Route::get('/riwayat', [PemesananController::class, 'riwayat'])->name('pemesanan.riwayat');

    // Pembayaran
    Route::get('/pembayaran/{pemesanan_id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/{pemesanan_id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{pemesanan_id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');

    // Ulasan
    Route::get('/ulasan/{pemesanan_id}', [UlasanController::class, 'create'])->name('ulasan.create');
    Route::post('/ulasan/{pemesanan_id}', [UlasanController::class, 'store'])->name('ulasan.store');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Destinasi
    Route::resource('destinasi', AdminDestinasiController::class);

    // Mobil
    Route::resource('mobil', AdminMobilController::class);

    // Paket Wisata
    Route::resource('paket', AdminPaketController::class);

    // Pemesanan
    Route::get('/pemesanan', [AdminPemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [AdminPemesananController::class, 'show'])->name('pemesanan.show');
    Route::post('/pemesanan/{id}/status', [AdminPemesananController::class, 'updateStatus'])->name('pemesanan.status');

    // Pembayaran
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    Route::post('/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

    // Ulasan
    Route::get('/ulasan', [AdminUlasanController::class, 'index'])->name('ulasan.index');
    Route::delete('/ulasan/{id}', [AdminUlasanController::class, 'destroy'])->name('ulasan.destroy');

    // Laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [AdminLaporanController::class, 'export'])->name('laporan.export');

    // Mitra
    Route::resource('mitra', AdminMitraController::class);

    // Pengaturan
    Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan/bank', [AdminPengaturanController::class, 'bankStore'])->name('pengaturan.bank.store');
    Route::put('/pengaturan/bank/{id}', [AdminPengaturanController::class, 'bankUpdate'])->name('pengaturan.bank.update');
    Route::delete('/pengaturan/bank/{id}', [AdminPengaturanController::class, 'bankDestroy'])->name('pengaturan.bank.destroy');
    Route::post('/pengaturan/setting', [AdminPengaturanController::class, 'settingUpdate'])->name('pengaturan.setting.update');
    Route::post('/pengaturan/banner', [AdminPengaturanController::class, 'bannerStore'])->name('pengaturan.banner.store');
    Route::put('/pengaturan/banner/{id}', [AdminPengaturanController::class, 'bannerUpdate'])->name('pengaturan.banner.update');
    Route::delete('/pengaturan/banner/{id}', [AdminPengaturanController::class, 'bannerDestroy'])->name('pengaturan.banner.destroy');
});
