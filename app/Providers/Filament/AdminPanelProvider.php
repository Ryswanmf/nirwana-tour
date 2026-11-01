<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->profile()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->spa()
            ->brandName('Nirwana Tour Lampung')
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->brandLogoHeight('2.8rem')
            ->favicon(fn () => asset('assets/logo/Logo-Nirwana.png'))
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('17.5rem')
            ->collapsedSidebarWidth('4.5rem')
            ->colors([
                'primary' => '#800020',
            ])
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn () => view('filament.auth.login-footer'),
            )
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => view('filament.custom-styles'),
            )
            ->navigationGroups([
                NavigationGroup::make('Manajemen Wisata & Reservasi')->collapsible(false),
                NavigationGroup::make('Konten & Informasi')->collapsible(false),
                NavigationGroup::make('Profil & Pengaturan')->collapsible(false),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\AdminWelcomeWidget::class,
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\LatestInquiriesWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
