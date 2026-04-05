@php
    // 1. Fetch Dynamic Logo and Branding
    $brandLogo = $siteSettings->logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'SuperDuper');

    // 2. Fetch Dynamic Menu
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $menu = Menu::location('header');
@endphp

<header id="archx-header" class="archx-header-section">
    <div class="container">
        <div class="header-top-content d-flex justify-content-between position-relative">
            <div class="header-top-cta ul-li">
                <ul>
                    <li><i class="fal fa-map-marker-alt"></i> Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren</li>
                    <li><i class="fal fa-envelope"></i>livingsmeinterior@gmail.com</li>
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
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header-main-menu-wrapper d-flex justify-content-between align-items-center position-relative">
            <div class="archx-side-bar-menu-wrapper d-flex">
                <div class="archx-side-bar-button navSidebar-button">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
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
                <div class="header-cta-number d-flex align-items-center text-uppercase" style="margin-right: 15px;">
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
                                            <a href="{{ $item->url }}" @if($item->target) target="{{ $item->target }}" @endif>
                                                {{ $item->title }}
                                            </a>
                                            @if($hasChildren)
                                                <ul class="dropdown-menu" style="padding-left: 15px;">
                                                    @foreach($item->children as $child)
                                                        <li>
                                                            <a href="{{ $child->url }}">{{ $child->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif

                                <li style="margin-top: 20px;">
                                    <a href="admin/login" style="color: #fff; background-color: #333; padding: 10px; text-align: center; border-radius: 5px;">Admin Panel</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                </div>
        </div>
    </div>
</header>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all elements that trigger the mobile menu
    const mobileMenuTriggers = document.querySelectorAll('.open_mobile_menu');
    const mobileMenuWrap = document.querySelector('.mobile_menu_wrap');

    // Function to toggle the mobile menu visibility
    function toggleMobileMenu() {
        if (mobileMenuWrap) {
            // Check current styling or class and toggle it
            // Many templates use a CSS class like 'active', or simply toggle display
            if (mobileMenuWrap.style.display === 'block') {
                mobileMenuWrap.style.display = 'none';
                document.body.style.overflow = 'auto'; // allow scrolling again
            } else {
                mobileMenuWrap.style.display = 'block';
                document.body.style.overflow = 'hidden'; // prevent background scrolling
            }
        }
    }

    // Attach click events to the hamburger icon, the overlay, and the close button
    mobileMenuTriggers.forEach(trigger => {
        trigger.addEventListener('click', toggleMobileMenu);
    });

    // Hide mobile menu wrap initially just in case CSS doesn't
    if(mobileMenuWrap && !mobileMenuWrap.classList.contains('active')) {
        mobileMenuWrap.style.display = 'none';
    }
});
</script>
@endpush
