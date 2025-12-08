<?php

namespace App\Filament\Resources\ProfessionalResource\Pages;

use App\Filament\Resources\ProfessionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessional extends EditRecord
{
    protected static string $resource = ProfessionalResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function getNavigationLabel(): string
    {
        return 'Datos profesional';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function afterSave ()
    {
        $record = $this->getRecord();

        if (count($this->data['profile_photo_path']) == 0)
            $record->user->update(['profile_photo_path' => null]);
        
        foreach ($this->data['profile_photo_path'] as $key => $value) {
            $record->user->update(['profile_photo_path' => $value]);
        }
    }
}
