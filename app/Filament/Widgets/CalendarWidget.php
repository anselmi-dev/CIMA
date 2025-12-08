<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment as Event;
use Carbon\Carbon;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Actions;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Event::class;

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // This method should return an array of event-like objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#returning-events
        // You can also return an array of EventData objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#the-eventdata-class
        // return [];
        $is_admin = app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');

        return Event::whereDate('start_at', '>=', $fetchInfo['start'])
            ->whereDate('end_at', '<=', $fetchInfo['end'])
            ->with('patient')
            ->with('professional')
            ->when(!$is_admin, function ($query) {
                $query->where('professional_id', auth()->user()->professional->id);
            })
            ->get()
            ->map(
                fn (Event $event) => [
                    "id" => $event->id,
                    'title' => "{$event->professional->user->name} con el paciente {$event->patient->name} {$event->patient->lastname}",
                    'start' => $event->start_at,
                    'end' => $event->end_at,
                    'display' => 'auto',
                    'description' => 'Lecture',
                    // 'url' => AppointmentResource::getUrl('edit', ['record' => $event]),
                    'backgroundColor' => '#' . substr(md5($event->professional->id), 0, 6),
                    'borderColor' => '#' . substr(md5($event->professional->id), 0, 6),
                    // 'backgroundColor' => Carbon::parse($event->start_at)->isPast() ? '#9ca3af' : '#8BC34A',
                    // 'borderColor' => Carbon::parse($event->start_at)->isPast() ? '#9ca3af' : '#8BC34A',
                    // 'shouldOpenModal' => true,
                    "shouldOpenUrlInNewTab" => false
                ]
            )
            ->all();
    }

    protected function headerActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
 
    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('professional_id')
                ->label(__('resources/appointment.labels.professional'))
                ->relationship('professional', 'rut')
                ->required(),
            Forms\Components\Select::make('patient_id')
                ->label(__('resources/appointment.labels.patient'))
                ->relationship('patient', 'name')
                ->required(),
            Forms\Components\DateTimePicker::make('start_at')
                ->label(__('resources/appointment.labels.start_at'))
                ->required(),
            Forms\Components\DateTimePicker::make('end_at')
                ->label(__('resources/appointment.labels.end_at'))
                ->required(),
            Forms\Components\Select::make('status')
                ->label(__('resources/appointment.labels.status'))
                ->options([
                    'pending' => 'Pendiente',
                    'confirmed' => 'Confirmada',
                    'cancelled' => 'Cancelada',
                ])
                ->default('pending')
                ->required(),
        ];
    }

}