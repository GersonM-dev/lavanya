<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Hasnayeen\Themes\Themes\Nord;
use Filament\Support\Colors\Color;
use Hasnayeen\Themes\ThemesPlugin;
use Hasnayeen\Themes\Themes\Sunset;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                config('filament-logger.activity_resource')
            ])
            ->brandLogo(asset('logo-light.png'))
            ->darkModeBrandLogo(asset('logo-dark.png'))
            ->brandLogoHeight('5rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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

                SetTheme::class
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                BreezyCore::make()
                    ->myProfile(shouldRegisterUserMenu: true),
                FilamentBackgroundsPlugin::make()->showAttribution(false),
                ThemesPlugin::make()
                    ->registerTheme(
                        [
                            Sunset::class,
                        ],
                        override: true,
                    ),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Venue & Vendor')
                    ->icon('heroicon-o-home-modern')->collapsed(),
                NavigationGroup::make()
                    ->label('Settings')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Administration')
                    ->collapsed(),
            ]);
    }
}
