<div>
<!-- Start of Breadcrumb section
    ============================================= -->
    <section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="assets/img/bg/ar-shape.png">
        <div class="slider-side-content position-absolute">
            <span class="archx-slider-side1 position-absolute"><a href="#">{{ $siteSettings->company_email ?? '' }}</a></span>
        </div>
        <div class="container">
            <div class="text-center arck-breadcrumb-content position-relative headline-2 ul-li">
                <h1>{{ $aboutSettings->hero_title }}</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $aboutSettings->hero_title }}</li>
                </ul>
            </div>
        </div>
    </section>
<!-- End of Breadcrumb section
    ============================================= -->

<!-- Start of about page about section
    ============================================= -->
    <section id="about-page-about" class="about-page-about-section">
        <div class="container">
            <div class="about-page-about-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="arck-about-img-wrapper position-relative">
                            <div class="acrk-img-shape1 position-absolute"><i></i></div>
                            <div class="acrk-img-shape2 position-absolute"><i></i></div>
                            <span class="shape1 position-absolute"><img src="assets/img/bg/dot-shape.png" alt=""></span>
                            <div class="inner-img">
                                <img src="{{ asset($aboutSettings->about_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="arck-about-text-wrap-2">
                            <div class="arck-section-title headline pera-content">
                                <span class="sub-title text-uppercase">{{ $aboutSettings->about_subtitle }}</span>
                                <h2>{{ $aboutSettings->about_heading }}</h2>
                                <p>{{ $aboutSettings->about_paragraph_1 }}</p>
                                <br>
                                <p>{{ $aboutSettings->about_paragraph_2 }}</p>
                                <br>
                            </div>
                            <div class="arck-btn">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="{{ route('portfolio') }}">{{ $aboutSettings->about_button_text }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of about page about section
    ============================================= -->

<!-- Start of Service section
    ============================================= -->
    <section id="arck-service" class="arck-service-section">
        <div class="container">
            <div class="arck-service-content">
                <div class="row justify-content-center">
                    @foreach($servicePreviews as $service)
                        <div class="col-lg-4 col-md-6 no-padding">
                            <div class="text-center arck-service-item position-relative">
                                <span class="serial-no position-absolute">{{ sprintf('%02d', $loop->iteration) }}</span>
                                <div class="hover-img position-absolute">
                                </div>
                                <div class="inner-icon position-relative">
                                    <img src="{{ $service->hasImage() ? $service->getImageUrl() : '' }}" alt="{{ $service->title }}">
                                </div>
                                <div class="arck-inner-text headline pera-content">
                                    <h3><a href="{{ $service->click_url ?: route('services') }}">{{ $service->title }}</a></h3>
                                    <p>{{ $service->description }}</p>
                                    <a class="btn-more text-uppercase" href="{{ $service->click_url ?: route('services') }}">Read More <i class="fal fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
<!-- End of Service section
    ============================================= -->

<!-- Start of CTA section
    ============================================= -->
    <section id="arck-cta" class="arck-cta-section position-relative" data-background="assets/img/bg/bg-about.jpg">
        <div class="background_overlay"></div>
        <div class="container">
            <div class="text-center arck-cta-content headline position-relative">
                <h2>{{ $aboutSettings->cta_heading }}</h2>
                <div class="arck-cta-button-group d-flex justify-content-center">
                    <div class="arck-btn">
                        <a class="d-flex justify-content-center align-items-center text-uppercase" href="{{ route('contact-us') }}">{{ $aboutSettings->cta_button_text }}</a>
                    </div>
                    <div class="arck-cta-number d-flex align-items-center ">
                        <i class="fal fa-phone-alt"></i>
                        <a href="#">{{ $siteSettings->company_phone ?? '' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of CTA section
    ============================================= -->

<!-- Start of Faq section
    ============================================= -->
    <section id="arck-faq-video" class="arck-faq-video-section">
        <div class="container">
            <div class="arck-faq-video-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="arck-faq-content">
                            <div class="arck-section-title headline pera-content">
                                <span class="sub-title text-uppercase">{{ $aboutSettings->faq_subtitle }}</span>
                                <h2>{{ $aboutSettings->faq_heading }}</h2>
                            </div>
                            <div class="arck-faq-accordion" wire:ignore>
                                <div class="accordion" id="accordionExample2">
                                    @foreach($faqs as $faq)
                                        <div class="accordion-item headline-2 pera-content wow fadeInUp" data-wow-delay="{{ 200 * $loop->iteration }}ms" data-wow-duration="1500ms">
                                            <h2 class="accordion-header" id="heading2{{ $loop->index }}">
                                                <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse2{{ $loop->index }}">
                                                    {{ $faq->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse2{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading2{{ $loop->index }}" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    {{ $faq->description }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="arck-faq-video-play-wrap position-relative">
                            <div class="acrk-img-shape1 position-absolute"><i></i></div>
                            <div class="acrk-img-shape2 position-absolute"><i></i></div>
                            <div class="inner-img">
                                <img src="{{ asset($aboutSettings->faq_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Faq section
    ============================================= -->

<!-- Start of Counter section
    ============================================= -->
    <section id="arck-counter" class="arck-counter-section">
        <div class="container">
            <div class="arck-counter-content">
                <div class="row">
                    @foreach($stats as $stat)
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center arck-counter-inner-item headline pera-content position-relative">
                                <h3><span>{{ rtrim($stat->title, '+') }}</span>+</h3>
                                <p>{{ $stat->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
<!-- End of Counter section
    ============================================= -->

<!-- Start of Testimonial section
    ============================================= -->
    <section id="arck-testimonial" class="arck-testimonial-section">
        <div class="container">
            <div class="arck-testimonial-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="arck-testimonial-img-wrap position-relative">
                            <div class="acrk-img-shape1 position-absolute"><i></i></div>
                            <div class="acrk-img-shape2 position-absolute"><i></i></div>
                            <div class="inner-img">
                                <img src="{{ asset($aboutSettings->testimonial_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="arck-testimonial-text-wrap">
                            <div class="arck-section-title headline pera-content">
                                <span class="sub-title text-uppercase">{{ $aboutSettings->testimonial_subtitle }}</span>
                                <h2>{{ $aboutSettings->testimonial_heading }}</h2>
                            </div>
                            <div class="arck-testimonial-slider-wrap">
                                <div class="arck-testimonial-slider">
                                    @foreach($testimonials as $testimonial)
                                        <div class="arck-teestimonial-item">
                                            <div class="inner-text position-relative">
                                                <i class="fas fa-quote-left"></i> {{ $testimonial->description }}
                                            </div>
                                            <div class="inner-author">
                                                <div class="author-text headline">
                                                    <h3>{{ $testimonial->title }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Testimonial section
    ============================================= -->

<!-- Start of Sponsor section
    ============================================= -->
    <section id="arck-sponsor" class="arck-sponsor-section">
        <div class="container">
            <div class="arck-sponsor-slider">
                @foreach($sponsors as $sponsor)
                    <div class="arck-sponsor-slider-item">
                        <img src="{{ $sponsor->hasImage() ? $sponsor->getImageUrl() : '' }}" alt="{{ $sponsor->title }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- End of Sponsor section
    ============================================= -->
</div>
