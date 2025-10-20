@props(['title' => 'Default Title', 'items' => []])
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'general');
            })
            ->active()
            ->orderBy('sort')
            ->with(['media'])
            ->first();

    if ($title == "About Us") {
        $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'about-us-banner');
            })
            ->active()
            ->orderBy('sort')
            ->with(['media'])
            ->first();
    }

    if ($title == "Portfolio") {
        $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'projects-banner');
            })
            ->active()
            ->with(['media'])
            ->first();
    }

    if ($title == "Service") {
        $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'services-banner');
            })
            ->active()
            ->with(['media'])
            ->first();
    }

    if ($title == "Contact Us") {
        $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'contact-us-banner');
            })
            ->active()
            ->with(['media'])
            ->first();
    }

    dd($banners);
@endphp

{{-- Title Bar Section --}}
<div class="pbmit-tbar">
    <div class="container pbmit-tbar-inner">
        <h1 class="pbmit-tbar-title">{{ $title }}</h1>
    </div>
</div>

{{-- Breadcrumb Navigation Section --}}
<div class="pbmit-breadcrumb">
    <div class="pbmit-breadcrumb-inner">
        {{-- The first link is always the home page --}}
        <span>
            <a title="Home Care Interior" href="{{ route('home') }}" class="home"><span>Home</span></a>
        </span>

        {{-- Loop through the breadcrumb items provided --}}
        @foreach($items as $item)
            <span class="sep">
                <i class="pbmit-base-icon-angle-right"></i>
            </span>
            <span>
                @if(isset($item['url']))
                    {{-- This is a clickable link in the middle of the trail --}}
                    <a title="" href="{{ $banners->getImageUrl('large') }}" class="home"><span>{{ $item['label'] }}</span></a>
                @else
                    {{-- This is the final, non-clickable item (the current page) --}}
                    <span class="post-root post post-post current-item">{{ $item['label'] }}</span>
                @endif
            </span>
        @endforeach
    </div>
</div>
