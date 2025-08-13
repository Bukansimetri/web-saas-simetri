
<div>
    <x-superduper.components.breadcrumb
        title="{{ $activeCategory ? ($categories->firstWhere('id', $activeCategory)?->name . ' Articles') : 'Articles' }}"
        :items="$activeCategory ? [['label' => 'Articles', 'url' => route('blog')], ['label' => $categories->firstWhere('id', $activeCategory)?->name]] : []"
    />

    <!-- =========================== News & Articles =================================== -->
    <section class="gray">
        <div class="container">
            <div class="row">

                @forelse($posts as $post)
                    <!-- Single Blog -->
                    <div class="mb-4 col-lg-4 col-md-6 col-sm-6">
                        <article class="post-grid-layout">
                            <a href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">
                                <div class="post-article-header">
                                    @if($post->hasFeaturedImage())
                                        <img src="{{ $post->getFeaturedImageUrl('large') }}" alt="{{ $post->title }}" class="mx-auto img-fluid"/>
                                    @else
                                        <img src="https://placehold.co/500x500?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="mx-auto img-fluid" />
                                    @endif
                                </div>
                            </a>
                            <div class="post-article box-inner">
                                <div class="post-grid-caption-header">
                                    <span class="post-article-cat theme-bg">{{ $post->category->name }}</span>
                                    <h4 class="entry-title"><a href="{{ $post->getUrl() }}" wire:click="trackView('{{ $post->id }}')">{{ $post->title }}</a></h4>
                                    <div class="post-short-des">
                                        {{ $post->content_overview }}
                                    </div>
                                </div>
                            </div>
                            <div class="post-article-footer">
                                <div class="post-author">
                                    <a href="{{ $post->getUrl() }}" class="theme-cl">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center alert alert-info">
                            <strong>No posts found.</strong>
                        </div>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="row">
                        <div class="col-lg-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <!-- Previous Page -->
                                    <li class="page-item left">
                                        <a class="page-link"
                                        wire:click="previousPage"
                                        @if(!$posts->onFirstPage()) wire:loading.attr="disabled" @endif
                                        @if($posts->onFirstPage()) disabled @endif
                                        href="#"
                                        aria-label="Previous"
                                        style="{{ $posts->onFirstPage() ? 'cursor: not-allowed; background-color: #f8f9fa;' : '' }}">
                                            <span aria-hidden="true"><i class="mr-1 ti-arrow-left"></i>Prev</span>
                                        </a>
                                    </li>

                                    <!-- Page Numbers -->
                                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                            wire:click="gotoPage({{ $page }})"
                                            href="#">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page -->
                                    <li class="page-item right">
                                        <a class="page-link"
                                        wire:click="nextPage"
                                        @if(!$posts->hasMorePages()) wire:loading.attr="disabled" @endif
                                        @if(!$posts->hasMorePages()) disabled @endif
                                        href="#"
                                        aria-label="Next"
                                        style="{{ !$posts->hasMorePages() ? 'cursor: not-allowed; background-color: #f8f9fa;' : '' }}">
                                            <span aria-hidden="true"><i class="mr-1 ti-arrow-right"></i>Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- =========================== News & Articles =================================== -->
</div>
