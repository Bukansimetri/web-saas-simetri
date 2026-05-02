<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home - Living Interior</title>
	<meta name="description" content="Archix - Architecture and Interior Design HTML Template">
	<meta name="keywords" content="apartments, architect, architecture, building, clean, construction, creative, decoration, interior design, minimal, modern, portfolio, residence, studio">
	<meta name="author" content="Themexriver">
	<link rel="shortcut icon" href="{{ asset('assets/img/logo/ficon.png') }}" type="image/x-icon">
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/video.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/twenty.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18097172538"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-18097172538');
    </script>


    <!-- Event snippet for Outbound click conversion page
    In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
    function gtag_report_conversion(url) {
    var callback = function () {
        if (typeof(url) != 'undefined') {
        window.location = url;
        }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-18097172538/Zx6ICPDu658cELrgs7VD',
        'value': 1.0,
        'currency': 'IDR',
        'event_callback': callback
    });
    return false;
    }
    </script>

    <style>
        /* Styling untuk tombol utama WhatsApp */
        .whatsapp-float {
            width: 55px;
            height: 55px;
            /* Posisikan 90px dari bawah agar berada di atas tombol scroll up */
            bottom: 90px; 
            right: 20px;
            z-index: 5;
            position: fixed;
            line-height: 55px;
            background-color: #25D366; /* Warna hijau resmi WhatsApp */
            border-radius: 100%;
            color: #FFF !important; /* Memastikan icon berwarna putih */
            text-decoration: none;
            transition: 500ms; /* Efek transisi halus seperti tombol sebelumnya */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sedikit bayangan */
            display: block; /* Memastikan link berbentuk kotak/lingkaran penuh */
        }

        /* Mengatur ukuran dan posisi icon WhatsApp di dalam tombol */
        .whatsapp-float i {
            color: rgb(255, 255, 255);
            font-size: 30px; /* Ukuran icon agak diperbesar agar proporsional */
            line-height: 55px; /* Menyelaraskan icon secara vertikal di tengah */
        }

        /* Efek ketika tombol di-hover (disentuh mouse) */
        .whatsapp-float:hover {
            background-color: #128C7E; /* Hijau WhatsApp yang lebih gelap */
            color: #FFF;
        }
    </style>

</head>
<body>
	<div class="up">
		<a href="#" class="text-center scrollup"><i class="fas fa-chevron-up"></i></a>
	</div>

<!-- Start of slider section
	============================================= -->
	<section id="arck-slider-2" class="arck-slider-section-2">
		<div class="arck-main-slider-area-2 position-relative">
			<div class="arck-main-slider-area-2 position-relative">
				<div id="arck-slider-main_2" class="arck-main-slider-2">
					<div class="arck-main-slider-item-2 position-relative" style="padding-top: 100px !important; padding-bottom: 100px !important;">
						<div class="arck-slider-img-2 position-absolute">
							<img src="{{ asset('assets/img/slider/hero-lv-1.webp') }}" alt="">
						</div>
						<div class="slider-shape position-absolute">
							<img src="{{ asset('assets/img/slider/s-sh1.png') }}" alt="">
						</div>
						<div class="container">
							<div class="arck-slider-main-text headline pera-content">
								<div class="slider-sub-text text-uppercase">
									Jasa Interior Indonesia
								</div>
								<h1 style="font-size: 60px;">Udah Keluar Budget Puluhan Juta, Tapi Hasilnya Malah <span>ZONK?</span></h1>
								<p>Jangan biarkan impian ruanganmu hancur karena vendor abal-abal. Percayakan pada ahlinya.
                                    Kami wujudkan desain 3D menjadi kenyataan dengan presisi, tanpa biaya siluman, dan anti-ngaret!</p>
								<div class="arck-btn-2">
									<a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">
                                        Konsultasi Gratis
                                    </a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Slider section
	============================================= -->

