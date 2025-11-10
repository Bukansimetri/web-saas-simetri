<?php

namespace App\Livewire\Simetri;

use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.simetri.landing-page')->layout('components.superduper.main');
    }
}
