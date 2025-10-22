@section('hero')
@php
    $banners = \App\Models\Banner\Content::whereHas('category', function($query) {
                $query->where('slug', 'services-banner');
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
                <x-superduper.components.breadcrumb title="Services"/>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->
@endsection
<!-- Page Content -->
<div class="page-content">
    <!-- Service Details -->
    <section class="site-content service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 service-right-col">
                    <div class="pbmit-service-feature-image">
                        @if (!empty($services))
                            <img src="{{ $services->getImageUrl('large') }}" class="img-fluid w-100" alt="{{ $services->title }}">
                        @else
                            <img src="{{ asset('assets/images/service/service-det-01.jpg') }}" class="img-fluid w-100" alt="homecareinterior">
                        @endif
                    </div>
                    <div class="pbmit-entry-content">
                        <div class="pbmit-service-content">
                            <div class="mb-3 pbmit-heading animation-style2">
                                @if (!empty($services))
                                    <h3 class="pbmit-title">{{ $services->title }}</h3>
                                @else
                                    <h3 class="pbmit-title">Our Goal is to Create Incredible Custom Interior Design</h3>
                                @endif
                            </div>
                            {{-- Use the description from your database. The raw HTML output is needed if it contains formatting. --}}
                            @if (!empty($services))
                                {!! $services->description !!}
                            @else
                                <p class="pbmit-firstletter">
                                    Monsidering the physical, mental, and emotional needs of people, interior designers use human-centered approaches to address how we live today. Creating novel approaches to promoting health, safety, and welfare, contemporary interiors are increasingly inspired by biophilia as a holistic approach to promoting health, safety, and welfare, contemporary interiors are increasingly inspired by biophilia as a holistic approach to design. By definition, interior design encompasses diverse aspects of our environment. The discipline extends to building materials and finishes; casework, furniture.
                                </p>
                            @endif
                            {{--
                                This section dynamically lists features.
                                It assumes you have a JSON column 'options' with a key 'features' that is an array.
                                Example: ['features' => ['Feature A', 'Feature B', 'Feature C', 'Feature D']]
                            --}}
                            @if (!empty($services->options['features']))
                                @php
                                    // Split the features array into two chunks for the two-column layout
                                    $featureChunks = array_chunk($services->options['features'], ceil(count($services->options['features']) / 2));
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-borderless">
                                            @foreach ($featureChunks[0] as $feature)
                                                <li class="list-group-item">
                                                    <span class="pbmit-icon-list-icon">
                                                        <i aria-hidden="true" class="pbmit-xinterio-icon pbmit-xinterio-icon-tick-mark"></i>
                                                    </span>
                                                    <span class="pbmit-icon-list-text">{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if (isset($featureChunks[1]))
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-borderless">
                                                @foreach ($featureChunks[1] as $feature)
                                                    <li class="list-group-item">
                                                        <span class="pbmit-icon-list-icon">
                                                            <i aria-hidden="true" class="pbmit-xinterio-icon pbmit-xinterio-icon-tick-mark"></i>
                                                        </span>
                                                        <span class="pbmit-icon-list-text">{{ $feature }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 service-left-col sidebar">
                    <aside class="service-sidebar">
                        <aside class="widget post-list">
                            <h2 class="widget-title">Our Service</h2>
                            <div class="all-post-list">
                                {{--
                                    This list should be populated with OTHER services.
                                    Pass a variable like $otherServices from your Livewire component.
                                --}}
                                @if(isset($otherServices) && $otherServices->isNotEmpty())
                                    <ul>
                                        @foreach ($otherServices as $otherService)
                                            {{-- Use the getUrl() helper from your model for clean routing --}}
                                            <li><a href="{{ $otherService->getUrl() }}">{{ $otherService->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </aside>
                        {{-- As requested, the ad and download widgets have been skipped --}}
                        <aside class="widget pbmit-service-ad">
                            <div class="textwidget">
                                <div class="pbmit-service-ads">
                                    <h5 class="pbmit-ads-subheding">Our Newsletter</h5>
                                    <h4 class="pbmit-ads-subtitle">Ready to start learn ?</h4>
                                    <h3 class="pbmit-ads-title">Sign up now!</h3>
                                    <div class="pbmit-ads-desc">
                                        <i class="pbmit-base-icon-phone-call-1"></i>+(123) 1234-567-8901
                                    </div>
                                    <a class="pbmit-btn pbmit-btn-hover-white" href="#">
                                        <span class="pbmit-button-content-wrapper">
                                            <span class="pbmit-button-text">Register now</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </aside>
                        <aside class="widget pbmit-download-content">
                            <h2 class="widget-title">Company profile</h2>
                            <div class="textwidget">
                                <div class="download">
                                    <div class="item-download">
                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                            <span class="pbmit-download-content">
                                                <i class="pbmit-base-icon-pdf-file-format-symbol-1"></i> Download Pdf File
                                            </span>
                                            <span class="pbmit-download-item">
                                                <i class="pbminfotech-base-icons pbmit-righticon pbmit-base-icon-download"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="item-download">
                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                            <span class="pbmit-download-content">
                                                <i class="pbmit-base-icon-pdf-file-format-symbol-1"></i> Download Word File
                                            </span>
                                            <span class="pbmit-download-item">
                                                <i class="pbminfotech-base-icons pbmit-righticon pbmit-base-icon-download"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <a href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16.75 13.96c.25.13.43.2.5.33.07.13.07.66 0 1.14-.07.48-.83 1.14-1.5 1.25-.67.11-1.33 0-2.1-.25-.77-.25-1.93-.92-3.3-2.2-.47-.44-.9-1-1.29-1.6-.39-.6-.6-1.28-.6-1.8 0-.52.23-.9.48-1.15.25-.25.5-.33.7-.33.19 0 .38.03.52.07.14.04.25.07.38.48s.33.81.36.88c.03.07.03.16 0 .25-.03.09-.07.14-.14.23-.07.09-.14.16-.2.23-.07.07-.12.12-.16.18-.04.06-.07.1-.04.16.14.3.52.83 1.1 1.36.77.7 1.48 1.11 1.8 1.23.07.03.13.01.16-.01.03-.02.31-.25.43-.5.12-.25.21-.47.28-.6.07-.13.14-.14.23-.1.09.04.63.3 1.1.58zM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
        </svg>
    </a>
</div>
<!-- Page Content End -->