<!-- Start of About section
	============================================= -->
	<section id="arck-about-2" class="arck-about-section-2 position-relative">
		<span class="about-shape-1 position-absolute"><img src="{{ asset('assets/img/about/ab-shape1.png') }}" alt=""></span>
		<div class="container">
			<div class="arck-about-content-2">
				<div class="row">
					<div class="col-lg-6 wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
						<div class="arck-about-img-wrap-2">
							<img src="{{ asset('assets/img/about/3.webp') }}" alt="">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="arck-about-text-wrap-2">
							<div class="arck-section-title-2 headline pera-content wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
								<span class="sub-title text-uppercase">TENTANG LIVING INTERIOR</span>
								<h2>Kami Paham Banget Rasanya Kecewa Sama Vendor...</h2>
								<p>
                                    Udah ngeluarin tabungan yang nggak sedikit, eh yang didapat malah sakit hati dan stres mikirin
                                    tukang yang molor, hasil beda jauh dari desain, dan material yang gampang ngelupas.
                                    Kamu nggak sendirian, banyak yang jadi korban vendor yang cuma jualan janji.
                                    Solusinya? Percayakan pada ahlinya.
                                </p>
							</div>
							<div class="about-signature-img d-flex wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
								<div class="inner-text headline position-relative">
									<h3>‘’Dari yang tadinya deg-degan ditagih biaya ini-itu, jadi tenang karena harga pas sesuai kesepakatan awal.’’ </h3>
								</div>
							</div>
							<div class="arck-btn-2 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
								<a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Konsultasi Sekarang</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of About section
	============================================= -->

<!-- Start of Counter section
	============================================= -->
	<section id="arck-counter" class="arck-counter-section">
		<div class="container">
			<div class="arck-counter-content">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="text-center arck-counter-inner-item headline pera-content position-relative">
							<h3><span class="counter">10</span>+</h3>
							<p>Tahun Pengalaman</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="text-center arck-counter-inner-item headline pera-content position-relative">
							<h3><span class="counter">100</span>+</h3>
							<p>Proyek Selesai</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="text-center arck-counter-inner-item headline pera-content position-relative">
							<h3><span class="counter">100</span>%</h3>
							<p>RAB Transparan</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="text-center arck-counter-inner-item headline pera-content position-relative">
							<h3><span>Live</span></h3>
							<p>Garansi Seumur Hidup</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Counter section
	============================================= -->

<!-- Start of Service section
	============================================= -->
	<section id="arck-service-2" class="arck-service-section-2" style="padding-top: 100px !important;">
		<div class="container">
			<div class="text-center arck-section-title-2 headline pera-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
				<span class="sub-title text-uppercase">FASILITAS VVIP</span>
				<h2>Pelayanan Spesial <span>Tanpa Biaya Tambahan</span> .</h2>
			</div>
			<div class="arck-service-content-2">
				<div class="row">
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic11.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Gratis Konsultasi</h3>
								<p>
                                    Diskusi kebutuhan interior setiap hari. Ceritain aja maumu gimana, kami bantu carikan solusi terbaiknya.
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic12.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Gratis Survey Lokasi</h3>
								<p>
                                    Tim ahli kami yang akan datang langsung ke lokasi untuk melakukan pengukuran dengan akurat.
								</p>
                            </div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic14.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Gratis Design 3D</a></h3>
								<p>
                                    Biar ada bayangan real sebelum dieksekusi! Kami buatkan visualisasi sampai kamu sreg.
								</p>
                            </div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1000ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic15.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>RAB Transparan</h3>
								<p>
                                    Nggak ada biaya siluman atau harga yang tiba-tiba bengkak di akhir. Semua jelas dari awal.
								</p>
                            </div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1200ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic16.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Tim Profesional</h3>
								<p>
                                    Dikerjakan langsung oleh tim tukang & desainer berpengalaman. Hasil presisi dan halus.
								</p>
                            </div>
						</div>
					</div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1200ms" data-wow-duration="1500ms">
						<div class="arck-service-item-2 position-relative">
							<span class="service-shape position-absolute"><img src="{{ asset('assets/img/shape/ser-icon1.png') }}" alt=""></span>
							<div class="inner-icon d-flex justify-content-center align-items-center position-relative">
								<img src="{{ asset('assets/icon/ic13.png') }}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Garansi Seumur Hidup</a></h3>
								<p>
                                    Engsel rusak? Rel macet? Kami ganti! Vendor mana lagi yang berani ngasih jaminan ini?
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Service section
	============================================= -->

