<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalSpecialtyResource\Pages;
use App\Filament\Resources\MedicalSpecialtyResource\RelationManagers;
use App\Models\MedicalSpecialty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalSpecialtyResource extends Resource
{
    protected static ?string $model = MedicalSpecialty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Professionals';

    protected static ?int $navigationSort = 1;
    
    public static function canAccess(): bool
    {
        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::count();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/medical_speciality.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/medical_speciality.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/medical_speciality.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('resources/medical_speciality.labels.name'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(__('resources/medical_speciality.labels.description'))
                    ->maxLength(1000)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('resources/medical_speciality.labels.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->sortable()
                    ->label(__('resources/medical_speciality.labels.description'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('resources/medical_speciality.labels.created_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('resources/medical_speciality.labels.updated_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Define los filtros aquí si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalSpecialties::route('/'),
            // 'create' => Pages\CreateMedicalSpecialty::route('/create'),
            // 'edit' => Pages\EditMedicalSpecialty::route('/{record}/edit'),
        ];
    }
}
