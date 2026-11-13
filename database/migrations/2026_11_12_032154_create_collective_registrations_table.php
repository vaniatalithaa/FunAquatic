<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collective_registrations', function (Blueprint $table) {
            $table->id();

            // Identitas pelatih atau perwakilan
            $table->string('nama_pelatih');
            $table->string('nama_swimschool');
            $table->string('email');
            $table->string('whatsapp', 20);

            // Dokumen pendaftaran kolektif
            $table->string('file_excel');
            $table->string('file_akte');

            // Jumlah atlet dalam pendaftaran
            $table->unsignedInteger('jumlah_peserta')->default(0);

            // Status pendaftaran
            $table->string('status')->default('menunggu_pembayaran');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collective_registrations');
    }
};