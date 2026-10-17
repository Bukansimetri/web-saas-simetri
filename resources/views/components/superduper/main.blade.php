<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" class="scroll-smooth">

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
        {{-- <meta name="robots" content="noindex"> --}}
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application-name" content="{{ $siteName }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoSettings->canonical_url ?? url()->current() }}" />

    <!-- SEO Meta Tags -->
    <meta name="keywords"
        content="{{ $metaKeywords ?? $seoSettings->meta_keywords ?? 'starter kit, development, templates, components, web solutions, digital transformation' }}" />
    <meta name="description"
        content="{{ $pageDescription ?? $seoSettings->meta_description ?? $siteSettings->description ?? 'SuperDuper Starter Kit provides everything you need to jumpstart your web project with pre-built components, layouts, and tools that enhance development efficiency and productivity.' }}">

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
        content="{{ $seoSettings->schema_logo ? Storage::url($seoSettings->schema_logo) : ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ $seoSettings->twitter_card_type ?? 'summary' }}">
    <meta name="twitter:site" content="{{ $seoSettings->twitter_site ?? '@superduperkit' }}" />
    <meta name="twitter:creator" content="{{ $seoSettings->twitter_creator ?? '@superduperkit' }}" />
    <meta name="twitter:title" content="{{ $seoSettings->twitter_title ?? $title }}">
    <meta name="twitter:description"
        content="{{ $seoSettings->twitter_description ?? $pageDescription ?? $seoSettings->meta_description }}" />
    <meta name="twitter:image"
        content="{{ $seoSettings->twitter_image ? Storage::url($seoSettings->twitter_image) : ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}">
    <meta name="twitter:url" content="{{ url()->current() }}">

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:site_name" content="{{ $seoSettings->og_site_name ?? $siteName }}" />
    <meta property="og:title" content="{{ $seoSettings->og_title ?? $title }}" />
    <meta property="og:type" content="{{ $seoSettings->og_type ?? 'website' }}" />
    <meta property="og:description"
        content="{{ $seoSettings->og_description ?? $pageDescription ?? $seoSettings->meta_description }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image"
        content="{{ $seoSettings->og_image ? Storage::url($seoSettings->og_image) : ($brandLogo ? Storage::url($brandLogo) : asset('storage/images/logo.png')) }}" />
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

    <!-- Favicon from settings -->
    <link rel="shortcut icon" href="{{ $favicon ? Storage::url($favicon) : asset('superduper/img/favicon.png') }}"
        type="image/x-icon">

    <!-- Fonts: self-hosted, hero/body faces preloaded -->
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('assets/fonts/google/space-grotesk-normal-a57c9413.woff2') }}" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('assets/fonts/google/outfit-normal-c8e7a734.woff2') }}" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('assets/fonts/google/raleway-normal-eec07959.woff2') }}" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/google-fonts.css') }}?v={{ filemtime(public_path('assets/css/google-fonts.css')) }}">

    @stack('preload')

	{{-- Theme CSS bundle (bootstrap, slick, global, twenty, reset, style): see bin/bundle-assets.sh --}}
	<link rel="stylesheet" href="{{ asset('assets/css/bundle.css') }}?v={{ filemtime(public_path('assets/css/bundle.css')) }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}?v={{ filemtime(public_path('assets/css/fontawesome-all.css')) }}" media="print" onload="this.media='all'">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" media="print" onload="this.media='all'">
	<link rel="stylesheet" href="{{ asset('assets/css/video.min.css') }}" media="print" onload="this.media='all'">
	<noscript>
		<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}?v={{ filemtime(public_path('assets/css/fontawesome-all.css')) }}">
		<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/video.min.css') }}">
	</noscript>

    @stack('css')

    <!-- Custom CSS -->
    @if(isset($scriptSettings->custom_css))
        <style>
            {!! $scriptSettings->custom_css !!}
        </style>
    @endif

    @if(($livewire ?? true) !== false)
        @livewireStyles
    @endif

    <!-- Header scripts -->
    @if(isset($scriptSettings->header_scripts))
        {!! $scriptSettings->header_scripts !!}
    @endif

    <style>
        /* width/height attributes reserve space against layout shift; keep the aspect ratio when CSS resizes the image. */
        img[width][height] {
            height: auto;
        }
        .whatsapp-float {
            width: 55px;
            height: 55px;
            bottom: 90px;
            right: 20px;
            z-index: 5;
            position: fixed;
            line-height: 55px;
            background-color: #25D366;
            border-radius: 100%;
            display: block;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
        }
        .whatsapp-float i {
            color: #fff;
            font-size: 30px;
            line-height: 55px;
        }
        .whatsapp-float:hover {
            background-color: #128C7E;
            color: #fff;
        }
    </style>

    <!--  structured data (JSON-LD) -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "{{ $seoSettings->schema_type ?? '' }}",
        "name": "{{ $seoSettings->schema_name ?? $siteName }}",
        "url": "{{ url('/') }}",
        "logo": "{{ $seoSettings->schema_logo ? Storage::url($seoSettings->schema_logo) : ($brandLogo ? Storage::url($brandLogo) : asset('superduper/img/favicon.png')) }}",
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
        <x-superduper.header />

        {{ $slot }}

        <x-superduper.footer />

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

    <div class="whatsapp-btn">
        <a href="https://wa.me/6282130354599?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20desain%20interior%20di%20Living%20Interiornya%0A%0ASaya%20ingin%20konsultasi%20untuk%20kebutuhan%20Design%20Interior.%20%0A%0ABoleh%20dibantu%20untuk%20informasi%20lebih%20lanjut%20dan%20estimasi%20biayanya%3F" class="text-center whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>
        </a>
    </div>

    {{-- Theme JS bundle (jquery, bootstrap, plugins, script.js): see bin/bundle-assets.sh --}}
    {{-- Deferred: inline scripts that need jQuery must wait for DOMContentLoaded. --}}
    <script src="{{ asset('assets/js/bundle.js') }}?v={{ filemtime(public_path('assets/js/bundle.js')) }}" defer></script>

    @if(($livewire ?? true) !== false)
        @livewireScripts
    @endif

    @if(isset($scriptSettings->custom_js))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                {!! $scriptSettings->custom_js !!}
            });
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
