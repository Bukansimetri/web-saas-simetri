<div>
    {{-- Breadcrumb --}}
    <x-superduper.components.breadcrumb
        title="{{ $post->title }}"
        :items="[
            ['label' => 'Blog', 'url' => route('blog')],
            ['label' => $post->category->name, 'url' => route('blog', ['category' => $post->category->id])],
            ['label' => $post->title]
        ]"
    />

    <!-- =========================== News & Articles =================================== -->
    <section class="gray">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <article class="blog-news big-detail-wrap">
                        <div class="blog-detail-wrap">

                            <!-- Featured Image -->
                            <figure class="img-holder">
                                <a href="{{$post->getFeaturedImageUrl('large') }}" target="_blank">
                                    @if($post->hasFeaturedImage())
                                        <img src="{{ $post->getFeaturedImageUrl('large') }}"
                                             alt="{{ $post->title }}"
                                             class="img-responsive" />
                                    @else
                                        <img src="https://via.placeholder.com/1200x700" class="img-responsive" alt="{{ $post->title }}"></a>
                                    @endif
                                </a>
                                <div class="blog-post-date theme-bg">
                                    {{ $post->published_at->format('d-M-Y') }}
                                </div>
                            </figure>

                            <!-- Blog Content -->
                            <div class="full blog-content">
                                <div class="post-meta">By: {{ $post->author->name }}</div>
                                <h3>{{ $post->title }}</h3>
                                <div class="blog-text">
                                    {!! $post->content_html !!}
                                    <div class="post-meta">Filed Under: <span class="category">{{ $post->category->name }}</span></div>
                                </div>

                            </div>
                            <!-- Blog Content -->

                            <!-- Blog Share Option -->
                            <div class="no-mrg">
                                <div class="blog-footer-social">
                                    <span>Share <i class="fa fa-share-alt"></i></span>
                                    <ul class="list-inline social">
                                        <li><a wire:click="sharePost('facebook')"><i class="ti-facebook"></i></a></li>
                                        <li><a wire:click="sharePost('twitter')"><i class="ti-twitter"></i></a></li>
                                        <li><a wire:click="sharePost('linkedin')"><i class="ti-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>

                </div>

                <!-- Sidebar Start -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="blog-sidebar">

                        <div class="side-widget">
                            <div class="side-widget-header">
                                <h4><i class="ti-check-box"></i>Latest Article</h4>
                            </div>
                            <div class="side-widget-body p-t-10">
                                <div class="side-list">
                                    <ul class="side-blog-list">
                                        @foreach($recentPosts as $recentPost)
                                            <li>
                                                <a href="{{ $recentPost->getUrl() }}" class="side-blog-list-link">
                                                    <div class="blog-list-img">
                                                        @if($recentPost->hasFeaturedImage())
                                                            <img src="{{ $recentPost->getFeaturedImageUrl('thumbnail') }}" class="img-responsive" alt="{{ $recentPost->title }}">
                                                        @else
                                                            <img src="https://via.placeholder.com/150x100?text={{ substr($recentPost->title, 0, 10) }}" class="img-responsive" alt="{{ $recentPost->title }}">
                                                        @endif
                                                    </div>
                                                    <div class="blog-list-info">
                                                        <h5>{{ $recentPost->title }}</h5>
                                                        <div class="blog-post-meta">
                                                            <span class="updated">{{ $recentPost->published_at->format('M d, Y') }}</span> | <a href="{{ route('blog', ['category' => $recentPost->category->id]) }}" rel="tag">{{ $recentPost->category->name }}</a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- =========================== News & Articles =================================== -->
</div>
