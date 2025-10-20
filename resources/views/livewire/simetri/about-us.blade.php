{{-- @section('hero')
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <x-superduper.components.breadcrumb title="About Us"/>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
@endsection --}}
<!-- Page Content -->
<div class="page-content">
    <!-- Ihbox -->
    <section class="ihbox-section-two">
        <div class="p-0 container-fluid">
            <div class="text-center pbmit-heading-subheading animation-style2">
                @if ($sectiontop->isNotEmpty())
                    <h4 class="pbmit-subtitle">{{ $sectiontop->first()->title }}</h4>
                    <h2 class="pbmit-title">{{ $sectiontop->first()->subtitle }}</h2>
                    <div class="pbmit-heading-desc">
                        {{ $sectiontop->first()->description }}
                    </div>
                @else
                    <h4 class="pbmit-subtitle">About</h4>
                    <h2 class="pbmit-title">General Questions</h2>
                    <div class="pbmit-heading-desc">
                        You will find answers to about our various construction work and constructor's  service and more. Please feel <br>  free to contact us if you don't get your question's answer in below.
                    </div>
                @endif
            </div>
            <div class="swiper-slider" data-autoplay="false" data-loop="true" data-dots="false" data-arrows="false" data-columns="4" data-margin="30" data-effect="slide">
                <div class="swiper-wrapper">
                    @if ($services->isNotEmpty())
                        @foreach ($services as $midsection)
                            <article class="pbmit-miconheading-style-7 swiper-slide">
                                <div class="pbmit-ihbox-style-7">
                                    <div class="pbmit-ihbox-box">
                                        <div class="pbmit-icon-wrapper d-flex align-items-center">
                                            <div class="pbmit-ihbox-icon">
                                                <div class="pbmit-ihbox-icon-wrapper">
                                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                        <i class="{{ $midsection->icon_class }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pbmit-title-wrap"></div>
                                                <h2 class="pbmit-element-title">
                                                    {{ $midsection->title }}
                                                </h2>
                                            </div>
                                        <div class="pbmit-content-wrapper"></div>
                                            <div class="pbmit-heading-desc">{{ $midsection->description }}</div>
                                        </div>
                                    </div>
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
                    @else
                        <!-- Slide1 -->
                        <article class="pbmit-miconheading-style-7 swiper-slide">
                            <div class="pbmit-ihbox-style-7">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper d-flex align-items-center">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="pbmit-xinterio-icon pbmit-xinterio-icon-living-room"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-title-wrap">
                                            <h2 class="pbmit-element-title">
                                                Modern Living Area
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="pbmit-content-wrapper">
                                        <div class="pbmit-heading-desc">Iterative methods of developing the corporate strategy.</div>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-btn">
                                    <a class="pbmit-button-inner" href="{{ route('home') }}">
                                        <span class="pbmit-button-wrapper">
                                            <span class="pbmit-button-text">Read More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <!-- Slide2 -->
                        <article class="pbmit-miconheading-style-7 swiper-slide">
                            <div class="pbmit-ihbox-style-7">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper d-flex align-items-center">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="pbmit-xinterio-icon pbmit-xinterio-icon-house"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-title-wrap">
                                            <h2 class="pbmit-element-title">
                                                Interior Design
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="pbmit-content-wrapper">
                                        <div class="pbmit-heading-desc">We create the complete set of project information.</div>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-btn">
                                    <a class="pbmit-button-inner" href="{{ route('home') }}">
                                        <span class="pbmit-button-wrapper">
                                            <span class="pbmit-button-text">Read More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <!-- Slide3 -->
                        <article class="pbmit-miconheading-style-7 swiper-slide">
                            <div class="pbmit-ihbox-style-7">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper d-flex align-items-center">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="pbmit-xinterio-icon pbmit-xinterio-icon-3d"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-title-wrap">
                                            <h2 class="pbmit-element-title">
                                                3D Design Layouts
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="pbmit-content-wrapper">
                                        <div class="pbmit-heading-desc">Iterative methods of developing the corporate strategy.</div>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-btn">
                                    <a class="pbmit-button-inner" href="{{ route('home') }}">
                                        <span class="pbmit-button-wrapper">
                                            <span class="pbmit-button-text">Read More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <!-- Slide4 -->
                        <article class="pbmit-miconheading-style-7 swiper-slide">
                            <div class="pbmit-ihbox-style-7">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper d-flex align-items-center">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="pbmit-xinterio-icon pbmit-xinterio-icon-brickwall-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-title-wrap">
                                            <h2 class="pbmit-element-title">
                                                Remodel Spaces
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="pbmit-content-wrapper">
                                        <div class="pbmit-heading-desc">We create the complete set of project information.</div>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-btn">
                                    <a class="pbmit-button-inner" href="{{ route('home') }}">
                                        <span class="pbmit-button-wrapper">
                                            <span class="pbmit-button-text">Read More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <!-- Slide5 -->
                        <article class="pbmit-miconheading-style-7 swiper-slide">
                            <div class="pbmit-ihbox-style-7">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper d-flex align-items-center">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <i class="pbmit-xinterio-icon pbmit-xinterio-icon-hard-hat"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pbmit-title-wrap">
                                            <h2 class="pbmit-element-title">
                                                Particular Solutions
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="pbmit-content-wrapper">
                                        <div class="pbmit-heading-desc">Iterative methods of developing the corporate strategy.</div>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-btn">
                                    <a class="pbmit-button-inner" href="{{ route('home') }}">
                                        <span class="pbmit-button-wrapper">
                                            <span class="pbmit-button-text">Read More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endif
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
                        @if ($sectionbottom->isNotEmpty())
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

</div>
<!-- Page Content End -->
