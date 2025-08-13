<div>
    <x-superduper.components.breadcrumb
        title="Search results for '{{ $q }}'"
        :items="[['label' => 'Search']]"
    />

    <section class="gray">
        <div class="container">
            <div class="row">

                {{-- Produk --}}
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="woo_product_grid">
                            @if($product->discount_percentage)
                                <span class="woo_offer_sell">Save {{ $product->discount_percentage }}% Off</span>
                            @endif
                            <div class="woo_product_thumb">
                                <img src="{{ $product->getImageUrl('medium') }}" class="img-fluid" alt="{{ $product->name }}">
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
                @endforeach

                {{-- Blog --}}
                @foreach($posts as $post)
                    <div class="mb-4 col-lg-4 col-md-6 col-sm-6">
                        <article class="post-grid-layout">
                            <a href="{{ $post->getUrl() }}">
                                <div class="post-article-header">
                                    @if($post->hasFeaturedImage())
                                        <img src="{{ $post->getFeaturedImageUrl('large') }}" alt="{{ $post->title }}" class="mx-auto img-fluid"/>
                                    @else
                                        <img src="https://placehold.co/500x500?text={{ urlencode($post->title) }}" alt="{{ $post->title }}" class="mx-auto img-fluid" />
                                    @endif
                                </div>
                            </a>
                            <div class="post-article box-inner">
                                <span class="post-article-cat theme-bg">{{ $post->category->name }}</span>
                                <h4 class="entry-title">
                                    <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
                                </h4>
                                <div class="post-short-des">
                                    {{ $post->content_overview }}
                                </div>
                            </div>
                            <div class="post-article-footer">
                                <a href="{{ $post->getUrl() }}" class="theme-cl">Read More</a>
                            </div>
                        </article>
                    </div>
                @endforeach

                @if($products->isEmpty() && $posts->isEmpty())
                    <div class="col-12">
                        <div class="text-center alert alert-info">
                            <strong>No results found for "{{ $q }}"</strong>
                        </div>
                    </div>
                @endif

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
</div>
