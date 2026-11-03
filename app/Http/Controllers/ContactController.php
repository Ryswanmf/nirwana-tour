<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
        $contacts = Contact::where('is_active', true)
            ->orderByDesc('is_primary')
            ->orderBy('order')
            ->get();
        $primaryContact = $contacts->firstWhere('is_primary', true) ?? $contacts->first();

        return view('pages.contact', compact('packages', 'services', 'contacts', 'primaryContact'));
    }
}
