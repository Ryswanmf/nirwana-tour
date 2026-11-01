<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\TourPackage;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticUrls = [
            ['loc' => route('home'), 'lastmod' => now()->toDateString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('packages.index'), 'lastmod' => now()->toDateString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('destinations.index'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('services.index'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('posts.index'), 'lastmod' => now()->toDateString(), 'changefreq' => 'daily', 'priority' => '0.8'],
            ['loc' => route('gallery.index'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('profile'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('management'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('certificates'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('about'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('contact'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
        ];

        $packages = TourPackage::where('is_active', true)
            ->select(['id', 'slug', 'updated_at'])
            ->latest('updated_at')
            ->get();

        $posts = Post::where('is_published', true)
            ->select(['id', 'slug', 'updated_at'])
            ->latest('updated_at')
            ->get();

        $services = Service::where('is_active', true)
            ->select(['id', 'slug', 'updated_at'])
            ->latest('updated_at')
            ->get();

        return response()
            ->view('sitemap', compact('staticUrls', 'packages', 'posts', 'services'))
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
