@php
    $heroBanners = \App\Models\Banner\Content::whereHas('category', function($query) {
            $query->where('slug', 'home-banner');
        })
        ->active()
        ->orderBy('sort')
        ->with(['media'])
        ->take(5)
        ->get();

    // Pisahkan banner: 2 untuk carousel utama, 3 untuk side banner
    $mainCarouselBanners = $heroBanners->take(2);
    $sideBanners = $heroBanners->slice(2, 3);
@endphp

<!-- ======================== Offer Banner Start ==================== -->
<section class="pt-5 pb-5 offer-banner-wrap">
    <div class="container">
        <div class="row align-items-center">

            <!-- Carousel Utama (8 kolom) -->
            <div class="col-lg-8 col-md-8 col-sm-12">
                @if($mainCarouselBanners->isNotEmpty())
                <div id="bannerCarousel" class="carousel slide elec-slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($mainCarouselBanners as $index => $banner)
                        <li data-target="#bannerCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($mainCarouselBanners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img class="rounded d-block w-100" src="{{ $banner->getImageUrl('large') ?? 'https://placehold.co/1200x700' }}" alt="{{ $banner->title }}">
                            @if($banner->title || $banner->description)
                            <div class="carousel-caption d-none d-md-block">
                                @if($banner->title)
                                <h5>{{ $banner->title }}</h5>
                                @endif
                                @if($banner->description)
                                <p>{!! nl2br(e($banner->description)) !!}</p>
                                @endif
                                @if($banner->click_url)
                                <a href="{{ $banner->click_url }}" target="{{ $banner->click_url_target ?? '_self' }}" class="mt-2 btn btn-primary">
                                    {{ $banner->options['button_text'] ?? 'Explore Now' }}
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                @else
                <!-- Fallback jika tidak ada banner -->
                <div id="bannerCarousel" class="carousel slide elec-slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="rounded d-block w-100" src="https://placehold.co/1200x700" alt="Default banner">
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Side Banner (4 kolom) -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                @if($sideBanners->isNotEmpty())
                    @foreach($sideBanners as $banner)
                    <div class="mb-4 single_bn_offer">
                        <a href="{{ $banner->click_url ?? '#' }}" target="{{ $banner->click_url_target ?? '_self' }}">
                            <img src="{{ $banner->getImageUrl('medium') ?? 'https://placehold.co/600x200' }}" class="rounded img-fluid" alt="{{ $banner->title }}" />
                        </a>
                        <div class="side_elec_caption">
                            @if($banner->title)
                            <h2 class="top_elec-title">{{ $banner->title }}</h2>
                            @endif

                            @if($banner->description)
                            <h4 class="mid_elec-title">{{ $banner->description }}</h4>
                            @endif

                            @if(isset($banner->options['price']))
                            <p class="mb-2 elec_price_rex">Price: {{ $banner->options['price'] }}</p>
                            @endif

                            @if(isset($banner->options['category']))
                            <span>{{ $banner->options['category'] }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <!-- Fallback jika tidak ada side banner -->
                <div class="mb-4 single_bn_offer">
                    <a href="#"><img src="https://placehold.co/600x200" class="rounded img-fluid" alt="Default banner" /></a>
                    <div class="side_elec_caption">
                        <h2 class="top_elec-title">Big Sale</h2>
                        <h4 class="mid_elec-title">New Love Addition</h4>
                        <p class="mb-2 elec_price_rex">Price: $120.00</p>
                        <span>All Computer Accessories</span>
                    </div>
                </div>
                <div class="mb-4 single_bn_offer">
                    <a href="#"><img src="https://via.placeholder.com/600x200" class="rounded img-fluid" alt="Default banner" /></a>
                    <div class="side_elec_caption">
                        <h2 class="top_elec-title">Feature</h2>
                        <h4 class="mid_elec-title">30% Off on Camera's</h4>
                        <p class="mb-2 elec_price_rex">Price: $720.00</p>
                        <span>Electric Accessories</span>
                    </div>
                </div>
                <div class="single_bn_offer">
                    <a href="#"><img src="https://via.placeholder.com/600x200" class="rounded img-fluid" alt="Default banner" /></a>
                    <div class="side_elec_caption">
                        <h2 class="top_elec-title">Big Sale</h2>
                        <h4 class="mid_elec-title">Best Seller product</h4>
                        <p class="mb-2 elec_price_rex">Price: $1,000.00</p>
                        <span>Camera Accessories</span>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
<div class="clearfix"></div>
<!-- ======================== Offer Banner End ==================== -->