<!-- Start of Project section
	============================================= -->
	<section id="arck-project-2" class="arck-project-section-2">
		<div class="container">
			<div class="arck-project-top-content d-flex justify-content-between align-items-center">
				<div class="arck-section-title headline pera-content">
					<h2>Hasil Proyek Nyata Kami</h2>
				</div>
				<div class="text-center arck-project-filter-btn ul-li">
					<div class="clearfix text-center button-group">
						<button class="filter-button is-checked" data-filter="*">All </button>
					</div>
				</div>
			</div>
		</div>
		<div class="arck-project-filter-content">
			<div class="grid clearfix filtr-container-area" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
				<div class="grid-sizer"></div>
				<div class="grid-item grid-size-50 interiors design" data-category="interiors design">
					<div class="arck-project-item-2 position-relative">
						<div class="inner-img">
							<img src="{{ asset('assets/img/project/IMG-20251029-WA0008.webp') }}" alt="">
						</div>
						<div class="inner-text headline pera-content">
							<h3>Kitchen Inspiration</a></h3>
							<span class="port-cate text-uppercase"> Architecture</a></span>
						</div>
					</div>
				</div>
                <div class="grid-item grid-size-25 house_exterior building" data-category="house_exterior building">
					<div class="arck-project-item-2 position-relative">
						<div class="inner-img">
							<img src="{{ asset('assets/img/project/IMG-20260123-WA0024.webp') }}" alt="">
						</div>
						<div class="inner-text headline pera-content">
							<h3>Kitchen Inspiration</a></h3>
							<span class="port-cate text-uppercase"> Architecture</a></span>
						</div>
					</div>
				</div>
				<div class="grid-item grid-size-25 house_exterior design" data-category="house_exterior design">
					<div class="arck-project-item-2 position-relative">
						<div class="inner-img">
							<img src="{{ asset('assets/img/project/IMG-20251029-WA0009.webp') }}" alt="">
						</div>
						<div class="inner-text headline pera-content">
							<h3>Kitchen Inspiration</a></h3>
							<span class="port-cate text-uppercase"> Architecture</a></span>
						</div>
					</div>
				</div>
				<div class="grid-item grid-size-25 building design" data-category="building design">
					<div class="arck-project-item-2 position-relative">
						<div class="inner-img">
							<img src="{{ asset('assets/img/project/IMG-20251102-WA0025.webp') }}" alt="">
						</div>
						<div class="inner-text headline pera-content">
							<h3>Kitchen Inspiration</a></h3>
							<span class="port-cate text-uppercase"> Architecture</a></span>
						</div>
					</div>
				</div>
				<div class="grid-item grid-size-25 house_exterior building" data-category="interiors design">
					<div class="arck-project-item-2 position-relative">
						<div class="inner-img">
							<img src="{{ asset('assets/img/project/IMG-20260123-WA0036.webp') }}" alt="">
						</div>
						<div class="inner-text headline pera-content">
							<h3>Kitchen Inspiration</a></h3>
							<span class="port-cate text-uppercase"> Architecture</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Project section
	============================================= -->

