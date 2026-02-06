<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class PrivacyPolicy extends Component
{
    public Page $page;

    public function mount()
    {
        $this->page = Page::where('slug', 'privacy-policy')->where('active', true)->first();

        if (!$this->page) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.privacy-policy');
    }
}
