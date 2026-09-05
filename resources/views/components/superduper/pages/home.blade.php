@php
    use App\Models\Banner\Content as BannerContent;
    use App\Models\Content\Item as ContentItem;
    use App\Settings\HomePageSettings;

    $homeSettings = app(HomePageSettings::class);

    $heroBanners = BannerContent::whereHas('category', fn ($q) => $q->where('slug', 'home-banner'))
        ->active()->orderBy('sort')->with('media')->get();

    $homeFeatures = ContentItem::categorySlug('home-feature')->active()->orderBy('sort')->with('media')->get();
    $faqHome = ContentItem::categorySlug('faq-home')->active()->orderBy('sort')->get();
    $beforeAfter = ContentItem::categorySlug('before-after')->active()->orderBy('sort')->with('media')->get();
    $sponsors = ContentItem::categorySlug('sponsor')->active()->orderBy('sort')->with('media')->get();
    $testimonials = ContentItem::categorySlug('testimonial')->active()->orderBy('sort')->get();
    $portfolioHighlights = ContentItem::whereHas('category.parent', fn ($q) => $q->where('slug', 'portofolio'))
        ->active()->orderBy('sort')->with('media')->take(9)->get();
@endphp
<x-superduper.main>
	<div class="up">
		<a href="#" class="text-center scrollup"><i class="fas fa-chevron-up"></i></a>
	</div>

	<!-- Sidebar sidebar Item -->
	<div class="xs-sidebar-group info-group">
		<div class="xs-overlay xs-bg-black">
			<div class="row loader-area">
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
			</div>
		</div>
		<div class="xs-sidebar-widget">
			<div class="sidebar-widget-container">
				<div class="widget-heading">
					<a href="#" class="close-side-widget">
						X
					</a>
				</div>
				<div class="sidebar-textwidget">

					<!-- Sidebar Info Content -->
					<div class="sidebar-info-contents headline pera-content">
						<div class="content-inner">
							<div class="logo">
								<a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo-3.png') }}" alt=""></a>
							</div>
							<div class="content-box">
								<h5>About Us</h5>
								<p class="text">{{ $homeSettings->sidebar_about_text }}</p>
							</div>
							<div class="gallery-box ul-li">
								<h5>Gallery</h5>
								<ul>
									@foreach($sponsors->take(6) as $sponsor)
										<li>
											<a href="#"><img src="{{ $sponsor->hasImage() ? $sponsor->getImageUrl('thumbnail') : asset('assets/img/gallery/01.png') }}" alt="{{ $sponsor->title }}"></a>
										</li>
									@endforeach
								</ul>
							</div>
							<!-- Social Box -->
							<div class="content-box">
								<h5>Social Account</h5>
								<ul class="social-box">
									<li><a href="{{ $siteSocialSettings->facebook_url ?? 'https://www.facebook.com/' }}" class="fab fa-facebook-f"></a></li>
									<li><a href="{{ $siteSocialSettings->twitter_url ?? 'https://www.twitter.com/' }}" class="fab fa-twitter"></a></li>
									<li><a href="{{ $siteSocialSettings->instagram_url ?? 'https://www.instagram.com/' }}" class="fab fa-dribbble"></a></li>
									<li><a href="{{ $siteSocialSettings->linkedin_url ?? 'https://www.linkedin.com/' }}" class="fab fa-linkedin"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- End of Header section============================================= -->

