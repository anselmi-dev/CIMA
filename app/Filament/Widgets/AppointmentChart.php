<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AppointmentChart extends ChartWidget
{
    protected static ?string $heading = 'Citas en los últimos 7 días';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        // $data = Trend::model(Appointment::class)
        //     ->dateColumn('start_at')
        //     ->between(
        //         start: now()->subDays(7),
        //         end: now(),
        //     )
        //     ->perDay()
        //     ->count();
        
        $is_admin = app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
        
        $startDate = now()->subDays(7)->startOfDay();
        $endDate = now()->endOfDay();

        $appointments = Appointment::query()
            ->when(!$is_admin, function ($query) {
                $query->where('professional_id', auth()->user()->professional->id);
            })
            ->select(DB::raw('DATE(start_at) as date'), DB::raw('COUNT(*) as aggregate'))
            ->whereBetween('start_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(start_at)'))
            ->orderBy('start_at')
            ->get()
            ->pluck('aggregate', 'date');

        $data = collect();

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {

            $formattedDate = $date->toDateString();

            $data->push((object) [
                'date' => $formattedDate,
                'aggregate' => $appointments[$formattedDate] ?? 0
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total de citas',
                    'data' => $data->map(fn ($value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn ($value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}