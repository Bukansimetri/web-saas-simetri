@section('hero')
    @php
        $baseQuery = \App\Models\Testimonial::where('is_active', true);
        $averageRating = number_format((clone $baseQuery)->avg('rating'), 1);
        $totalRatings = (clone $baseQuery)->count();

        $heroBanners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'home-banner');
            })
            ->active()
            ->orderBy('sort')
            ->with(['media'])
            ->take(5)
            ->get();

        $services =  \App\Models\Service::where('is_active', true)
            ->orderBy('sort')
            ->with(['media'])
            ->take(6)
            ->get();

        $portfolios = \App\Models\Project::where('is_active', true)
            ->orderBy('sort')
            ->with(['media'])
            ->take(6)
            ->get();

        $blogs = \App\Models\Blog\Post::where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->with(['media', 'author'])
            ->take(3)
            ->get();

        $featureBlog = \App\Models\Blog\Post::where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->with(['media', 'author'])
            ->first();

        $testimonials = \App\Models\Testimonial::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->take(5)
            ->get();

        $packages = \App\Models\Package::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $clients = \App\Models\Client::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->get();

        $homeTop = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-top',
            ])
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->first();

        $homeTopOne = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-top-one',
            ])
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->take(4)
            ->get();

        $homeTopTwo = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-top-two',
            ])
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->take(4)
            ->get();

        $homeMiddleLeft = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-middle',
            ])
            ->orderBy('created_at', 'asc')
            ->with(['media'])
            ->take(3)
            ->get();

        $homeMiddleRight = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-middle',
            ])
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->take(3)
            ->get();

        $homeBottom = \App\Models\SiteFeature::where([
                'is_active' => true,
                'type' => 'home-section-bottom',
            ])
            ->orderBy('created_at', 'asc')
            ->with(['media'])
            ->take(5)
            ->get();
    @endphp
    <div class="pbmit-slider-area pbmit-slider-one">
        <div class="swiper-slider" data-autoplay="true" data-loop="true" data-dots="true" data-arrows="false" data-columns="1" data-margin="0" data-effect="fade">
            <div class="swiper-wrapper">
                <!-- Slider -->
                @if ($heroBanners->isNotEmpty())
                    @foreach ($heroBanners as $banner)
                        <div class="swiper-slide">
                            <div class="pbmit-slider-item">
                                @if ($banner->hasImage())
                                    <div class="pbmit-slider-bg" style="background-image: url('{{ $banner->getImageUrl('large') }}');"></div>
                                @else
                                    <div class="pbmit-slider-bg" style="background-image: url('https://placehold.co/1920x1080');"></div>
                                @endif
                                <div class="container">
                                    <div class="text-center row">
                                        <div class="col-md-12">
                                            <div class="pbmit-slider-content">
                                                <h5 class="pbmit-sub-title transform-top transform-delay-1">{!! nl2br(e($banner->description)) !!}</h5>
                                                <h2 class="pbmit-title transform-bottom-1 transform-delay-2">
                                                   {{ $banner->title }}
                                                </h2>
                                                <div class="pbmit-button-wrap transform-bottom-1 transform-delay-3">
                                                    @if($banner->click_url)
                                                        <a class="pbmit-btn pbmit-btn-outline" href="{{ $banner->click_url }}" target="{{ $banner->click_url_target ?? '_self' }}" onclick="trackBannerClick('{{ $banner->id }}')">
                                                            <span class="pbmit-button-content-wrapper">
                                                                <span class="pbmit-button-text">{{ $banner->options['button_text'] ?? 'Learn More' }}</span>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pbmit-slider-dots-corner">
                <div class="pbmit-sticky-corner pbmit-top-right-corner">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg" data-stylerecorder="true">
                        <path d="M20 20V0C20 16 16 20 0 20H20Z" fill="red" data-stylerecorder="true"></path>
                    </svg>
                </div>
                <div class="pbmit-sticky-corner pbmit-bottom-left-corner">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg" data-stylerecorder="true">
                        <path d="M20 20V0C20 16 16 20 0 20H20Z" fill="red" data-stylerecorder="true"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-superduper.main>
    <div class="page-content">

        <!-- About -->
        <section class="section-xl">
            <div class="container">
                <div class="row g-0">
                    <div class="col-md-12 col-xl-6">
                        <div class="about-one-leftbox">
                            <div class="ihbox-style-area">
                                <div class="pbmit-ihbox-style-12">
                                    <div class="pbmit-ihbox-headingicon">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                                <img src="https://homecareinterior.co.id/storage/11/home-care-icon.png" width="123" height="133" alt="Home Care Interior Icon">
                                            </div>
                                        </div>
                                        <div class="pbmit-sticky-corner pbmit-bottom-left-corner">
                                            <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M30 30V0C30 16 16 30 0 30H30Z"></path>
                                            </svg>
                                        </div>
                                        <div class="pbmit-sticky-corner pbmit-top-right-corner">
                                            <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M30 30V0C30 16 16 30 0 30H30Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="about-one-rightbox">
                            <div class="pbmit-heading-subheading animation-style2">
                                <h4 class="pbmit-subtitle">since 2020</h4>
                                <h2 class="pbmit-title">{{ $homeTop->title ?? 'We design thoughtful, liveable spaces.' }}</h2>
                                <div class="pbmit-heading-desc">
                                    {{ $homeTop->description ?? 'There are many variations of passages of form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text.' }}
                                </div>
                            </div>
                            <div class="row g-3">
                                @if ($homeTopOne->isNotEmpty())
                                    @foreach ($homeTopOne as $feature)
                                        <div class="col-md-6">
                                            <article class="pbmit-miconheading-style-9">
                                                <div class="pbmit-ihbox-style-9">
                                                    <div class="pbmit-ihbox-box d-flex align-items-center">
                                                        <div class="pbmit-ihbox-icon">
                                                            <div class="pbmit-ihbox-icon-wrapper">
                                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                    <i class="pbmit-xinterio-icon {{ $feature->icon_class ?? 'pbmit-xinterio-icon-tools' }}"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pbmit-ihbox-contents">
                                                            <h2 class="pbmit-element-title">
                                                                {{ $feature->title }}
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-6">
                                        <article class="pbmit-miconheading-style-9">
                                            <div class="pbmit-ihbox-style-9">
                                                <div class="pbmit-ihbox-box d-flex align-items-center">
                                                    <div class="pbmit-ihbox-icon">
                                                        <div class="pbmit-ihbox-icon-wrapper">
                                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-tools"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pbmit-ihbox-contents">
                                                        <h2 class="pbmit-element-title">
                                                            Cafe
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article class="pbmit-miconheading-style-9">
                                            <div class="pbmit-ihbox-style-9">
                                                <div class="pbmit-ihbox-box d-flex align-items-center">
                                                    <div class="pbmit-ihbox-icon">
                                                        <div class="pbmit-ihbox-icon-wrapper">
                                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-hard-hat"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pbmit-ihbox-contents">
                                                        <h2 class="pbmit-element-title">
                                                            Hotel
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article class="pbmit-miconheading-style-9">
                                            <div class="pbmit-ihbox-style-9">
                                                <div class="pbmit-ihbox-box d-flex align-items-center">
                                                    <div class="pbmit-ihbox-icon">
                                                        <div class="pbmit-ihbox-icon-wrapper">
                                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-offer"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pbmit-ihbox-contents">
                                                        <h2 class="pbmit-element-title">
                                                            Rumah tinggal
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article class="pbmit-miconheading-style-9">
                                            <div class="pbmit-ihbox-style-9">
                                                <div class="pbmit-ihbox-box d-flex align-items-center">
                                                    <div class="pbmit-ihbox-icon">
                                                        <div class="pbmit-ihbox-icon-wrapper">
                                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-house-design"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pbmit-ihbox-contents">
                                                        <h2 class="pbmit-element-title">
                                                            Kantor
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-5 pbmit-ihbox pbmit-ihbox-style-5">
                                <div class="pbmit-ihbox-box d-flex align-items-center">
                                    <div class="pbmit-content-wrapper">
                                        <h2 class="pbmit-element-title">Home Care Interior</h2>
                                        <div class="pbmit-heading-desc">PT. Sejahtera Langgeng Anugerah</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About End -->

        <!-- Service Start -->
        <section class="pbmit-extend-animation service-one pbmit-bg-color-secondary">
            <div class="container">
                <div class="text-center position-relative">
                    <div class="text-center pbmit-heading-subheading animation-style2">
                        <h4 class="pbmit-subtitle">What we do</h4>
                        <h2 class="pbmit-title">What we offer for you</h2>
                    </div>
                    <div class="pbmit-service-highlight">
                        <h2>Services</h2>
                    </div>
                </div>
                <div class="swiper-slider" data-autoplay="false" data-loop="true" data-dots="false" data-arrows="false" data-columns="3" data-margin="30" data-effect="slide">
                    <div class="swiper-wrapper">
                        @if ($services->isNotEmpty())
                            @foreach ($services as $service)
                                <article class="pbmit-ele-service pbmit-service-style-2 swiper-slide">
                                    <div class="pbminfotech-post-item">
                                        <div class="pbminfotech-box-content">
                                            <div class="pbmit-service-image-wrapper">
                                                <div class="pbmit-featured-img-wrapper">
                                                    <div class="pbmit-featured-wrapper">
                                                        @if ($service->hasImage())
                                                            <img src="{{ $service->getImageUrl('medium') }}" class="img-fluid" alt="{{ $service->title }}">
                                                        @else
                                                            <img src="{{ asset('assets/images/homepage-1/service/service-01.jpg') }}" class="img-fluid" alt="service-01">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-service-icon elementor-icon">
                                                <i class=""></i>
                                            </div>
                                            <div class="pbmit-content-box">
                                                <h3 class="pbmit-service-title">
                                                    <a href="service-details.html">{{ $service->title }}</a>
                                                </h3>
                                                <div class="pbmit-service-description">
                                                    <p>{{ $service->short_description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="pbmit-service-btn" href="{{ $service->click_url }}" target="{{ $service->click_target }}" title="{{ $service->title }}">
                                            <span class="pbmit-button-icon">
                                                <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                            </span>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <!-- Slide1 -->
                            <article class="pbmit-ele-service pbmit-service-style-2 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-service-image-wrapper">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    <img src="{{ asset('assets/images/homepage-1/service/service-01.jpg') }}" class="img-fluid" alt="service-01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-service-icon elementor-icon">
                                            <i class=""></i>
                                        </div>
                                        <div class="pbmit-content-box">
                                            <div class="pbmit-serv-cat">
                                                <a href="#" rel="tag">Kitchen</a>
                                            </div>
                                            <h3 class="pbmit-service-title">
                                                <a href="service-details.html">Transforming Rooms</a>
                                            </h3>
                                            <div class="pbmit-service-description">
                                                <p>The interior professional worker’s available in the xinterio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="pbmit-service-btn" href="service-details.html" title="Transforming Rooms">
                                        <span class="pbmit-button-icon">
                                            <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                        </span>
                                    </a>
                                </div>
                            </article>
                            <!-- Slide2 -->
                            <article class="pbmit-ele-service pbmit-service-style-2 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-service-image-wrapper">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    <img src="{{ asset('assets/images/homepage-1/service/service-02.jpg') }}" class="img-fluid" alt="service-01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-service-icon elementor-icon">
                                            <i class=""></i>
                                        </div>
                                        <div class="pbmit-content-box">
                                            <div class="pbmit-serv-cat">
                                                <a href="#" rel="tag">Kitchen</a>
                                            </div>
                                            <h3 class="pbmit-service-title">
                                                <a href="service-details.html">Weaving Dreams</a>
                                            </h3>
                                            <div class="pbmit-service-description">
                                                <p>The interior professional worker’s available in the xinterio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="pbmit-service-btn" href="service-details.html" title="Weaving Dreams">
                                        <span class="pbmit-button-icon">
                                            <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                        </span>
                                    </a>
                                </div>
                            </article>
                            <!-- Slide3 -->
                            <article class="pbmit-ele-service pbmit-service-style-2 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-service-image-wrapper">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    <img src="{{ asset('assets/images/homepage-1/service/service-03.jpg') }}" class="img-fluid" alt="service-01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-service-icon elementor-icon">
                                            <i class=""></i>
                                        </div>
                                        <div class="pbmit-content-box">
                                            <div class="pbmit-serv-cat">
                                                <a href="#" rel="tag">Kitchen</a>
                                            </div>
                                            <h3 class="pbmit-service-title">
                                                <a href="service-details.html">Interior Decorator</a>
                                            </h3>
                                            <div class="pbmit-service-description">
                                                <p>The interior professional worker’s available in the xinterio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="pbmit-service-btn" href="service-details.html" title="Interior Decorator">
                                        <span class="pbmit-button-icon">
                                            <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                        </span>
                                    </a>
                                </div>
                            </article>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <div class="pbmit-service-text">
                        <p>Need more services based on your demand? <span class="pbmit-globalcolor">Contact us</span></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Service End -->

        <!-- Portfolio Start -->
        <section class="pbmit-bg-color-light portfolio-one pbmit-sortable-yes">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-4">
                        <div class="pbmit-heading-subheading animation-style2">
                            <h4 class="pbmit-subtitle">Process</h4>
                            <h2 class="pbmit-title">Our Latest Project</h2>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-8">
                        <div class="pbmit-sortable-list">
                            <ul class="pbmit-sortable-list-ul">
                                <li><a href="#" class="pbmit-sortable-link pbmit-selected" data-category="*" data-sortby="*">All</a></li>
                                @if ($portfolios->isNotEmpty())
                                    @foreach ($portfolios as $type)
                                        @if (!empty($type->project_type))
                                            <li>
                                                <a href="#" class="pbmit-sortable-link" data-sortby="{{ strtolower($type->portfolio_type) }}">
                                                    {{ $type->portfolio_type }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pbmit-element-posts-wrapper">
                    @if ($portfolios->isNotEmpty())
                        @foreach ($portfolios as $portfolio)
                            <article class="pbmit-portfolio-style-3 col-md-4 bedroom">
                                <div class="pbminfotech-post-content">
                                    <div class="pbmit-featured-img-wrapper">
                                        <div class="pbmit-featured-wrapper">
                                            @if ($portfolio->hasImage())
                                                <img src="{{ $portfolio->getImageUrl('medium') }}"
                                                    class="img-fluid"
                                                    alt="{{ $portfolio->title }}"
                                                    style="width: 440px !important; height: 348px !important;">
                                            @else
                                                <img src="{{ asset('assets/images/homepage-1/portfolio/portfolio-01.jpg') }}" class="img-fluid" alt="portfolio-01">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pbminfotech-box-content">
                                        <div class="pbminfotech-titlebox">
                                            <div class="pbmit-port-cat">
                                                <a href="{{ route('portfolio') }}" rel="tag">{{ $portfolio->project_type }}</a>
                                            </div>
                                            <h3 class="pbmit-portfolio-title">
                                                <a href="{{ $portfolio->getUrl() }}">{{ $portfolio->title }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="pbmit-portfolio-btn">
                                        <a href="{{ $portfolio->getUrl() }}">
                                            <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                        </a>
                                    </div>
                                    <a class="pbmit-link" href="{{ $portfolio->getUrl() }}"></a>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <article class="pbmit-portfolio-style-3 col-md-4 bedroom">
                            <div class="pbminfotech-post-content">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{ asset('assets/images/homepage-1/portfolio/portfolio-01.jpg') }}" class="img-fluid" alt="portfolio-01">
                                    </div>
                                </div>
                                <div class="pbminfotech-box-content">
                                    <div class="pbminfotech-titlebox">
                                        <div class="pbmit-port-cat">
                                            <a href="portfolio-grid-col-3.html" rel="tag">Bedroom</a>
                                        </div>
                                        <h3 class="pbmit-portfolio-title">
                                            <a href="portfolio-detail-style-1.html">Innovation</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="pbmit-portfolio-btn">
                                    <a href="portfolio-detail-style-1.html">
                                        <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                    </a>
                                </div>
                                <a class="pbmit-link" href="portfolio-detail-style-1.html"></a>
                            </div>
                        </article>
                        <article class="pbmit-portfolio-style-3 col-md-4 furniture">
                            <div class="pbminfotech-post-content">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{ asset('assets/images/homepage-1/portfolio/portfolio-02.jpg') }}" class="img-fluid" alt="portfolio-01">
                                    </div>
                                </div>
                                <div class="pbminfotech-box-content">
                                    <div class="pbminfotech-titlebox">
                                        <div class="pbmit-port-cat">
                                            <a href="portfolio-grid-col-3.html" rel="tag">Furniture</a>
                                        </div>
                                        <h3 class="pbmit-portfolio-title">
                                            <a href="portfolio-detail-style-1.html">Minimalism</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="pbmit-portfolio-btn">
                                    <a href="portfolio-detail-style-1.html">
                                        <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                    </a>
                                </div>
                                <a class="pbmit-link" href="portfolio-detail-style-1.html"></a>
                            </div>
                        </article>
                        <article class="pbmit-portfolio-style-3 col-md-4 interior">
                            <div class="pbminfotech-post-content">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{ asset('assets/images/homepage-1/portfolio/portfolio-03.jpg') }}" class="img-fluid" alt="portfolio-01">
                                    </div>
                                </div>
                                <div class="pbminfotech-box-content">
                                    <div class="pbminfotech-titlebox">
                                        <div class="pbmit-port-cat">
                                            <a href="portfolio-grid-col-3.html" rel="tag">Interior</a>
                                        </div>
                                        <h3 class="pbmit-portfolio-title">
                                            <a href="portfolio-detail-style-1.html">Lighting</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="pbmit-portfolio-btn">
                                    <a href="portfolio-detail-style-1.html">
                                        <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                    </a>
                                </div>
                                <a class="pbmit-link" href="portfolio-detail-style-1.html"></a>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </section>
        <!-- Portfolio End -->

        <!-- Pricing Start -->
        <section class="section-xl pricing-one-bg">
            <div class="container">
                <div class="text-center position-relative">
                    <div class="pbmit-heading-subheading animation-style3">
                        <h4 class="pbmit-subtitle">Pricing Plan</h4>
                        <h2 class="pbmit-title">Investasi dalam Desain yang Tahan Lama</h2>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-12 col-xl-12">
                        <div class="pbminfotech-ele-ptable-style-1">
                            <div class="pbmit-ptable-cols row">
                                @if ($packages->isNotEmpty())
                                    @foreach ($packages as $package)
                                        <div class="pbmit-ptable-col col-md-6">
                                            <div class="pbmit-pricing-table-box">
                                                <div class="pbmit-head-wrap">
                                                    <h3 class="pbminfotech-ptable-heading">{{ $package->package_name}}</h3>
                                                    <div class="pbminfotech-sep"></div>
                                                    <div class="pbmit-price-wrapper">
                                                        <div class="pbmit-ptable-price-w">
                                                            <div class="pbminfotech-ptable-symbol">IDR</div>
                                                            <div class="pbminfotech-ptable-price">{{ $package->price_per_meter }}</div>
                                                        </div>
                                                        <div class="pbminfotech-ptable-frequency">/meter</div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ptable-inner">
                                                    <div class="pbmit-ptable-lines-w">
                                                        {{ $package->features_summary}}
                                                    </div>
                                                    <div class="pbminfotech-ptable-btn">
                                                        <div class="pbmit-button">
                                                            <a class="pbmit-button-inner" href="{{ route('contact-us') }}">
                                                                <span class="pbmit-button-wrapper">
                                                                    <span class="pbmit-button-text">{{ $package->cta_text }}</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-feature-wrap"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="pbmit-ptable-col col-md-3">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Standard Plan</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 14px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 40px !important">2 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 14px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Blokboard 18mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Engsell slowmotion ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rell double track ex huben</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Piring Kabinet Atas/Bawah Standard</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Sendok Standard</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Edging pvc ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing hpl ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing kabinet dalam melaminto</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">LED Strip</div>
                                                </div>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="{{ route('contact-us') }}">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Purchase Now</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                            </div>
                                            <div class="pbmit-feature-wrap"></div>
                                        </div>
                                    </div>
                                    <div class="pbmit-pricing-table-featured-col pbmit-ptable-col col-md-3">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Premium Plan</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 14px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 40px !important">2,4 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 14px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Multiplex 18mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Engsell slowmotion ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rell double track ex huben</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Piring Kabinet Atas/Bawah Standard</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Sendok Standard</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Edging pvc ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing hpl ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing kabinet dalam melaminto</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">LED Strip</div>
                                                </div>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="{{ route('contact-us') }}">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Purchase Now</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                            </div>
                                            <div class="pbmit-feature-wrap"></div>
                                        </div>
                                    </div>
                                    <div class="pbmit-ptable-col col-md-3">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Platinum Plan</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 14px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 40px !important">2,8 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 14px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Multiplex 18mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Engsell slowmotion ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rell double track ex huben</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Piring Kabinet Atas & Bawah Stainless</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Sendok Stainless</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Edging pvc ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing hpl ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing kabinet dalam tacosheet</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Kaca polos 5 mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">LED Strip</div>
                                                </div>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="about-mask-img">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Purchase Now</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-feature-wrap">
                                                <div class="pbmit-ptablebox-featured-w"></div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="pbmit-pricing-table-featured-col pbmit-ptable-col col-md-3">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Luxury Plan</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 14px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 40px !important">3,2 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 14px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">PVC,HDF/HMR 18 mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Engsell slowmotion ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rell double track ex huben</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Piring Kabinet Atas & Bawah Stainless</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Rak Sendok Standard</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Edging pvc ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing hpl ex taco</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Finishing kabinet dalam tacosheet</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">Kaca polos 5 mm</div>
                                                    <div class="pbmit-ptable-line" style="font-size: 12px !important;">LED Strip</div>
                                                </div>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="{{ route('contact-us') }}">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Purchase Now</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                            </div>
                                            <div class="pbmit-feature-wrap"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing End -->

        <!-- Process Start -->
        <section class="process-section-two">
            <div class="container">
                <div class="text-center position-relative">
                    <div class="pbmit-heading-subheading animation-style3">
                        <h4 class="pbmit-subtitle">Steps</h4>
                        <h2 class="pbmit-title">Work Process Home Care Interior</h2>
                    </div>
                    <div class="pbmit-ih-highlight">
                        <h2>Process</h2>
                    </div>
                </div>
                <div class="row pbmit-element-column-four">
                    @if ($homeBottom->isNotEmpty())
                        @foreach ($homeBottom as $homeBottomFeature)
                            <article class="pbmit-miconheading-style-4 col-md-6 col-lg-3">
                                <div class="pbmit-ihbox-style-4">
                                    <div class="pbmit-ihbox-headingicon">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="{{ $homeBottomFeature->icon_class }}"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="pbmit-element-title">
                                            {{ $homeBottomFeature->title }}
                                        </h2>
                                        <div class="pbmit-heading-desc">{{ $homeBottomFeature->description }}</div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <article class="pbmit-miconheading-style-4 col-md-6 col-lg-3">
                            <div class="pbmit-ihbox-style-4">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-engineer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="pbmit-element-title">
                                        Meet Designer
                                    </h2>
                                    <div class="pbmit-heading-desc">Lorem ipsum is simply text of the printing typesetting.</div>
                                </div>
                            </div>
                        </article>
                        <article class="pbmit-miconheading-style-4 col-md-6 col-lg-3">
                            <div class="pbmit-ihbox-style-4">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-compass"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="pbmit-element-title">
                                        Finalized layout
                                    </h2>
                                    <div class="pbmit-heading-desc">Lorem ipsum is simply text of the printing typesetting.</div>
                                </div>
                            </div>
                        </article>
                        <article class="pbmit-miconheading-style-4 col-md-6 col-lg-3">
                            <div class="pbmit-ihbox-style-4">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-tools"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="pbmit-element-title">
                                        Work in progress
                                    </h2>
                                    <div class="pbmit-heading-desc">Lorem ipsum is simply text of the printing typesetting.</div>
                                </div>
                            </div>
                        </article>
                        <article class="pbmit-miconheading-style-4 col-md-6 col-lg-3">
                            <div class="pbmit-ihbox-style-4">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-axis"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="pbmit-element-title">
                                        Smooth delivery
                                    </h2>
                                    <div class="pbmit-heading-desc">Lorem ipsum is simply text of the printing typesetting.</div>
                                </div>
                            </div>
                        </article>
                    @endif
                </div>
                <div class="pbmit-text-editor">
                    <span class="pbmit-text-design">Hurry</span>  Let’s make something great work together. Got a project in mind? <span class="pbmit-globalcolor"><u>Got a project in mind?</u></span>
                </div>
            </div>
        </section>
        <!-- Process End -->

        <!-- Blog Start -->
        <section class="section-md" style="padding-top: 50px !important">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="pbmit-heading-subheading animation-style4">
                            <h4 class="pbmit-subtitle">What we do</h4>
                            <h2 class="pbmit-title">Latest posts & articles</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-btn">
                            <a class="pbmit-btn pbmit-btn-outline" href="{{ route('blog') }}">
                                <span class="pbmit-button-content-wrapper">
                                    <span class="pbmit-button-text">See all blogs</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row g-0 align-items-center">
                    <div class="col-md-12 col-xl-4">
                        <div class="row">
                            <div class="blog-one-left-col">
                                @if ($blogs->isNotEmpty())
                                    @foreach ($blogs as $blog)
                                        <article class="pbmit-ele-blog pbmit-blog-style-2 col-md-12">
                                            <div class="post-item">
                                                <div class="pbminfotech-box-content">
                                                    <div class="pbminfotech-content-inner">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="{{ $blog->getFeaturedImageUrl('large') }}" class="img-fluid" alt="{{ $blog->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="pbmit-meta-wraper">
                                                            <div class="pbmit-meta-date-wrapper pbmit-meta-line">
                                                                <div class="pbmit-meta-date">
                                                                    <span class="pbmit-post-date">
                                                                        <i class="pbmit-base-icon-calendar-3"></i>{{ $blog->created_at->format('M d, Y') }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="pbmit-meta-author pbmit-meta-line">
                                                                <span class="pbmit-post-author">
                                                                    <i class="pbmit-base-icon-user-3"></i>
                                                                    <span>By</span>{{ $blog->author->name ?? 'admin' }}
                                                                </span>
                                                            </div>
                                                            <div class="pbmit-content-wrapper">
                                                                <h3 class="pbmit-post-title">
                                                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-8">
                        <div class="blog-one-right-col">
                            <article class="pbmit-ele-blog pbmit-blog-style-3">
                                <div class="post-item d-flex">
                                    <div class="pbmit-featured-container">
                                        <div class="pbmit-bg-image" style="background-image:url('{{ $featureBlog->getFeaturedImageUrl('large') }}">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    @if ($featureBlog->hasFeaturedImage())
                                                        <img src="{{ $featureBlog->getFeaturedImageUrl('large') }}" class="img-fluid" alt="{{ $featureBlog->title }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/homepage-1/blog/blog-04b.jpg') }}" class="img-fluid" alt="blog-01">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pbminfotech-box-wrap">
                                        <div class="pbminfotech-box-content">
                                            <div class="pbmit-date-admin-wraper d-flex align-items-center">
                                                <div class="pbmit-meta-date pbmit-meta-line">
                                                    <span class="pbmit-post-date">
                                                        <i class="pbmit-base-icon-calendar-3"></i>{{ $featureBlog->created_at->format('M d, Y') }}
                                                    </span>
                                                </div>
                                                <div class="pbmit-meta-author pbmit-meta-line">
                                                <span class="pbmit-post-author">
                                                    <i class="pbmit-base-icon-user-3"></i>
                                                    <span>By</span>{{ $featureBlog->author->name ?? 'admin' }}
                                                </span>
                                                </div>
                                            </div>
                                            <h3 class="pbmit-post-title">
                                                <a href="{{ route('blog.show', $featureBlog->slug) }}">{{ $featureBlog->title }}</a>
                                            </h3>
                                            <div class="pbminfotech-box-desc">
                                                {{ $featureBlog->content_overview }}
                                            </div>
                                        </div>
                                        <a class="pbmit-blog-btn" href="{{ route('blog.show', $featureBlog->slug) }}">
                                            <span class="pbmit-button-icon">
                                                <i class="pbmit-base-icon-pbmit-up-arrow"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog End -->

    </div>

    <a id="home-floating-whatsapp" href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%2C%20terima%20kasih%20telah%20menghubungi%20Home%20Care%20Interior.%20Saya%20ingin%20berkonsultasi%20mengenai%20kebutuhan%20desain%20interior%2C%20boleh%20dibantu%20untuk%20konsultasinya.%20" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <span class="visually-hidden-text">Home - Contact on Whatsapp</span>
        <i class="fa fa-whatsapp"></i>
    </a>
</x-superduper.main>
@push('js')
<script>
    function trackBannerClick(bannerId) {
        fetch(`/api/banners/${bannerId}/click`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            keepalive: true
        }).catch(() => {});
    }
</script>
@endpush