<!-- Start of Slider section
	============================================= -->
	<section id="archx-slider" class="archx-slider-section position-relative" data-background="assets/img/slider-2/home2.jpg">

		<div class="container">
			@if($heroBanners->isNotEmpty())
				@php($banner = $heroBanners->first())
				<div class="archx-slider-content position-relative">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="archx-slider-counter position-relative headline-2">
								<div class="text-center archx-slider-counter-text">
									<h2><span class="counter">{{ $homeSettings->hero_counter_number }}</span>{{ $homeSettings->hero_counter_suffix }}</h2>
									<p>{{ $homeSettings->hero_counter_text }}</p>
								</div>
								<div class="ar-slider-shape-img position-absolute">
									<img src="assets/img/bg/ar-ba.png" alt="">
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="archx-slider-text headline-2 pera-content">
								<div class="slider-slug wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">{{ $homeSettings->hero_slug_text }}</div>
								<h1 class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">{{ $banner->title }}</h1>
								<p class=" wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">{{ $banner->description }}</p>
								<div class="archx-video-play-btn d-flex align-items-center wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
									<div class="archx-slider-btn">
										<a class="d-flex justify-content-center align-items-center" href="{{ $banner->click_url ?: route('contact-us') }}">{{ $banner->options['button_text'] ?? $homeSettings->hero_button_text }}<i class="fal fa-long-arrow-right"></i></a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</section>
<!-- End of Slider section
	============================================= -->

<!-- Start of Feature section
	============================================= -->
	<section id="archx-feature" class="archx-feature-section position-relative">
		<span class="archx-bg position-absolute"><img src="assets/img/bg/ar-bg1.png" alt=""></span>
		<div class="container">
			<div class="archx-feature-content_2">
				<div class="row">
					<div class="col-lg-3">
						<div class="archx-feature-img_2 position-relative wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
							<img src="assets/img/about/10thn.jpg" alt="">
							<span class="archx-ft-shape position-absolute"><img src="assets/img/shape/ar-ft-sh.png" alt=""></span>


						</div>
					</div>
					<div class="col-lg-9">
						<div class="archx-feature-content-item_2">
							<div class="row">
								@foreach($homeFeatures as $feature)
									<div class="col-md-4">
										<div class="archx-feature-item_2 position-relative wow fadeInUp" data-wow-delay="{{ 200 * $loop->iteration }}ms" data-wow-duration="1500ms">
											<div class="archx-feature-icon position-relative">
												<img src="{{ $feature->hasImage() ? $feature->getImageUrl() : asset('assets/icon/ar-ic1.png') }}" alt="">
											</div>
											<div class="archx-feature-text headline-2 pera-content">
												<h3>{{ $feature->title }}</h3>
												<p>{{ $feature->description }}</p>
											</div>
										</div>
									</div>
								@endforeach
							</div>
							<div class="archx-feature-cta-text wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1500ms">
								{{ $homeSettings->feature_cta_text }} <a href="{{ route('contact-us') }}">{{ $homeSettings->feature_cta_link_text }}</a>  CALL {{ $siteSettings->company_phone ?? '' }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Feature section
	============================================= -->

<!-- Start of FAQ section ============================================= -->
	<section id="archx-faq" class="archx-faq-section position-relative">
        <span class="ar-bg position-absolute"><img src="assets/img/bg/ar-bg2.png" alt=""></span>
        <div class="container">
            <div class="archx-faq-content">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="archx-section-title headline-2 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <span class="title-serial">01</span>
                            <h2>Tentang Living Interior<br>
                            Jawaban untuk <span> Pertanyaan</span> Anda</h2>
                        </div>
                        <div class="archx-faq-content-wrapper">
                            <div class="accordion" id="accordionExample">
								@foreach($faqHome as $faq)
									<div class="accordion-item headline-2 pera-content wow fadeInUp" data-wow-delay="{{ 200 * $loop->index }}ms" data-wow-duration="1500ms">
										<h2 class="accordion-header" id="heading{{ $loop->index }}">
											<button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
												{{ $faq->title }}
											</button>
										</h2>
										<div id="collapse{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												{{ $faq->description }}
											</div>
										</div>
									</div>
								@endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="archx-faq-img-wrap wow fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <img src="assets/img/about/faq.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of FAQ section ============================================= -->

<!-- Start of Before After section
	============================================= -->
	<section id="archx-before-after" class="archx-before-after-section position-relative" data-background="assets/img/bg/before-after-bg.png">
		<span class="archx-before-after-shape position-absolute"><img src="assets/img/bg/ar-ba.png" alt=""></span>
		<div class="container">
			<div class="text-center archx-section-title headline-2 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
				<span class="title-serial">02</span>
				<h2>Lihat Perubahan Interior<br>
					<span>Sebelum</span> & <span>Sesudah</span> dikerjakan</h2>
				</div>
				<div class="archx-before-after-content">
					<div class="row align-items-center">
						<div class="col-lg-2">
							<div class="archx-before-after-tab-btn position-relative ul-li-block">
								<ul class="nav nav-pills" id="pills-tab" role="tablist">
									@foreach($beforeAfter as $ba)
										<li class="nav-item" role="presentation">
											<button class="nav-link @if($loop->first) active @endif" id="pills-tab-{{ $loop->index }}" data-bs-toggle="pill" data-bs-target="#pills-{{ $loop->index }}" type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $ba->title }}</button>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="col-lg-10">
							<div class="archx-before-after-img-wrapper">
								<div class="tab-content" id="pills-tabContent">
									@foreach($beforeAfter as $ba)
										<div class="tab-pane fade @if($loop->first) show active @endif" id="pills-{{ $loop->index }}" role="tabpanel">
											<div  class="twentytwenty-container beforeafter-wrap">
												<div class="arck-before-item before-after-item position-relative">
													<img src="{{ $ba->hasImage('images') ? $ba->getImageUrl('', 'images') : asset('assets/img/about/dabur-before.jpeg') }}" alt="">
												</div>
												<div class="arck-after-item before-after-item position-relative">
													<img src="{{ $ba->hasImage('images_secondary') ? $ba->getImageUrl('', 'images_secondary') : asset('assets/img/about/dapur-after.jpeg') }}" alt="">
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
		</section>
