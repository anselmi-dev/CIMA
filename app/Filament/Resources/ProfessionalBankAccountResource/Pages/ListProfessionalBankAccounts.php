<?php

namespace App\Filament\Resources\ProfessionalBankAccountResource\Pages;

use App\Filament\Resources\ProfessionalBankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalBankAccounts extends ListRecords
{
    protected static string $resource = ProfessionalBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
