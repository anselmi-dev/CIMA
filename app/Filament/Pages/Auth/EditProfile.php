<?php
 
namespace App\Filament\Pages\Auth;

use App\Livewire\Professional;
use App\Models\MedicalSpecialty;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Forms;
use Illuminate\Contracts\Auth\Access\Gate;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                
                Forms\Components\FileUpload::make('profile_photo_path')
                    ->label('Foto de perfil')
                    ->avatar()
                    ->disk('public')
                    ->directory('profile')
                    ->image()
                    ->visibility('public'),

                TextInput::make('last_name')
                    ->label('Apellido')
                    ->required()
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->label('Apellido')
                    ->required()
                    ->maxLength(255),

                $this->getEmailFormComponent(),

                Forms\Components\TextInput::make('rut')
                    ->unique(Professional::class, 'rut', ignoreRecord: true)
                    ->label(__('resources/professional.labels.rut'))
                    ->required()
                    ->visible(function() {
                        return !app(Gate::class)->allows('admin');
                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label(__('resources/professional.labels.phone'))
                    ->tel()
                    ->required()
                    ->visible(function() {
                        return !app(Gate::class)->allows('admin');
                    })
                    ->maxLength(15),


                Forms\Components\Textarea::make('bio')
                    ->label(__('resources/professional.labels.bio'))
                    ->maxLength(1000)
                    ->visible(function() {
                        return !app(Gate::class)->allows('admin');
                    })
                    ->columnSpanFull(),

                $this->getPasswordFormComponent(),

                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}