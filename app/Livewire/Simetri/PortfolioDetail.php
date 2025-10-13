<?php

namespace App\Livewire\Simetri;

use App\Models\Project;
use Livewire\Component;

class PortfolioDetail extends Component
{
    public $project;

    public $title;

    public function mount($title)
    {
        $this->title = $title;

        // Redirect if title has trailing slash
        if (substr($this->title, -1) === '/') {
            return redirect()->to(rtrim(request()->path(), '/'), 301);
        }

        $this->loadProject();
    }

    protected function loadProject()
    {
        $this->project = Project::with(['media'])
            ->where('title', $this->title)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.simetri.portfolio-detail')->layout('components.superduper.main');
    }
}
