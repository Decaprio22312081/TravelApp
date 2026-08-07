<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('durasi_hari')->default(1);
            $table->decimal('harga', 12, 2);
            $table->text('fasilitas')->nullable();
            $table->text('itinerary')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
