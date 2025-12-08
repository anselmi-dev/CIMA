<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationGroup = 'Pacientes';
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::when(!app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin'), function ($query) {
            return $query->where('professional_id', auth()->user()->professional->id);
        })->count();
    }

    public static function getTitle(): string
    {
        return static::getLabel();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/appointment.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/appointment.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/appointment.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin') ?  Forms\Components\Select::make('professional_id')
                    ->label(__('resources/appointment.labels.professional'))
                    ->relationship('professional.user', 'name')
                    ->getOptionLabelUsing(fn ($user) => "{$user->name} {$user->last_name}")
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('patient_id', null))
                    ->required()
                    : Forms\Components\Hidden::make('professional_id')
                    ->default(fn () => auth()->user()->professional->id),

                    
                Forms\Components\Select::make('patient_id')
                    ->label(__('resources/appointment.labels.patient'))
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} {$record->lastname} ({$record->rut})")
                    ->relationship(
                        name: 'patient',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query, $get) => $query->when($get('professional_id'), function ($query) use ($get) {
                            $query->where('professional_id', $get('professional_id'));
                        })
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->createOptionForm(fn ($form, $get) => \App\Filament\Resources\PatientResource::form($form, $get('professional_id')))
                    ->disabled(fn ($get) => is_null($get('professional_id'))),

                Forms\Components\DateTimePicker::make('start_at')
                    ->label(__('resources/appointment.labels.start_at'))
                    ->seconds(false)
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label(__('resources/appointment.labels.status'))
                    ->options([
                        'pending' => __("status:pending"),
                        'scheduled' => __("status:scheduled"),
                        'completed' => __("status:completed"),
                        'cancelled' => __("status:cancelled"),
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/appointment.labels.id'))
                    ->sortable()
                    ->searchable()
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('patient.professional.user.name')
                    ->label(__('resources/appointment.labels.professional'))
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-m-user-circle')
                    ->color('primary')
                    ->url(fn ($record) => route('filament.admin.resources.professionals.edit', $record->patient->professional_id))
                    ->hidden(function () {
                        return !app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('patient.name')
                    ->label(__('resources/appointment.labels.patient'))
                    ->sortable()
                    ->color('primary')
                    ->url(fn ($record) => route('filament.admin.resources.patients.edit', $record->patient->id)),
                Tables\Columns\TextColumn::make('start_at')
                    ->label(__('resources/appointment.labels.date'))
                    ->sortable()
                    ->getStateUsing(function (Appointment $record) {
                        return "{$record->start_at->format('Y-m-d H:i')} a {$record->end_at->format('H:i')}";
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(fn (Appointment $record) => $record->status)
                    ->label(__('resources/appointment.labels.status'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/appointment.labels.created_at'))->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('medical_speciality')
                    ->label(__('resources/medical_speciality.navigation_label'))
                    ->options([
                        'pending' => __("status:pending"),
                        'scheduled' => __("status:scheduled"),
                        'completed' => __("status:completed"),
                        'cancelled' => __("status:cancelled"),
                    ])
                    ->multiple()
                    ->query(function ($query, $data) {
                        $query->when(optional($data)['values'], function ($query, $data) {
                            $query->whereIn('status', $data);
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\DeleteBulkAction::make(),
        ])
        ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Define any relation managers here
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        return $query->when(!app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin'), function ($query) {
            return $query->where('professional_id', auth()->user()->professional->id);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}