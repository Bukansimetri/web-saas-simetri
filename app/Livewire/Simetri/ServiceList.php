<?php

namespace App\Livewire\Simetri;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class ServiceList extends Component
{
    public $search = '';

    public $sortField = 'created_at';

    public $sortDirection = 'desc';

    public function mount()
    {
        // Get popular tags
        $locale = app()->getLocale();
    }

    public function render()
    {
        $query = Project::query()
            ->locale(App::getLocale());

        $services = $query->where('is_active', true)
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.simetri.service-list', [
            'services' => $services,
        ])->layout('components.superduper.main');
    }
}
