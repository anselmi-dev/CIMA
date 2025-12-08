<?php

namespace App\Filament\Resources\MedicalSpecialtyResource\Pages;

use App\Filament\Resources\MedicalSpecialtyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalSpecialty extends EditRecord
{
    protected static string $resource = MedicalSpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