<!-- Start of Working Skill section
	============================================= -->
	<section id="arck-working-skill" class="arck-working-skill-section">
		<div class="container">
			<div class="arck-working-skill-content">
				<div class="row">
					<div class="col-lg-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
						<div class="arck-working-skill-text-wrap">
							<div class="arck-section-title-2 headline pera-content">
								<span class="sub-title text-uppercase">STANDAR KUALITAS</span>
								<h2>Mengapa Hasil Kami <span>Lebih Awet</span> dan  <span>Presisi?</span></h2>
								<p>
                                    Kami tidak mau kompromi soal kualitas. Kami menggunakan material grade A dan
                                    finishing tingkat tinggi yang dikerjakan dengan pengawasan ketat, memastikan setiap
                                    sudut ruangan Anda sempurna.
                                </p>
							</div>
							<div class="arck-skill-progress-bar">
								<div class="arck-skill-progress-bar">
									<div class="skill-set-percent headline">
										<h4>Ketepatan Waktu Pengerjaan</h4>
										<div class="progress">
											<div class="progress-bar" data-percent="98"></div>
										</div>
									</div>
									<div class="skill-set-percent headline">
										<h4>Kepresisian Hasil vs Desain 3D</h4>
										<div class="progress">
											<div class="progress-bar" data-percent="99"></div>
										</div>
									</div>
									<div class="skill-set-percent headline">
										<h4>Kepuasan Klien Kami</h4>
										<div class="progress">
											<div class="progress-bar" data-percent="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms" data-wow-duration="1500ms">
						<div class="arck-working-skill-img">
							<img src="{{ asset('assets/img/about/4.webp') }}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Working Skill section
	============================================= -->

