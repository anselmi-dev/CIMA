<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Professional;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AppStats extends BaseWidget
{
    protected function getStats(): array
    {
        $is_admin = app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
        
        return [
            
            // $is_admin ? Stat::make('Total de profesionales', Professional::count())->url(route('filament.admin.resources.professionals.index')) : null,

            Stat::make('Total de pacientes', Patient::when(!$is_admin, function ($query) {
                $query->where('professional_id', auth()->user()->professional->id);
            })->count())->url(route('filament.admin.resources.patients.index')),

            Stat::make('Total de citas', Appointment::when(!$is_admin, function ($query) {
                $query->where('professional_id', auth()->user()->professional->id);
            })->count())->url(route('filament.admin.resources.appointments.index')),
        ];
    }
}
