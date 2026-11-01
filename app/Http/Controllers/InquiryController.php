<?php

namespace App\Http\Controllers;

use App\Mail\NewInquiryReceived;
use App\Models\Inquiry;
use App\Models\SiteSetting;
use App\Models\TourPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // 1. Honeypot Anti-Spam Check
        if ($request->filled('_hp_security_check')) {
            $waNumber = SiteSetting::get('whatsapp_number', '6282269616188');
            $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);
            return redirect()->away("https://wa.me/{$cleanWa}");
        }

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

        // 2. Kirim Notifikasi Email Otomatis ke Tim Admin (Non-blocking)
        try {
            $adminEmail = SiteSetting::get('email', config('mail.from.address', 'info@nirwanatour.com'));
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new NewInquiryReceived($inquiry));
            }
        } catch (\Throwable $e) {
            Log::info('Pengiriman email leads baru dilewati / gagal: ' . $e->getMessage());
        }

        // 3. Notifikasi Database ke Admin Panel Filament
        try {
            $admins = \App\Models\User::all();
            if ($admins->isNotEmpty()) {
                \Filament\Notifications\Notification::make()
                    ->title('Permintaan Pesanan Baru!')
                    ->icon('heroicon-o-shopping-bag')
                    ->iconColor('success')
                    ->body("{$inquiry->name} mengirim konsultasi untuk {$inquiry->package_name} ({$inquiry->participants} orang).")
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Buka Detail')
                            ->url(route('filament.admin.resources.inquiries.edit', $inquiry->id)),
                    ])
                    ->sendToDatabase($admins);
            }
        } catch (\Throwable $e) {
            Log::info('Notifikasi database admin dilewati: ' . $e->getMessage());
        }

        // 4. Bangun tautan WhatsApp redirect resmi
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
