<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama Kantor / Unit Layanan');
            $table->string('type')->default('Kantor Pusat')->comment('Kantor Pusat, Kantor Cabang, Customer Service');
            $table->text('address')->comment('Alamat Fisik Lengkap');
            $table->string('city')->default('Bandar Lampung')->comment('Kota / Wilayah');
            $table->string('phone')->nullable()->comment('Nomor Telepon Kantor');
            $table->string('whatsapp')->nullable()->comment('Nomor WhatsApp');
            $table->string('email')->nullable()->comment('Email Resmi');
            $table->string('operating_hours')->nullable()->default('Senin - Sabtu: 08:00 - 17:00 WIB');
            $table->text('google_maps_embed')->nullable()->comment('URL / Iframe Google Maps');
            $table->text('google_maps_url')->nullable()->comment('Link Buka di Google Maps');
            $table->text('description')->nullable()->comment('Catatan Tambahan');
            $table->boolean('is_primary')->default(false)->comment('Apakah Kantor Utama');
            $table->boolean('is_active')->default(true)->comment('Status Aktif Tampil di Web');
            $table->integer('order')->default(0)->comment('Urutan Prioritas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
