<?php

namespace App\Livewire;

use App\Models\Appointment;
use Livewire\Component;

class ScheduleCanceled extends Component
{
    public Appointment $appointment;

    public function mount(
        Appointment $appointment
    ) {
        $this->appointment = $appointment;
    }

    public function render()
    {
        return view('livewire.schedule.canceled');
    }
}
