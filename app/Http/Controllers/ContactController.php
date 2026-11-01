<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $packages = TourPackage::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('pages.contact', compact('packages', 'services'));
    }
}
