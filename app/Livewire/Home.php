<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testimonial;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'testimonials' => Testimonial::active()->ordered()->limit(3)->get(),
        ]);
    }
}
