<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalBankAccountResource\Pages;
use App\Filament\Resources\ProfessionalBankAccountResource\RelationManagers;
use App\Models\ProfessionalBankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfessionalBankAccountResource extends Resource
{
    protected static ?string $model = ProfessionalBankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    // protected static ?string $navigationGroup = 'Professionals';
    protected static ?string $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::count();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/professional_bank_account.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/professional_bank_account.label');
    }
    
    public static function getPluralLabel(): string
    {
        return __('resources/professional_bank_account.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...[
                    app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin') ? Forms\Components\Select::make('professional_id')
                        ->label('Professional')
                        ->relationship('professional.user', 'name')
                        ->required() : 
                        Forms\Components\Hidden::make('professional_id')
                            ->default(fn () => auth()->user()->professional->id),
                ],
                ...self::getComponentBankDetails(),
            ]);
    }

    public static function getComponentBankDetails ()
    {
        return [
            Forms\Components\TextInput::make('bank_details.full_name')
                ->label('Nombre completo del titular de la cuenta')
                ->required(),
            Forms\Components\TextInput::make('bank_details.email')
                ->label(__('resources/admin_bank_account.labels.email'))
                ->required(),
            Forms\Components\TextInput::make('bank_details.bank_name')
                ->label('Nombre del Banco')
                ->required(),
            Forms\Components\TextInput::make('bank_details.account_number')
                ->label('Número de cuenta bancaria')
                ->required(),
            Forms\Components\Select::make('bank_details.account_type')
                ->label('Tipo de cuenta')
                ->options([
                    'ahorro' => 'Cuenta de Ahorro',
                    'corriente' => 'Cuenta Corriente',
                ])
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->label(__('resources/professional_bank_account.labels.notes'))
                ->columnSpanFull()
                ->nullable(),
    ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('resources/professional_bank_account.labels.id'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('professional.user.name')
                    ->label(__('resources/professional_bank_account.labels.professional'))
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-m-user-circle')
                    ->color('primary')
                    ->url(fn ($record) => route('filament.admin.resources.professionals.edit', $record->professional_id))
                    ->visible(function() {
                        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
                    }),
                Tables\Columns\TextColumn::make('bank_details')
                    ->label(__('resources/professional_bank_account.labels.bank_details'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('resources/professional_bank_account.labels.status'))
                    ->sortable()
                    ->searchable()
                    ->disabled(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/professional_bank_account.labels.created_at'))->dateTime()->sortable(),
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
            ->defaultSort('id', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return $query->when(!app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin'), function ($query) {
            return $query->where('professional_id', auth()->user()->professional->id);
        });
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
            'index' => Pages\ListProfessionalBankAccounts::route('/'),
            'create' => Pages\CreateProfessionalBankAccount::route('/create'),
            'edit' => Pages\EditProfessionalBankAccount::route('/{record}/edit'),
        ];
    }
}