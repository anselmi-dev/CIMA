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
                Forms\Components\Select::make('bank')
                    ->label(__('resources/admin_bank_account.labels.bank_name'))
                    ->relationship('bank', 'name')
                    ->options(Bank::all()->pluck('name', 'id'))
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('bank_details.full_name')
                    ->label(__('resources/admin_bank_account.labels.full_name'))
                    ->required(),
                Forms\Components\TextInput::make('bank_details.email')
                    ->label(__('resources/admin_bank_account.labels.email'))
                    ->required(),
                Forms\Components\TextInput::make('bank_details.account_number')
                    ->label(__('resources/admin_bank_account.labels.account_number'))
                    ->required(),
                Forms\Components\Select::make('bank_details.account_type')
                    ->label(__('resources/admin_bank_account.labels.account_type'))
                    ->options([
                        'ahorro' => 'Cuenta de Ahorro',
                        'corriente' => 'Cuenta Corriente',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label(__('resources/admin_bank_account.labels.notes'))
                    ->columnSpanFull()
                    ->nullable(),
                Forms\Components\Toggle::make('status')
                    ->label(__('resources/admin_bank_account.labels.status'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/admin_bank_account.labels.id'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank.name')
                    ->label(__('resources/admin_bank_account.labels.bank_name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bank_details')
                    ->label(__('resources/admin_bank_account.labels.bank_details'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('resources/admin_bank_account.labels.status'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/admin_bank_account.labels.created_at'))->dateTime()->sortable(),
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