<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalResource\Pages;
use App\Filament\Resources\ProfessionalResource\Pages\EditProfessional;
use App\Filament\Resources\ProfessionalResource\Pages\ManagerUser;
use App\Filament\Resources\ProfessionalResource\RelationManagers;
use App\Models\MedicalSpecialty;
use App\Models\Professional;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Contracts\Auth\Access\Gate;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\MaxWidth;

use Filament\Tables\Enums\FiltersLayout;

class ProfessionalResource extends Resource
{
    protected static ?string $model = Professional::class;

    protected static ?string $navigationGroup = 'Professionals';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
        return __('resources/professional.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/professional.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/professional.plural_label');
    }

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditProfessional::class,
            Pages\ManagerUser::class,
            Pages\ProfessionalBankAccount::class,
            Pages\ProfessionalSchedule::class,
            // RelationManagers\ProfessionalBankAccountManager::class
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('profile_photo_path')
                    ->label('Foto de perfil')
                    ->avatar()
                    ->disk('public')
                    ->directory('profile')
                    ->image()
                    ->visibility('public')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('rut')
                    ->unique(Professional::class, 'rut', ignoreRecord: true)
                    ->label(__('resources/professional.labels.rut'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label(__('resources/professional.labels.phone'))
                    ->tel()
                    ->required()
                    ->maxLength(15),

                Forms\Components\Select::make('medical_specialties')
                    ->label(__('resources/medical_speciality.navigation_label'))
                    ->multiple()
                    ->relationship('medicalSpecialties', 'name')
                    ->options(MedicalSpecialty::all()->pluck('name', 'id'))
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('bio')
                    ->label(__('resources/professional.labels.bio'))
                    ->maxLength(1000)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25)
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/professional.labels.id'))
                    ->sortable()
                    ->searchable()
                    ->visible(function() {
                        return app(Gate::class)->allows('admin');
                    }),
                Tables\Columns\ImageColumn::make('user.profile_photo_path')
                    ->label(__('Foto'))
                    ->circular()
                    ->disk('public'),
                    
                Tables\Columns\TextColumn::make('user.name')->label(__('resources/professional.labels.user_name'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.last_name')->label(__('resources/professional.labels.user_last_name'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.email')->label(__('resources/professional.labels.user_email'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('medicalSpecialties.name')
                    ->label(__('resources/medical_speciality.navigation_label')),
                Tables\Columns\TextColumn::make('phone')->label(__('resources/professional.labels.phone'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('resources/professional.labels.created_at'))->dateTime()->sortable(),
            ])
			->filters([
                SelectFilter::make('medical_speciality')
                    ->label(__('resources/medical_speciality.navigation_label'))
                    ->options(MedicalSpecialty::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->query(function (Builder $query, $data) {
                        $query->when($data['values'], function ($query) use ($data) {
                            $query->whereHas('medicalSpecialties', function ($query) use ($data) {
                                $query->whereIn('medical_specialty_id', $data['values']);
                            });
                        });
                    }),
                // SelectFilter::make('status')
                //     ->label("Estado")
                //     ->options([
                //         'pending' => 'Pendiente',
                //         'progress' => 'En proceso',
                //         'cancelled' => 'Cancelado',
                //         'completed' => 'Compleatado',

                //     ])->attribute('status')
			], layout: FiltersLayout::Modal)
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->deferFilters()
			->persistFiltersInSession()
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionals::route('/'),
            'create' => Pages\CreateProfessional::route('/create'),
            'edit' => Pages\EditProfessional::route('/{record}/edit'),
            'manageUser' => Pages\ManagerUser::route('/{record}/manage-user'),
            'bank-account' => Pages\ProfessionalBankAccount::route('/{record}/bank-account'),
            'schedule' => Pages\ProfessionalSchedule::route('/{record}/schedule'),
        ];
    }
}