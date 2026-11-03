<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertificate extends EditRecord
{
    protected static string $resource = CertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_on_web')
                ->label('Lihat di Web')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(route('certificates'))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