<!-- End of Before After section
	============================================= -->


<!-- Start of  About Section
	============================================= -->
	<section id="archx-about" class="archx-about-section position-relative">
		<div class="container">
			<div class="archx-about-content">
				<div class="row">
					<div class="col-lg-5">
						<div class="archx-about-text-content">
							<div class="archx-section-title headline-2 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
								<h2>{{ $homeSettings->about_heading }}
								</h2>
							</div>
							<div class="archx-about-sub-text headline-2 pera-content wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
								<h3>{{ $homeSettings->about_subheading }}</h3>
							</div>
							<div class="archx-about-feature-list ul-li-block wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
								<ul>
									@foreach($homeSettings->about_features as $feature)
										<li>{{ $feature }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<br>
					<div class="col-lg-7">
						<div class="archx-about-sponsor-scroller">
							<div class="archx-about-sponsor-wrapper">
								@foreach($sponsors as $sponsor)
									<div class="archx-sponsor-item">
										<img src="{{ $sponsor->hasImage() ? $sponsor->getImageUrl() : '' }}" alt="{{ $sponsor->title }}">
									</div>
								@endforeach
							</div>
							<div class="archx-about-experience-scoller d-flex">
								<div class="text-center archx-about-experience headline-2 pera-content d-flex align-items-center justify-content-center wow fadeLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
									<div class="archx-about-exp-text">
										<h3>
											{{ $homeSettings->about_experience_number }}<sub>{{ $homeSettings->about_experience_suffix }}</sub>
										</h3>
										<p>{{ $homeSettings->about_experience_label }}</p>
									</div>
								</div>
								<div class="archx-about-scroller-wrapper wow fadeInRight" data-wow-delay="400ms" data-wow-duration="1500ms">
									<div class="archx-about-scroller-content">
										<div class="archx-about-scroller-item headline-2 pera-content">
											<h3>Desainer Berpengalaman</h3>
											<p>Tim kami memiliki pengalaman dalam menangani proyek residensial dan komersial dengan berbagai konsep desain.</p>
										</div>
										<div class="archx-about-scroller-item headline-2 pera-content">
											<h3>Desain Fungsional & Estetis</h3>
											<p>Kami tidak hanya memperhatikan tampilan, tetapi juga kenyamanan dan fungsi ruang.</p>
										</div>
										<div class="archx-about-scroller-item headline-2 pera-content">
											<h3>Detail & Presisi</h3>
											<p>Setiap elemen dirancang dengan perhitungan matang untuk hasil akhir yang maksimal.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of About section
	============================================= -->

@push('css')
<style>
    /* The theme's .archx-contact-img pulls the image up 170px to overlap the
       previous section. With this page's shorter About column, that overlap
       makes the About and Contact sections look joined instead of separate. */
    #archx-contact {
        margin-top: 70px;
    }
    #archx-contact .archx-contact-img {
        top: 0;
        margin-bottom: 0;
    }
