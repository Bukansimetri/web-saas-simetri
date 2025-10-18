<div>
    {{-- Schema.org JSON-LD data for SEO --}}
    @if(isset($schemaData))
        @push('js')
            <script type="application/ld+json">
                {!! $schemaData !!}
            </script>
        @endpush
    @endif

    {{-- Title Bar using the new structure but with dynamic data --}}
    @section('hero')
        <!-- Title Bar -->
        <div class="pbmit-title-bar-wrapper">
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
    </div>
</div>
