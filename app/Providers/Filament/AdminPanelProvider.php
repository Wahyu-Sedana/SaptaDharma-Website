<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Http\Middleware\SetAdminLocale;
use App\Models\WebSetting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('superadmin')
            ->brandName('Sapta Darma')
            ->darkMode(true)
            ->brandLogo(function () {
                $setting = WebSetting::first();
                $logo = $setting?->logo ? asset('storage/' . $setting->logo) : null;
                $siteName = $setting?->site_name ?: 'Sapta Darma';

                return new HtmlString('
                    <div class="flex items-center gap-3">
                        ' . ($logo ? '<img src="' . e($logo) . '" style="height:56px;" alt="' . e($siteName) . '">' : '') . '

                        <div class="leading-tight">
                            <div class="fi-brand-title" style="font-size: 1.125rem; font-weight: 700;">
                            ' . e($siteName) . '
                        </div>

                        <div class="fi-brand-subtitle" style="font-size: 0.75rem; letter-spacing: .05em;">
                            Panel Admin
                        </div>
                        </div>
                    </div>
                ');
            })
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn() => '
                    <style>
                        .fi-brand-title {
                            color: #1f2937 !important; /* Dark Grey */
                        }
                        .fi-brand-subtitle {
                            color: #6b7280 !important; /* Grey */
                        }
                        .fi-sidebar .fi-brand-title {
                            color: #ffffff !important;
                        }
                        .fi-sidebar .fi-brand-subtitle {
                            color: rgba(255, 255, 255, 0.75) !important;
                        }
                        .dark .fi-brand-title {
                            color: #ffffff !important;
                        }
                        .dark .fi-brand-subtitle {
                            color: rgba(255, 255, 255, 0.75) !important;
                        }
                        .fi-sidebar {
                            background: linear-gradient(
                                180deg,
                                #0b0d12 0%,
                                #142521 45%,
                                #1a5c46 100%
                            ) !important;
                            border-right: none;
                        }
                        .fi-sidebar-nav,
                        .fi-sidebar-header {
                            background: transparent !important;
                        }

                        .fi-sidebar-item {
                            margin-inline: 0.25rem;
                        }

                        /* Filament paints the actual pill background on the inner
                           <a class="fi-sidebar-item-button">, not the outer <li>, and
                           with dark mode disabled its default is a light grey/white
                           Tailwind class. Override the button itself, not the <li>. */
                        .fi-sidebar-item-button {
                            border-radius: 10px !important;
                            border-left: 3px solid transparent;
                            transition: background-color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
                        }

                        .fi-sidebar-item-label,
                        .fi-sidebar-item-icon {
                            color: rgba(255, 255, 255, 0.65) !important;
                            transition: color 0.25s ease;
                        }

                        /* Dark glassmorphism: darken + blur, not a bright white tint */
                        .fi-sidebar-item-button:hover,
                        .fi-sidebar-item-button:focus-visible {
                            background-color: rgba(0, 0, 0, 0.25) !important;
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border-left-color: rgba(255, 255, 255, 0.15);
                        }

                        .fi-sidebar-item-button:hover .fi-sidebar-item-label,
                        .fi-sidebar-item-button:hover .fi-sidebar-item-icon,
                        .fi-sidebar-item-button:focus-visible .fi-sidebar-item-label,
                        .fi-sidebar-item-button:focus-visible .fi-sidebar-item-icon {
                            color: rgba(255, 255, 255, 0.95) !important;
                        }

                        .fi-sidebar-item.fi-active .fi-sidebar-item-button {
                            background-color: rgba(0, 0, 0, 0.35) !important;
                            backdrop-filter: blur(12px);
                            -webkit-backdrop-filter: blur(12px);
                            border-left-color: #22c55e;
                            box-shadow:
                                inset 0 0 0 1px rgba(255, 255, 255, 0.06),
                                0 4px 14px -6px rgba(0, 0, 0, 0.6);
                        }

                        .fi-sidebar-item.fi-active .fi-sidebar-item-label,
                        .fi-sidebar-item.fi-active .fi-sidebar-item-icon {
                            color: #ffffff !important;
                            font-weight: 600;
                        }

                        .fi-sidebar-group-label {
                            color: rgba(255, 255, 255, 0.7) !important;
                        }
                    </style>
                '
            )
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                function () {
                    $current = session('admin_locale', config('languages.default'));
                    $languages = config('languages.available');
                    $flags = [
                        'id' => '🇮🇩',
                        'en' => '🇬🇧',
                    ];

                    $currentFlag = $flags[$current] ?? '';
                    $currentLabel = $languages[$current] ?? strtoupper($current);

                    $options = collect($languages)->map(function (string $label, string $locale) use ($current, $flags) {
                        $active = $locale === $current;
                        $flag = $flags[$locale] ?? '';

                        return '<a href="' . route('admin.locale.switch', $locale) . '"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition-colors ' .
                                ($active
                                    ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-400'
                                    : 'text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-white/5') . '"
                                >
                                    <span style="font-size:16px;line-height:1;">' . $flag . '</span>
                                    <span>' . e($label) . '</span>
                                </a>';
                    })->implode('');

                    return new HtmlString('
                        <div x-data="{ open: false }" @click.outside="open = false" class="relative px-2">
                            <button
                                type="button"
                                @click="open = !open"
                                class="fi-badge inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-xs font-medium text-gray-500 transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/5"
                            >
                                <span style="font-size:14px;line-height:1;">' . $currentFlag . '</span>
                                <span>' . e($currentLabel) . '</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:14px;height:14px;" :style="open ? \'transform:rotate(180deg)\' : \'\'">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                x-show="open"
                                x-cloak
                                x-transition
                                class="absolute right-0 z-50 mt-2 w-40 rounded-xl border border-gray-200 bg-white p-1 shadow-lg dark:border-white/10 dark:bg-gray-900"
                            >
                                ' . $options . '
                            </div>
                        </div>
                    ');
                }
            )
            ->favicon(function () {
                $favicon = WebSetting::first()?->favicon;

                return $favicon ? asset('storage/' . $favicon) : null;
            })
            ->login()
            ->sidebarCollapsibleOnDesktop(true)
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                SetAdminLocale::class,
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
