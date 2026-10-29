<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\SiteSetting;
use App\Models\TourPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:100',
            'tour_package_id' => 'nullable|exists:tour_packages,id',
            'package_name' => 'nullable|string|max:150',
            'participants' => 'nullable|integer|min:1',
            'fleet_type' => 'nullable|string|max:100',
            'estimated_price' => 'nullable|numeric',
            'message' => 'nullable|string|max:1000',
            'source' => 'nullable|string|max:50',
        ]);

        $packageName = $validated['package_name'] ?? null;
        if (!empty($validated['tour_package_id'])) {
            $package = TourPackage::find($validated['tour_package_id']);
            if ($package) {
                $packageName = $package->title;
            }
        }

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'tour_package_id' => $validated['tour_package_id'] ?? null,
            'package_name' => $packageName,
            'participants' => $validated['participants'] ?? 1,
            'fleet_type' => $validated['fleet_type'] ?? null,
            'estimated_price' => $validated['estimated_price'] ?? null,
            'message' => $validated['message'] ?? null,
            'source' => $validated['source'] ?? 'website',
            'status' => 'pending',
        ]);

        // Build WhatsApp redirect link
        $waNumber = SiteSetting::get('whatsapp_number', '6282269616188');
        $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);

        $waText = "Halo Nirwana Tour Lampung,\n";
        $waText .= "Saya ingin konsultasi perjalanan wisata:\n\n";
        $waText .= "• *Nama/Instansi*: {$inquiry->name}\n";
        $waText .= "• *Nomor WhatsApp*: {$inquiry->phone}\n";
        if (!empty($inquiry->email)) {
            $waText .= "• *Email*: {$inquiry->email}\n";
        }
        if ($inquiry->package_name) {
            $waText .= "• *Pilihan Layanan/Paket*: {$inquiry->package_name}\n";
        }
        if ($inquiry->participants) {
            $waText .= "• *Jumlah Peserta*: {$inquiry->participants} orang\n";
        }
        if ($inquiry->fleet_type) {
            $waText .= "• *Pilihan Armada*: {$inquiry->fleet_type}\n";
        }
        if ($inquiry->estimated_price) {
            $waText .= "• *Estimasi Budget*: Rp " . number_format($inquiry->estimated_price, 0, ',', '.') . "\n";
        }
        if ($inquiry->message) {
            $waText .= "• *Catatan Tambahan*: {$inquiry->message}\n";
        }
        $waText .= "\nMohon informasi ketersediaan jadwal dan penawaran terbaiknya. Terima kasih!";

        $redirectUrl = "https://wa.me/{$cleanWa}?text=" . rawurlencode($waText);

        return redirect()->away($redirectUrl);
    }
}
