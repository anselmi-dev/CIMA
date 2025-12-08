<?php

namespace App\Filament\Resources\MedicalSpecialtyResource\Pages;

use App\Filament\Resources\MedicalSpecialtyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalSpecialties extends ListRecords
{
    protected static string $resource = MedicalSpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
