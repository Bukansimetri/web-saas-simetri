<div>
    <x-superduper.main>
        <!-- Start of Breadcrumb section
	============================================= -->
	<section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="assets/img/bg/ar-shape.png">
		<div class="slider-side-content position-absolute">
			<span class="archx-slider-side1 position-absolute"><a href="#">{{ $siteSettings->company_email ?? '' }}</a></span>
		</div>
		<div class="container">
			<div class="text-center arck-breadcrumb-content position-relative headline-2 ul-li">
				<h1>{{ $servicesSettings->hero_title }}</h1>
				<ul>
					<li><a href="{{ route('home') }}">Home</a></li>
					<li>{{ $servicesSettings->hero_title }}</li>
				</ul>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->

<!-- Start of Service section
	============================================= -->
	<section id="arck-service-2" class="arck-service-section-2 inner-page-padding">
		<div class="container">
			<div class="arck-service-content-2">
				<div class="row">
					@foreach($servicesGrid as $service)
						<div class="col-lg-4 col-md-6">
							<div class="arck-service-item-2 position-relative">
								<span class="service-shape position-absolute"><img src="assets/img/shape/ser-icon1.png" alt=""></span>
								<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
									<img src="{{ $service->hasImage() ? $service->getImageUrl() : '' }}" alt="{{ $service->title }}">
								</div>
								<div class="inner-text headline pera-content">
									<h3><a href="#">{{ $service->title }}</a></h3>
									<p>{{ $service->description }}
									</p>
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
	<section id="arck-cta" class="arck-cta-section position-relative" data-background="assets/img/bg/cta-bg.jpg">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="text-center arck-cta-content headline position-relative">
				<h2>{{ $servicesSettings->cta_heading }}</h2>
				<div class="arck-cta-button-group d-flex justify-content-center">
					<div class="arck-btn">
						<a class="d-flex justify-content-center align-items-center text-uppercase" href="{{ route('contact-us') }}">{{ $servicesSettings->cta_button_text }}</a>
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


<!-- Start of Working Skill section
	============================================= -->
	<section id="arck-working-skill" class="arck-working-skill-section">
		<div class="container">
			<div class="arck-working-skill-content">
				<div class="row">
					<div class="col-lg-6">
						<div class="arck-working-skill-text-wrap">
							<div class="arck-section-title headline pera-content">
								<span class="sub-title text-uppercase">{{ $servicesSettings->skill_subtitle }}</span>
								<h2>{{ $servicesSettings->skill_heading }}</h2>
								<p>{{ $servicesSettings->skill_paragraph }}</p>
							</div>
							<div class="arck-skill-progress-bar">
								<div class="skill-progress-bar">
									@foreach($skills as $skill)
										<div class="skill-set-percent headline">
											<h4>{{ $skill->title }}</h4>
											<div class="progress">
												<div class="progress-bar" data-percent="{{ $skill->option('percent', 0) }}"></div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="arck-working-skill-img position-relative">
							<div class="acrk-img-shape1 position-absolute"><i></i></div>
							<div class="acrk-img-shape2 position-absolute"><i></i></div>
							<img src="{{ asset($servicesSettings->skill_image) }}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Working Skill section
	============================================= -->

<!-- Start of Pricing section
	============================================= -->
	<section id="arck-pricing" class="arck-pricing-section" data-background="assets/img/bg/pr-bg.jpg">
		<div class="container">
			<div class="text-center arck-section-title headline pera-content">
				<span class="sub-title text-uppercase">{{ $servicesSettings->pricing_subtitle }}</span>
				<h2>{{ $servicesSettings->pricing_heading }}</h2>
			</div>
			<div class="arck-pricing-content">
				<div class="row justify-content-center">
					@foreach($pricingPlans as $plan)
						<div class="col-lg-4 col-md-6">
							<div class="text-center arck-pricing-item @if($plan->option('is_featured') === 'true') active @endif">
								<div class="inner-title headline pera-content">
									<h3>{{ $plan->title }}</h3>
									<div class="inner-price">
										<h4>{{ $plan->option('price') }}</h4>
										<span>{{ $plan->option('unit') }}</span>
									</div>
								</div>
								<div class="inner-feature-list ul-li-block">
									<ul>
										@foreach(preg_split('/\r?\n/', trim((string) $plan->description)) as $line)
											<li>{{ ltrim($line, '- ') }}</li>
										@endforeach
									</ul>
								</div>
								<div class="arck-btn-2 d-flex justify-content-center">
									<a class="d-flex justify-content-center align-items-center text-uppercase" href="{{ route('contact-us') }}">{{ $plan->option('button_text', 'Pilih Paket') }}</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
<!-- End of Pricing section
	============================================= -->

<!-- Start of Work Process section
	============================================= -->
	<section id="arck-work-process" class="arck-work-process-section inner-page-padding">
		<div class="container">
			<div class="text-center arck-section-title headline pera-content">
				<span class="sub-title text-uppercase">{{ $servicesSettings->work_process_subtitle }}</span>
				<h2>{{ $servicesSettings->work_process_heading }}</h2>
				<p>{{ $servicesSettings->work_process_paragraph }}
				</p>
			</div>
			<div class="arck-work-process-content">
				<div class="row justify-content-center">
					@foreach($workProcessSteps as $step)
						<div class="col-lg-4 col-md-6">
							<div class="text-center arck-work-process-item position-relative">
								<div class="inner-icon">
									<img src="{{ $step->hasImage() ? $step->getImageUrl() : '' }}" alt="{{ $step->title }}">
								</div>
								<div class="inner-text headline pera-content">
									<h3>{{ $step->title }}</h3>
									<p>{{ $step->description }}</p>
									<div class="work-serial position-relative">
										<h4>{{ $step->option('step_number') }}</h4>
										<span class="text-uppercase">Step</span>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
<!-- End of Work Process section
	============================================= -->

    </x-superduper.main>
</div>
