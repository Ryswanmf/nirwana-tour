<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        // Anti-spam honeypot
        if ($request->filled('_hp_check')) {
            return back()->with('review_success', 'Terima kasih atas ulasan Anda!');
        }

        $validated = $request->validate([
            'client_name' => 'required|string|max:100',
            'organization' => 'nullable|string|max:100',
            'role' => 'nullable|string|max:100',
            'trip_name' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'client_name.required' => 'Nama lengkap wajib diisi.',
            'rating.required' => 'Silakan pilih rating bintang.',
            'comment.required' => 'Tuliskan ulasan pengalaman Anda.',
            'comment.min' => 'Ulasan minimal 10 karakter.',
            'avatar.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial = Testimonial::create([
            'client_name' => strip_tags($validated['client_name']),
            'organization' => !empty($validated['organization']) ? strip_tags($validated['organization']) : null,
            'role' => !empty($validated['role']) ? strip_tags($validated['role']) : null,
            'trip_name' => !empty($validated['trip_name']) ? strip_tags($validated['trip_name']) : null,
            'rating' => (int) $validated['rating'],
            'comment' => strip_tags($validated['comment']),
            'avatar' => $avatarPath,
            'is_active' => false, // Perlu moderasi admin
            'order' => 99,
        ]);

        // Notifikasi ke Admin Panel Filament
        try {
            $admins = \App\Models\User::all();
            if ($admins->isNotEmpty()) {
                \Filament\Notifications\Notification::make()
                    ->title('Testimoni Baru Perlu Moderasi!')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->iconColor('warning')
                    ->body("{$testimonial->client_name} memberikan ulasan bintang {$testimonial->rating}. Silakan verifikasi untuk ditampilkan di web.")
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Buka Testimoni')
                            ->url(route('filament.admin.resources.testimonials.edit', $testimonial->id)),
                    ])
                    ->sendToDatabase($admins);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::info('Notifikasi database testimoni dilewati: ' . $e->getMessage());
        }

        return back()->with('review_success', 'Terima kasih banyak! Ulasan Anda telah terkirim dan akan ditampilkan setelah diverifikasi admin.');
    }
}
