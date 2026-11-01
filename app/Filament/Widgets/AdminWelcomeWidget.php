<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\InquiryResource;
use App\Filament\Resources\TestimonialResource;
use App\Filament\Resources\TourPackageResource;
use App\Models\Inquiry;
use App\Models\Testimonial;
use Filament\Widgets\Widget;

class AdminWelcomeWidget extends Widget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.admin-welcome-widget';

    public function getViewData(): array
    {
        return [
            'pendingInquiries' => Inquiry::where('status', 'pending')->count(),
            'pendingTestimonials' => Testimonial::where('is_active', false)->count(),
            'createPackageUrl' => TourPackageResource::getUrl('create'),
            'inquiriesUrl' => InquiryResource::getUrl('index'),
            'testimonialsUrl' => TestimonialResource::getUrl('index'),
        ];
    }
}
