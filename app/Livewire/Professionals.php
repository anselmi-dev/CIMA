<?php

namespace App\Livewire;

use App\Models\Professional;
use App\Models\User;
use Livewire\Component;

class Professionals extends Component
{
    public function render()
    {
        return view('livewire.professionals', [
            'professionals' => Professional::with('user')->paginate(15)
        ]);
    }
}
