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

<footer class="site-footer footer-style-2 pbmit-bg-color-light">
    <div class="footer-wrap pbmit-footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <div class="pbmit-footer-logo">
                                @if ($footerLogo)
                                    <img src="{{ Storage::url($footerLogo) }}" alt="{{ $brandName }}">
                                @endif
                            </div>
                        </div>
                    </aside>
                    <aside class="widget">
                        <div class="pbmit-contact-widget-lines">
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-address">{{ $siteSettings->company_address ?? 'yourdemoaddress' }}</div>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-phone">{{ $siteSettings->company_phone ?? 'yourdemophone' }}</div>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-email">{{ $siteSettings->company_email ?? 'yourdemo@email.com' }}</div>
                        </div>
                    </aside>
                </div>
                <div class="col-md-6 col-xl-4">
                    <aside class="pbmit-two-column-menu widget">
                        <ul>
                            @if($footerMenu)
                                    @foreach($footerMenu->menuItems as $item)
                                        <li><a href="{{ $item->url }}">{{ $item->title }}</a></li>
                                    @endforeach
                            @endif
                        </ul>
                    </aside>
                </div>
                <div class="col-md-6 col-xl-4">
                    <aside class="pbmit-two-column-menu widget">
                        <ul>
                            @if($footerOthers)
                                @foreach($footerOthers->menuItems as $item)
                                    <li><a href="{{ $item->url }}">{{ $item->title }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="pbmit-footer-big-area">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-12 col-xl-6 pbmit-footer-left">
                    <form>
                        <div class="pbmit-newsletter">
                            <h3>Subscribe to Our Newsletter</h3>
                            <div class="pbmit-footer-email-button">
                                <input type="email" name="EMAIL" placeholder="Your email address">
                                <button class="pbmit-btn">
                                    <span class="pbmit-button-content-wrapper">
                                        <span class="pbmit-button-text">Subscribe</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 col-xl-6 pbmit-footer-right">
                    <div class="pbmit-footer-bg-image">
                        <img src="images/footer-mailchip-img.png" alt="">
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
                        <div class="pbmit-footer-social-area">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
