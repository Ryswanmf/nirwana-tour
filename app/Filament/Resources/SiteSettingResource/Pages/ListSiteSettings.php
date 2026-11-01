<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSiteSettings extends ListRecords
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('backup_database')
                ->label('Backup & Download Database')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(route('admin.backup.download'))
                ->openUrlInNewTab(false),
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Pengaturan'),
            'about' => Tab::make('Profil Perusahaan (Pemilik & Sambutan)')
                ->icon('heroicon-o-user-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'about')),
            'marketing' => Tab::make('Marketing & Beranda')
                ->icon('heroicon-o-megaphone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'marketing')),
            'social_proof' => Tab::make('Social Proof & Angka')
                ->icon('heroicon-o-chart-bar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'social_proof')),
            'general' => Tab::make('Umum & Kontak')
                ->icon('heroicon-o-phone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'general')),
        ];
    }
}
