<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $fleets = Fleet::where('is_active', true)->orderBy('order')->get();

        return view('pages.services.index', compact('services', 'fleets'));
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->get();

        return view('pages.services.show', compact('service', 'otherServices'));
    }
}
