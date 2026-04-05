<div>
    <div wire:loading.delay wire:target="filterByCategory, search, toggleFeatured, sortBy, nextPage, previousPage, gotoPage"
         class="position-fixed d-flex align-items-center justify-content-center"
         style="z-index: 9999; bottom: 20px; right: 20px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #ff3c00;"></i>
        <span style="margin-left: 10px; font-weight: bold; color: #333;">Loading...</span>
    </div>

    <section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="{{ asset('assets/img/bg/ar-shape.png') }}">
        <div class="slider-side-content position-absolute">
            <span class="archx-slider-side1 position-absolute"><a href="mailto:{{ $siteSettings->company_email ?? 'Contact@gmail.com' }}">{{ $siteSettings->company_email ?? 'Contact@gmail.com' }}</a></span>
        </div>
        <div class="container">
            <div class="text-center arck-breadcrumb-content position-relative headline-2 ul-li">
                <h1>{{ $activeCategory ? ($categories->firstWhere('id', $activeCategory)?->name . ' Articles') : 'Blog List' }}</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Blog</li>
                </ul>
            </div>
        </div>
    </section>
    <section id="arck-blog-feed" class="arck-blog-feed-section inner-page-padding">
        <div class="container">
            <div class="arck-blog-feed-content-wrap">
                <div class="row">

                    <div class="col-lg-8">

                        @if($search || $activeCategory || $featuredOnly)
                            <div class="p-3 mb-4 rounded" style="background-color: #f8f9fa; border-left: 4px solid #ff3c00;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($search)
                                            <strong>Search results for:</strong> <span style="color: #ff3c00;">"{{ $search }}"</span> ({{ $posts->total() }} found)
                                            <a href="#" wire:click.prevent="clearSearch" class="ml-2 text-muted"><u>Clear</u></a>
                                        @elseif($activeCategory)
                                            <strong>Category:</strong> <span style="color: #ff3c00;">{{ $categories->firstWhere('id', $activeCategory)?->name }}</span>
                                            <a href="#" wire:click.prevent="filterByCategory(null)" class="ml-2 text-muted"><u>Clear</u></a>
                                        @elseif($featuredOnly)
                                            <strong>Showing:</strong> <span style="color: #ff3c00;">Featured Posts</span>
                                            <a href="#" wire:click.prevent="toggleFeatured" class="ml-2 text-muted"><u>Show All</u></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="relative arck-blog-feed-content">
                            <div wire:loading.delay wire:target="filterByCategory, search, toggleFeatured, sortBy, nextPage, previousPage, gotoPage"
                                 class="position-absolute w-100 h-100" style="background: rgba(255,255,255,0.5); z-index: 10; top: 0; left: 0;">
                            </div>

                            @forelse($posts as $post)
                                <div class="arck-blog-item-2" wire:key="post-{{ $post->id }}">
                                    <div class="inner-img">
                                        <a href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">
                                            @if($post->hasFeaturedImage())
                                                <img src="{{ $post->getFeaturedImageUrl('large') }}" alt="{{ $post->title }}">
                                            @else
                                                <img src="https://placehold.co/856x450?text={{ urlencode($post->title) }}" alt="{{ $post->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="inner-text headline pera-content">
                                        <div class="blog-meta">
                                            <a href="#" wire:click.prevent="filterByCategory('{{ $post->category->id }}')">
                                                <span class="text-uppercase blog-cat">{{ $post->category->name }}</span>
                                            </a>
                                            <a href="{{ $post->getUrl() }}">
                                                <span class="date">{{ $post->published_at->format('M jS, Y') }}</span>
                                            </a>
                                            <a href="{{ $post->getUrl() }}">
                                                <span class="author">By {{ $post->author->name ?? 'Admin' }}</span>
                                            </a>
                                        </div>
                                        <h3><a href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">{{ $post->title }}</a></h3>
                                        <p>{{ $post->content_overview }}</p>
                                        <a class="text-uppercase read-more-btn" href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">
                                            read more <i class="fal fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="p-5 text-center" style="background-color: #f8f9fa; border-radius: 8px;">
                                    <i class="mb-3 fal fa-folder-open" style="font-size: 48px; color: #ccc;"></i>
                                    <h3>No articles found</h3>
                                    <p class="mb-4 text-muted">Try changing your search criteria or clear your filters.</p>
                                    <a href="#" wire:click.prevent="filterByCategory(null)" class="read-more-btn text-uppercase" style="color: #ff3c00; font-weight: bold;">
                                        View All Posts <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>
                            @endforelse
                        </div>

                        @if($posts->hasPages())
                            <div class="arck-pagination ul-li">
                                <ul>
                                    <li>
                                        <a href="#" wire:click.prevent="previousPage" class="{{ $posts->onFirstPage() ? 'disabled text-muted' : '' }}" style="{{ $posts->onFirstPage() ? 'pointer-events: none;' : '' }}">
                                            <i class="far fa-long-arrow-left"></i>
                                        </a>
                                    </li>

                                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                        <li>
                                            <a href="#" wire:click.prevent="gotoPage({{ $page }})" class="{{ $page == $posts->currentPage() ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    <li>
                                        <a href="#" wire:click.prevent="nextPage" class="{{ !$posts->hasMorePages() ? 'disabled text-muted' : '' }}" style="{{ !$posts->hasMorePages() ? 'pointer-events: none;' : '' }}">
                                            <i class="far fa-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="arck-blog-sidebar top-sticky-sidebar">

                            <div class="arck-side-bar-widget headline">
                                <div class="search-widget">
                                    <form action="#" wire:submit.prevent="$refresh">
                                        <input type="text" wire:model.debounce.500ms="search" placeholder="Type Keywords...">
                                        <button type="submit"><i class="far fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="arck-side-bar-widget headline ul-li-block">
                                <div class="category-widget">
                                    <h3 class="widget-title">Categories</h3>
                                    <ul>
                                        <li>
                                            <a href="#" wire:click.prevent="filterByCategory(null)" style="{{ is_null($activeCategory) ? 'color: #ff3c00;' : '' }}">
                                                All Categories
                                            </a>
                                        </li>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="#" wire:click.prevent="filterByCategory('{{ $category->id }}')" style="{{ $activeCategory === $category->id ? 'color: #ff3c00;' : '' }}">
                                                    {{ $category->name }}
                                                    <span>{{ $category->posts_count < 10 && $category->posts_count > 0 ? '0'.$category->posts_count : $category->posts_count }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="#" wire:click.prevent="toggleFeatured" style="{{ $featuredOnly ? 'color: #ff3c00;' : '' }}">
                                                ★ Featured Only
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="arck-side-bar-widget headline">
                                <div class="recent-post-widget">
                                    <h3 class="widget-title">Popular Posts</h3>
                                    <div class="recent-post-wrap">
                                        @foreach($recentPosts as $recentPost)
                                            <div class="recent-blog-img-text d-flex align-items-center">
                                                <div class="recent-blog-img">
                                                    <a href="{{ $recentPost->getUrl() }}" wire:click="trackView('{{ $recentPost->id }}')">
                                                        @if($recentPost->hasFeaturedImage())
                                                            <img src="{{ $recentPost->getFeaturedImageUrl('thumbnail') }}" alt="{{ $recentPost->title }}">
                                                        @else
                                                            <img src="https://placehold.co/150x100?text={{ substr($recentPost->title, 0, 10) }}" alt="{{ $recentPost->title }}">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="recent-blog-text headline">
                                                    <h3>
                                                        <a href="{{ $recentPost->getUrl() }}" wire:click="trackView('{{ $recentPost->id }}')">
                                                            {{ $recentPost->title }}
                                                        </a>
                                                    </h3>
                                                    <span><i class="far fa-calendar-alt"></i> {{ $recentPost->published_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="arck-side-bar-widget headline ul-li">
                                <div class="popular-tag-widget">
                                    <h3 class="widget-title">Popular Tags</h3>
                                    <ul>
                                        @forelse($popularTags as $tag)
                                            @php
                                                $tagName = is_object($tag) ? ($tag->name ?? '') : ($tag['name'] ?? '');
                                                if(is_array($tagName)) $tagName = $tagName[app()->getLocale()] ?? '';
                                            @endphp
                                            <li>
                                                <a href="#" wire:click.prevent="searchByTag('{{ $tagName }}')">
                                                    {{ $tagName }}
                                                </a>
                                            </li>
                                        @empty
                                            <li><span class="text-muted">No tags available</span></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            <div class="arck-side-bar-widget headline" data-background="{{ asset('assets/img/blog/br-bg.jpg') }}">
                                <div class="brochure-widget">
                                    <div class="inner-logo"><img src="{{ asset('assets/img/logo/logo-2.png') }}" alt="Logo"></div>
                                    <h3>Our Company Interior Design Brochure</h3>
                                    <div class="arck-btn">
                                        <a class="d-flex justify-content-center align-items-center text-uppercase" href="#">Download PDF</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
