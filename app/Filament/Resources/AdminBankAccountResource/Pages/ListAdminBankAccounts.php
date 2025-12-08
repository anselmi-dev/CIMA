<?php

namespace App\Filament\Resources\AdminBankAccountResource\Pages;

use App\Filament\Resources\AdminBankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminBankAccounts extends ListRecords
{
    protected static string $resource = AdminBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
