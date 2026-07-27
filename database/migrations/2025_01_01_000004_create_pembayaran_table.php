<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan')->onDelete('cascade');
            $table->string('nama_pengirim');
            $table->string('bank_pengirim');
            $table->date('tanggal_transaksi');
            $table->decimal('nominal_transfer', 12, 2);
            $table->string('bukti_pembayaran');
            $table->enum('status', ['menunggu_verifikasi', 'terverifikasi', 'ditolak'])->default('menunggu_verifikasi');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
