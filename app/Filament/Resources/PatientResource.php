<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\PatientResource\RelationManagers\AppointmentsRelationManager;
use Illuminate\Contracts\Auth\Access\Gate;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationGroup = 'Pacientes';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::when(!app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin'), function ($query) {
            return $query->where('professional_id', auth()->user()->professional->id);
        })->count();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/patient.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/patient.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/patient.plural_label');
    }

    public static function form(Form $form, $professional_id = null): Form
    {
        return $form
            ->schema([
                app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin') ?  Forms\Components\Select::make('professional_id')
                    ->label(__('resources/appointment.labels.professional'))
                    ->relationship('professional.user', 'name')
                    ->getOptionLabelUsing(fn ($user) => "{$user->name} {$user->last_name}")
                    ->afterStateHydrated(function (Forms\Components\Select $component, $state) use ($professional_id) {
                        if (!is_null($professional_id)) {
                            $component->state($professional_id);
                        }
                    })
                    ->preload()
                    ->required()
                    :  Forms\Components\Hidden::make('professional_id')
                        ->default(fn () => auth()->user()->professional->id),

                Forms\Components\TextInput::make('name')
                    ->label(__('resources/patient.labels.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('lastname')
                    ->label(__('resources/patient.labels.lastname'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('rut')
                    ->label(__('resources/patient.labels.rut'))
                    ->required()
                    ->unique(Patient::class, 'rut', ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\DatePicker::make('birthday')
                    ->label(__('resources/patient.labels.birthday'))
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label(__('resources/patient.labels.email'))
                    ->email()
                    ->required()
                    ->unique(Patient::class, 'rut', ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label(__('resources/patient.labels.phone'))
                    ->required()
                    ->maxLength(15)
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->placeholder('123-456-7890'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/professional.labels.id'))
                    ->sortable()
                    ->searchable()
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('professional.user.name')
                    ->label(__('resources/professional.labels.professional'))
                    ->sortable()
                    ->searchable()
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('name')->label(__('resources/patient.labels.name'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('lastname')->label(__('resources/patient.labels.lastname'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('rut')->label(__('resources/patient.labels.rut'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('birthday')->label(__('resources/patient.labels.birthday'))->date()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label(__('resources/patient.labels.email'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__('resources/patient.labels.phone'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/patient.labels.created_at'))->dateTime()->sortable(),
            ])
            ->filters([
                // Define any filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            AppointmentsRelationManager::class,
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}