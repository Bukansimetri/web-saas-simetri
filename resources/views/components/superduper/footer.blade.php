@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;

    // 1. Branding Setup
    $brandLogo = $generalSettings->brand_logo ?? null;
    $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'Living Interior');
    $footerLogo = $siteSettings->footer_logo ?? $brandLogo;

    // 2. Menu Setup (Menyesuaikan dengan 1 kolom menu di HTML baru)
    $footerMenu = Menu::location('footer');

    // 3. Kontak Setup
    $address = $siteSettings->address ?? 'Gg. Sanan, Pd. Kacang Bar., Kec. Pd. Aren, Tangerang Selatan';
    $phone = $siteSettings->phone ?? '+62 821-3035-4599';
    $email = $siteSettings->company_email ?? 'livingsmeinterior@gmail.com';

    // 4. Social Links Setup
    $instagramUrl = $siteSocialSettings->instagram_url ?? 'https://www.instagram.com/living_interior.id/';
    $whatsappUrl = $siteSocialSettings->whatsapp_url ?? 'https://api.whatsapp.com/send?phone=6282130354599&text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20desain%20interior%20di%20Living%20Interiornya%0A%0ASaya%20ingin%20konsultasi%20untuk%20kebutuhan%20Design%20Interior.%20%0A%0ABoleh%20dibantu%20untuk%20informasi%20lebih%20lanjut%20dan%20estimasi%20biayanya%3F';
@endphp

<footer id="arck-footer" class="arck-footer-section" data-background="{{ asset('assets/img/bg/footer-bg.jpg') }}">
    <div class="arck-footer-widget-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="arck-footer-widget headline ul-li-block pera-content">
                        <div class="contact-cta-widget">
                            <h3 class="widget-title">Kontak Kami</h3>
                            <div class="contact-cta-item">
                                <ul>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $address }}</span>
                                    </li>
                                    <li>
                                        <i class="fal fa-phone-alt"></i>
                                        <span>{{ $phone }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="arck-footer-widget headline ul-li-block pera-content">
                        <div class="menu-widget">
                            <h3 class="widget-title">Informations</h3>
                            <ul>
                                @if($footerMenu)
                                    @foreach($footerMenu->menuItems as $item)
                                        <li>
                                            <a href="{{ $item->url }}" @if($item->target) target="{{ $item->target }}" @endif>
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('home') }}">Tentang Kami</a></li>
                                    <li><a href="#">Proyek</a></li>
                                    <li><a href="#">Kontak Kami</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="arck-footer-widget headline ul-li-block pera-content" style="padding-right: 20px;">
                        <a href="{{ route('home') }}" style="display: inline-block; margin-bottom: 20px;">
                            @if($footerLogo)
                                <img src="{{ Storage::url($footerLogo) }}" alt="{{ $brandName }}" style="max-height: 60px;">
                            @else
                                <img src="{{ asset('assets/img/logo/logoLV100.png') }}" alt="{{ $brandName }}" style="max-height: 60px;">
                            @endif
                        </a>
                        <p style="color: #ccc; line-height: 1.8;">
                            {{ $siteSettings->description ?? 'Wujudkan Interior Impian Anda Bersama Living Interior' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="arck-footer-widget headline ul-li-block pera-content">
                        <div class="newslatter-widget">
                            <h3 class="widget-title">Newsletter</h3>
                            <div class="newsleter-form">
                                <form action="#" method="POST">
                                    @csrf
                                    <input type="email" name="email" placeholder="Email" required>
                                    <button type="submit">Subscribe Now</button>
                                </form>
                            </div>
                            <div class="footer-social ul-li">
                                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center arck-footer-copyright">
        &copy; {{ date('Y') }} All rights reserved. <a href="{{ route('home') }}">{{ $brandName }}</a>
    </div>
</footer>
