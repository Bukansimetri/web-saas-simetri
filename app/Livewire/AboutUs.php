<?php

namespace App\Livewire;

use App\Models\Content\Item;
use App\Settings\AboutPageSettings;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.about-us', [
            'aboutSettings' => app(AboutPageSettings::class),
            'servicePreviews' => Item::categorySlug('about-service-preview')->active()->orderBy('sort')->with('media')->get(),
            'faqs' => Item::categorySlug('faq-about-us')->active()->orderBy('sort')->get(),
            'stats' => Item::categorySlug('stat')->active()->orderBy('sort')->get(),
            'testimonials' => Item::categorySlug('testimonial')->active()->orderBy('sort')->get(),
            'sponsors' => Item::categorySlug('sponsor')->active()->orderBy('sort')->with('media')->get(),
        ])->layout('components.superduper.main');
    }
}
