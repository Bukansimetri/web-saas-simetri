<div>
    <!-- Start of Breadcrumb section
	============================================= -->
	<section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="assets/img/bg/ar-shape.png">
		<div class="slider-side-content position-absolute">
			<span class="archx-slider-side1 position-absolute"><a href="#">{{ $siteSettings->company_email ?? '' }}</a></span>
		</div>
		<div class="container">
			<div class="text-center arck-breadcrumb-content position-relative headline-2 ul-li">
				<h1>{{ $portfolioSettings->hero_title }}</h1>
				<ul>
					<li><a href="{{ route('home') }}">Home</a></li>
					<li>{{ $portfolioSettings->hero_title }}</li>
				</ul>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->

<!-- Start of Project Page content section
	============================================= -->
	<section id="arck-project-feed" class="arck-project-feed-section inner-page-padding">
		<div class="container">
			<div class="arck-project-filter-btn ul-li">
				<div class="clearfix button-group">
					<button class="filter-button is-checked" data-filter="*">All </button>
					@foreach($filters as $filter)
						<button class="filter-button" data-filter=".{{ $filter->slug }}">{{ $filter->name }}</button>
					@endforeach
				</div>
			</div>
		</div>
		<div class="arck-project-filter-content">
			<div class="grid clearfix filtr-container-area" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
				<div class="grid-sizer"></div>
				@foreach($projects as $project)
					<div class="grid-item grid-size-25 {{ $project->category->slug }}" data-category="{{ $project->category->slug }}">
						<div class="arck-project-item position-relative two">
							<div class="inner-img">
								<img src="{{ $project->hasImage() ? $project->getImageUrl('large') : '' }}" alt="{{ $project->title }}">
							</div>
							<div class="inner-text">
								<div class="project-title-desc headline pera-content">
									<span class="text-uppercase item-category"><a href="#">{{ $project->category->name }}</a></span>
									<h3><a>{{ $project->title }}</a></h3>
								</div>
							</div>
							<div class="view-more-btn text-uppercase position-absolute">
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
<!-- End of Project Page content section
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
