<?php

namespace App\Filament\Widgets;

use App\Models\Fleet;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\TourPackage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $packageCount = TourPackage::where('is_active', true)->count();
        $inquiryCount = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();
        $postCount = Post::where('is_published', true)->count();
        $fleetCount = Fleet::where('is_active', true)->count();

        return [
            Stat::make('Paket Wisata Aktif', $packageCount . ' Paket')
                ->description('Katalog tour siap dipesan')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),

            Stat::make('Pesanan Masuk (Leads)', $inquiryCount . ' Permintaan')
                ->description($pendingInquiries . ' perlu ditindaklanjuti')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color($pendingInquiries > 0 ? 'warning' : 'success'),

            Stat::make('Artikel & Tips Wisata', $postCount . ' Artikel')
                ->description('Konten edukasi terpublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('Armada Pariwisata', $fleetCount . ' Kendaraan')
                ->description('Bus & van siap operasional')
                ->descriptionIcon('heroicon-m-truck')
                ->color('success'),
        ];
    }
}
