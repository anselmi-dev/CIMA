<?php

namespace App\Filament\Resources\ProfessionalScheduleResource\Pages;

use App\Filament\Resources\ProfessionalScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalSchedules extends ListRecords
{
    protected static string $resource = ProfessionalScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
