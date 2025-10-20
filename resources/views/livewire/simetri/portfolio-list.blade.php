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
        <i class="fab fa-whatsapp"></i>
    </a>
</div>
