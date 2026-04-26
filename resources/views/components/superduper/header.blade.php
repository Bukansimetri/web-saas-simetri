@php
    // 1. Fetch Dynamic Logo and Branding
    $brandLogo = $siteSettings->logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'Living Interior');

    // 2. Fetch Dynamic Menu
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $menu = Menu::location('header');
    $topBarColor = request()->routeIs('home') ? '#fff' : '#000';
@endphp

<header id="archx-header" class="archx-header-section">
    <div class="container">
        <div class="header-top-content d-flex justify-content-between position-relative">
            <div class="header-top-cta ul-li">
                <ul>
                    <li>
                        <i class="fal fa-map-marker-alt" style="color: {{ $topBarColor }} !important;"></i>
                        <span style="color: {{ $topBarColor }} !important;">Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren</span>
                    </li>
                    <li>
                        <i class="fal fa-envelope" style="color: {{ $topBarColor }} !important;"></i>
                        <span style="color: {{ $topBarColor }} !important;">livingsmeinterior@gmail.com</span>
                    </li>
                </ul>
            </div>

            <div class="brand-logo">
                <a href="{{ route('home') }}">
                    @if($brandLogo)
                        <img src="{{ Storage::url($brandLogo) }}" alt="{{ $brandName }}" style="max-height: 50px;">
                    @else
                        <span style="font-size: 1.5rem; font-weight: bold; color: #333;">{{ $brandName }}</span>
                    @endif
                </a>
            </div>

            <div class="header-language-select-social d-flex">
                <div class="header-social ul-li">
                    <ul>
                        <li><a href="https://www.instagram.com/living_interior.id/"><i class="fab fa-instagram"></i></a></li>
							<li><a href="https://api.whatsapp.com/send?phone=6282130354599&text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20desain%20interior%20di%20Living%20Interiornya%0A%0ASaya%20ingin%20konsultasi%20untuk%20kebutuhan%20Design%20Interior.%20%0A%0ABoleh%20dibantu%20untuk%20informasi%20lebih%20lanjut%20dan%20estimasi%20biayanya%3F"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header-main-menu-wrapper d-flex justify-content-between align-items-center position-relative">
            <div class="archx-side-bar-menu-wrapper d-flex">
                <div class="archx-main-navigation-wrap">
                    <nav class="clearfix main-navigation ul-li">
                        <ul id="main-nav" class="clearfix nav navbar-nav">
                            @if($menu)
                                @foreach($menu->menuItems as $item)
                                    @php $hasChildren = count($item->children) > 0; @endphp
                                    <li class="{{ $hasChildren ? 'dropdown' : '' }}">
                                        <a href="{{ $item->url }}" @if($item->target) target="{{ $item->target }}" @endif>
                                            {{ $item->title }}
                                        </a>

                                        @if($hasChildren)
                                            <ul class="dropdown-menu">
                                                @foreach($item->children as $child)
                                                    <li>
                                                        <a href="{{ $child->url }}" @if($child->target) target="{{ $child->target }}" @endif>
                                                            {{ $child->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="header-cta-btn-wrapper d-flex align-items-center">
                <div class="header-cta-number d-flex align-items-center text-uppercase">
                    <div class="header-cta-icon d-flex justify-content-center align-items-center">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="header-cta-value">
                        <span class="ar-title">WhatsApp:</span>
                        <span class="ar-value">+62 821-3035-4599</span>
                    </div>
                </div>
                <div class="header-cta-btn">
                    <a class="d-flex justify-content-center align-items-center" href="#">Konsultasi Gratis <i class="fal fa-long-arrow-right"></i></a>
                </div>
            </div>

            <div class="mobile_menu">
                <div class="mobile_menu_button open_mobile_menu">
                    <i class="fal fa-bars"></i>
                </div>
                <div class="mobile_menu_wrap">
                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                    <div class="mobile_menu_content">
                        <div class="mobile_menu_close open_mobile_menu">
                            <i class="fal fa-times"></i>
                        </div>
                        <div class="m-brand-logo">
                            <a href="{{ route('home') }}">
                                @if($brandLogo)
                                    <img src="{{ Storage::url($brandLogo) }}" alt="{{ $brandName }}" style="max-height: 40px;">
                                @else
                                    <span style="font-size: 1.25rem; font-weight: bold; color: #333;">{{ $brandName }}</span>
                                @endif
                            </a>
                        </div>
                        <nav class="clearfix mobile-main-navigation ul-li">
                            <ul id="m-main-nav" class="clearfix nav navbar-nav">
                                @if($menu)
                                    @foreach($menu->menuItems as $item)
                                        @php $hasChildren = count($item->children) > 0; @endphp
                                        <li class="{{ $hasChildren ? 'dropdown' : '' }}">
                                            <a href="{{ $item->url }}">{{ $item->title }}</a>
                                            @if($hasChildren)
                                                <ul class="dropdown-menu" style="padding-left: 15px;">
                                                    @foreach($item->children as $child)
                                                        <li><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
