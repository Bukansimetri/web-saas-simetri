<div>
    @php
        $breadcrumbItems = [
            ['label' => 'Products', 'url' => route('products.index')]
        ];

        if ($productCategory) {
            $cat = \App\Models\ProductCategory::where('slug', $productCategory)->first();
            if ($cat) {
                $breadcrumbItems[] = [
                    'label' => $cat->name,
                    'url' => route('products.category', $cat->slug)
                ];
            }
        }

        if ($tag) {
            $breadcrumbItems[] = [
                'label' => "Tag: {$tag}",
                'url' => route('products.tag', $tag)
            ];
        }
    @endphp

    <x-superduper.components.breadcrumb
        title="Products"
        :items="$breadcrumbItems"
    />


    <section>
        <div class="container">

            <!-- Filter Toggle Button (Mobile) -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="filter_search_opt">
                        <a href="javascript:void(0);" onclick="openFilterSearch()"><i class="ti-reload"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Sidebar Filter -->
                <div class="col-lg-4 col-md-12">
                    <div class="search-sidebar sm-sidebar" id="filter_search" style="left:0;">
                        <div class="search-sidebar_header">
                            <h4 class="ssh_heading">Close Filter</h4>
                            <button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                        </div>
                        <div class="search-sidebar-body">

                            <!-- Categories -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4 class="mt-4 ml-4">Categories</h4>
                                </div>

                                <div class="widget-boxed-body">
                                    <div class="side-list no-border">
                                        <div class="filter-card" id="shop-categories">

                                            @foreach($categories as $cat)
                                            <div class="single_filter_card">
                                                <h5>
                                                    <a href="{{ route('products.category', $cat->slug) }}" class="collapsed" aria-expanded="false" role="button">
                                                        {{ $cat->name }}
                                                    </a>
                                                </h5>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Option -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#tag" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Tags</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse" id="tag" data-parent="#tag">
                                    <div class="side-list no-border">
                                        <!-- Single Filter Card -->
                                        <div class="single_filter_card">
                                            <div class="pt-0 card-body">
                                                <div class="inner_widget_link">
                                                    <ul class="no-ul-list">

                                                        @foreach($tags as $index => $tg)
                                                            @php
                                                                $tagSlug = \Illuminate\Support\Str::slug($tg);
                                                                $tagId = "tag-{$tagSlug}-{$index}";
                                                            @endphp

                                                            <li>
                                                                <input id="{{ $tagId }}"
                                                                    class="checkbox-custom"
                                                                    name="tags[]"
                                                                    type="checkbox"
                                                                    value="{{ $tg }}"
                                                                    wire:model="selectedTags" />
                                                                <label for="{{ $tagId }}" class="checkbox-custom-label">{{ ucfirst($tg) }}</label>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Option -->
                            <div class="single_search_boxed">
                                <div class="widget-boxed-header">
                                    <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
                                </div>
                                <div class="widget-boxed-body collapse" id="pricing" data-parent="#pricing">
                                    <div class="mb-4 side-list no-border">
                                        <div class="rg-slider">
                                            <input type="text" class="js-range-slider" name="my_range" value="" />
                                        </div>
                                        <div class="mt-2 d-flex justify-content-between">
                                            <span style="font-size: 12px">Rp. {{ number_format($minPrice, 0, ',', '.') }}</span>
                                            <span style="font-size: 12px">Rp. {{ number_format($maxPrice, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <div class="col-lg-8 col-md-12">

                    <!-- Banner (You can add your banner here if needed) -->
                    <!-- <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-5 min_banner">
                                <img src="https://via.placeholder.com/1200x400" class="rounded img-fluid" alt="" />
                            </div>
                        </div>
                    </div> -->

                    <!-- Shorter Toolbar -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="toolbar toolbar-products">
                                <div class="toolbar-sorter sorter">
                                    <label class="sorter-label" for="sorter">Sort By</label>
                                    <select id="sorter" wire:model="sortBy" class="sorter-options">
                                        <option value="position" selected="selected">Position</option>
                                        <option value="name">Product Name</option>
                                        <option value="price">Price</option>
                                    </select>
                                    <a href="#" class="action sorter-action"><i class="ti-arrow-up"></i></a>
                                </div>

                                <!-- View Mode (Grid/List) -->
                                <div class="modes">
                                    <a class="modes-mode mode-grid" title="Grid" href="#"><i class="ti-layout-grid3"></i></a>
                                    <a class="modes-mode mode-list" title="List" href="#"><i class="ti-view-list"></i></a>
                                </div>

                                <!-- Items Per Page -->
                                <div class="field limiter">
                                    <label class="label" for="limiter">
                                        <span>Show</span>
                                    </label>
                                    <div class="control">
                                        <select id="limiter" wire:model="perPage" class="limiter-options">
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="woo_product_grid">
                                    @if($product->discount_percentage)
                                        <span class="woo_offer_sell">Save {{ $product->discount_percentage }}% Off</span>
                                    @endif
                                    <div class="woo_product_thumb">
                                        <img src="{{ $product->getImageUrl('thumbnail') }}" class="img-fluid" alt="{{ $product->name }}">
                                    </div>
                                    <div class="woo_product_caption center" style="margin-top: 5%">
                                        <div class="woo_title">
                                            <h4 class="woo_pro_title"><a href="#">{{ $product->name }}</a></h4>
                                        </div>
                                        <div class="woo_price">
                                            <h6>Rp. {{ number_format($product->price,0,',','.') }}
                                                @if($product->old_price)
                                                    <span class="less_price">Rp{{ number_format($product->old_price,0,',','.') }}</span>
                                                @endif
                                            </h6>
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
                        @empty
                            <div class="col-12">
                                <p>No products found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="row">
                            <div class="col-lg-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <!-- Previous Page -->
                                        <li class="page-item left">
                                            <a class="page-link"
                                            wire:click="previousPage"
                                            @if(!$products->onFirstPage()) wire:loading.attr="disabled" @endif
                                            @if($products->onFirstPage()) disabled @endif
                                            href="#"
                                            aria-label="Previous"
                                            style="{{ $products->onFirstPage() ? 'cursor: not-allowed; background-color: #f8f9fa;' : '' }}">
                                                <span aria-hidden="true"><i class="mr-1 ti-arrow-left"></i>Prev</span>
                                            </a>
                                        </li>

                                        <!-- Page Numbers -->
                                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                                <a class="page-link"
                                                wire:click="gotoPage({{ $page }})"
                                                href="#">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endforeach

                                        <!-- Next Page -->
                                        <li class="page-item right">
                                            <a class="page-link"
                                            wire:click="nextPage"
                                            @if(!$products->hasMorePages()) wire:loading.attr="disabled" @endif
                                            @if(!$products->hasMorePages()) disabled @endif
                                            href="#"
                                            aria-label="Next"
                                            style="{{ !$products->hasMorePages() ? 'cursor: not-allowed; background-color: #f8f9fa;' : '' }}">
                                                <span aria-hidden="true"><i class="mr-1 ti-arrow-right"></i>Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </section>

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
                                    <!-- Pindahkan diskon ke JavaScript -->
                                    <span class="woo_pr_trending" id="modal-product-discount" style="display: none;"></span>
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
                                        <!-- Gunakan ID untuk link Add to Cart -->
                                        <a type="button" class="mb-2 btn btn-block btn-dark" id="modal-product-cart-link" href="#">
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

                    // Tampilkan diskon jika ada
                    const discountElement = document.getElementById('modal-product-discount');
                    if (product.discount_percentage) {
                        discountElement.textContent = `Save ${product.discount_percentage}%`;
                        discountElement.style.display = 'inline';
                    } else {
                        discountElement.style.display = 'none';
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

                    // Update link Add to Cart
                    const cartLink = document.getElementById('modal-product-cart-link');
                    if (product.url_grab_mart) {
                        cartLink.href = product.url_grab_mart;
                    } else {
                        cartLink.href = '#';
                        cartLink.onclick = function(e) {
                            e.preventDefault();
                            addToCart(productId);
                        };
                    }

                    // Show the modal
                    $('#viewproduct-over').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching product:', error);
                    alert('Failed to load product details');
                });
        }

        function addToCart(productId) {
            // Implement your add to cart functionality here
            alert('Add to cart functionality would go here for product ID: ' + productId);
        }
    </script>

</div>

