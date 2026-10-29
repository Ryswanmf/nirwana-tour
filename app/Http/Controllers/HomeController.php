<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fleet;
use App\Models\GalleryItem;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $tourCategories = Category::where('type', 'tour')->withCount(['tourPackages' => fn ($q) => $q->where('is_active', true)])->get();
        $packages = TourPackage::where('is_active', true)->with('category')->orderBy('order')->get();
        $featuredPackages = TourPackage::where('is_active', true)->where('is_featured', true)->with('category')->orderBy('order')->take(6)->get();
        $fleets = Fleet::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $posts = Post::where('is_published', true)->with('category')->orderByDesc('published_at')->take(4)->get();
        $galleryItems = GalleryItem::orderBy('order')->take(6)->get();

        return view('pages.home', compact(
            'partners',
            'services',
            'tourCategories',
            'packages',
            'featuredPackages',
            'fleets',
            'testimonials',
            'posts',
            'galleryItems'
        ));
    }

    public function profile(): View
    {
        $fleets = Fleet::where('is_active', true)->orderBy('order')->get();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->take(3)->get();

        return view('pages.profile', compact('fleets', 'partners', 'testimonials'));
    }

    public function management(): View
    {
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->take(3)->get();

        return view('pages.management', compact('partners', 'testimonials'));
    }

    public function certificates(): View
    {
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $fleets = Fleet::where('is_active', true)->orderBy('order')->get();

        return view('pages.certificates', compact('partners', 'fleets'));
    }

    public function about(): View
    {
        return $this->profile();
    }
}
