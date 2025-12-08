<?php

namespace App\Filament\Resources\ProfessionalResource\Pages;

use App\Filament\Resources\ProfessionalScheduleResource;
use App\Filament\Resources\ProfessionalResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ProfessionalSchedule extends ManageRelatedRecords
{
    public bool $showOnlyWithSchedules = false;
    protected static string $resource = ProfessionalResource::class;

    protected static string $relationship = 'schedules';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public bool $showPresence = true;

    public function getTitle(): string | Htmlable
    {
        return $this->getNavigationLabel();
    }

    public static function getNavigationLabel(): string
    {
        return 'Horarios';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(ProfessionalScheduleResource::getComponentSchedule());
    }

    public function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('is_presence', $this->showPresence);
            })
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Día de la Semana')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return self::get_day_of_week()[(int)$state] ?? '';
                    }),

                Tables\Columns\TextColumn::make('time')
                    ->label(fn () => $this->showPresence ? 'Horario presencial' : 'Horario telemedicina')
                    ->searchable()
                    ->formatStateUsing(function ($state) {

                        if (is_string($state)) {
                            $state = explode(', ', $state);
                        }

                        return self::formatTimeRanges($state);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('toggleView')
                    ->label(fn () => !$this->showPresence ? 'Ver horario presencial' : 'Ver horario de telemedicina')
                    ->color($this->showPresence ? 'success' : 'danger')                    
                    ->size(ActionSize::Large)
                    ->action(function () {

                        $this->showPresence = !$this->showPresence;
                        
                        $this->resetTable();
                    })
            ])
            ->defaultSort('day_of_week', 'desc'); 
    }

    protected static function get_day_of_week(): array
    {
        return [
            \Carbon\Carbon::SUNDAY => 'Domingo',
            \Carbon\Carbon::MONDAY => 'Lunes',
            \Carbon\Carbon::TUESDAY => 'Martes',
            \Carbon\Carbon::WEDNESDAY => 'Miércoles',
            \Carbon\Carbon::THURSDAY => 'Jueves',
            \Carbon\Carbon::FRIDAY => 'Viernes',
            \Carbon\Carbon::SATURDAY => 'Sabado',
        ];
    }


    protected static function formatTimeRanges(array $times): string
    {
        sort($times);
        $ranges = [];
        $start = $times[0];
        $end = $times[0];

        for ($i = 1; $i < count($times); $i++) {
            if ($times[$i] == $end + 1) {
                $end = $times[$i];
            } else {
                $ranges[] = $start == $end ? "$start:00" : "$start:00-$end:00";
                $start = $times[$i];
                $end = $times[$i];
            }
        }

        $ranges[] = $start == $end ? "$start:00" : "$start:00-$end:00";

        if (count($ranges))
            return implode(', ', $ranges);

        return 'SIN HORARIOS';
    }
}