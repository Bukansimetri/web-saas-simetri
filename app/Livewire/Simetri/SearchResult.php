<?php

namespace App\Livewire\Simetri;

use App\Models\Blog\Post;
use App\Models\Product;
use Livewire\Component;

class SearchResult extends Component
{
    public $q;

    public $products;

    public $posts;

    public function mount($q = null)
    {
        $this->q = $q;

        if (! empty($q)) {
            $this->products = Product::query()
                ->where('name', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->get();

            $this->posts = Post::query()
                ->where('title', 'like', "%{$q}%")
                ->orWhere('content_overview', 'like', "%{$q}%")
                ->get();
        } else {
            $this->products = collect();
            $this->posts = collect();
        }
    }

    public function render()
    {
        return view('livewire.simetri.search-result')->layout('components.superduper.main');
    }
}
