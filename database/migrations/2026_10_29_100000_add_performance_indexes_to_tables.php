<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->index(['is_active', 'order'], 'tp_is_active_order_idx');
            $table->index(['is_active', 'is_featured'], 'tp_is_active_featured_idx');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index(['is_active', 'order'], 'srv_is_active_order_idx');
        });

        Schema::table('fleets', function (Blueprint $table) {
            $table->index(['is_active', 'order'], 'flt_is_active_order_idx');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->index(['is_active', 'order'], 'prt_is_active_order_idx');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->index(['is_active', 'order'], 'tst_is_active_order_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index(['is_published', 'published_at'], 'pst_is_pub_pub_at_idx');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->index(['media_type', 'order'], 'gi_media_type_order_idx');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropIndex('tp_is_active_order_idx');
            $table->dropIndex('tp_is_active_featured_idx');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex('srv_is_active_order_idx');
        });

        Schema::table('fleets', function (Blueprint $table) {
            $table->dropIndex('flt_is_active_order_idx');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropIndex('prt_is_active_order_idx');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex('tst_is_active_order_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('pst_is_pub_pub_at_idx');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropIndex('gi_media_type_order_idx');
        });
    }
};
