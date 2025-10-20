<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" class="no-js">
   <head>
        @php
            $favicon = $generalSettings->site_favicon;
            $brandLogo = $generalSettings->brand_logo;
            $siteName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'SuperDuper Starter Kit');

            $separator = $seoSettings->title_separator ?? '|';
            $page_type = $page_type ?? 'standard';

            $_main_variables = [
                '{site_name}' => $siteName,
                '{separator}' => $separator,
            ];

            switch ($page_type) {
                case 'blog_post':
                    $titleFormat = $seoSettings->blog_title_format ?? '{post_title} {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{post_title}' => $postTitle ?? '',
                        '{post_category}' => $postCategory ?? '',
                        '{author_name}' => $authorName ?? '',
                        '{publish_date}' => isset($publishDate) ? $publishDate->format('Y') : '',
                    ]);
                    break;

                case 'product':
                    $titleFormat = $seoSettings->product_title_format ?? '{product_name} {separator} {product_category} {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{product_name}' => $productName ?? '',
                        '{product_category}' => $productCategory ?? '',
                        '{product_brand}' => $productBrand ?? '',
                        '{price}' => $productPrice ?? '',
                    ]);
                    break;

                case 'category':
                    $titleFormat = $seoSettings->category_title_format ?? '{category_name} {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{category_name}' => $categoryName ?? '',
                        '{parent_category}' => $parentCategory ?? '',
                        '{products_count}' => $productsCount ?? '',
                    ]);
                    break;

                case 'search':
                    $titleFormat = $seoSettings->search_title_format ?? 'Search results for "{search_term}" {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{search_term}' => $searchTerm ?? '',
                        '{results_count}' => $resultsCount ?? '',
                    ]);
                    break;

                case 'author':
                    $titleFormat = $seoSettings->author_title_format ?? 'Posts by {author_name} {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{author_name}' => $authorName ?? '',
                        '{post_count}' => $postCount ?? '',
                    ]);
                    break;

                default:
                    $titleFormat = $seoSettings->meta_title_format ?? '{page_title} {separator} {site_name}';
                    $variables = array_merge($_main_variables, [
                        '{page_title}' => $pageTitle ?? '',
                    ]);
            }

            // Process the format by replacing placeholders
            $title = str_replace(
                array_keys($variables),
                array_values($variables),
                $titleFormat
            );

            // Clean up the title (remove double separators, eliminate leading/trailing separators)
            $title = preg_replace('/\s*' . preg_quote($separator) . '\s*' . preg_quote($separator) . '\s*/', " $separator ", $title);
            $title = trim($title);
            $title = trim($title, " $separator");

            // Fallback if empty
            if (empty(trim($title))) {
                $title = $siteName;
            }
        @endphp

        @if (!$generalSettings->search_engine_indexing)
            <meta name="robots" content="noindex">
        @endif

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="application-name" content="{{ $siteName }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ $seoSettings->canonical_url ?? url()->current() }}" />

        <!-- SEO Meta Tags -->
        <meta name="keywords"
            content="{{ $metaKeywords ?? $seoSettings->meta_keywords ?? 'Simetri kit, Website Development, Application, web solutions, digital marketing' }}" />
        <meta name="description"
            content="{{ $pageDescription ?? $seoSettings->meta_description ?? $siteSettings->description ?? 'Simetri Space provides solution website development, application development and digital marketing for your business growth' }}">

        <!-- Mobile Optimization Meta Tags -->
        <meta name="format-detection" content="telephone=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <!-- Schema.org markup (Google) -->
        <meta itemprop="name" content="{{ $title }}" />
        <meta itemprop="url" content="{{ url()->current() }}">
        <meta itemprop="description"
            content="{{ $pageDescription ?? $seoSettings->meta_description ?? $siteSettings->description }}">
        <meta itemprop="thumbnailUrl"
            content="{{ $brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png') }}">
        <meta itemprop="image"
            content="{{ $seoSettings->schema_logo ?? ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="{{ $seoSettings->twitter_card_type ?? 'summary' }}">
        <meta name="twitter:site" content="{{ $seoSettings->twitter_site ?? '@bukansimetri' }}" />
        <meta name="twitter:creator" content="{{ $seoSettings->twitter_creator ?? '@bukansimetri' }}" />
        <meta name="twitter:title" content="{{ $seoSettings->twitter_title ?? $title }}">
        <meta name="twitter:description"
            content="{{ $seoSettings->twitter_description ?? $pageDescription ?? $seoSettings->meta_description }}" />
        <meta name="twitter:image"
            content="{{ $seoSettings->twitter_image ?? ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}">
        <meta name="twitter:url" content="{{ url()->current() }}">

        <!-- Open Graph (Facebook, LinkedIn) -->
        <meta property="og:site_name" content="{{ $seoSettings->og_site_name ?? $siteName }}" />
        <meta property="og:title" content="{{ $seoSettings->og_title ?? $title }}" />
        <meta property="og:type" content="{{ $seoSettings->og_type ?? 'website' }}" />
        <meta property="og:description"
            content="{{ $seoSettings->og_description ?? $pageDescription ?? $seoSettings->meta_description }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image"
            content="{{ $seoSettings->og_image ?? ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}" />
        <meta property="og:image:width" content="1500">
        <meta property="og:image:height" content="1500">
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:alt" content="{{ $siteName }}" />

        <!-- Verification codes -->
        @if(!empty($seoSettings->verification_codes))
            @foreach($seoSettings->verification_codes as $verificationCode)
                {!! $verificationCode !!}
            @endforeach
        @endif

        <!-- Additional meta tags -->
        @if($seoSettings->head_additional_meta)
            {!! $seoSettings->head_additional_meta !!}
        @endif

        @yield('meta')

        <title>{{ $title }}</title>
        <meta name="robots" content="noindex, follow">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon from settings -->
        <link rel="shortcut icon" href="{{ $favicon ? Storage::url($favicon) : asset('superduper/img/favicon.png') }}"
            type="image/x-icon">

        <!-- CSS ============================================ -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
        <!-- Flaticon -->
        <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
        <!-- Base Icons -->
        <link rel="stylesheet" href="{{ asset('assets/css/pbminfotech-base-icons.css') }}">
        <!-- Themify Icons -->
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <!-- Slick -->
        <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
        <!-- Magnific -->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <!-- Twentytwenty CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/twentytwenty.css') }}">
        <!-- AOS -->
        <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
        <!-- Shortcode CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/shortcode.css') }}">
        <!-- Base CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

        @stack('css')

        <!-- Custom CSS -->
        @if(isset($scriptSettings->custom_css))
            <style>
                {!! $scriptSettings->custom_css !!}
            </style>
        @endif

        <!-- Header scripts -->
        @if(isset($scriptSettings->header_scripts))
            {!! $scriptSettings->header_scripts !!}
        @endif

        <!--  structured data (JSON-LD) -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "{{ $seoSettings->schema_type ?? '' }}",
                "name": "{{ $seoSettings->schema_name ?? $siteName }}",
                "url": "{{ url('/') }}",
                "logo": "{{ $seoSettings->schema_logo ?? ($brandLogo ? Storage::url($brandLogo) : asset('superduper/img/favicon.png')) }}",
                "description": "{{ $seoSettings->schema_description ?? $siteSettings->description ?? 'SuperDuper Starter Kit provides everything you need to jumpstart your web project with pre-built components, layouts, and tools that enhance development efficiency and productivity.' }}",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "{{ explode(',', $siteSettings->company_address)[0] ?? '' }}",
                    "addressRegion": "{{ explode(',', $siteSettings->company_address)[1] ?? '' }}",
                    "addressCountry": "{{ explode(',', $siteSettings->company_address)[2] ?? 'ID' }}"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "{{ $siteSettings->company_phone ?? '' }}",
                    "contactType": "customer service",
                    "email": "{{ $siteSettings->company_email ?? '' }}"
                }
            }
        </script>

   </head>
   <body>
        <!-- Body start scripts -->
        @if(isset($scriptSettings->body_start_scripts))
            {!! $scriptSettings->body_start_scripts !!}
        @endif

        @if(isset($siteSettings->is_maintenance) && $siteSettings->is_maintenance)
            <div class="maintenance-mode">
                <div class="container">
                    <h1>Site Under Maintenance</h1>
                    <p>We're currently performing maintenance. Please check back soon.</p>
                </div>
            </div>
        @else
            <!-- page wrapper -->
            <div class="page-wrapper">
                <!-- Header Main Area -->
                <x-superduper.header />
                <!-- Header Main Area End Here -->

                <!-- Page Content -->
                {{ $slot }}
                <!-- Page Content End -->

                <!-- footer -->
                <x-superduper.footer />
                <!-- footer End -->
            </div>
            <!-- Cookie Consent -->
            @if(isset($scriptSettings->cookie_consent_enabled) && $scriptSettings->cookie_consent_enabled)
                <div class="cookie-consent js-cookie-consent" style="display: none;">
                    <div class="container">
                        <span class="cookie-consent__message">
                            {!! $scriptSettings->cookie_consent_text ?? 'We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.' !!}
                            @if(isset($scriptSettings->cookie_consent_policy_url) && $scriptSettings->cookie_consent_policy_url)
                                <a href="{{ $scriptSettings->cookie_consent_policy_url }}">Learn more</a>
                            @endif
                        </span>
                        <button class="cookie-consent__agree">
                            {{ $scriptSettings->cookie_consent_button_text ?? 'Accept' }}
                        </button>
                    </div>
                </div>
            @endif
        @endif

        <x-superduper.searchbar />

        <!-- Scroll To Top -->
        <div class="pbmit-progress-wrap">
            <svg class="pbmit-progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
            </svg>
        </div>
        <!-- Scroll To Top End -->

        <!-- JS ============================================ -->
        <!-- jQuery JS -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- jquery Waypoints JS -->
        <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
        <!-- jquery Appear JS -->
        <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
        <!-- Numinate JS -->
        <script src="{{ asset('assets/js/numinate.min.js') }}"></script>
        <!-- Slick JS -->
        <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
        <!-- Magnific JS -->
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Circle Progress JS -->
        <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
        <!-- countdown JS -->
        <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
        <!-- AOS -->
        <script src="{{ asset('assets/js/aos.js') }}"></script>
        <!-- GSAP -->
        <script src='{{ asset('assets/js/gsap.js') }}'></script>
        <!-- Scroll Trigger -->
        <script src='{{ asset('assets/js/ScrollTrigger.js') }}'></script>
        <!-- Split Text -->
        <script src='{{ asset('assets/js/SplitText.js') }}'></script>
        <!-- Magnetic -->
        <script src='{{ asset('assets/js/magnetic.js') }}'></script>
        <!-- Morphext JS -->
        <script src="{{ asset('assets/js/morphext.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <!-- GSAP Animation -->
        <script src='{{ asset('assets/js/gsap-animation.js') }}'></script>
        <!-- Isotope JS -->
        <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
        <!-- Twentytwenty JS -->
        <script src="{{ asset('assets/js/jquery.event.move.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.twentytwenty.js') }}"></script>
        <!-- Scripts JS -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>

        @livewireScripts

        <!-- Custom JS -->
        @if(isset($scriptSettings->custom_js))
            <script>
                {!! $scriptSettings->custom_js !!}
            </script>
        @endif

        <!-- Footer scripts -->
        @if(isset($scriptSettings->footer_scripts))
            {!! $scriptSettings->footer_scripts !!}
        @endif

        <!-- Body end scripts -->
        @if(isset($scriptSettings->body_end_scripts))
            {!! $scriptSettings->body_end_scripts !!}
        @endif

        @stack('js')
   </body>
</html>