</style>
@endpush

<!-- Start of  Contact Section
	============================================= -->
	<section id="archx-contact" class="archx-contact-section">
		<div class="container">
			<div class="archx-contact-content">
				<div class="row">
					<div class="col-lg-4">
						<div class="archx-contact-img-counter">
							<div class="archx-contact-img position-relative wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
								<img src="{{ asset($homeSettings->contact_image) }}" alt="">
								<span class="img-shape"></span>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="archx-contact-form-wrapper">
							<div class="archx-section-title headline-2 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
								<h2>
									{{ $homeSettings->contact_heading }}
								</h2>
							</div>

							@if(session('success'))
								<div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px;">
									<i class="fas fa-check-circle"></i> {{ session('success') }}
								</div>
							@endif

							@if(session('error'))
								<div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px;">
									<i class="fas fa-exclamation-circle"></i> {{ session('error') }}
								</div>
							@endif

							<div class="archx-contact-form wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
								<form action="{{ route('contact.submit') }}" method="post">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<input type="text" name="name" placeholder="Nama Lengkap*" value="{{ old('name') }}" required>
											@error('firstname') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-6">
											<input type="text" name="phone" placeholder="Nomor WhatsApp*" value="{{ old('phone') }}" required>
											@error('phone') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-6">
											<input type="email" name="email" placeholder="Email*" value="{{ old('email') }}" required>
											@error('email') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-6">
											<input type="text" name="room_type" placeholder="Jenis Ruangan (Rumah/Apartemen/Kantor/Komersial)*" value="{{ old('room_type') }}">
										</div>
										<div class="col-md-12">
											<textarea name="message" placeholder="Pesan Anda*" required>{{ old('message') }}</textarea>
											@error('message') <span style="color: #ef4444; font-size: 13px;">{{ $message }}</span> @enderror
										</div>
										<div class="col-md-12">
											<button type="submit">Kirim Pesan<i class="fal fa-long-arrow-right"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of  About Section
	============================================= -->

