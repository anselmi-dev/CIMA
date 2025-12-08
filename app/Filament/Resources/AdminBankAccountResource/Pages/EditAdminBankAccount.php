<?php

namespace App\Filament\Resources\AdminBankAccountResource\Pages;

use App\Filament\Resources\AdminBankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminBankAccount extends EditRecord
{
    protected static string $resource = AdminBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
