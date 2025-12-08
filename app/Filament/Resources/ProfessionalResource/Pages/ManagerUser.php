<?php

namespace App\Filament\Resources\ProfessionalResource\Pages;

use App\Filament\Resources\ProfessionalResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\EditUser as EditRecord;
use App\Filament\Resources\UserResource;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ManagerUser extends EditRecord
{
    protected static string $resource = ProfessionalResource::class;

    protected static string $relationship = 'user';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public function getTitle(): string | Htmlable
    {
        return $this->getNavigationLabel();
    }

    public static function getNavigationLabel(): string
    {
        return 'Datos de usuario';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('last_name')
                ->label('Apellido')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('Correo Electrónico')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique('users', 'email', fn ($record) => $record ? $record->user : null, ignoreRecord: true),
        ]);
    }

    public function table(Table $table): Table
    {
        return UserResource::table($table);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = $this->record->user;

        return $user ? $user->toArray() : [];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $user = $this->record->user;

        if ($user) {
            $user->update($data);
        } else {
            $this->record->user()->create($data);
        }

        return $this->record->user;
    }
}