<!-- Start of Pricing section
	============================================= -->
	<section id="arck-pricing" class="arck-pricing-section" data-background="{{ asset('assets/img/bg/pr-bg.jpg') }}">
		<div class="container">
			<div class="text-center arck-section-title-2 headline pera-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
				<span class="sub-title text-uppercase">Pilihan Paket</span>
				<h2>Sesuaikan Dengan <span>Budget</span> & <span>Kebutuhanmu.</span></h2>
			</div>
			<div class="arck-pricing-content">
				<div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="text-center arck-pricing-item">
                            <div class="inner-title headline pera-content">
                                <h3>BRONZE</h3>
                                <div class="inner-price">
                                    <h4><sup>Rp</sup> 2 JT</h4>
                                    <span>Per Meter</span>
                                </div>
                            </div>
                            <div class="inner-feature-list ul-li-block">
                                <ul>
                                    <li>Blokmelamin 18 mm</li>
                                    <li>Engsel slowmotion ex Taco</li>
                                    <li>Rell doubletrack standard</li>
                                    <li>Rak piring atas/bawah standard</li>
                                    <li>Rak sendok standard</li>
                                    <li>Edging ex Taco</li>
                                    <li>Finishing HPL ex Taco</li>
                                    <li>Lampu LED dotless</li>
                                </ul>
                            </div>
                            <div class="arck-btn-2 d-flex justify-content-center">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Pilih Paket</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                        <div class="text-center arck-pricing-item">
                            <div class="inner-title headline pera-content">
                                <h3>SILVER</h3>
                                <div class="inner-price">
                                    <h4><sup>Rp</sup> 2.3 JT</h4>
                                    <span>Per Meter</span>
                                </div>
                            </div>
                            <div class="inner-feature-list ul-li-block">
                                <ul>
                                    <li>Plywood 18 mm</li>
                                    <li>Engsel slowmotion ex Taco</li>
                                    <li>Rell doubletrack slowmotion</li>
                                    <li>Rak piring atas/bawah stainless</li>
                                    <li>Rak sendok standard</li>
                                    <li>Edging ex Taco</li>
                                    <li>Finishing HPL ex Taco</li>
                                    <li>Lampu LED dotless</li>
                                </ul>
                            </div>
                            <div class="arck-btn-2 d-flex justify-content-center">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Pilih Paket</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="text-center arck-pricing-item">
                            <div class="inner-title headline pera-content">
                                <h3>GOLD</h3>
                                <div class="inner-price">
                                    <h4><sup>Rp</sup> 2.7 JT</h4>
                                    <span>Per Meter</span>
                                </div>
                            </div>
                            <div class="inner-feature-list ul-li-block">
                                <ul>
                                    <li>Plywood 18 mm</li>
                                    <li>Engsel slowmotion ex Taco</li>
                                    <li>Rell doubletrack slowmotion</li>
                                    <li>Rak piring atas/bawah stainless</li>
                                    <li>Rak sendok custom ex Ikea</li>
                                    <li>Edging ex Taco</li>
                                    <li>Finishing HPL ex Taco</li>
                                    <li>Finisihing kabinet dalam Tacosheet</li>
                                    <li>Lampu LED dotless</li>
                                </ul>
                            </div>
                            <div class="arck-btn-2 d-flex justify-content-center">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Pilih Paket</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1500ms">
                        <div class="text-center arck-pricing-item">
                            <div class="inner-title headline pera-content">
                                <h3>TITANIUM</h3>
                                <div class="inner-price">
                                    <h4><sup>Rp</sup> 3.2 JT</h4>
                                    <span>Per Meter</span>
                                </div>
                            </div>
                            <div class="inner-feature-list ul-li-block">
                                <ul>
                                    <li>PVC Board 18 mm ex Taco</li>
                                    <li>Engsel slowmotion ex Taco</li>
                                    <li>Rell doubletrack slowmotion</li>
                                    <li>Rak piring atas/bawah stainless</li>
                                    <li>Rak sendok custom ex Ikea</li>
                                    <li>Edging ex Taco</li>
                                    <li>Finishing HPL ex Taco</li>
                                    <li>Lampu LED dotless</li>
                                </ul>
                            </div>
                            <div class="arck-btn-2 d-flex justify-content-center">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Pilih Paket</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1000ms" data-wow-duration="1500ms">
                        <div class="text-center arck-pricing-item">
                            <div class="inner-title headline pera-content">
                                <h3>PLATINUM</h3>
                                <div class="inner-price">
                                    <h4><sup>Rp</sup> 3.5 JT</h4>
                                    <span>Per Meter</span>
                                </div>
                            </div>
                            <div class="inner-feature-list ul-li-block">
                                <ul>
                                    <li>Plywood 18 mm</li>
                                    <li>Engsel slowmotion ex Taco</li>
                                    <li>Rell doubletrack slowmotion</li>
                                    <li>Rak piring atas/bawah stainless</li>
                                    <li>Rak sendok custome ex Ikea</li>
                                    <li>Finishing Cat Duco ex Propan</li>
                                    <li>Lampu LED dotless</li>
                                </ul>
                            </div>
                            <div class="arck-btn-2 d-flex justify-content-center">
                                <a class="d-flex justify-content-center align-items-center text-uppercase" href="https://api.whatsapp.com/send/?phone=6282130354599&text&type=phone_number&app_absent=0&utm_source=ig">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Pricing section
	============================================= -->

