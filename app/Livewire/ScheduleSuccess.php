<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\MedicalSpecialty;
use Livewire\Component;

class ScheduleSuccess extends Component
{
    public MedicalSpecialty $medicalSpecialty;

    public Appointment $appointment;

    public function mount(
        MedicalSpecialty $medicalSpecialty,
        Appointment $appointment
    ) {

    }
    public function render()
    {
        if ($this->appointment->is_cancelled)
            return view('livewire.schedule.canceled')->layout('layouts.simple');

        return view('livewire.schedule.success')->layout('layouts.simple');
    }

    public function cancel()
    {
        $this->appointment->status = 'cancelled';
        
        $this->appointment->save();

        return redirect()->route('schedule.canceled', [
            'appointment' => $this->appointment->uuid
        ]);
    }
}
