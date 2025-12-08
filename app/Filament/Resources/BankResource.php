<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Administración';
    
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
        return __('resources/bank.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/bank.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/bank.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('resources/bank.labels.name'))
                    ->unique(Bank::class, 'name', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('name')->label(__('resources/bank.labels.name'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/bank.labels.created_at'))->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('resources/bank.labels.updated_at'))->dateTime()->sortable(),
            ])
            ->filters([
                // Define los filtros aquí si es necesario
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanks::route('/'),
            // 'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
