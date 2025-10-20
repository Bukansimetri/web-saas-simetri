@section('hero')
    @php
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

        $baseQuery = \App\Models\Testimonial::where('is_active', true);
        $averageRating = number_format((clone $baseQuery)->avg('rating'), 1);
        $totalRatings = (clone $baseQuery)->count();

        $packages = \App\Models\Package::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $clients = \App\Models\Client::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with(['media'])
            ->take(6)
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
                                <h4 class="pbmit-subtitle">since 2022</h4>
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
                                                            Commercial
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
                                                            industrial
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
                                                            Residential
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
                                                            Corporate
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

        <!-- Ihbox Start -->
        <section class="section-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xl-4">
                        <div class="pbmit-heading-subheading animation-style2">
                            <h4 class="pbmit-subtitle">since 2022</h4>
                            <h2 class="pbmit-title">Why choose us</h2>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="pbmit-heading-desc">
                            <!-- Take Out -->
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-2">
                        <a class="pbmit-btn pbmit-btn-outline" href="contact-us.html">
                            <span class="pbmit-button-content-wrapper">
                                <span class="pbmit-button-text">Book Consult</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-3 ihbox-one-left-col">
                        <div class="row">
                            @if ($homeMiddleLeft->isNotEmpty())
                                @foreach ($homeMiddleLeft as $featureMiddle)
                                    <article class="pbmit-miconheading-style-8 col-md-12">
                                        <div class="pbmit-ihbox-style-8">
                                            <div class="pbmit-ihbox-box d-flex">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xinterio-icon {{ $featureMiddle->icon_class ?? 'pbmit-xinterio-icon-stairs' }}"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        {{ $featureMiddle->title }}
                                                    </h2>
                                                    <div class="pbmit-heading-desc">{{ $featureMiddle->description }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-stairs"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    5 Years Warranty
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-3d"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    Latest technologies
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-kitchen"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    High-Quality Designs
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        </div>
                    </div>
                    <!-- Start Change Image -->
                    <div class="col-md-6 ihbox-one-img-col">
                        <div class="ihbox-imgbox">
                            <img src="https://homecareinterior.co.id/storage/9/why-choose-us-520x520.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <!-- End Change Image -->
                    <div class="col-md-3 ihbox-one-right-col">
                        <div class="row">
                            @if ($homeMiddleRight->isNotEmpty())
                                @foreach ($homeMiddleRight as $featureMiddleRight)
                                    <article class="pbmit-miconheading-style-8 col-md-12">
                                        <div class="pbmit-ihbox-style-8">
                                            <div class="pbmit-ihbox-box d-flex">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xinterio-icon {{ $featureMiddleRight->icon_class ?? 'pbmit-xinterio-icon-axis' }}"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        {{ $featureMiddleRight->title }}
                                                    </h2>
                                                    <div class="pbmit-heading-desc">{{ $featureMiddleRight->description }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-axis"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    Transparent Pricing
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-brickwall-1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    Professional Team
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="pbmit-miconheading-style-8 col-md-12">
                                    <div class="pbmit-ihbox-style-8">
                                        <div class="pbmit-ihbox-box d-flex">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="pbmit-xinterio-icon pbmit-xinterio-icon-pantone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ihbox-contents">
                                                <h2 class="pbmit-element-title">
                                                    Award winning
                                                </h2>
                                                <div class="pbmit-heading-desc">We offer competitive and affordable rates for our interior design .</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ihbox End -->

        <!-- Marquee Start -->
        <section class="marquee-one">
            <div class="p-0 container-fluid">
                <div class="swiper-slider marquee">
                    <div class="swiper-wrapper">
                        <article class="pbmit-marquee-effect-style-1 swiper-slide">
                            <div class="pbmit-tag-wrapper">
                                <h2 class="pbmit-element-title" data-text="Master Bedroom ">
                                    Master Bedroom
                                </h2>
                            </div>
                        </article>
                        <article class="pbmit-marquee-effect-style-1 swiper-slide">
                            <div class="pbmit-tag-wrapper">
                                <h2 class="pbmit-element-title" data-text="Living Room">
                                    Living Room
                                </h2>
                            </div>
                        </article>
                        <article class="pbmit-marquee-effect-style-1 swiper-slide">
                            <div class="pbmit-tag-wrapper">
                                <h2 class="pbmit-element-title" data-text="Kitchen">
                                    Kitchen
                                </h2>
                            </div>
                        </article>
                        <article class="pbmit-marquee-effect-style-1 swiper-slide">
                            <div class="pbmit-tag-wrapper">
                                <h2 class="pbmit-element-title" data-text="Best Gallery">
                                    Best Gallery
                                </h2>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- Marquee End -->

        <!-- Before After Start -->
        <section>
            <div class="p-0 container-fluid">
                <div class="row g-2">
                    <div class="col-md-12 col-xl-6">
                        <div class="before-after-left-area pbmit-bg-color-blackish">
                            <div class="pbmit-heading-subheading animation-style4">
                                <h4 class="pbmit-subtitle">since 1986</h4>
                                <h2 class="pbmit-title">We design thoughtful, livable spaces.</h2>
                                <div class="pbmit-heading-desc">
                                    Kami percaya bahwa setiap ruang memiliki karakter unik yang perlu diterjemahkan melalui desain yang tepat, detail yang presisi, dan eksekusi yang sempurna.
                                </div>
                            </div>
                            <div class="row pbmit-fid-style-one">
                                <div class="col-md-6">
                                    <div class="pbminfotech-ele-fid-style-1">
                                        <div class="pbmit-fld-contents d-flex align-items-center">
                                            <div class="pbmit-circle-outer" data-digit="87" data-fill="#bb9a65" data-emptyfill="" data-before="" data-after="<span>%</span>" data-thickness="1" data-size="127">
                                                <div class="pbmit-circle">
                                                    <div class="pbmit-fid-inner">
                                                        <span class="pbmit-fid-before"></span>
                                                        <span class="pbmit-number-rotate numinate" data-appear-animation="animateDigits" data-from="0" data-to="87" data-interval="5" data-before="" data-before-style="" data-after="" data-after-style="">87</span>
                                                        <span class="pbmit-fid"><span>%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-fid-sub">
                                                <h3 class="pbmit-fid-title">Clients <br> Satisfactions</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pbminfotech-ele-fid-style-1">
                                        <div class="pbmit-fld-contents d-flex align-items-center">
                                            <div class="pbmit-circle-outer" data-digit="89" data-fill="#bb9a65" data-emptyfill="" data-before="" data-after="<span>%</span>" data-thickness="1" data-size="127">
                                                <div class="pbmit-circle">
                                                    <div class="pbmit-fid-inner">
                                                        <span class="pbmit-fid-before"></span>
                                                        <span class="pbmit-number-rotate numinate" data-appear-animation="animateDigits" data-from="0" data-to="89" data-interval="5" data-before="" data-before-style="" data-after="" data-after-style="">89</span>
                                                        <span class="pbmit-fid"><span>%</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-fid-sub">
                                                <h3 class="pbmit-fid-title">Work <br> Experiences</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="twentytwenty-container">
                            <img src="https://homecareinterior.co.id/storage/12/Before-955x595.jpg" alt="Before">
                            <img src="https://homecareinterior.co.id/storage/13/after-955x595.jpg" alt="After">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Before After End -->

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
                                    @foreach ($portfolios->pluck('project_type')->unique() as $type)
                                        <li><a href="#" class="pbmit-sortable-link" data-sortby="{{ strtolower($type) }}">{{ $type }}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="#" class="pbmit-sortable-link" data-sortby="architecture">Architecture</a></li>
                                    <li><a href="#" class="pbmit-sortable-link" data-sortby="bedroom">Bedroom</a></li>
                                    <li><a href="#" class="pbmit-sortable-link"  data-sortby="furniture">Furniture</a></li>
                                    <li><a href="#" class="pbmit-sortable-link" data-sortby="interior">Interior</a></li>
                                    <li><a href="#" class="pbmit-sortable-link" data-sortby="kitchen">Kitchen</a></li>
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
                                                <img src="{{ $portfolio->getImageUrl('medium') }}" class="img-fluid" alt="{{ $portfolio->title }}">
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

        <!-- Pricing Start -->
        <section class="section-xl pricing-one-bg">
            <div class="container">
                <div class="row g-0">
                    <div class="col-md-12 col-xl-7">
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
                                    <div class="pbmit-ptable-col col-md-6">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Basic Plan</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 20px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 50px !important">27 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 20px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line">Konsultasi intensif & analisis kebutuhan</div>
                                                    <div class="pbmit-ptable-line">Desain konsep menyeluruh (layout, moodboard, dan 3D visual)</div>
                                                    <div class="pbmit-ptable-line">Desain detail tiap area (meja, kitchen set, lighting, dinding, flooring)</div>
                                                    <div class="pbmit-ptable-line">Estimasi RAB dan pemilihan material</div>
                                                    <div class="pbmit-ptable-line">Supervisi desain saat pengerjaan</div>
                                                </div>
                                                <p style="margin-top: 8%">
                                                    <b>Cocok Untuk:</b><br>
                                                    Proyek residential skala menengah seperti apartemen, rumah, atau unit sewa yang butuh desain cepat dan fungsional
                                                </p>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="{{ route('contact-us') }}">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Consult Now</span>
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
                                    <div class="pbmit-pricing-table-featured-col pbmit-ptable-col col-md-6">
                                        <div class="pbmit-pricing-table-box">
                                            <div class="pbmit-head-wrap">
                                                <h3 class="pbminfotech-ptable-heading">Advance</h3>
                                                <div class="pbminfotech-sep"></div>
                                                <div class="pbmit-price-wrapper">
                                                    <div class="pbmit-ptable-price-w">
                                                        <div class="pbminfotech-ptable-symbol" style="font-size: 20px !important">Rp</div>
                                                        <div class="pbminfotech-ptable-price" style="font-size: 50px !important">47 Juta</div>
                                                    </div>
                                                    <div class="pbminfotech-ptable-frequency" style="font-size: 20px !important">/Meter</div>
                                                </div>
                                            </div>
                                            <div class="pbmit-ptable-inner">
                                                <div class="pbmit-ptable-lines-w">
                                                    <div class="pbmit-ptable-line">Konsultasi intensif & analisis kebutuhan</div>
                                                    <div class="pbmit-ptable-line">Desain konsep menyeluruh (layout, moodboard, dan 3D visual)</div>
                                                    <div class="pbmit-ptable-line">Desain detail tiap area (meja, kitchen set, lighting, dinding, flooring)</div>
                                                    <div class="pbmit-ptable-line">Estimasi RAB dan pemilihan material</div>
                                                    <div class="pbmit-ptable-line">Supervisi desain saat pengerjaan</div>
                                                </div>
                                                <p style="margin-top: 8%; color:white;">
                                                    <b>Cocok Untuk:</b><br>
                                                    Proyek corporate atau commercial yang menuntut tampilan berkelas dan pengerjaan terkoordinasi dengan tim konstruksi
                                                </p>
                                                <div class="pbminfotech-ptable-btn">
                                                    <div class="pbmit-button">
                                                        <a class="pbmit-button-inner" href="about-mask-img">
                                                            <span class="pbmit-button-wrapper">
                                                                <span class="pbmit-button-text">Consult Now</span>
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
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-5">
                        <div class="pricing-one-rightbox">
                            <div class="pbmit-heading-subheading animation-style2">
                                <h4 class="pbmit-subtitle">Pricing Plan</h4>
                                <h2 class="pbmit-title">Invest in Design That Lasts</h2>
                                <p>Kami memahami bahwa setiap proyek memiliki kebutuhan dan skala berbeda. Karena itu, Home Care Interior menyediakan pilihan paket layanan yang fleksibel</p>
                            </div>
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item">
                                    <span class="pbmit-icon-list-icon">
                                        <i aria-hidden="true" class="pbmit-xinterio-icon pbmit-xinterio-icon-wallet"></i>
                                    </span>
                                    <span class="pbmit-icon-list-text">No any hidden fees pay</span>
                                </li>
                            </ul>
                            <a class="pbmit-btn pbmit-btn-outline" href="{{ route('contact-us') }}">
                                <span class="pbmit-button-content-wrapper">
                                    <span class="pbmit-button-text">More Price</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing End -->

        <!-- Testimonial Start -->
        <section class="pbmit-bg-color-light testimonial-one">
            <div class="container pbmit-col-stretched-yes pbmit-col-right">
                <div class="pbmit-col-stretched-right">
                    <div class="row g-0">
                        <div class="col-md-12 col-lg-3">
                            <div class="pbmit-testimonialbox-left">
                                <div class="pbmit-heading-subheading animation-style2">
                                    <h4 class="pbmit-subtitle">Client feedback</h4>
                                    <h2 class="pbmit-title">Hear from clients.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-9 pbmit-testimonialbox-right">
                            <div class="swiper-slider" data-autoplay="true" data-loop="true" data-dots="false" data-arrows="true" data-columns="2.6" data-margin="30" data-effect="slide">
                                <div class="swiper-wrapper">
                                    <!-- Slide1 -->
                                    @if ($testimonials->isNotEmpty())
                                        @foreach ($testimonials as $testimonial)
                                            <article class="pbmit-testimonial-style-1 swiper-slide">
                                                <div class="pbminfotech-post-item">
                                                    <div class="pbmit-box-content-wrap">
                                                        <div class="pbminfotech-box-star-ratings">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $testimonial->rating)
                                                                    <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="pbminfotech-box-desc">
                                                            <blockquote class="pbminfotech-testimonial-text">
                                                                <p>{{ $testimonial->description }}</p>
                                                            </blockquote>
                                                        </div>
                                                        <div class="pbminfotech-box-author">
                                                            <div class="pbmit-auther-content">
                                                                <h3 class="pbminfotech-box-title">{{ $testimonial->client }}</h3>
                                                                <div class="pbminfotech-testimonial-detail">{{ $testimonial->client_location }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="pbminfotech-box-img">
                                                            <div class="pbmit-featured-img-wrapper">
                                                                <div class="pbmit-featured-wrapper">
                                                                    @if ($testimonial->hasImage())
                                                                        <img src="{{ $testimonial->getImageUrl('preview') }}" class="img-fluid" alt="{{ $testimonial->client }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/images/homepage-1/reviewer/reviewer-01.jpg') }}" class="img-fluid" alt="reviewer-04">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        @endforeach
                                    @else
                                        <article class="pbmit-testimonial-style-1 swiper-slide">
                                            <div class="pbminfotech-post-item">
                                                <div class="pbmit-box-content-wrap">
                                                    <div class="pbminfotech-box-star-ratings">
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                    </div>
                                                    <div class="pbminfotech-box-desc">
                                                        <blockquote class="pbminfotech-testimonial-text">
                                                            <p>Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks guys for all your hard work. Trust us we looked for a very long time.</p>
                                                        </blockquote>
                                                    </div>
                                                    <div class="pbminfotech-box-author">
                                                        <div class="pbmit-auther-content">
                                                            <h3 class="pbminfotech-box-title">Olivia Cruz</h3>
                                                            <div class="pbminfotech-testimonial-detail">Grorgia, USA</div>
                                                        </div>
                                                    </div>
                                                    <div class="pbminfotech-box-img">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="{{ asset('assets/images/homepage-1/reviewer/reviewer-01.jpg') }}" class="img-fluid" alt="reviewer-04">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- Slide2 -->
                                        <article class="pbmit-testimonial-style-1 swiper-slide">
                                            <div class="pbminfotech-post-item">
                                                <div class="pbmit-box-content-wrap">
                                                    <div class="pbminfotech-box-star-ratings">
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                    </div>
                                                    <div class="pbminfotech-box-desc">
                                                        <blockquote class="pbminfotech-testimonial-text">
                                                            <p>Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks guys for all your hard work. Trust us we looked for a very long time.</p>
                                                        </blockquote>
                                                    </div>
                                                    <div class="pbminfotech-box-author">
                                                        <div class="pbmit-auther-content">
                                                            <h3 class="pbminfotech-box-title">Martin Bailey</h3>
                                                            <div class="pbminfotech-testimonial-detail">Grorgia, USA</div>
                                                        </div>
                                                    </div>
                                                    <div class="pbminfotech-box-img">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="{{ asset('assets/images/homepage-1/reviewer/reviewer-02.jpg') }}" class="img-fluid" alt="reviewer-04">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- Slide3 -->
                                        <article class="pbmit-testimonial-style-1 swiper-slide">
                                            <div class="pbminfotech-post-item">
                                                <div class="pbmit-box-content-wrap">
                                                    <div class="pbminfotech-box-star-ratings">
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                    </div>
                                                    <div class="pbminfotech-box-desc">
                                                        <blockquote class="pbminfotech-testimonial-text">
                                                            <p>Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks guys for all your hard work. Trust us we looked for a very long time.</p>
                                                        </blockquote>
                                                    </div>
                                                    <div class="pbminfotech-box-author">
                                                        <div class="pbmit-auther-content">
                                                            <h3 class="pbminfotech-box-title">Alex Zender</h3>
                                                            <div class="pbminfotech-testimonial-detail">Grorgia, USA</div>
                                                        </div>
                                                    </div>
                                                    <div class="pbminfotech-box-img">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="{{ asset('assets/images/homepage-1/reviewer/reviewer-03.jpg') }}" class="img-fluid" alt="reviewer-04">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- Slide4 -->
                                        <article class="pbmit-testimonial-style-1 swiper-slide">
                                            <div class="pbminfotech-post-item">
                                                <div class="pbmit-box-content-wrap">
                                                    <div class="pbminfotech-box-star-ratings">
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                        <i class="pbmit-base-icon-star-1 pbmit-active"></i>
                                                    </div>
                                                    <div class="pbminfotech-box-desc">
                                                        <blockquote class="pbminfotech-testimonial-text">
                                                            <p>Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks guys for all your hard work. Trust us we looked for a very long time.</p>
                                                        </blockquote>
                                                    </div>
                                                    <div class="pbminfotech-box-author">
                                                        <div class="pbmit-auther-content">
                                                            <h3 class="pbminfotech-box-title">Robert Gold</h3>
                                                            <div class="pbminfotech-testimonial-detail">Grorgia, USA</div>
                                                        </div>
                                                    </div>
                                                    <div class="pbminfotech-box-img">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="{{ asset('assets/images/homepage-1/reviewer/reviewer-04.jpg') }}" class="img-fluid" alt="reviewer-04">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ihbox-style-area">
                    <div class="pbmit-ihbox-style-2">
                        <div class="pbmit-ihbox-headingicon">
                            <div class="pbmit-ihbox-contents d-flex align-items-center">
                                <div class="pbmit-title-wrap">
                                    <h2 class="pbmit-element-title">{{ $averageRating  }}</h2>
                                </div>
                                <div class="pbmit-icon-wrap">
                                    <div class="pbmit-ihbox-svg">
                                        <div class="pbmit-ihbox-svg-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="90.51" viewBox="0 0 512 90.51">
                                                <path d="M89.26,29.43l-24.9-3.62L53.23,3.33c-2.2-4.44-9.48-4.44-11.68,0L30.42,25.81,5.58,29.43A6.52,6.52,0,0,0,2,40.55L20,58.11,15.74,82.88a6.51,6.51,0,0,0,9.46,6.87l22.19-11.7,22.25,11.7a6.5,6.5,0,0,0,3,.75,6.51,6.51,0,0,0,6.43-7.62L74.86,58.11l18-17.56a6.52,6.52,0,0,0-3.62-11.12Z"></path>
                                                <path d="M193.55,29.43l-24.9-3.62L157.52,3.33c-2.2-4.44-9.48-4.44-11.68,0L134.71,25.81l-24.84,3.62a6.52,6.52,0,0,0-3.61,11.12l18,17.56L120,82.88a6.52,6.52,0,0,0,9.47,6.87l22.19-11.7,22.25,11.7a6.5,6.5,0,0,0,3,.75,6.51,6.51,0,0,0,6.43-7.62l-4.24-24.77,18-17.56a6.52,6.52,0,0,0-3.62-11.12Z"></path>
                                                <path d="M297.84,29.43l-24.9-3.62L261.81,3.33c-2.2-4.44-9.48-4.44-11.68,0L239,25.81l-24.84,3.62a6.52,6.52,0,0,0-3.61,11.12l18,17.56-4.25,24.77a6.52,6.52,0,0,0,9.47,6.87L256,78.05l22.25,11.7a6.5,6.5,0,0,0,3,.75,6.51,6.51,0,0,0,6.43-7.62l-4.24-24.77,18-17.56a6.52,6.52,0,0,0-3.62-11.12Z"></path>
                                                <path d="M402.13,29.43l-24.9-3.62L366.1,3.33c-2.2-4.44-9.48-4.44-11.69,0L343.29,25.81l-24.84,3.62a6.52,6.52,0,0,0-3.61,11.12l18,17.56L328.6,82.88a6.52,6.52,0,0,0,9.47,6.87l22.18-11.7,22.26,11.7a6.5,6.5,0,0,0,3,.75A6.51,6.51,0,0,0,392,82.88l-4.24-24.77,18-17.56a6.52,6.52,0,0,0-3.61-11.12Z"></path>
                                                <path d="M511.68,33.86a6.54,6.54,0,0,0-5.26-4.43l-24.9-3.62L470.39,3.33c-2.2-4.44-9.48-4.44-11.69,0L447.58,25.81l-24.84,3.62a6.52,6.52,0,0,0-3.61,11.12l18,17.56-4.25,24.77a6.52,6.52,0,0,0,6.42,7.62,6.61,6.61,0,0,0,3.05-.75l22.19-11.7,22.26,11.7a6.46,6.46,0,0,0,6.86-.5,6.53,6.53,0,0,0,2.59-6.37L492,58.11l18-17.56A6.54,6.54,0,0,0,511.68,33.86Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="pbmit-element-heading">
                                         {{ $totalRatings }}Rating
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial End -->

        <!-- Blog Start -->
        <section class="section-md">
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
                                                                @if ($blog->hasFeaturedImage())
                                                                    <img src="{{ $blog->getImageUrl('preview') }}" class="img-fluid" alt="{{ $blog->title }}">
                                                                @else
                                                                    <img src="{{ asset('assets/images/homepage-1/blog/blog-01.jpg') }}" class="img-fluid" alt="blog-01">
                                                                @endif
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
                                        <div class="pbmit-bg-image" style="background-image:url('{{ asset('assets/images/homepage-1/blog/blog-04b.jpg') }}">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    @if ($featureBlog->hasFeaturedImage())
                                                        <img src="{{ $featureBlog->getImageUrl('large') }}" class="img-fluid" alt="{{ $featureBlog->title }}">
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
                                                <a href="blog-single-details.html">{{ $featureBlog->title }}</a>
                                            </h3>
                                            <div class="pbminfotech-box-desc">
                                                {{ $featureBlog->content_overview }}
                                            </div>
                                        </div>
                                        <a class="pbmit-blog-btn" href="blog-single-details.html">
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
