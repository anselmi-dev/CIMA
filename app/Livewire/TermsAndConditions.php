<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class TermsAndConditions extends Component
{
    public ?Page $page = null;

    public function mount()
    {
        $this->page = Page::where('slug', 'terms-and-conditions')->where('active', true)->first();
    }

    public function render()
    {
        return view('livewire.terms-and-conditions');
    }
}
