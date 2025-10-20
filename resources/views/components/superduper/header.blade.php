@php
    /** Get Site Settings */
    $brandLogo = $siteSettings->logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'Simetri');
    $brandPhone = $generalSettings->company_phone ?? '+62 81-1199-9435';

    /** Get Menu */
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $menu = Menu::location('header');
@endphp
<header class="site-header header-style-1">
    <div class="pbmit-header-overlay">
        <div class="pbmit-main-header-area">
            <div class="container-fluid">
                <div class="pbmit-header-content d-flex justify-content-between align-items-center">
                    <div class="pbmit-logo-button-area d-flex justify-content-between align-items-center">
                        <div class="site-branding">
                            <h1 class="site-title">
                                <a href="{{ route('home') }}">
                                    @if($brandLogo)
                                        <img src="{{ Storage::url($brandLogo) }}"
                                            alt="{{ $brandName }}"
                                            class="logo-img"
                                        />
                                    @else
                                        Simetri
                                    @endif
                                </a>
                            </h1>
                            <div class="pbmit-sticky-corner pbmit-top-right-corner">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 20V0C20 16 16 20 0 20H20Z" fill="red"></path>
                                </svg>
                            </div>
                            <div class="pbmit-sticky-corner pbmit-bottom-left-corner">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 20V0C20 12 12 20 0 20H20Z" fill="red"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pbmit-button-box">
                            <div class="pbmit-header-button">
                                <a href="tel:{{ $brandPhone }}">
                                    <span class="pbmit-header-button-text-1">{{ $brandPhone }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="site-navigation">
                        <nav class="main-menu navbar-expand-xl navbar-light">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button class="navbar-toggler" type="button">
                                    <i class="pbmit-base-icon-menu-1"></i>
                                </button>
                            </div>
                            <div class="pbmit-mobile-menu-bg"></div>
                            <div class="clearfix collapse navbar-collapse show" id="pbmit-menu">
                                <div class="pbmit-menu-wrap">
                                    <span class="closepanel">
                                        <svg class="qodef-svg--close qodef-m" xmlns="http://www.w3.org/2000/svg" width="20.163" height="20.163" viewBox="0 0 26.163 26.163">
                                            <rect width="36" height="1" transform="translate(0.707) rotate(45)"></rect>
                                            <rect width="36" height="1" transform="translate(0 25.456) rotate(-45)"></rect>
                                        </svg>
                                    </span>
                                    <ul class="clearfix navigation">
                                        @if($menu)
                                            @foreach($menu->menuItems as $index => $item)
                                                @php
                                                    $hasChildren = count($item->children) > 0;
                                                    $menuId = 'submenu-' . ($index + 1);
                                                @endphp
                                                <li class="{{ $hasChildren ? 'dropdown' : '' }} {{ request()->is(ltrim($item->url, '/')) ? 'active' : '' }}">
                                                    <a href="{{ url($item->url) }}">{{ $item->title }}</a>
                                                    @if($hasChildren)
                                                        <ul id="{{ $menuId }}">
                                                            @foreach($item->children as $child)
                                                                <li class="{{ request()->is(ltrim($child->url, '/')) ? 'active' : '' }}">
                                                                    <a href="{{ url($child->url) }}">{{ $child->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="pbmit-right-box d-flex align-items-center">
                        <div class="pbmit-header-search-btn">
                            <a href="#" title="Search">
                                <i class="pbmit-base-icon-search-1"></i>
                            </a>
                        </div>
                        <div class="pbmit-button-box-second">
                            <a class="pbmit-btn" href="https://api.whatsapp.com/send?phone=628111999435&text=Halo%20Tim%20Home%20Care%20Interior%2C%20saya%20ingin%20berkonsultasi%20dengan%20tim%20designnya%20mengenai%20desain%20interior%2C%20bisa%20dibantu%20%3F">
                                <span class="pbmit-button-content-wrapper">
                                    <span class="pbmit-button-text">Book Consult</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Box Start Here -->
    @yield('hero')
</header>
