@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'general-banner');
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
                <x-superduper.components.breadcrumb title="{{ $project->title }}"/>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<!-- Page Content -->
<div class="page-content">
    <!-- Portfolio Detail Style 1 -->
    <section class="site-content">
        <div class="container">
            <article class="portfolio-single">
                <div class="pbmit-short-description">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->short_description }}</p>
                </div>
                <div class="pbmit-single-project-details-list">
                    <h3>Project info</h3>
                    @if (!empty($project->client))
                        <div class="pbmit-portfolio-lines-wrapper">
                            <ul class="pbmit-portfolio-lines-ul">
                                <li class="pbmit-portfolio-line-li">
                                    <span class="pbmit-portfolio-line-title">Build By : </span>
                                    <span class="pbmit-portfolio-line-value">Homecare Interior</span>
                                </li>
                                <li class="pbmit-portfolio-line-li">
                                    <span class="pbmit-portfolio-line-title">Client : </span>
                                    <span class="pbmit-portfolio-line-value">{{ $project->client }}</span>
                                </li>
                                <li class="pbmit-portfolio-line-li">
                                    <span class="pbmit-portfolio-line-title">Terms : </span>
                                    <span class="pbmit-portfolio-line-value">{{ $project->terms }}</span>
                                </li>
                                <li class="pbmit-portfolio-line-li">
                                    <span class="pbmit-portfolio-line-title">Project Type : </span>
                                    <span class="pbmit-portfolio-line-value">{{ $project->project_type }}</span>
                                </li>
                                <li class="pbmit-portfolio-line-li">
                                    <span class="pbmit-portfolio-line-title">Production Year : </span>
                                    <span class="pbmit-portfolio-line-value">{{ $project->production_year }}</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="pbmit-featured-img-wrapper">
                    @if ($project->hasImage())
                        <img src="{{ $project->getImageUrl('large') }}" class="w-100" alt="{{ $project->title }}">
                    @else
                        <img src="images/portfolio/portfolio-single-01.jpg" class="w-100" alt="">
                    @endif
                </div>
                <div class="pbmit-entry-content">
                    <div class="pbmit-heading animation-style2">
                        <h2 class="pbmit-title">Design in Details</h2>
                    </div>
                    {{ $project->description }}
                    @if (!empty($project->lenght))
                        <div class="ihbox-style-area">
                            <div class="row g-0">
                                <div class="col-md-6 col-xl-3">
                                    <div class="pbmit-ihbox-style-14">
                                        <div class="pbmit-ihbox-box">
                                            <div class="pbmit-icon-wrapper">
                                                <h2 class="pbmit-element-title">[{{ $project->length }}]</h2>
                                                <div class="pbmit-heading-desc">Lenght</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="pbmit-ihbox-style-14">
                                        <div class="pbmit-ihbox-box">
                                            <div class="pbmit-icon-wrapper">
                                                <h2 class="pbmit-element-title">[{{ $project->width }}]</h2>
                                                <div class="pbmit-heading-desc">Width</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="pbmit-ihbox-style-14">
                                        <div class="pbmit-ihbox-box">
                                            <div class="pbmit-icon-wrapper">
                                                <h2 class="pbmit-element-title">[{{ $project->height }}]</h2>
                                                <div class="pbmit-heading-desc">Height</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="pbmit-ihbox-style-14">
                                        <div class="pbmit-ihbox-box">
                                            <div class="pbmit-icon-wrapper">
                                                <h2 class="pbmit-element-title">[{{ $project->area }}]</h2>
                                                <div class="pbmit-heading-desc">Site Area</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        // Get the collection of remaining images once to be efficient.
                        $remainingImages = $project->getRemainingImages();
                    @endphp
                    {{-- Only render the gallery if there's at least one remaining image --}}
                    @if ($remainingImages->isNotEmpty())
                        <div class="pf-img-box">
                            <div class="row">
                                {{-- Image #1 --}}
                                @if(isset($remainingImages[0]))
                                    <div class="col-md-6">
                                        <div class="pbmit-animation-style1 me-md-3 first-img">
                                            <img src="{{ $remainingImages[0]->getUrl('medium') }}" class="img-fluid" alt="Gallery image 1 for {{ $project->title }}">
                                        </div>
                                    </div>
                                @endif

                                {{-- Image #2 --}}
                                @if(isset($remainingImages[1]))
                                    <div class="col-md-6">
                                        <div class="pbmit-animation-style2 ms-md-3">
                                            <img src="{{ $remainingImages[1]->getUrl('medium') }}" class="img-fluid" alt="Gallery image 2 for {{ $project->title }}">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if(isset($remainingImages[2]))
                                <div class="mt-4">
                                    <div class="row">
                                        {{-- Image #3 --}}
                                        <div class="col-md-6">
                                            <div class="pbmit-animation-style3 me-md-3 third-img">
                                                <img src="{{ $remainingImages[2]->getUrl('medium') }}" class="img-fluid" alt="Gallery image 3 for {{ $project->title }}">
                                            </div>
                                        </div>

                                        {{-- Image #4 --}}
                                        @if(isset($remainingImages[3]))
                                            <div class="col-md-6">
                                                <div class="pbmit-animation-style4 ms-md-3">
                                                    <img src="{{ $remainingImages[3]->getUrl('medium') }}" class="img-fluid" alt="Gallery image 4 for {{ $project->title }}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($remainingImages->count() > 4)
                                <div class="mt-4 row">
                                    {{--
                                        Loop through a new collection that contains only the items
                                        from the 5th position onwards (index 4).
                                    --}}
                                    @foreach ($remainingImages->slice(4) as $image)
                                        <div class="mt-4 col-md-6">
                                            {{-- A simple, repeating div for additional images --}}
                                            <div>
                                                <img src="{{ $image->getUrl('medium') }}" class="img-fluid" alt="Gallery image for {{ $project->title }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="py-5">
                        @if (!empty($project->options))
                            <div class="pbmit-heading animation-style2">
                                <h2 class="pbmit-title">What say our Client’s about design</h2>
                            </div>
                            <div>
                                The interior designer may also work with engineers and contractors to ensure that the design is feasible and can be implemented within the construction budget. We believe that a well-designed space can have a profound impact on your well-being and quality of life. With a team of skilled designers and professionals, we are strive to provide exceptional interior design services that exceed your expectations.
                            </div>
                            <div class="ihbox-style-15-area">
                                <div class="pbmit-ihbox-style-15">
                                    <div class="pbmit-ihbox-box d-flex">
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                                <i class="pbmit-xinterio-icon pbmit-xinterio-icon-quote-left"></i>
                                            </div>
                                        </div>
                                        <div class="pbmit-ihbox-contents">
                                            <div class="pbmit-heading-desc">"{{ $project->options['feedback'] }}”</div>
                                            <h2 class="pbmit-element-title">- {{ $project->client }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <nav class="navigation post-navigation" aria-label="Posts">
                    <div class="nav-links">
                        @if ($previousProject)
                            <div class="nav-previous">
                                <a href="{{ route('portfolio.show', ['slug' => $previousProject->slug]) }}" rel="prev">
                                    <span class="pbmit-post-nav-icon">
                                        <i class="pbmit-base-icon-left-arrow-1"></i>
                                        <span class="pbmit-post-nav-head">Previous Project</span>
                                    </span>
                                    <span class="pbmit-post-nav-wrapper">
                                        <span class="pbmit-post-nav nav-title">{{ $previousProject->title }}</span>
                                    </span>
                                </a>
                            </div>
                        @endif
                        @if ($nextProject)
                            <div class="nav-next">
                                <a href="{{ route('portfolio.show', ['slug' => $nextProject->slug]) }}" rel="next">
                                    <span class="pbmit-post-nav-icon">
                                        <span class="pbmit-post-nav-head">Next Project</span>
                                        <i class="pbmit-base-icon-next"></i>
                                    </span>
                                    <span class="pbmit-post-nav-wrapper">
                                        <span class="pbmit-post-nav nav-title">{{ $nextProject->title }}</span>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </nav>
            </article>
        </div>
    </section>
    <!-- Portfolio Detail Style 1 End -->

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>
<!-- Page Content End -->
