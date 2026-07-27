<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobil')->onDelete('cascade');
            $table->foreignId('destinasi_id')->nullable()->constrained('destinasi')->onDelete('set null');
            $table->string('alamat_jemput');
            $table->string('alamat_tujuan');
            $table->date('tanggal_mulai');
            $table->integer('jumlah_hari');
            $table->decimal('total_harga', 12, 2);
            $table->string('nama_penumpang');
            $table->string('no_hp_penumpang', 20);
            $table->integer('jumlah_penumpang');
            $table->enum('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'dikonfirmasi', 'berjalan', 'selesai', 'ditolak', 'batal'])->default('menunggu_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
