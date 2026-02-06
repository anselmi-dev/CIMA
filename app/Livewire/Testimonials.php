<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testimonial;
use App\Models\Page;

class Testimonials extends Component
{
    public ?Page $page = null;

    public function mount()
    {
        $this->page = Page::where('slug', 'testimonials')->where('active', true)->first();

        if (!$this->page) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.testimonials', [
            'testimonials' => Testimonial::active()->ordered()->get(),
        ]);
    }
}
