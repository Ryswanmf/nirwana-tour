<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Fleet;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Tampilkan ringkasan data & statistik dashboard admin
     */
    public function index(): Response
    {
        $stats = [
            'packages_total' => TourPackage::count(),
            'packages_active' => TourPackage::where('is_active', true)->count(),
            'inquiries_total' => Inquiry::count(),
            'inquiries_pending' => Inquiry::where('status', 'pending')->count(),
            'services_total' => Service::count(),
            'fleets_total' => Fleet::count(),
            'posts_total' => Post::count(),
            'testimonials_total' => Testimonial::count(),
            'team_members_total' => TeamMember::count(),
            'certificates_total' => Certificate::count(),
            'contacts_total' => Contact::count(),
        ];

        $recentInquiries = Inquiry::with('tourPackage:id,title')
            ->latest()
            ->take(6)
            ->get();

        $featuredPackages = TourPackage::with('category:id,name')
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'recentInquiries' => $recentInquiries,
            'featuredPackages' => $featuredPackages,
        ]);
    }
}
