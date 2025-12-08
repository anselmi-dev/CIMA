<?php

namespace App\Filament\Resources\ProfessionalResource\Pages;

use App\Filament\Resources\ProfessionalBankAccountResource;
use App\Filament\Resources\ProfessionalResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProfessionalBankAccountResource\Pages\EditProfessionalBankAccount as EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ProfessionalBankAccount extends ManageRelatedRecords
{
    protected static string $resource = ProfessionalResource::class;

    protected static string $relationship = 'bankAccounts';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    
    public function getTitle(): string | Htmlable
    {
        return $this->getNavigationLabel();
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/professional_bank_account.navigation_label');
    }

    public static function getLabel(): string
    {
        return __('resources/professional_bank_account.label');
    }

    public static function getPluralLabel(): string
    {
        return __('resources/professional_bank_account.plural_label');
    }
    
    public static function getNavigationBadge(): ?string
    {
        return null;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                professionalBankAccountResource::getComponentBankDetails()
            );
    }

    public function table(Table $table): Table
    {
        return ProfessionalBankAccountResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(fn (): string => __('filament-actions::create.single.label', ['label' => '']))
            ])
            ->heading($this->getPluralLabel());
    }
}
