<?php

namespace App\Livewire;

use App\Models\Content\Item;
use App\Settings\ServicesPageSettings;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.services', [
            'servicesSettings' => app(ServicesPageSettings::class),
            'servicesGrid' => Item::categorySlug('services-grid')->active()->orderBy('sort')->with('media')->get(),
            'skills' => Item::categorySlug('skill')->active()->orderBy('sort')->get(),
            'pricingPlans' => Item::categorySlug('pricing-plan')->active()->orderBy('sort')->get(),
            'workProcessSteps' => Item::categorySlug('work-process-step')->active()->orderBy('sort')->with('media')->get(),
        ]);
    }
}
