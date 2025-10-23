@props(['title' => 'Default Title', 'items' => []])
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
                    <a title="{{ $item['label'] }}" href="{{ route('home') }}" class="home"><span>{{ $item['label'] }}</span></a>
                @else
                    {{-- This is the final, non-clickable item (the current page) --}}
                    <span class="post-root post post-post current-item">{{ $item['label'] }}</span>
                @endif
            </span>
        @endforeach
    </div>
</div>
