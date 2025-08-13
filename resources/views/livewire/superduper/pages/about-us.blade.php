<div x-data="{}" x-init="">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-superduper.components.breadcrumb title="About Us" />

    <!-- =========================== About Us =================================== -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <h2>{{ $content->title }}</h2>
                    <p>
                        {{ $content->subtitle }}
                    </p>
                    <a href="{{ route('contact-us') }}" class="mt-2 btn btn-theme">{{ $content->button_text }}</a>
                </div>

                <div class="ml-auto col-lg-6 col-md-6 col-sm-12">
                    <div class="about_video">
                        <div class="thumb">
                            <img class="pro_img img-fluid w100" src="{{ $content->background_image ?? 'https://via.placeholder.com/626x417'}}" alt="{{$content->title}}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- =========================== About Us =================================== -->

    <!-- =========================== About Us =================================== -->
    <section class="image-bg" style="background:url(https://via.placeholder.com/1920x820) no-repeat;" data-overlay="5">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-5 col-md-6 col-sm-12">
                    <h2>Meet Our <span class="theme-cl">Brands</span></h2>
                </div>

                <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="row">

                        @foreach ($partners as $partner)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="mt-3 mb-3 partner-logo">
                                    <img src="{{ $partner->getImageUrl('thumbnail') }}" class="ml-auto img-fluid" alt="" />
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- =========================== About Us =================================== -->

    <!-- =========================== About Us =================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="sec-heading-flex">
                        <div class="sec-heading">
                            <h2>Meet <span class="theme-cl">our Team</span></h2>
                            <p>In a free hour, when our power of choice is untrammelled and when nothing prevents our being able</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="team_styles owl-carousel owl-theme products-slider " id="team-carousel">
                        @foreach ($teams as $team)
                            <!-- single testimonial -->
                            <div class="single_testi_box">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="single_teams_thumb">
                                            <img src="{{ $team->getImageUrl('medium') }}" class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="single_teams_wraps">
                                            <div class="single_team_caption">
                                                <p class="teams_description">{{ $team->bio }}</p>
                                                <div class="review_author_box">
                                                    <div class="reviews_caption">
                                                        <h4 class="testi2_title">{{ $team->name }}</h4>
                                                        <span>{{ $team->position }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- single testimonial -->
                        <div class="single_testi_box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="single_teams_thumb">
                                        <img src="https://via.placeholder.com/500x500" class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="single_teams_wraps">
                                        <div class="single_team_caption">
                                            <p class="teams_description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                            <div class="review_author_box">
                                                <div class="reviews_caption">
                                                    <h4 class="testi2_title">Mrs. Rani Shah Gupta</h4>
                                                    <span>Business Executive</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- single testimonial -->
                        <div class="single_testi_box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="single_teams_thumb">
                                        <img src="https://via.placeholder.com/500x500" class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="single_teams_wraps">
                                        <div class="single_team_caption">
                                            <p class="teams_description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                            <div class="review_author_box">
                                                <div class="reviews_caption">
                                                    <h4 class="testi2_title">Mr. yash Verma</h4>
                                                    <span>CEO & Founder</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- =========================== About Us =================================== -->

    <!-- =========================== About Us =================================== -->
    <section class="gray">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="sec-heading">
                        <div class="sec-heading center">
                            <h2>Our Loving <span class="theme-cl">Customers</span></h2>
                            <p>In a free hour, when our power of choice is untrammelled and when nothing prevents our.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="customers-carousel owl-carousel owl-theme products-slider " id="customers-carousel">
                        @foreach ($testimonials as $testimonial)
                            <!-- single testimonial -->
                            <div class="single_customers_box">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7 col-md-7">
                                        <div class="single_customers_wraps">
                                            <div class="single_customers_caption">
                                                <div class="quote_icon_2"><i class="fas fa-quote-right"></i></div>
                                                <p class="customers_description">
                                                    {{ $testimonial->content }}
                                                </p>
                                                <div class="review_author_box">
                                                    <div class="reviews_img">
                                                        <img src="{{ $testimonial->getImageUrl() }}" class="img-fluid" alt="" />
                                                    </div>
                                                    <div class="reviews_caption">
                                                        <h4 class="testi2_title">{{ $testimonial->author_name }}</h4>
                                                        <span>{{ $testimonial->author_company }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- =========================== About Us =================================== -->
</div>
