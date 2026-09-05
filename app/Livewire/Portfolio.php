<?php

namespace App\Livewire;

use App\Models\Content\Category;
use App\Models\Content\Item;
use App\Settings\PortfolioPageSettings;
use Livewire\Component;

class Portfolio extends Component
{
    public function render()
    {
        $parent = Category::where('slug', 'portofolio')->first();

        $filters = $parent
            ? $parent->children()->active()->orderBy('name')->get()
            : collect();

        return view('livewire.portfolio', [
            'portfolioSettings' => app(PortfolioPageSettings::class),
            'filters' => $filters,
            'projects' => Item::whereHas('category.parent', fn ($q) => $q->where('slug', 'portofolio'))
                ->active()->orderBy('sort')->with(['media', 'category'])->get(),
            'sponsors' => Item::categorySlug('sponsor')->active()->orderBy('sort')->with('media')->get(),
        ])->layout('components.superduper.main');
    }
}
