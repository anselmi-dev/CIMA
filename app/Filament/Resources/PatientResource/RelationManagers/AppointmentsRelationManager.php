<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    protected static ?string $recordTitleAttribute = 'date';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return static::getPluralLabel();
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

    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('professional_id')
                    ->label(__('resources/appointment.labels.professional'))
                    ->relationship('professional', 'user.name')
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label(__('resources/appointment.labels.date'))
                    ->required(),

                Forms\Components\TimePicker::make('start_at')
                    ->label(__('resources/appointment.labels.start_at'))
                    ->required(),

                Forms\Components\TimePicker::make('end_at')
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')->label(__('resources/appointment.labels.id'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('professional.user.name')->label(__('resources/appointment.labels.professional'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date')->label(__('resources/appointment.labels.date'))->date()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_at')->label(__('resources/appointment.labels.start_at'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('end_at')->label(__('resources/appointment.labels.end_at'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->label(__('resources/appointment.labels.status'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/appointment.labels.created_at'))->dateTime()->sortable(),
            ])
            ->filters([
                // Define any filters here
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}