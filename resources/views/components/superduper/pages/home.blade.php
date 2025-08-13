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
@endphp
<x-superduper.main>

    <x-superduper.components.banner />

    <!-- ======================== Choose Category Start ==================== -->
    <section class="pt-0 overlio">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="owl-carousel category-slider owl-theme">
                        @foreach ($productCategories as $productCategory)
                            <!-- Single Item -->
                            <div class="item">
                                <div class="rounded woo_category_box border_style">
                                    <div class="woo_cat_thumb">
                                        <a href="{{ url('/category/'.$productCategory->id) }}">
                                            <img src="{{ $productCategory->getImageUrl('thumbnail') ?? 'https://placehold.co/140x140'}}" class="img-fluid" alt="{{ $productCategory->name }}" />
                                        </a>
                                    </div>
                                    <div class="woo_cat_caption">
                                        <h4>
                                            <a href="{{ url('/category/'.$productCategory->id) }}">{{ $productCategory->name }}</a>
                                        </h4>
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
    <!-- ======================== Choose Category End ==================== -->

    <!-- ======================== Fresh Vegetables Start ==================== -->
    <section class="pt-0">
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
    <section class="pt-0">
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

    <!-- ======================== Fruits Offers Start ==================== -->
    <section class="pt-0 pb-0">
        <div class="container">
            <div class="rounded row align-items-center offer_flix light-yellow">

                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="offer_block_caption">
                        <h2 class="mb-4">Products Of The Week<br>Upto 40% Off on Fresh Fruits</h2>
                        <a href="#" class="btn btn-warning">Explore All Products<i class="ml-2 ti-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="ordering">
                        <img src="https://placehold.co/500x600" class="img-fluid" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================== Fruits Offers End ==================== -->

    <!-- ======================== Fresh Vegetables & Fruits Start ==================== -->
    <section class="">
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