<!-- Start of  Project Section
	============================================= -->
	<section id="archx-project-2" class="archx-project-section-2" data-background="assets/img/bg/ar-pro-bg.png">
		<div class="container">
			<div class="archx-project-top-content d-flex justify-content-between align-items-center">
				<div class="archx-section-title headline-2">
					<h2>Portofolio <span> Proyek </span> <br>Living Interior
					</h2>
				</div>
				<div class="archx-section-title headline-2">
					<span class="title-serial">03</span>
				</div>
				<div class="carousel_nav">
					<button type="button" class="ar-pro_left_arrow text-uppercase"><i class="fal fa-long-arrow-left"></i></button>
					<button type="button" class="ar-pro_right_arrow text-uppercase"><i class="fal fa-long-arrow-right"></i></button>
				</div>
			</div>
		</div>
		<div class="archx-project-slider-area">
			<div class="archx-project-slider">
				@foreach($portfolioHighlights as $project)
					<div class="archx-project-item-2">
						<div class="archx-project-item-content position-relative">
							<div class="archx-project-img-2">
								<img src="{{ $project->hasImage() ? $project->getImageUrl('large') : '' }}" alt="{{ $project->title }}">
							</div>
							<div class="serial-no d-flex justify-content-center align-items-center position-absolute">
								{{ sprintf('%02d', $loop->iteration) }}
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="archx-newslatter-wrapper">
			<div class="container">
				<div class="archx-newslatter-content d-flex justify-content-between">
					<div class="archx-newslatter-cta d-flex align-items-center">
						<div class="inner-icon">
							<img src="assets/icon/ar-nw.png" alt="">
						</div>
						<div class="inner-text">
							<span class="cta-no">{{ $siteSettings->company_phone ?? '' }}</span>
							<span class="cta-text">Jadwalkan Survey Gratis.</span>
						</div>
					</div>
					<div class="archx-newslatter-form">
						<div class="newslatter-form position-relative">
							<span class="bg-icon position-absolute"><i class="fas fa-envelope"></i></span>
							<form action="#" method="get">
								<input type="email" name="email" placeholder="Enter your Email">
								<button type="submit">Subscribe</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of  Project Section
	============================================= -->

<!-- Start of  Testimonial Section
	============================================= -->
	<section id="archx-testimonial" class="archx-testimonial-section position-relative">
		<div class="container">
			<div class="archx-testimonial-content-wrapper">
				<div class="row">
					<div class="col-lg-7">
						<div class="archx-testimonial-top-content d-flex justify-content-between align-items-center">
							<div class="archx-section-title headline-2">
								<h2>Apa Kata  <span> Klien </span> Kami
								</h2>
							</div>
							<div class="archx-testimonial-carousel-btn d-flex">
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fal fa-long-arrow-left"></i></span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"><i class="fal fa-long-arrow-right"></i></span>
								</button>
							</div>
						</div>
						<div class="archx-testimonial-slider">
							<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
								<div class="archx-testimonial-content">
									<div class="carousel-inner">
										@foreach($testimonials as $testimonial)
											<div class="carousel-item @if($loop->first) active @endif">
												<div class="archx-testimonial-item headline-2 pera-content">
													<h3>{{ $testimonial->title }}</h3>
													<p>{{ $testimonial->description }}
													</p>
												</div>
											</div>
										@endforeach
									</div>
								</div>
								<div class="carousel-indicators-wrap d-flex align-items-center">
									<div class="more-testimonial-btn">
										<a href="{{ route('about-us') }}">Lihat Semua Testimoni →<i class="fal fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="archx-testimonial-img-wrap d-flex justify-content-end">
							<div class="inner-img position-relative">
								<img src="assets/img/testimonial/testi.jpg" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of  Testimonial Section
	============================================= -->

<!-- Start of  Map Section
	============================================= -->
	<section id="archx-map" class="archx-map-section position-relative">
		<div class="archx-map-wrap">
			<iframe class="map" src="{{ $homeSettings->map_embed_url }}" width="100%" height="470"></iframe>
		</div>
		<div class="container">
			<div class="archx-map-info">
				<div class="archx-map-contact-info headline-2 pera-content">
					<div class="archx-map-info-item">
						<div class="info-title d-flex align-items-center">
							<span><i class="fas fa-address-book"></i></span>
							<h3>Alamat Kami</h3>
						</div>
						<div class="info-text">
							 {{ $siteSettings->company_address ?? '' }}
						</div>
					</div>
					<div class="archx-map-info-item">
						<div class="info-title d-flex align-items-center">
							<span><i class="fas fa-address-book"></i></span>
							<h3>Kontak Kami</h3>
						</div>
						<div class="info-text ul-li-block">
							<ul>
								<li><i class="fas fa-comments"></i> {{ $siteSettings->company_email ?? '' }}</li>
								<li><i class="fas fa-phone-alt"></i> {{ $siteSettings->company_phone ?? '' }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of  Map Section
	============================================= -->

</x-superduper.main>
