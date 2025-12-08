<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProfessionalResource\Pages\EditProfessional as EditRecord;
use App\Filament\Resources\ProfessionalResource;
// use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class ManageProfessional extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected static string $relationship = 'professional';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Datos profesionales';
    }

    public function form(Form $form): Form
    {
        return ProfessionalResource::form($form);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $professional = $this->record->professional;

        if ($professional) {
            $data['medical_specialty'] = $professional->medical_specialty;
            $data['phone'] = $professional->phone;
            $data['bio'] = $professional->bio;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $professional = $this->record->professional;

        if ($professional) {
            $professional->update($data);
        } else {
            $this->record->professional()->create($data);
        }

        return $this->record->professional;
    }
}
