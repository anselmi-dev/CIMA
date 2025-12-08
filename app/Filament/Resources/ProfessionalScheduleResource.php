<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalScheduleResource\Pages;
use App\Filament\Resources\ProfessionalScheduleResource\RelationManagers;
use App\Models\ProfessionalSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Get;

class ProfessionalScheduleResource extends Resource
{
    protected static ?string $model = ProfessionalSchedule::class;

    protected static ?string $navigationGroup = 'Professionals';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::when(!app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin'), function ($query) {
            return $query->where('professional_id', auth()->user()->professional->id);
        })->count();
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema(...self::getComponentSchedule());
    }

    public static function getComponentSchedule ()
    {
        return [
            Forms\Components\Select::make('day_of_week')
                ->label('Día de la Semana')
                ->options(static::get_day_of_week())
                ->required()
                ->columnSpanFull()
                ->disabled(),
                
            Forms\Components\CheckboxList::make('time')
                ->label(__('resources/professional_schedule.labels.time'))
                ->options([
                    '7' => '7:00',
                    '8' => '8:00',
                    '9' => '9:00',
                    '10' => '10:00',
                    '11' => '11:00',
                    '12' => '12:00',
                    '13' => '13:00',
                    '14' => '14:00',
                    '15' => '15:00',
                    '16' => '16:00',
                    '17' => '17:00',
                    '18' => '18:00',
                    '19' => '19:00',
                    '20' => '20:00',
                    '21' => '21:00',
                ])
                ->columnSpanFull()
                ->bulkToggleable(),
            
        ];
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('id'))
                    ->sortable()
                    ->searchable()
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('professional.user.name')
                    ->label('Profesional')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Día de la Semana')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return static::get_day_of_week()[(int)$state] ?? '';
                    }),
                Tables\Columns\TextColumn::make('time')
                    ->label('Horario')
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
            ->defaultSort('id', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            // Define any relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalSchedules::route('/'),
            'edit' => Pages\EditProfessionalSchedule::route('/{record}/edit'),
        ];
    }

    public static function query(): Builder
    {
        return parent::query()->orderBy('day_of_week');
    }

    protected static function get_day_of_week(): array
    {
        return [
            Carbon::SUNDAY => 'Domingo',
            Carbon::MONDAY => 'Lunes',
            Carbon::TUESDAY => 'Martes',
            Carbon::WEDNESDAY => 'Miércoles',
            Carbon::THURSDAY => 'Jueves',
            Carbon::FRIDAY => 'Viernes',
            Carbon::SATURDAY => 'Sabado',
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