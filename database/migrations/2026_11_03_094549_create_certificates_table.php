<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('issuer')->nullable();
            $table->string('certificate_number')->nullable();
            $table->string('badge')->nullable();
            $table->string('icon')->default('fa-solid fa-certificate');
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed 6 data legalitas & sertifikasi awal
        $initialCertificates = [
            [
                'title' => 'Nomor Induk Berusaha (NIB)',
                'slug' => 'nomor-induk-berusaha-nib',
                'issuer' => 'Kementerian Investasi / BKPM RI',
                'certificate_number' => 'KBLI 79120 (Biro Perjalanan Wisata)',
                'badge' => 'OSS BKPM',
                'icon' => 'fa-solid fa-id-card-clip',
                'description' => 'Terdaftar secara sah pada sistem OSS (Online Single Submission) Kementerian Investasi/BKPM Republik Indonesia dengan klasifikasi baku KBLI 79120 (Biro Perjalanan Wisata).',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Izin Usaha Pariwisata (TDUP)',
                'slug' => 'izin-usaha-pariwisata-tdup',
                'issuer' => 'Dinas Kebudayaan & Pariwisata Kota Bandar Lampung',
                'certificate_number' => 'TDUP/556/012/BPW/2016',
                'badge' => 'Pemda Aktif',
                'icon' => 'fa-solid fa-file-contract',
                'description' => 'Memiliki Tanda Daftar Usaha Pariwisata yang diakui Dinas Kebudayaan dan Pariwisata Pemerintah Kota Bandar Lampung untuk menyelenggarakan jasa tur dan perjalanan.',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lisensi Pemandu Resmi HPI',
                'slug' => 'lisensi-pemandu-resmi-hpi',
                'issuer' => 'DPD HPI Lampung & BNSP',
                'certificate_number' => 'Sertifikasi Profesi BNSP',
                'badge' => 'BNSP & HPI',
                'icon' => 'fa-solid fa-users-gear',
                'description' => 'Seluruh Tour Leader dan koordinator pemandu lapangan memegang kartu lisensi kompetensi dari DPD Himpunan Pramuwisata Indonesia (HPI) Provinsi Lampung.',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Armada Berizin Resmi Dishub',
                'slug' => 'armada-berizin-resmi-dishub',
                'issuer' => 'Dinas Perhubungan RI & BPTD',
                'certificate_number' => 'Izin Trayek & KIR Berkala',
                'badge' => 'Uji KIR Aktif',
                'icon' => 'fa-solid fa-bus',
                'description' => 'Seluruh bus dan HiAce pariwisata yang kami operasikan memiliki izin trayek pariwisata resmi dari Dinas Perhubungan, uji KIR berkala aktif, dan pengemudi profesional.',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jaminan Asuransi Resmi',
                'slug' => 'jaminan-asuransi-resmi',
                'issuer' => 'Mitra Asuransi Perjalanan Terdaftar OJK',
                'certificate_number' => 'Proteksi Personal Accident',
                'badge' => 'Terproteksi',
                'icon' => 'fa-solid fa-shield-virus',
                'description' => 'Perlindungan asuransi kecelakaan diri perjalanan wisata resmi untuk menjamin keselamatan dan kenyamanan seluruh rombongan selama masa trip berlangsung.',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kelayakan Transaksi B2B',
                'slug' => 'kelayakan-transaksi-b2b',
                'issuer' => 'Direktorat Jenderal Pajak RI & Perbankan',
                'certificate_number' => 'NPWP Badan & Rekening Giro Resmi',
                'badge' => 'NPWP & Faktur',
                'icon' => 'fa-solid fa-file-invoice-dollar',
                'description' => 'Memiliki NPWP Badan Usaha aktif, rekening bank resmi atas nama perusahaan, dan siap menerbitkan MoU, proposal penawaran, invoice resmi, faktur pajak, serta kwitansi bermaterai.',
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('certificates')->insert($initialCertificates);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

