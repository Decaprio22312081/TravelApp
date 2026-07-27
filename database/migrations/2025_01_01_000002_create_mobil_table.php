<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('merk');
            $table->string('tipe');
            $table->string('plat_nomor')->unique();
            $table->integer('kapasitas');
            $table->decimal('harga_per_hari', 12, 2);
            $table->string('foto')->nullable();
            $table->text('fasilitas')->nullable();
            $table->string('nama_supir')->nullable();
            $table->string('no_hp_supir', 20)->nullable();
            $table->string('foto_supir')->nullable();
            $table->enum('status', ['tersedia', 'disewa', 'maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
