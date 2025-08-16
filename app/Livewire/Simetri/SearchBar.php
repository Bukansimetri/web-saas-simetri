<?php

namespace App\Livewire\Simetri;

use Livewire\Component;

class SearchBar extends Component
{
    public $q;

    public function search()
    {
        if (! empty($this->q)) {
            return redirect()->route('search.results', ['q' => $this->q]);
        }
    }

    public function render()
    {
        return view('livewire.simetri.search-bar');
    }
}
