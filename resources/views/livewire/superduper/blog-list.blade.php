{{-- The main container now gets the Alpine.js functionality --}}
@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'general-banner');
            })
            ->active()
            ->orderBy('sort')
            ->with(['media'])
            ->first();
@endphp
<!-- Title Bar -->
<div class="pbmit-title-bar-wrapper" style="background-image: url({{ $banners->getImageUrl('large') }}) !important;">
    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <x-superduper.components.breadcrumb title="Blog"
                    :items="$activeCategory ? [['label' => 'Blog', 'url' => route('blog')], ['label' => $categories->firstWhere('id', $activeCategory)?->name]] : [['label' => 'Blog']]"
                />
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<div x-data="{
        isObserverVisible: false
    }"
    x-intersect:enter="isObserverVisible = true"
    x-intersect:leave="isObserverVisible = false"
    x-init="
        $watch('isObserverVisible', value => {
            // Check if the observer is visible AND if there are more pages to load
            if (value && {{ $posts->hasMorePages() ? 'true' : 'false' }}) {
                // Call the Livewire loadMore method
                $wire.loadMore();
            }
        });
    ">

    <div class="page-content">
        <section class="section-md pbmit-element-viewtype-masonry">
            <div class="container">
                    <div wire:loading.delay.class="opacity-50" wire:target="filterByCategory, search, toggleFeatured, sortBy, nextPage, previousPage, gotoPage" class="absolute inset-0 z-10 transition-opacity duration-300 bg-white opacity-0 pointer-events-none"></div>

                    <div class="row pbmit-element-posts-wrapper">
                        @forelse($posts as $post)
                            <article class="pbmit-ele-blog pbmit-blog-style-1 col-md-6" wire:key="post-{{ $post->id }}">
                                <div class="post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-featured-container">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    @if($post->hasFeaturedImage())
                                                        <img src="{{ $post->getFeaturedImageUrl('large') }}" class="img-fluid" alt="{{ $post->title }}">
                                                    @else
                                                        {{-- Fallback placeholder --}}
                                                        <img src="https://placehold.co/600x400?text={{ urlencode($post->title) }}" class="img-fluid" alt="{{ $post->title }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <a class="pbmit-blog-btn" href="{{ $post->getUrl() }}" title="{{ $post->title }}" wire:click="trackView('{{ $post->id }}')">
                                                <span class="pbmit-button-icon">
                                                    <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                                </span>
                                            </a>
                                            <a class="pbmit-link" href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')"></a>
                                        </div>
                                        <div class="pbmit-content-wrapper">
                                            <div class="pbmit-date-wraper d-flex align-items-center">
                                                <div class="pbmit-meta-date-wrapper pbmit-meta-line">
                                                    <div class="pbmit-meta-date">
                                                        <span class="pbmit-post-date">
                                                            <i class="pbmit-base-icon-calendar-3"></i>{{ $post->published_at->format('M d, Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="pbmit-meta-author pbmit-meta-line">
                                                    <span class="pbmit-post-author">
                                                        <i class="pbmit-base-icon-user-3"></i><span>By</span> {{ $post->author->name ?? 'Anonymous' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <h3 class="pbmit-post-title">
                                                <a href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">{{ $post->title }}</a>
                                            </h3>
                                            <div class="pbminfotech-box-desc">
                                                {{ $post->content_overview }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-12">
                                <div class="w-full p-10 text-center bg-white rounded-lg shadow-sm">
                                    <h3 class="pbmit-post-title">No Articles Found</h3>
                                    <p class="mb-4">Please try adjusting your search or filter criteria.</p>
                                    <button wire:click="clearSearch" class="pbmit-btn">
                                        View All Posts
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                @if ($posts->hasMorePages())
                    {{--
                        This empty div is our "trigger". When it becomes visible on the screen,
                        Alpine.js will detect it and call the loadMore method.
                    --}}
                    <div x-ref="observer" class="h-10"></div>

                    {{-- This loading indicator will ONLY show when the loadMore action is running --}}
                    <div wire:loading wire:target="loadMore" class="w-full py-10 text-center">
                        <div class="pbmit-title">Loading more posts...</div>
                    </div>
                @endif
            </div>
        </section>
    </div>

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16.75 13.96c.25.13.43.2.5.33.07.13.07.66 0 1.14-.07.48-.83 1.14-1.5 1.25-.67.11-1.33 0-2.1-.25-.77-.25-1.93-.92-3.3-2.2-.47-.44-.9-1-1.29-1.6-.39-.6-.6-1.28-.6-1.8 0-.52.23-.9.48-1.15.25-.25.5-.33.7-.33.19 0 .38.03.52.07.14.04.25.07.38.48s.33.81.36.88c.03.07.03.16 0 .25-.03.09-.07.14-.14.23-.07.09-.14.16-.2.23-.07.07-.12.12-.16.18-.04.06-.07.1-.04.16.14.3.52.83 1.1 1.36.77.7 1.48 1.11 1.8 1.23.07.03.13.01.16-.01.03-.02.31-.25.43-.5.12-.25.21-.47.28-.6.07-.13.14-.14.23-.1.09.04.63.3 1.1.58zM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
        </svg>
    </a>
</div>
@push('js')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
@endpush
