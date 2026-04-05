@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;

    // 1. Branding Setup
    $brandLogo = $generalSettings->brand_logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'Living Interior');
    $footerLogo = $siteSettings->footer_logo ?? $brandLogo;

    // 2. Menus Setup (Using the first two from your old code)
    $footerMenu1 = Menu::location('footer');
    $footerMenu2 = Menu::location('footer-2');

    // 3. Social Links Setup
    $socialLinks = [
        'facebook' => $siteSocialSettings->facebook_url ?? null,
        'twitter' => $siteSocialSettings->twitter_url ?? null,
        'instagram' => $siteSocialSettings->instagram_url ?? null,
        'linkedin' => $siteSocialSettings->linkedin_url ?? null,
        'youtube' => $siteSocialSettings->youtube_url ?? null,
        'tiktok' => $siteSocialSettings->tiktok_url ?? null,
    ];

    // FontAwesome 5 classes to match your new HTML template
    $faIcons = [
        'facebook' => 'fab fa-facebook-f',
        'twitter' => 'fab fa-twitter',
        'instagram' => 'fab fa-instagram',
        'linkedin' => 'fab fa-linkedin-in',
        'youtube' => 'fab fa-youtube',
        'tiktok' => 'fab fa-tiktok',
    ];
@endphp

<footer id="archx-footer" class="archx-footer-section position-relative" data-background="{{ asset('assets/img/bg/ar-ft-bg.png') }}">

    <span class="archx-footer-mail position-absolute">{{ $siteSettings->company_email ?? 'livingsmeinterior@gmail.com' }}</span>
    <span class="archx-footer-address position-absolute">Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren</span>

    <div class="container">
        <div class="archx-footer-content">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="archx-footer-widget headline-2">
                        <div class="logo-widget">
                            <div class="brand-logo">
                                <a href="{{ route('home') }}">
                                    @if($footerLogo)
                                        <img src="{{ Storage::url($footerLogo) }}" alt="{{ $brandName }}" style="max-height: 80px;">
                                    @else
                                        <span style="font-size: 1.5rem; font-weight: bold; color: #fff;">{{ $brandName }}</span>
                                    @endif
                                </a>
                            </div>
                            <div class="logo-text">
                                {{ $siteSettings->description ?? 'Lebih dari 10 tahun pengalaman dalam desain interior dan pembuatan furniture custom, Living Interior telah dipercaya menangani berbagai proyek hunian dan komersial seperti rumah, kantor, apartemen, kafe, dan klinik.' }}
                            </div>
                            <div class="logo-cta-info ul-li-block">
                                <ul>
                                    <li><i class="fal fa-map-marker-alt"></i> Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren</li>
                                    <li><i class="fas fa-phone-alt"></i> +62 821-3035-4599</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="archx-footer-widget headline-2">
                        <div class="menu-widget ul-li-block">
                            <h3 class="widget-title">Marketplace</h3>
                            <ul>
                                @if($footerMenu1)
                                    @foreach($footerMenu1->menuItems as $item)
                                        <li>
                                            <a href="{{ $item->url }}" @if($item->target) target="{{ $item->target }}" @endif>
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="archx-footer-widget headline-2">
                        <div class="menu-widget ul-li-block">
                            <h3 class="widget-title">My Account</h3>
                            <ul>
                                @if($footerMenu2)
                                    @foreach($footerMenu2->menuItems as $item)
                                        <li>
                                            <a href="{{ $item->url }}" @if($item->target) target="{{ $item->target }}" @endif>
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="archx-footer-widget headline-2">
                        <div class="award-widget">
                            <h3 class="widget-title">Our Information</h3>
                            <div class="total-award d-flex align-items-center">
                                <span class="aw-title">Total Awards</span>
                                <span class="aw-number">X8</span>
                            </div>
                            <div class="aw-instagram-wrap ul-li">
                                <ul>
                                    <li><a href="#"><img src="{{ asset('assets/img/gallery/ins1.jpg') }}" alt=""> <i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><img src="{{ asset('assets/img/gallery/ins2.jpg') }}" alt=""> <i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="aw-btn-wrap position-relative">
                                <img src="{{ asset('assets/icon/fr1.png') }}" alt="">We provide fast on-demand <span>printing.</span>
                                <span class="aw-line position-absolute"><img src="{{ asset('assets/icon/line1.png') }}" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="archx-footer-copyright d-flex justify-content-between align-items-center">
            <div class="archx-footer-copyright-text">
                Copyright © <a href="{{ route('home') }}"> {{ date('Y') }} </a> by {{ $generalSettings->brand_name ?? config('app.name', 'Living Interior') }}. {{ $siteSettings->copyright_text ?? 'All Rights Reserved.' }}
            </div>
            <div class="archx-footer-copyright-social ul-li">
                <ul>
                    @php $hasSocials = false; @endphp

                    @foreach($socialLinks as $platform => $url)
                        @if(!empty($url))
                            @php $hasSocials = true; @endphp
                            <li>
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($platform) }}">
                                    <i class="{{ $faIcons[$platform] ?? 'fab fa-'.$platform }}"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @if(!$hasSocials)
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>
