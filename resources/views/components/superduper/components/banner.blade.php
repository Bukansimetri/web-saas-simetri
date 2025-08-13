@php
    $heroBanners = \App\Models\Banner\Content::whereHas('category', function($query) {
            $query->where('slug', 'home-banner');
        })
        ->active()
        ->orderBy('sort')
        ->with(['media'])
        ->take(5)
        ->get();
@endphp

<!-- ======================== Offer Banner Start ==================== -->
<section class="pt-4 offer-banner-wrap gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel banner-offers owl-theme">
                    @if($heroBanners->isNotEmpty())
                        @foreach($heroBanners as $banner)
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="{{ $banner->getImageUrl('large') ?? 'https://placehold.co/626x417' }}" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <div class="offer_title">{{ $banner->title }}</div>
                                            <span>{!! nl2br(e($banner->description)) !!}</span>
                                        </div>
                                        <a href="{{ $banner->click_url }}" target="{{ $banner->click_url_target ?? '_self' }}" class="btn offer_box_btn">{{ $banner->options['button_text'] ?? 'Explore Now' }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="ht-25"></div>
</section>
<div class="clearfix"></div>
<!-- ======================== Offer Banner End ==================== -->
