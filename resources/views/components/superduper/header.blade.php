<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header">
    <!-- Main header -->
    <div class="main_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                    <a class="nav-brand" href="#" style="margin-top: 30%;">
                        @php
                            $brandLogo = $siteSettings->logo ?? null;
                            $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'SuperDuper');
                        @endphp

                        @if($brandLogo)
                            <img src="{{ Storage::url($brandLogo) }}"
                                alt="{{ $brandName }}"
                                class="logo"
                            />
                        @endif
                    </a>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                    <!-- Show on Mobile & iPad -->
                    <div class="blocks shop_cart d-xl-none d-lg-none">
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <a class="cart_box" data-toggle="collapse" href="#mySearch" role="button" aria-expanded="false" aria-controls="mySearch"><i class="ti-search"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Show on Desktop -->
                    <div class="blocks shop_cart d-none d-xl-block d-lg-block">
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <a href="https://wa.me/{{ $siteSettings->company_phone }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20Anda" class="cart_box"><i class="lni lni-phone"></i></a>
                            </div>
                            <div class="ss_cart_content">
                                <strong>Call Us:</strong>
                                <span>{{ $siteSettings->company_phone }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- <livewire:superduper.pages.search-bar /> --}}
                </div>
            </div>
        </div>
        <div class="collapse" id="mySearch">
            <div class="blocks search_blocks">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search entire store here...">
                    <div class="input-group-append">
                    <button class="btn search_btn" type="button"><i class="ti-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header_nav">
        <div class="container">
            <div class="row align-item-center">
                <div class="col-lg-3 col-md-4 col-sm-8 col-10">
                    <!-- For Desktop -->
                    @php
                        use Datlechin\FilamentMenuBuilder\Models\Menu;
                        $menu = Menu::location('header');

                        $productCategories = \App\Models\ProductCategory::where('is_active', true)
                                ->orderBy('name')
                                ->withCount('products')
                                ->get();
                    @endphp
                    <div class="shopby_categories d-none d-xl-block d-lg-block">
                        <a class="shop_category" data-toggle="collapse" href="#myCategories" role="button" aria-expanded="false" aria-controls="myCategories"><i class="ti-menu"></i>Shop By categories</a>
                        <div class="collapse" id="myCategories">
                            <div id="cats_menu">
                                <ul>
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

                    <!-- For Mobile -->
                    <div class="shopby_categories d-xl-none d-lg-none">
                        <a class="shop_category" href="#" onclick="openLeftMenu()"><i class="ti-menu"></i>Shop By categories</a>
                    </div>

                </div>

                <div class="col-lg-9 col-md-8 col-sm-4 col-2">
                    <nav id="navigation" class="navigation navigation-landscape">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div>
                        <div class="nav-menus-wrapper" style="transition-property: none;">
                            <ul class="nav-menu">
                                @if($menu)
                                    @foreach($menu->menuItems as $index => $item)
                                        @php
                                            $hasChildren = count($item->children) > 0;
                                            $menuId = 'submenu-' . ($index + 1);
                                        @endphp

                                        <li>
                                            <a href="{{ $item->url }}">{{ $item->title }} {{ $hasChildren ? '<span class="submenu-indicator"></span>' : '' }}</a>
                                            @if($hasChildren)
                                                <ul class="nav-dropdown nav-submenu">
                                                    @foreach($item->children as $childIndex => $childItem)
                                                        @php
                                                            $hasGrandchildren = count($childItem->children) > 0;
                                                            $submenuId = $menuId . '-' . ($childIndex + 1);
                                                        @endphp
                                                        <li><a href="{{ $childItem->url }}">{{ $childItem->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
