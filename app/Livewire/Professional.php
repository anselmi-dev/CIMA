<?php

namespace App\Livewire;

use App\Models\Professional as ModelsProfessional;
use Livewire\Component;

class Professional extends Component
{
    public ModelsProfessional $professional;

    public function mount (ModelsProfessional $professional)
    {
        $this->professional = $professional;
    }

    public function render()
    {
        return view('livewire.professional');
    }
}
