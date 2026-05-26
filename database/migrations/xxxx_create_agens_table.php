// database/migrations/xxxx_create_agens_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agens', function (Blueprint $table) {
            $table->id();

            // Step 1 — Data Agen
            $table->string('nama_agen');
            $table->string('nama_pic');
            $table->string('provinsi');
            $table->string('kota');
            $table->year('tahun_berdiri')->nullable();
            $table->text('alamat')->nullable();
            $table->string('whatsapp');
            $table->string('email_bisnis');
            $table->string('website')->nullable();
            $table->string('no_siup')->nullable();
            $table->text('deskripsi')->nullable();

            // Step 2 — Layanan
            $table->json('layanan');
            $table->string('jumlah_armada');
            $table->string('jumlah_supir');
            $table->integer('harga_mulai')->default(0);
            $table->text('area_destinasi')->nullable();

            // Step 3 — Dokumen & Rekening
            $table->string('file_ktp')->nullable();
            $table->string('file_siup')->nullable();
            $table->string('file_foto_kantor')->nullable();
            $table->string('file_logo')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('atas_nama_rekening')->nullable();

            // Step 4 — Akun
            $table->string('email_login')->unique();
            $table->string('password');
            $table->string('no_wa_otp')->nullable();

            // Status
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agens');
    }
};