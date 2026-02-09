<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class CookiesPolicy extends Component
{
    public ?Page $page = null;

    public function mount()
    {
        $this->page = Page::where('slug', 'cookies-policy')->where('active', true)->first();
    }

    public function render()
    {
        return view('livewire.cookies-policy');
    }
}
