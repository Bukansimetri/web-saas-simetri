<?php

namespace App\Livewire\Simetri;

use App\Models\Blog\Post;
use App\Models\Project;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        $portfolios = Project::where('is_active', true)
            ->orderBy('sort')
            ->with(['media'])
            ->take(6)
            ->get();

        $blogs = Post::where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->with(['media', 'author'])
            ->take(3)
            ->get();

        $featureBlog = Post::where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->with(['media', 'author'])
            ->first();

        return view('livewire.simetri.landing-page', [
            'portfolios' => $portfolios,
            'blogs' => $blogs,
            'featureBlog' => $featureBlog,
        ])->layout('components.superduper.main');
    }
}
