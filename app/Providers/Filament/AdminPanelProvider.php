<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources;
use Filament\Support\Enums\MaxWidth;

use App\Filament\Pages\Profile;
use Filament\Navigation\MenuItem;

use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

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
            ->profile(EditProfile::class)
            ->userMenuItems([
            ])
            ->maxContentWidth(MaxWidth::ScreenTwoExtraLarge)
            ->resources([
                Resources\AppointmentResource::class,
                Resources\ProfessionalResource::class,
                Resources\BankResource::class,
                Resources\PatientResource::class,
                Resources\MedicalSpecialtyResource::class,
                Resources\AdminBankAccountResource::class,
                Resources\TransactionResource::class,
                // Resources\ProfessionalScheduleResource::class,
                Resources\ProfessionalBankAccountResource::class,
                Resources\FaqResource::class,
                Resources\PageResource::class,
            ])
            ->plugins([
                FilamentFullCalendarPlugin::make()
            ])
            ->plugin(\RickDBCN\FilamentEmail\FilamentEmail::make())
            // ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\AdminPanelPage::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                \App\Filament\Widgets\AppStats::class,
                \App\Filament\Widgets\AppointmentChart::class,
                \App\Filament\Widgets\CalendarWidget::class,
                \App\Filament\Resources\AppointmentResource\Widgets\TransferWidget::class,
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
