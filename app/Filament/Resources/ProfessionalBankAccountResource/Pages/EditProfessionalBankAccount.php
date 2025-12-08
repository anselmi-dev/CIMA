<?php

namespace App\Filament\Resources\ProfessionalBankAccountResource\Pages;

use App\Filament\Resources\ProfessionalBankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalBankAccount extends EditRecord
{
    protected static string $resource = ProfessionalBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
