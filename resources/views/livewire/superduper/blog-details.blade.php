{{-- Title Bar using the new structure but with dynamic data --}}
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
                <x-superduper.components.breadcrumb :items="[
                    ['label' => 'Blog', 'url' => route('blog')],
                    ['label' => $post->category->name, 'url' => route('blog', ['category' => $post->category->id])],
                    ['label' => Str::limit($post->title, 40)]
                ]" />
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<div>
    {{-- Schema.org JSON-LD data for SEO --}}
    @if(isset($schemaData))
        @push('js')
            <script type="application/ld+json">
                {!! $schemaData !!}
            </script>
        @endpush
    @endif
    <div class="page-content">
        <section class="site-content blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 blog-right-col">
                        <article class="post blog-classic">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    @if($post->hasFeaturedImage())
                                        <img src="{{ $post->getFeaturedImageUrl('large') }}" class="img-fluid" alt="{{ $post->title }}">
                                    @else
                                        <img src="https://placehold.co/856x540?text={{ urlencode($post->title) }}" class="img-fluid" alt="{{ $post->title }}">
                                    @endif
                                </div>
                            </div>
                            <div class="pbmit-blog-classic-inner">
                                <div class="pbmit-blog-meta pbmit-blog-meta-top">
                                    <span class="pbmit-meta pbmit-meta-cat">
                                        <a href="{{ route('blog', ['category' => $post->category->id]) }}" rel="category tag">{{ $post->category->name }}</a>
                                    </span>
                                    <span class="pbmit-meta pbmit-meta-date">
                                        <i class="pbmit-base-icon-calendar-3"></i>
                                        <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('M d, Y') }}</time>
                                    </span>
                                    @if($post->author)
                                    <span class="pbmit-meta pbmit-meta-author">
                                        <i class="pbmit-base-icon-user-3"></i>by
                                        <span class="pbmit-author-link">{{ $post->author->name }}</span>
                                    </span>
                                    @endif
                                </div>
                                <div class="pbmit-entry-content">
                                    {{-- The main blog content is injected here. The styling comes from your new template's CSS. --}}
                                    {!! $post->content_html !!}
                                </div>
                                @if($post->tags && $post->tags->count() > 0)
                                <div class="pbmit-blog-meta-bottom">
                                    <div class="pbmit-blog-meta-bottom-left">
                                        <span class="pbmit-meta-tags">
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('blog', ['search' => $tag->name]) }}" rel="tag">{{ $tag->name }}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </article>

                        <nav class="navigation post-navigation" aria-label="Posts">
                            <div class="nav-links">
                                @if($previousPost)
                                    <div class="nav-previous">
                                        <a href="{{ $previousPost->getUrl() }}" rel="prev">
                                            <span class="pbmit-post-nav-icon">
                                                <i class="pbmit-base-icon-left-arrow-1"></i>
                                                <span class="pbmit-post-nav-head">Previous Post</span>
                                            </span>
                                            <span class="pbmit-post-nav-wrapper">
                                                <span class="pbmit-post-nav nav-title">{{ $previousPost->title }}</span>
                                            </span>
                                        </a>
                                    </div>
                                @endif
                                @if($nextPost)
                                    <div class="nav-next">
                                        <a href="{{ $nextPost->getUrl() }}" rel="next">
                                            <span class="pbmit-post-nav-icon">
                                                <span class="pbmit-post-nav-head">Next Post</span>
                                                <i class="pbmit-base-icon-next"></i>
                                            </span>
                                            <span class="pbmit-post-nav-wrapper">
                                                <span class="pbmit-post-nav nav-title">{{ $nextPost->title }}</span>
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </nav>

                        @if($post->author)
                        <div class="pbmit-author-box">
                            <div class="pbmit-author-image">
                                @if($post->author->profile_photo_path)
                                    <img src="{{ Storage::url($post->author->profile_photo_path) }}" class="img-fluid" alt="{{ $post->author->name }}">
                                @else
                                    <img src="https://placehold.co/100x100?text={{ substr($post->author->name ?? 'A', 0, 1) }}" class="img-fluid" alt="{{ $post->author->name }}">
                                @endif
                            </div>
                            <div class="pbmit-author-content">
                                <span class="pbmit-author-name">
                                    <a href="#" title="Posted by {{ $post->author->name }}" rel="author">{{ $post->author->name }}</a>
                                </span>
                                <p class="pbmit-text pbmit-author-bio">{{ $post->author->description ?? 'Author at ' . config('app.name') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-12 col-lg-3 blog-left-col">
                        <aside class="sidebar">
                            <aside class="widget widget-categories">
                                <h2 class="widget-title">Categories</h2>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <span class="pbmit-cat-li">
                                                <a href="{{ route('blog', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                <span class="pbmit-brackets">( {{ $category->posts_count }} )</span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </aside>

                            <aside class="widget widget-recent-post">
                                <h2 class="widget-title">Recent Posts</h2>
                                <ul class="recent-post-list">
                                    @foreach($recentPosts as $recentPost)
                                    <li class="recent-post-list-li">
                                        <a class="recent-post-thum" href="{{ $recentPost->getUrl() }}">
                                            @if($recentPost->hasFeaturedImage())
                                                <img src="{{ $recentPost->getFeaturedImageUrl('thumbnail') }}" class="img-fluid" alt="{{ $recentPost->title }}">
                                            @else
                                                <img src="https://placehold.co/150x150?text=..." class="img-fluid" alt="">
                                            @endif
                                        </a>
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="{{ $recentPost->getUrl() }}">{{ $recentPost->published_at->format('M d, Y') }}</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="{{ $recentPost->getUrl() }}">{{ $recentPost->title }}</a>
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </aside>

                            <aside class="widget widget-tag-cloud">
                                <h3 class="widget-title">Tag Cloud</h3>
                                <div class="tagcloud">
                                    @foreach($popularTags as $tag)
                                        @php
                                            $tagName = is_array($tag) ? $tag['name'] : $tag->name;
                                        @endphp
                                        <a href="{{ route('blog', ['search' => $tagName]) }}" class="tag-cloud-link">{{ $tagName }}</a>
                                    @endforeach
                                </div>
                            </aside>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16.75 13.96c.25.13.43.2.5.33.07.13.07.66 0 1.14-.07.48-.83 1.14-1.5 1.25-.67.11-1.33 0-2.1-.25-.77-.25-1.93-.92-3.3-2.2-.47-.44-.9-1-1.29-1.6-.39-.6-.6-1.28-.6-1.8 0-.52.23-.9.48-1.15.25-.25.5-.33.7-.33.19 0 .38.03.52.07.14.04.25.07.38.48s.33.81.36.88c.03.07.03.16 0 .25-.03.09-.07.14-.14.23-.07.09-.14.16-.2.23-.07.07-.12.12-.16.18-.04.06-.07.1-.04.16.14.3.52.83 1.1 1.36.77.7 1.48 1.11 1.8 1.23.07.03.13.01.16-.01.03-.02.31-.25.43-.5.12-.25.21-.47.28-.6.07-.13.14-.14.23-.1.09.04.63.3 1.1.58zM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
        </svg>
    </a>
</div>
