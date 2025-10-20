@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'about-us-banner');
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
                <x-superduper.components.breadcrumb title="About Us"/>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<!-- Page Content -->
<div class="page-content">

    <!-- Ihbox -->
    <section class="ihbox-section-two">
        <div class="p-0 container-fluid">
            <div class="text-center pbmit-heading-subheading animation-style2">
                <h4 class="pbmit-subtitle">About</h4>
                <h2 class="pbmit-title">{{ $sectiontop->title }}</h2>
                <div class="pbmit-heading-desc">
                    {{ $sectiontop->description }}
                </div>
            </div>
            <div class="swiper-slider" data-autoplay="false" data-loop="true" data-dots="false" data-arrows="false" data-columns="4" data-margin="30" data-effect="slide">
                <div class="swiper-wrapper">
                        @foreach ($services as $midsection)
                            <article class="pbmit-miconheading-style-7 swiper-slide">
                                <div class="pbmit-ihbox-style-7">
                                    <div class="pbmit-ihbox-btn">
                                        <a class="pbmit-button-inner" href="{{ route('services')}}">
                                            <span class="pbmit-button-wrapper">
                                                <span class="pbmit-button-text">Read More</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Ihbox end -->

    <!-- Our History Start -->
    <section class="section-xl pbmit-element-timeline-style-1">
        <div class="p-0 container-fluid">
            <div class="pbmit-timeline">
                <div class="swiper-slider" data-autoplay="false" data-loop="false" data-dots="false" data-arrows="false" data-columns="4" data-margin="30" data-effect="slide">
                    <div class="swiper-wrapper">
                        @if (!empty($sectionbottom))
                            @foreach ($sectionbottom as $item)
                                {{--
                                    The @class directive cleanly adds 'pbmit-slide-even'
                                    only on odd iterations (1st, 3rd, 5th, etc.)
                                    to match your design.
                                --}}
                                <div @class([
                                    'pbmit-timeline-wrapper',
                                    'swiper-slide',
                                    'pbmit-slide-even' => $loop->odd,
                                ])>
                                    <div class="pbmit-same-height steps-media pbmit-feature-image">
                                        {{-- Assuming the image path is stored in an 'image' attribute --}}
                                        @if ($item->hasImage())
                                            <img src="{{ $item->getImageUrl('medium') }}" class="img-fluid" alt="{{ $item->title }}">
                                        @else
                                            <img src="{{ asset('assets/images/history/time-line-01.jpg') }}" class="img-fluid" alt="">
                                        @endif
                                    </div>
                                    <div class="steps-dot">
                                        <i class="steps-dot-line"></i>
                                        <span class="dot"></span>
                                    </div>
                                    <div class="pbmit-same-height steps-content_wrap">
                                        <p class="pbmit-timeline-year">{{ $item->year }}</p>
                                        <h3 class="pbmit-timeline-title">{{ $item->title }}</h3>
                                        <p class="pbmit-timeline-desc">{{ $item->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Slide1 -->
                            <div class="pbmit-timeline-wrapper swiper-slide pbmit-slide-even">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-01.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2015</p>
                                    <h3 class="pbmit-timeline-title">Our Beginning</h3>
                                    <p class="pbmit-timeline-desc">Interior designers are independent business people.</p>
                                </div>
                            </div>
                            <!-- Slide2 -->
                            <div class="pbmit-timeline-wrapper swiper-slide">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-02.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2017</p>
                                    <h3 class="pbmit-timeline-title">Research</h3>
                                    <p class="pbmit-timeline-desc">We are master of Research & innovation idea.</p>
                                </div>
                            </div>
                            <!-- Slide3 -->
                            <div class="pbmit-timeline-wrapper swiper-slide pbmit-slide-even">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-03.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2019</p>
                                    <h3 class="pbmit-timeline-title">Communication</h3>
                                    <p class="pbmit-timeline-desc">We develop the full cycle of project details for clients.</p>
                                </div>
                            </div>
                            <!-- Slide4 -->
                            <div class="pbmit-timeline-wrapper swiper-slide">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-04.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2021</p>
                                    <h3 class="pbmit-timeline-title">budget</h3>
                                    <p class="pbmit-timeline-desc">The cost of interior decoration is also significant factor.</p>
                                </div>
                            </div>
                            <!-- Slide5 -->
                            <div class="pbmit-timeline-wrapper swiper-slide pbmit-slide-even">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-05.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2022</p>
                                    <h3 class="pbmit-timeline-title">Social Media</h3>
                                    <p class="pbmit-timeline-desc">We do all types of the interior designing, decoration & furnishing.</p>
                                </div>
                            </div>
                            <!-- Slide6 -->
                            <div class="pbmit-timeline-wrapper swiper-slide">
                                <div class="pbmit-same-height steps-media pbmit-feature-image">
                                    <img src="{{ asset('assets/images/history/time-line-06.jpg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="steps-dot">
                                    <i class="steps-dot-line"></i>
                                    <span class="dot"></span>
                                </div>
                                <div class="pbmit-same-height steps-content_wrap">
                                    <p class="pbmit-timeline-year">2023</p>
                                    <h3 class="pbmit-timeline-title">Result</h3>
                                    <p class="pbmit-timeline-desc">Our creative 3D artists are always ready to translate your designs</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our History Start -->

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%2C%20saya%20sudah%20melihat%20profil%20PT.%20Sejahtera%20Langgeng%20Anugerah%20%E2%80%93%20Home%20Care%20Interior.%20Saya%20tertarik%20untuk%20berdiskusi%20lebih%20lanjut%20mengenai%20layanan%20desain%20interiornya" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>
<!-- Page Content End -->
