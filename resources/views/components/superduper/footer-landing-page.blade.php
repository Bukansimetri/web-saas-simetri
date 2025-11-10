<!-- footer -->
@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $footerMenu = Menu::location('footer');
    $footerOthers = Menu::location('footer-2');

    $brandLogo = $generalSettings->brand_logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'Simetri');
    $footerLogo = $siteSettings->footer_logo ?? $brandLogo;

    $socialLinks = [
        'facebook' => $siteSocialSettings->facebook_url ?? null,
        'twitter' => $siteSocialSettings->twitter_url ?? null,
        'instagram' => $siteSocialSettings->instagram_url ?? null,
        'linkedin' => $siteSocialSettings->linkedin_url ?? null,
        'youtube' => $siteSocialSettings->youtube_url ?? null,
        'tiktok' => $siteSocialSettings->tiktok_url ?? null,
    ];

    $licClass = [
        'facebook' => 'pbmit-social-li pbmit-social-facebook',
        'twitter' => 'pbmit-social-li pbmit-social-twitter',
        'instagram' => 'pbmit-social-li pbmit-social-instagram',
        'linkedin' => 'pbmit-social-li pbmit-social-linkedin',
        'youtube' => 'youtube',
        'tiktok' => 'tiktok',
    ];

    $faIcons = [
        'twitter' => 'pbmit-base-icon-twitter-2',
        'facebook' => 'pbmit-base-icon-facebook-f',
        'instagram' => 'pbmit-base-icon-instagram',
        'linkedin' => 'pbmit-base-icon-linkedin-in',
        'youtube' => 'fa-brands fa-youtube',
        'tiktok' => 'fa-brands fa-tiktok',
    ];

@endphp

<footer class="site-footer footer-style-3 pbmit-bg-color-secondary">
    <div class="pbmit-footer-big-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xl-4">
                    <div class="pbmit-footer-logo">
                        @if ($footerLogo)
                            <img src="{{ Storage::url($footerLogo) }}" alt="{{ $brandName }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-12 col-xl-8">
                    <form>
                        <div class="pbmit-newsletter">
                            <h3>Subscribe to Our Newsletter</h3>
                            <div class="pbmit-footer-email-button">
                                <input type="email" class="form-control" name="EMAIL" placeholder="Enter Your Email Address">
                                <button class="pbmit-btn">
                                    <span class="pbmit-button-content-wrapper">
                                        <span class="pbmit-button-text">Subscribe Now</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pbmit-footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <ul class="pbmit-social-links">
                                @foreach($socialLinks as $platform => $url)
                                    @if($url)
                                        <li class="{{ $licClass[$platform] }}">
                                            <a title="{{ ucfirst($platform) }}" href="{{ $url }}" target="_blank">
                                                <span><i class="{{ $faIcons[$platform] }}"></i></span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                @if(empty(array_filter($socialLinks)))
                                    <li class="pbmit-social-li pbmit-social-facebook">
                                        <a title="Facebook" href="https://facebook.com" target="_blank">
                                            <span><i class="pbmit-base-icon-facebook-f"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-twitter">
                                        <a title="Twitter" href="https://twitter.com" target="_blank">
                                            <span><i class="pbmit-base-icon-twitter-2"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-linkedin">
                                        <a title="LinkedIn" href="https://linkedin.com" target="_blank">
                                            <span><i class="pbmit-base-icon-linkedin-in"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-instagram">
                                        <a title="Instagram" href="https://instagram.com" target="_blank">
                                            <span><i class="pbmit-base-icon-instagram"></i></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-md-4">
                    <aside class="widget pbmit-two-column-menu">
                        <h2 class="widget-title">Useful Link</h2>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('home') }}">Pricing</a></li>
                            <li><a href="{{ route('about-us') }}">About</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-4">
                    <div class="widget widget_text">
                        <h2 class="widget-title">Working Time</h2>
                        <div class="pbmit-timelist-wrapper">
                            <ul class="pbmit-timelist-list">
                                <li>
                                    <span class="pbmit-timelist-time">Mon - Fri: 9.00am - 5.00pm</span>
                                </li>
                                <li>
                                    <span class="pbmit-timelist-time">Saturday: 10.00am - 6.00pm</span>
                                </li>
                                <li>
                                    <span class="pbmit-timelist-time">Sunday Closed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pbmit-footer-text-area">
        <div class="container">
            <div class="pbmit-footer-text-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pbmit-footer-copyright-text-area"> Copyright © {{ date('Y') }} <a href="{{ route('home') }}">{{ $siteSettings->company_name }} - {{ $generalSettings->brand_name }}</a>, {{ $siteSettings->copyright_text ?? 'All Rights Reserved.' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="pbmit-footer-menu-area">
                            <div class="menu-footer-menu-container">
                                <ul class="pbmit-footer-menu">
                                    <li><a href="{{ route('coming-soon') }}">Terms and conditions</a></li>
                                    <li><a href="{{ route('coming-soon') }}">Privacy policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer End -->
