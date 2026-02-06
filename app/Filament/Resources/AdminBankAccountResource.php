<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminBankAccountResource\Pages;
use App\Models\AdminBankAccount;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdminBankAccountResource extends Resource
{
    protected static ?string $model = AdminBankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

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
        return __('resources/admin_bank_account.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/admin_bank_account.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/admin_bank_account.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bank_id')
                    ->label(__('resources/admin_bank_account.labels.bank_name'))
                    ->relationship('bank', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('bank_details.full_name')
                    ->label(__('resources/admin_bank_account.labels.full_name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_details.rut')
                    ->label(__('resources/admin_bank_account.labels.rut'))
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('bank_details.email')
                    ->label(__('resources/admin_bank_account.labels.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_details.account_number')
                    ->label(__('resources/admin_bank_account.labels.account_number'))
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('bank_details.account_type')
                    ->label(__('resources/admin_bank_account.labels.account_type'))
                    ->options([
                        'ahorro' => 'Cuenta de Ahorro',
                        'corriente' => 'Cuenta Corriente',
                    ])
                    ->default('corriente'),
                Forms\Components\Textarea::make('notes')
                    ->label(__('resources/admin_bank_account.labels.notes'))
                    ->columnSpanFull()
                    ->nullable()
                    ->rows(3),
                Forms\Components\Toggle::make('status')
                    ->label(__('resources/admin_bank_account.labels.status'))
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/admin_bank_account.labels.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank.name')
                    ->label(__('resources/admin_bank_account.labels.bank_name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_details.full_name')
                    ->label(__('resources/admin_bank_account.labels.full_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_details.account_number')
                    ->label(__('resources/admin_bank_account.labels.account_number'))
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('resources/admin_bank_account.labels.status'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('resources/admin_bank_account.labels.created_at'))
                    ->dateTime()
                    ->sortable(),
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
            ]);
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
            'index' => Pages\ListAdminBankAccounts::route('/'),
            'create' => Pages\CreateAdminBankAccount::route('/create'),
            'edit' => Pages\EditAdminBankAccount::route('/{record}/edit'),
        ];
    }
}
