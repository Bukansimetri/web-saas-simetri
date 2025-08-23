@php
    $productCategories = \App\Models\ProductCategory::where('is_active', true)
        ->orderBy('name')
        ->withCount('products')
        ->get();

    $newProducts = \App\Models\Product::where('is_active', true)
        ->with(['media'])
        ->where('tag', 'new')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    $hotProducts = \App\Models\Product::where('is_active', true)
        ->with(['media'])
        ->where('tag', 'hot')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    $products = \App\Models\Product::where('is_active', true)
        ->with(['media'])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    $bodyBanner = \App\Models\Banner\Content::whereHas('category', function($query) {
            $query->where('slug', 'main-banner');
        })
        ->with(['media'])
        ->first();

@endphp
<x-superduper.main>

    <x-superduper.components.banner />

    <!-- ======================== Choose Category Start ==================== -->
    <section class="pt-0 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="owl-carousel category-slider owl-theme">
                        @forelse($productCategories as $productCategory)
                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="{{ url('/category/'.$productCategory->slug) }}">
                                            <img src="{{ $productCategory->getImageUrl('thumbnail') ?? 'https://placehold.co/180x180' }}" class="img-fluid" alt="{{ $productCategory->name }}" />
                                        </a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="{{ url('/category/'.$productCategory->slug) }}">{{ $productCategory->name }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Fallback categories jika tidak ada data -->
                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="#"><img src="https://via.placeholder.com/180x180" class="img-fluid" alt="Headphones" /></a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="#">Headphones</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="#"><img src="https://via.placeholder.com/180x180" class="img-fluid" alt="CCTV Camera" /></a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="#">CCTV Camera</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="#"><img src="https://via.placeholder.com/180x180" class="img-fluid" alt="Computers" /></a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="#">Computers</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="#"><img src="https://via.placeholder.com/180x180" class="img-fluid" alt="Mobile Phones" /></a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="#">Mobile Phones</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="#"><img src="https://via.placeholder.com/180x180" class="img-fluid" alt="Printer" /></a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4><a href="#">Printer</a></h4>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ======================== Choose Category End ==================== -->

    <!-- ======================== Fresh Vegetables Start ==================== -->
    <section class="pb-5 gray">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pl-2 pr-2 sec-heading-flex">
                        <div class="sec-heading-flex-one">
                            <h2>All Product</h2>
                        </div>
                        <div class="sec-heading-flex-last">
                            <a href="{{ route('products.index') }}" class="btn btn-theme">View More<i class="ml-2 ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel products-slider owl-theme">

                        @foreach ($products as $product)
                            <!-- Single Item -->
                            <div class="item">
                                <div class="woo_product_grid">
                                    <span class="woo_pr_tag {{ $product->tag }}">{{ ucfirst($product->tag) }}</span>
                                    <div class="woo_product_thumb">
                                        <img src="{{ $product->getImageUrl('thumbnail') }}" class="img-fluid" alt="{{ $product->name }}" />
                                    </div>
                                    <div class="woo_product_caption center">
                                        <div class="woo_title" style="margin-top: 5%">
                                            <h4 class="woo_pro_title">
                                                <a href="#">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="woo_price">
                                            <h6>Rp. {{ number_format($product->price, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="woo_product_cart hover">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#viewproduct-over"
                                                class="woo_cart_btn btn_cart"
                                                onclick="showProductModal({{ $product->id }})">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </li>
                                            <li><a href="{{ $product->url_grab_mart }}" class="woo_cart_btn btn_view"><i class="ti-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ======================== Fresh Vegetables End ==================== -->

    <!-- ======================== Fresh & Fast Fruits Start ==================== -->
    <section class="pt-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pl-2 pr-2 sec-heading-flex">
                        <div class="sec-heading-flex-one">
                            <h2>Hot Product</h2>
                        </div>
                        <div class="sec-heading-flex-last">
                            <a href="{{ url('/tag/hot') }}" class="btn btn-theme">View More<i class="ml-2 ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel products-slider owl-theme">

                        @foreach ($hotProducts as $hot)
                            <!-- Single Item -->
                            <div class="item">
                                <div class="woo_product_grid">
                                    <span class="woo_pr_tag {{ $hot->tag }}">{{ ucfirst($hot->tag) }}</span>
                                    <div class="woo_product_thumb">
                                        <img src="{{ $hot->getImageUrl('thumbnail') }}" class="img-fluid" alt="{{ $hot->name }}" />
                                    </div>
                                    <div class="woo_product_caption center">
                                        <div class="woo_title" style="margin-top: 5%">
                                            {{-- <h4 class="woo_pro_title"><a href="{{ route('product.detail', $hot->slug) }}">{{ $hot->name }}</a></h4> --}}
                                            <h4 class="woo_pro_title"><a href="#">{{ $hot->name }}</a></h4>
                                        </div>
                                        <div class="woo_price">
                                            <h6>Rp. {{ number_format($hot->price, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="woo_product_cart hover">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#viewproduct-over"
                                                class="woo_cart_btn btn_cart"
                                                onclick="showProductModal({{ $hot->id }})">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </li>
                                            <li><a href="{{ $hot->url_grab_mart }}" class="woo_cart_btn btn_view"><i class="ti-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ======================== Fresh & Fast Fruits End ==================== -->

    <!-- ======================== Fresh Vegetables & Fruits Start ==================== -->
    <section class="pt-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pl-2 pr-2 sec-heading-flex">
                        <div class="sec-heading-flex-one">
                            <h2>Added New Products</h2>
                        </div>
                        <div class="sec-heading-flex-last">
                            <a href="{{ url('/tag/new') }}" class="btn btn-theme">View More<i class="ml-2 ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel products-slider owl-theme">

                        @foreach ($newProducts as $new)
                            <!-- Single Item -->
                            <div class="item">
                                <div class="woo_product_grid">
                                    <span class="woo_pr_tag {{ $new->tag }}">{{ ucfirst($new->tag) }}</span>
                                    <div class="woo_product_thumb">
                                        <img src="{{ $new->getImageUrl('thumbnail') }}" class="img-fluid" alt="{{ $new->name }}" />
                                    </div>
                                    <div class="woo_product_caption center">
                                        <div class="woo_title" style="margin-top: 5%">
                                            {{-- <h4 class="woo_pro_title"><a href="{{ route('product.detail', $new->slug) }}">{{ $new->name }}</a></h4> --}}
                                            <h4 class="woo_pro_title"><a href="#">{{ $new->name }}</a></h4>
                                        </div>
                                        <div class="woo_price">
                                            <h6>Rp. {{ number_format($new->price, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="woo_product_cart hover">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#viewproduct-over"
                                                class="woo_cart_btn btn_cart"
                                                onclick="showProductModal({{ $new->id }})">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </li>
                                            <li><a href="{{ $new->url_grab_mart }}" class="woo_cart_btn btn_view"><i class="ti-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ======================== Fresh Vegetables & Fruits End ==================== -->

    <!-- Product View Modal -->
    <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="view-product-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="sp-wrap">
                                <img id="modal-product-image" src="" class="rounded img-fluid" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="woo_pr_detail">
                                <div class="woo_cats_wrps">
                                    <a href="#" class="woo_pr_cats" id="modal-product-category"></a>
                                    @if($product->discount_percentage ?? false)
                                        <span class="woo_pr_trending">Save {{ $product->discount_percentage }}%</span>
                                    @endif
                                </div>
                                <h2 class="woo_pr_title" id="modal-product-name"></h2>

                                <div class="woo_pr_reviews"></div>

                                <div class="woo_pr_price">
                                    <div class="woo_pr_offer_price">
                                        <h3 id="modal-product-price"></h3>
                                        <span class="org_price" id="modal-product-old-price"></span>
                                    </div>
                                </div>

                                <div class="woo_pr_short_desc">
                                    <p id="modal-product-description"></p>
                                </div>

                                <!-- Add any other product details you want to display -->

                                <div class="woo_btn_action">
                                    <div class="col-12 col-lg-auto">
                                        <a type="button" class="mb-2 btn btn-block btn-dark" href="{{ $product->url_grab_mart }}">
                                            Add to Cart <i class="ml-2 ti-shopping-cart-full"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Age Verification Modal -->
    <div id="age-verification-modal" class="age-verification-modal">
        <div class="text-center age-verification-content">
            <!-- Icon / Logo -->
            <img src="https://img.icons8.com/color/96/beer.png" alt="cheers" class="mb-4" />

            <h2 class="mb-3" style="color:#fff;">Selamat Datang di <span style="color:#016725;">Minum24</span></h2>
            <p class="mb-4" style="color:#ddd;">
                Website ini hanya untuk pengunjung berusia <b>21 tahun ke atas</b>.<br>
                Apakah Anda sudah berusia 21+?
            </p>

            <!-- Buttons -->
            <div class="gap-3 d-flex justify-content-center">
                <button id="btn-yes" class="btn btn-yes">Ya, Saya 21+</button>
                <button id="btn-no" class="btn btn-no">Belum</button>
            </div>
        </div>
    </div>

    <style>
    /* Fullscreen modal */
    .age-verification-modal {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5000;
        background: rgba(0, 0, 0, 0.562); /* Gelap transparan */
    }

    /* Konten modal */
    .age-verification-content {
        background: rgba(30, 30, 30, 0.921);
        padding: 40px;
        border-radius: 15px;
        max-width: 500px;
        color: #fff;
        border: 2px solid #016725;
    }

    /* Tombol */
    .btn {
        padding: 12px 24px;
        margin: 0 10px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        border: none;
    }

    .btn-yes {
        background: #016725;
        color: #fff;
    }
    .btn-yes:hover {
        background: #014f1b;
    }

    .btn-no {
        background: #dc311c;
        color: #fff;
    }
    .btn-no:hover {
        background: #b92715;
    }
    </style>

    <script>
    // Cek jika sudah pernah validasi
    if(localStorage.getItem("age_verified") === "true"){
        document.getElementById("age-verification-modal").style.display = "none";
    }

    // Event tombol
    document.getElementById("btn-yes").addEventListener("click", function(){
        localStorage.setItem("age_verified", "true");
        document.getElementById("age-verification-modal").style.display = "none";
    });

    document.getElementById("btn-no").addEventListener("click", function(){
        window.location.href = "/errorpage"; // redirect ke 404
    });
    </script>


    <script>
        function showProductModal(productId) {
            // Construct the API URL using Laravel's URL helper
            const apiUrl = `{{ url('/api/products') }}/${productId}`;

            // Fetch product data via AJAX
            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(product => {
                    // Populate modal with product data
                    document.getElementById('modal-product-image').src = product.image_url;
                    document.getElementById('modal-product-image').alt = product.name;
                    document.getElementById('modal-product-name').textContent = product.name;

                    const categoryElement = document.getElementById('modal-product-category');
                    if (product.category) {
                        categoryElement.textContent = product.category.name;
                        categoryElement.href = product.category.slug ?
                            `/products/category/${product.category.slug}` : '#';
                        categoryElement.style.display = 'inline';
                    } else {
                        categoryElement.style.display = 'none';
                    }

                    // Format prices in Indonesian Rupiah
                    const formatPrice = (price) => {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(price);
                    };

                    document.getElementById('modal-product-price').innerHTML = formatPrice(product.price);

                    const oldPriceElement = document.getElementById('modal-product-old-price');
                    if (product.old_price) {
                        oldPriceElement.innerHTML = formatPrice(product.old_price);
                        oldPriceElement.style.display = 'inline';
                    } else {
                        oldPriceElement.style.display = 'none';
                    }

                    document.getElementById('modal-product-description').textContent =
                        product.description || 'No description available';

                    // Show the modal
                    $('#viewproduct-over').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching product:', error);
                    alert('Failed to load product details');
                });
        }

        function addToCart() {
            // Implement your add to cart functionality here
            alert('Add to cart functionality would go here');
        }
    </script>
</x-superduper.main>
