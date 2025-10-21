<?php

namespace App\Livewire\Simetri;

use App\Models\Service;
use App\Models\SiteFeature;
use Livewire\Component;

class AboutUs extends Component
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
        $query = SiteFeature::query();

        $sectiontop = $query->where('type', 'about-section-top')
            ->with('media')
            ->first();

        $sectionmiddle = $query->where('type', 'about-section-middle')
            ->with('media')
            ->get();

        $sectionbottom = $query->where('type', 'about-section-bottom')
            ->with('media')
            ->first();

        $services = Service::where('is_active', true)
            ->with('media')
            ->get();

        return view('livewire.simetri.about-us', [
            'sectiontop' => $sectiontop,
            'sectionmiddle' => $sectionmiddle,
            'sectionbottom' => $sectionbottom,
            'services' => $services,
        ])->layout(
            'components.superduper.main',
        );
    }
}
