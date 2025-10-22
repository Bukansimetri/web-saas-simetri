@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'projects-banner');
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
                <x-superduper.components.breadcrumb title="Projects"/>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<div class="page-content">
    <!-- Portfolio Grid col 4 -->
    <section class="section-md pbmit-element-viewtype-masonry">
        <div class="px-4 container-fluid">
            <div class="row pbmit-element-posts-wrapper">
                @if (isset($projects) && $projects->isNotEmpty())
                    @foreach ($projects as $project)
                        <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                            <div class="pbminfotech-post-content">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        @if ($project->hasImage())
                                            <img src="{{ $project->getImageUrl('medium') }}" class="img-fluid" alt="{{ $project->title }}">
                                        @else
                                            <img src="{{ asset('assets/images/portfolio/portfolio-01b.jpg') }}" class="img-fluid" alt="Placeholder">
                                        @endif
                                    </div>
                                </div>
                                <div class="pbminfotech-box-content">
                                    <div class="pbminfotech-titlebox">
                                        <div class="pbmit-port-cat">
                                            <a href="{{ $project->getUrl() }}" rel="tag">{{ $project->project_type }}</a>
                                        </div>
                                        <h3 class="pbmit-portfolio-title">
                                            <a href="{{ $project->getUrl() }}">{{ $project->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-01b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Bedroom</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Innovation</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-02b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Furniture</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Minimalism</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-03b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Interior</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Lighting</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-04b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Kitchen</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Bold Tiles</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-05b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Bedroom</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Clean lines</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-06b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Architecture</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Integral</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-07b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Interior</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Functionality</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="pbmit-ele-portfolio pbmit-portfolio-style-2 col-md-6 col-lg-3">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="{{ asset('assets/images/portfolio/portfolio-08b.jpg') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="pbminfotech-box-content">
                                <div class="pbminfotech-titlebox">
                                    <div class="pbmit-port-cat">
                                        <a href="{{ route('home') }}" rel="tag">Furniture</a>
                                    </div>
                                    <h3 class="pbmit-portfolio-title">
                                        <a href="{{ route('home') }}">Terracotta</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif
            </div>
        </div>
    </section>
    <!-- Portfolio Grid col 4 End -->

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%2C%20saya%20melihat%20beberapa%20proyek%20Home%20Care%20Interior%20dan%20tertarik%20untuk%20berkonsultasi%20lebih%20lanjut.%20Boleh%20dibantu%20oleh%20tim%20desainnya%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16.75 13.96c.25.13.43.2.5.33.07.13.07.66 0 1.14-.07.48-.83 1.14-1.5 1.25-.67.11-1.33 0-2.1-.25-.77-.25-1.93-.92-3.3-2.2-.47-.44-.9-1-1.29-1.6-.39-.6-.6-1.28-.6-1.8 0-.52.23-.9.48-1.15.25-.25.5-.33.7-.33.19 0 .38.03.52.07.14.04.25.07.38.48s.33.81.36.88c.03.07.03.16 0 .25-.03.09-.07.14-.14.23-.07.09-.14.16-.2.23-.07.07-.12.12-.16.18-.04.06-.07.1-.04.16.14.3.52.83 1.1 1.36.77.7 1.48 1.11 1.8 1.23.07.03.13.01.16-.01.03-.02.31-.25.43-.5.12-.25.21-.47.28-.6.07-.13.14-.14.23-.1.09.04.63.3 1.1.58zM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
        </svg>
    </a>
</div>
