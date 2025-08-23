@php
    $socialLinks = [
        'facebook' => $siteSocialSettings->facebook_url ?? null,
        'twitter' => $siteSocialSettings->twitter_url ?? null,
        'instagram' => $siteSocialSettings->instagram_url ?? null,
        'linkedin' => $siteSocialSettings->linkedin_url ?? null,
        'youtube' => $siteSocialSettings->youtube_url ?? null,
        'tiktok' => $siteSocialSettings->tiktok_url ?? null,
    ];

    $productCategories = \App\Models\ProductCategory::where('is_active', true)
            ->orderBy('name')
            ->withCount('products')
            ->get();
@endphp
<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="before-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <div class="single_facts">
                        <div class="facts_icon">
                            <i class="ti-shopping-cart"></i>
                        </div>
                        <div class="facts_caption">
                            <h4>Delivered Anywhere in Indonesia</h4>
                            <p>Nationwide shipping with guaranteed delivery to every region.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="single_facts">
                        <div class="facts_icon">
                            <i class="ti-money"></i>
                        </div>
                        <div class="facts_caption">
                            <h4>Money Back Guaratee</h4>
                            <p>100% refund if you're not satisfied. No hassle, no questions asked.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="single_facts last">
                        <div class="facts_icon">
                            <i class="ti-headphone-alt"></i>
                        </div>
                        <div class="facts_caption">
                            <h4>24x7 Online Support</h4>
                            <p>Round-the-clock support via live chat, email, or phone. We're always here to help.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <div class="footer_widget">
                        <h4 class="extream">Contact us</h4>
                        <p>Let's here all about it! <a href="#" class="theme-cl">Get it touch</a></p>

                        <div class="address_infos">
                            <ul>
                                <li><i class="ti-home theme-cl"></i>{{ $siteSettings->company_address }}</li>
                                <li><i class="ti-email theme-cl"></i>{{ $siteSettings->company_email }}</li>
                                <li><i class="ti-headphone-alt theme-cl"></i>{{ $siteSettings->company_phone }}</li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer_widget">

                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer_widget">
                        <h4 class="widget_title">Our Company</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer_widget">
                        <h4 class="widget_title">Latest News</h4>
                        <ul class="footer-menu">
                            <li><a href="#">Offers & Deals</a></li>
                            <li><a href="#">New Product</a></li>
                            <li><a href="{{ route('blog') }}">New Article</a></li>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer_widget">
                        <h4 class="widget_title">Customer Support</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('blog') }}">Article</a></li>
                            <li><a href="{{ route('tnc') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-8">
                    <p class="mb-0">Copyright {{ $siteSettings->copyright_text ?? 'All Rights Reserved' }}</p>
                </div>

                <div class="text-right col-lg-6 col-md-6">
                    <ul class="footer_social_links">
                        @foreach($socialLinks as $platform => $url)
                            @if($url)
                                <li>
                                    <a href="{{ $url }}" target="_blank">
                                        <i class="ti-{{ $platform }}"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->

<!-- Left Collapse navigation -->
<div class="w3-ch-sideBar-left w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="leftMenu">
    <div class="rightMenu-scroll">
        <div class="flixel">
            <h4 class="cart_heading">Navigation</h4>
            <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
        </div>

        <div class="right-ch-sideBar">

            <div class="side_navigation_collapse">
                <div class="d-navigation">
                    <ul id="side-menu">
                        @foreach ($productCategories as $category)
                            <li>
                                {{-- <a href="{{ route('shop.category', $category->slug) }}"> --}}
                                <a href="#">
                                    <span>{{ $category->name }}</span>
                                    @if($category->products_count > 0)
                                        <span class="badge badge-secondary">{{ $category->products_count }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                        @if($productCategories->isEmpty())
                            <li class="text-center">No categories found</li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Left Collapse navigation -->
