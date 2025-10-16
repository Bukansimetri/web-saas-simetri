<?php

namespace App\Livewire\Simetri;

use App\Models\Project;
use Livewire\Component;

class PortfolioList extends Component
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
        $query = Project::query();

        $projects = $query->where('is_active', true)
            ->with(['media'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.simetri.portfolio-list', [
            'projects' => $projects,
        ])->layout('components.superduper.main');
    }
}
