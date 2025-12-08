<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\MorphToSelect;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\IconColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    // protected static ?string $navigationIcon = 'heroicon-o-cash';

    public static function canAccess(): bool
    {
        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
    }
    
    protected static ?string $navigationGroup = 'Administración';

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::count();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/transaction.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/transaction.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/transaction.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transactionable_type')
                    ->label(__('resources/transaction.labels.transactionable_type'))
                    ->options([
                        'App\Models\User' => 'Pago de Professional',
                    ])
                    ->required(),

                Forms\Components\Select::make('transactionable_id')
                    ->label(__('resources/professional.label'))
                    ->options(
                        \App\Models\User::with('professional')->has('professional')->get()->mapWithKeys(function ($user) {
                            return [$user->id => "{$user->name} {$user->last_name} - {$user->professional->rut}"];
                        })
                    )
                    ->preload()
                    ->suffixIcon('heroicon-o-user-group')
                    ->searchable()
                    ->required(),

                // MorphToSelect::make('transactionable')
                //     ->types([
                //         MorphToSelect\Type::make(\App\Models\User::class)
                //             ->label('Pago de Professional')
                //             ->modifyOptionsQueryUsing(fn (Builder $query) => $query->with('professional')->has('professional'))
                //             ->getOptionLabelFromRecordUsing(fn (\App\Models\User $record): string => "{$record->name} {$record->last_name} - {$record->professional->rut}")
                //     ])
                //     ->columns(2)
                //     ->columnSpanFull(),

                Forms\Components\TextInput::make('amount')
                    ->label(__('resources/transaction.labels.amount'))
                    ->numeric()
                    ->prefix('$')
                    ->placeholder('0.00')
                    ->minValue(1)
                    ->required(),

                Forms\Components\DatePicker::make('payment_date')
                    ->label(__('resources/transaction.labels.payment_date'))
                    ->required(),

                Forms\Components\Select::make('method')
                    ->label(__('resources/transaction.labels.method'))
                    ->options([
                        'credit_card' => 'Tarjeta de Crédito',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Transferencia Bancaria',
                    ])
                    ->required(),

                SpatieMediaLibraryFileUpload::make('attachment')
                    ->label(__('resources/transaction.labels.attachment'))
                    ->disk('public')
                    ->conversion('thumb')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('notes')
                    ->label(__('resources/transaction.labels.notes'))
                    ->nullable()
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('notify')
                    ->label('Notificación enviada el:')
                    ->readOnly()
                    ->format('d/m/Y')
                    ->visible(fn ($record) => $record && !is_null($record->notify)),

                Forms\Components\Toggle::make('notification')
                    ->label(__('resources/transaction.labels.notify'))
                    ->visible(fn ($record) => $record && is_null($record->notify))
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        if ($state) {
                            $set('notify', now());
                        } else {
                            $set('notify', null);
                        }
                    })
                    ->columnSpanFull(),

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
                // Tables\Columns\TextColumn::make('transactionable_type')->label(__('resources/transaction.labels.transactionable_type'))->sortable()->searchable()
                Tables\Columns\TextColumn::make('transactionable_id')
                    ->label(__('resources/professional.label'))
                    ->formatStateUsing(function ($state) {
                        $user = \App\Models\User::find($state);
                        
                        return $user ? "{$user->name} {$user->last_name} - {$user->professional->rut}" : null;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->prefix('$')
                    ->label(__('resources/transaction.labels.amount'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_date')->label(__('resources/transaction.labels.payment_date'))->date()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('method')->label(__('resources/transaction.labels.method'))->sortable()->searchable(),
                // Tables\Columns\BooleanColumn::make('notify')->label(__('Notificado'))->sortable()->searchable(),
                IconColumn::make('notify')
                    ->tooltip(__('resources/transaction.labels.notify'))
                    ->boolean()
                    ->label(__('Notificado')),
                    // ->trueIcon('heroicon-o-badge-check')
                    // ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/transaction.labels.created_at'))->dateTime()->sortable(),
            ])
            ->filters([
                // Define any filters here
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
            // Define any relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}