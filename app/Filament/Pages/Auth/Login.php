<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    /**
     * Menggunakan layout base murni agar dapat menampilkan split-screen kustom.
     */
    protected static string $layout = 'filament-panels::components.layout.base';

    /**
     * View kustom split-screen modern untuk halaman login.
     */
    protected static string $view = 'filament.pages.auth.login';

    /**
     * Menangani proses autentikasi dengan rate limit 5x gagal decay 120 detik (2 menit).
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            // Batas 5 kali percobaan, tunggu 120 detik (2 menit) jika melebihi batas
            $this->rateLimit(5, 120);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        // Bersihkan counter limit saat login berhasil
        $this->clearRateLimiter();

        session()->regenerate();

        return app(LoginResponse::class);
    }

    /**
     * Notifikasi saat batas percobaan terlampaui.
     */
    protected function getRateLimitedNotification(TooManyRequestsException $exception): ?Notification
    {
        $minutes = ceil($exception->secondsUntilAvailable / 60);

        return Notification::make()
            ->title('Batas Percobaan Login Terlampaui')
            ->body("Anda telah 5 kali salah memasukkan data login. Demi keamanan sistem, silakan tunggu {$exception->secondsUntilAvailable} detik ({$minutes} menit) sebelum mencoba kembali.")
            ->danger()
            ->persistent();
    }

    /**
     * Input Alamat Email
     */
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Alamat Email')
            ->email()
            ->placeholder('contoh: admin@nirwanatour.com')
            ->required()
            ->autocomplete('email')
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    /**
     * Input Kata Sandi dengan tautan Lupa Sandi ke WhatsApp 089515915699
     */
    protected function getPasswordFormComponent(): Component
    {
        $waNumber = '6289515915699';
        $waMessage = rawurlencode('Halo Admin Nirwana Tour, saya membutuhkan bantuan untuk reset/pemulihan kata sandi akun Admin CMS Nirwana.');
        $waUrl = "https://wa.me/{$waNumber}?text={$waMessage}";

        return TextInput::make('password')
            ->label('Kata Sandi')
            ->hint(new HtmlString(
                '<a href="' . $waUrl . '" target="_blank" rel="noopener noreferrer" style="color: #800020; font-weight: 700; text-decoration: none; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 4px;" title="Reset kata sandi melalui WhatsApp">Lupa Sandi?</a>'
            ))
            ->password()
            ->revealable()
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    /**
     * Kotak Centang Ingat Saya
     */
    protected function getRememberFormComponent(): Component
    {
        return parent::getRememberFormComponent()
            ->label('Ingat saya di perangkat ini');
    }

    public function getTitle(): string | Htmlable
    {
        return 'Masuk Panel Admin - Nirwana Tour Lampung';
    }

    public function getHeading(): string | Htmlable
    {
        return 'Masuk ke Panel Pengelola';
    }

    public function getSubHeading(): string | Htmlable | null
    {
        return 'Sistem Informasi & Manajemen Konten Nirwana Tour & Travel Lampung';
    }
}
