<?php

namespace App\Livewire\SuperDuper\Pages;

use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        return view('livewire.superduper.pages.faq')->layout('components.superduper.main');
    }
}
