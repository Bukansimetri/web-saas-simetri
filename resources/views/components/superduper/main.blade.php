<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ $seoSettings->canonical_url ?? url()->current() }}" />

        <!-- SEO Meta Tags -->
        <meta name="keywords"
            content="{{ $metaKeywords ?? $seoSettings->meta_keywords ?? 'starter kit, development, templates, components, web solutions, digital transformation' }}" />
        <meta name="description"
            content="{{ $pageDescription ?? $seoSettings->meta_description ?? $siteSettings->description ?? 'SuperDuper Starter Kit provides everything you need to jumpstart your web project with pre-built components, layouts, and tools that enhance development efficiency and productivity.' }}">

        <!-- Mobile Optimization Meta Tags -->
        <meta name="format-detection" content="telephone=no">
        <meta name="theme-color" content="#512B0F">
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
        <meta name="twitter:site" content="{{ $seoSettings->twitter_site ?? '@superduperkit' }}" />
        <meta name="twitter:creator" content="{{ $seoSettings->twitter_creator ?? '@superduperkit' }}" />
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

        <!-- Favicon from settings -->
        <link rel="shortcut icon" href="{{ $favicon ? Storage::url($favicon) : asset('superduper/img/favicon.png') }}"
            type="image/x-icon">

        <!-- Theme CSS via Vite -->
        {{-- @vite([
            'resources/css/app.css',
        ]) --}}

        <!-- Custom CSS -->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

        @stack('css')

        <!-- Custom CSS -->
        @if(isset($scriptSettings->custom_css))
            <style>
                {!! $scriptSettings->custom_css !!}
            </style>
        @endif

        @livewireStyles

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
<body class="grocery-theme">

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

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>

        <div id="main-wrapper">
            <x-superduper.header />

            {{ $slot }}

            <x-superduper.footer />
        </div>

    @endif

    <!-- WhatsApp Floating Button -->
<div class="whatsapp-button" style="position:fixed; bottom:20px; right:20px; z-index:9999;">
    <a href="https://wa.me/{{ $siteSettings->company_phone }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20Anda"
       target="_blank"
       style="display:flex; align-items:center; justify-content:center; width:60px; height:60px; background-color:#25D366; border-radius:50%; box-shadow:0 4px 8px rgba(0,0,0,0.2); transition:all 0.3s ease;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#ffffff">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
</div>

    <!-- Vite compiled JS -->
    {{-- @vite([
        'resources/js/app.js',
    ]) --}}

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/smoothproducts.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-rating.js') }}"></script>
    <script src="{{ asset('assets/js/jQuery.style.switcher.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <script>
        function openRightMenu() {
            document.getElementById("rightMenu").style.display = "block";
        }
        function closeRightMenu() {
            document.getElementById("rightMenu").style.display = "none";
        }
    </script>

    <script>
        function openLeftMenu() {
            document.getElementById("leftMenu").style.display = "block";
        }
        function closeLeftMenu() {
            document.getElementById("leftMenu").style.display = "none";
        }
    </script>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openModal', (data) => {
                const $modal = $('#' + data.id);
                $modal.modal('show');

                $modal.on('shown.bs.modal', function () {
                    $(this).find('img').each(function () {
                        this.src = this.src; // force repaint image
                    });
                });
            });
        });
    </script>

    <script>
        function openFilterSearch() {
            document.getElementById("filter_search").style.display = "block";
        }
        function closeFilterSearch() {
            document.getElementById("filter_search").style.display = "none";
        }
    </script>

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
