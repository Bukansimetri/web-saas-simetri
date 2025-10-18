<?php

namespace App\Livewire\Simetri;

use App\Models\Service;
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
        $query = Service::query();

        $services = $query->where('is_active', true)
            ->with(['media'])
            ->first();

        $otherServices = $query->where('is_active', true)
            ->with(['media'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.simetri.service-list', [
            'services' => $services,
            'otherServices' => $otherServices,
        ])->layout('components.superduper.main');
    }
}
