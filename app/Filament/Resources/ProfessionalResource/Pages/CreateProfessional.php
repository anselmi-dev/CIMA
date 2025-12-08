<?php

namespace App\Filament\Resources\ProfessionalResource\Pages;

use App\Filament\Resources\ProfessionalResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Form;

class CreateProfessional extends CreateRecord
{
    protected static string $resource = ProfessionalResource::class;


    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $data['user_id'] = $user->id;

        return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                ...[
                    Forms\Components\Section::make(__('Datos de usuario'))
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label(__('resources/user.labels.name'))
                                ->required()
                                ->maxLength(255),
                        
                            Forms\Components\TextInput::make('last_name')
                                ->label(__('resources/user.labels.last_name'))
                                ->required()
                                ->maxLength(255),
                        
                            Forms\Components\TextInput::make('email')
                                ->unique(User::class, 'email', ignoreRecord: true)
                                ->label(__('resources/user.labels.email'))
                                ->required()
                                ->maxLength(255),
                        
                            Forms\Components\TextInput::make('password')
                                ->label(__('resources/user.labels.password'))
                                ->password()
                                ->required()
                                ->maxLength(255),
                                
                            Forms\Components\Toggle::make('notification')
                                ->label(__('resources/user.labels.notification'))
                                ->default(false),
                        ])
                        ->columns(2),
                ],
                ...[
                    Forms\Components\Section::make(__('Datos profesional'))
                        ->schema(ProfessionalResource::form($form)->getComponents())
                        ->columns(2),
                ],
            ]);
    }
}
