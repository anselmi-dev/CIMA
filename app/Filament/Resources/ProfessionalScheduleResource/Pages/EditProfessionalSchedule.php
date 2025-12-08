<?php

namespace App\Filament\Resources\ProfessionalScheduleResource\Pages;

use App\Filament\Resources\ProfessionalScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalSchedule extends EditRecord
{
    protected static string $resource = ProfessionalScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
