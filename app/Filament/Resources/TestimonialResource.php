<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?string $navigationLabel = 'Testimonios';

    protected static ?string $modelLabel = 'Testimonio';

    protected static ?string $pluralModelLabel = 'Testimonios';

    protected static ?int $navigationSort = 102;

    public static function canAccess(): bool
    {
        return app(\Illuminate\Contracts\Auth\Access\Gate::class)->allows('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('role')
                    ->label('Rol o cargo (opcional)')
                    ->placeholder('Ej: Paciente, Dr. García')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('content')
                    ->label('Testimonio')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Select::make('rating')
                    ->label('Valoración (1-5)')
                    ->options([
                        1 => '1 estrella',
                        2 => '2 estrellas',
                        3 => '3 estrellas',
                        4 => '4 estrellas',
                        5 => '5 estrellas',
                    ])
                    ->nullable(),
                Forms\Components\Toggle::make('active')
                    ->label('Visible en la web')
                    ->default(true),
                Forms\Components\TextInput::make('sort')
                    ->label('Orden')
                    ->numeric()
                    ->default(fn () => (int) Testimonial::max('sort') + 1)
                    ->required()
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->label('Orden')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->searchable()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Testimonio')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Valoración')
                    ->formatStateUsing(fn ($state) => $state ? "{$state} ★" : '—')
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Visible')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort')
            ->reorderable('sort')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
