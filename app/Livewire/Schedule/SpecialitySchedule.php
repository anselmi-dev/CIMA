<?php

namespace App\Livewire\Schedule;

use App\Models\MedicalSpecialty;
use Livewire\Component;

class SpecialitySchedule extends Component
{
    public ?MedicalSpecialty $medicalSpecialty = null;

    public $medicalSpecialtyId;

    public $type;

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
        'medicalSpecialtyId.required' => 'La especialidad es obligatoria',
        'type.required' => 'El tipo es obligatorio',
    ];


    public function render ()
    {
        return view('livewire.schedule.speciality-schedule', [
            'medicalSpecialties' => MedicalSpecialty::orderBy('name')->get()
        ])->layout('layouts.simple');
    }

    public function submit ()
    {
        $this->validate();

        $this->medicalSpecialty = MedicalSpecialty::find($this->medicalSpecialtyId);
        
        return redirect()->route('schedule', [
            'medicalSpecialty' => $this->medicalSpecialty,
            'tipo' => $this->type
        ]);
    }
}
