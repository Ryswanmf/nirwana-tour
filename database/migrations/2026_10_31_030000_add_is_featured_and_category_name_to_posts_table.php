<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_published');
            $table->string('category_name')->nullable()->after('category_id');
            $table->index('is_featured');
        });

        // Set 3 artikel unggulan untuk beranda dan isi kategori teks default untuk data awal
        DB::table('posts')->where('id', 1)->update([
            'is_featured' => true,
            'category_name' => 'Tips Wisata',
        ]);
        DB::table('posts')->where('id', 2)->update([
            'is_featured' => true,
            'category_name' => 'Panduan Wisata',
        ]);
        DB::table('posts')->where('id', 3)->update([
            'is_featured' => true,
            'category_name' => 'Transportasi Bus',
        ]);
        DB::table('posts')->where('id', 4)->update([
            'is_featured' => false,
            'category_name' => 'Spot Foto',
        ]);
        DB::table('posts')->where('id', 5)->update([
            'is_featured' => false,
            'category_name' => 'Study Tour',
        ]);
        DB::table('posts')->where('id', 6)->update([
            'is_featured' => false,
            'category_name' => 'Gathering',
        ]);
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['is_featured']);
            $table->dropColumn(['is_featured', 'category_name']);
        });
    }
};
