<?php

namespace App\Livewire\Schedule;

use App\Models\MedicalSpecialty;
use Livewire\Component;

class SpecialitySchedule extends Component
{
    public ?MedicalSpecialty $medicalSpecialty = null;

    public $medicalSpecialtyId;

    public $type = 'presencial';

    /**
     * @var array
     */
    public $rules = [
        'medicalSpecialtyId' => 'required',
        'type' => 'required',
    ];

    /**
     * @var array
     */
    public $messages = [
        'medicalSpecialtyId.required' => 'La especialidad médica es obligatoria',
        'type.required' => 'El tipo de consulta es obligatorio',
    ];

    public function render ()
    {
        $medicalSpecialtys = MedicalSpecialty::orderBy('name')->get();

        $this->medicalSpecialtyId = $medicalSpecialtys->first()?->id;

        return view('livewire.schedule.speciality-schedule', [
            'medicalSpecialties' => $medicalSpecialtys
        ])->layout('layouts.simple');
    }

    public function submit ()
    {
        $this->validate();

        $this->medicalSpecialty = MedicalSpecialty::find($this->medicalSpecialtyId);

        return $this->redirectRoute('schedule', [
            'medicalSpecialty' => $this->medicalSpecialty,
            'tipo' => $this->type
        ], navigate: true);
    }
}