<!-- Start of Service Details section
	============================================= -->
	{{-- <section id="arck-service-details" class="arck-service-details-section inner-page-padding">
		<div class="container">
			<div class="arck-service-details-testimonial-slider">
                <div class="arck-section-title headline pera-content">
                    <span class="sub-title text-uppercase">Client Review</span>
                    <h2>What Our Client Say</h2>
                </div>
                <div class="arck-testimonial-slider-2">
                    <div class="service-testimonial-item">
                        <div class="arck-teestimonial-item-2">
                            <div class="inner-text position-relative">
                                <i class="fas fa-quote-left"></i> Rorem Ipsum is simply dummy text of the printing and typesetting industry. dummy text ever since the 1500s throughout the duration of your project the of your renovation
                            </div>
                            <div class="inner-author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/img/about/tst1.jpg') }}" alt="">
                                </div>
                                <div class="author-text headline">
                                    <h3>Thone De Smith </h3>
                                    <span>House Owner</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-testimonial-item">
                        <div class="arck-teestimonial-item-2">
                            <div class="inner-text position-relative">
                                <i class="fas fa-quote-left"></i> Rorem Ipsum is simply dummy text of the printing and typesetting industry. dummy text ever since the 1500s throughout the duration of your project the of your renovation
                            </div>
                            <div class="inner-author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/img/about/tst1.jpg') }}" alt="">
                                </div>
                                <div class="author-text headline">
                                    <h3>Thone De Smith </h3>
                                    <span>House Owner</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-testimonial-item">
                        <div class="arck-teestimonial-item-2">
                            <div class="inner-text position-relative">
                                <i class="fas fa-quote-left"></i> Rorem Ipsum is simply dummy text of the printing and typesetting industry. dummy text ever since the 1500s throughout the duration of your project the of your renovation
                            </div>
                            <div class="inner-author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/img/about/tst1.jpg') }}" alt="">
                                </div>
                                <div class="author-text headline">
                                    <h3>Thone De Smith </h3>
                                    <span>House Owner</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-testimonial-item">
                        <div class="arck-teestimonial-item-2">
                            <div class="inner-text position-relative">
                                <i class="fas fa-quote-left"></i> Rorem Ipsum is simply dummy text of the printing and typesetting industry. dummy text ever since the 1500s throughout the duration of your project the of your renovation
                            </div>
                            <div class="inner-author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/img/about/tst1.jpg') }}" alt="">
                                </div>
                                <div class="author-text headline">
                                    <h3>Thone De Smith </h3>
                                    <span>House Owner</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section> --}}
<!-- End of Service Details section
	============================================= -->

<!-- Start of Sponsor section
	============================================= -->
	<section id="arck-sponsor" class="arck-sponsor-section">
		<div class="container">
			<div class="arck-sponsor-slider">
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/5.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/6.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/7.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/8.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/9.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/10.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/11.webp') }}" alt="">
				</div>
				<div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/12.webp') }}" alt="">
				</div>
                <div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/13.webp') }}" alt="">
				</div>
                <div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/14.webp') }}" alt="">
				</div>
                <div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/15.webp') }}" alt="">
				</div>
                <div class="arck-sponsor-slider-item">
					<img src="{{ asset('assets/img/sponsor/16.webp') }}" alt="">
				</div>
			</div>
		</div>
	</section>
<!-- End of Sponsor section
	============================================= -->

<!-- Start of Footer section
	============================================= -->
	<footer id="arck-footer" class="arck-footer-section" data-background="{{ asset('assets/img/bg/footer-bg.jpg') }}">
		<div class="text-center arck-footer-copyright">
			©2026 All rights reserved. Developed by <a href="#">Simetri Space</a>
		</div>

	</footer>
<!-- End of Footer section
	============================================= -->

    <div class="whatsapp-btn">
        <a href="https://api.whatsapp.com/send?phone=6282130354599&text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20desain%20interior%20di%20Living%20Interiornya%0A%0ASaya%20ingin%20konsultasi%20untuk%20kebutuhan%20Design%20Interior.%20%0A%0ABoleh%20dibantu%20untuk%20informasi%20lebih%20lanjut%20dan%20estimasi%20biayanya%3F" class="text-center whatsapp-float" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

	<!-- For Js Library -->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets/js/appear.js') }}"></script>
	<script src="{{ asset('assets/js/slick.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
	<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.filterizr.js') }}"></script>
	<script src="{{ asset('assets/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/js/twenty.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.inputarrow.js') }}"></script>
	<script src="{{ asset('assets/js/script.js') }}"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18097172538"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-18097172538');
    </script>

    <!-- Event snippet for Outbound click conversion page
    In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
        function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
            window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-18097172538/Zx6ICPDu658cELrgs7VD',
            'value': 1.0,
            'currency': 'IDR',
            'event_callback': callback
        });
        return false;
        }
    </script>
</body>
</html>
