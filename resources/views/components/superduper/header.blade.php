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
                    <a class="nav-brand" href="#">
                        @php
                            $brandLogo = $siteSettings->logo ?? null;
                            $brandName = $generalSettings->brand_name ?? $siteSettings->name ?? config('app.name', 'SuperDuper');
                        @endphp

                        @if($brandLogo)
                            <img src="{{ Storage::url($brandLogo) }}"
                                alt="{{ $brandName }}"
                                class="logo"
                            />
                        @else
                            <div class="flex items-center">
                                <span class="text-xl font-bold md:text-2xl text-primary-800 dark:text-white header-brand-text">{{ $brandName }}</span>
                            </div>
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
                                <a href="javascript:void(0)" class="cart_box"><i class="lni lni-phone"></i></a>
                            </div>
                            <div class="ss_cart_content">
                                <strong>Call Us:</strong>
                                <span>+91 855 606 8402</span>
                            </div>
                        </div>
                    </div>

                    <div class="blocks search_blocks d-none d-xl-block d-lg-block">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search entire store here...">
                            <div class="input-group-append">
                            <button class="btn search_btn" type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
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
                    @endphp
                    <div class="shopby_categories d-none d-xl-block d-lg-block">
                        <a class="shop_category" data-toggle="collapse" href="#myCategories" role="button" aria-expanded="false" aria-controls="myCategories"><i class="ti-menu"></i>Shop By categories</a>
                        <div class="collapse" id="myCategories">
                            <div id="cats_menu">
                                <ul>
                                    <li class="active has-sub"><a href="#"><span>Category</span></a>
                                        <ul>
                                                <li><a href="#"><span>Grocery</span></a></li>
                                                <li><a href="#"><span>Organic</span></a></li>
                                                <li><a href="#"><span>Electronics</span></a></li>
                                                <li><a href="#"><span>Fashion</span></a></li>
                                                <li><a href="#"><span>Education</span></a></li>
                                                <li><a href="#"><span>Beauty</span></a></li>
                                        </ul>
                                        <ul>
                                                <li class="has-sub"><a href="#"><span>Digital</span></a>
                                                <ul>
                                                    <li><a href="#"><span>Sub Product</span></a></li>
                                                    <li><a href="#"><span>Sub Product</span></a></li>
                                                    <li><a href="#"><span>Sub Product</span></a></li>
                                                    <li><a href="#"><span>Sub Product</span></a></li>
                                                </ul>
                                                </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub"><a href="#"><span>Brand</span></a>
                                        <ul>
                                                <li><a href="#"><span>Nike</span></a></li>
                                                <li><a href="#"><span>Apple</span></a></li>
                                                <li><a href="#"><span>Hackerl</span></a></li>
                                                <li><a href="#"><span>Tuffan</span></a></li>
                                                <li><a href="#"><span>Orio</span></a></li>
                                                <li><a href="#"><span>Kite</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-sub"><a href="#"><span>Pages</span></a>
                                        <ul>
                                                <li><a href="#"><span>About Us</span></a></li>
                                                <li><a href="#"><span>Blog grid</span></a></li>
                                                <li><a href="#"><span>Blog Detail</span></a></li>
                                                <li><a href="#"><span>Add To Cart</span></a></li>
                                                <li><a href="#"><span>Payment</span></a></li>
                                                <li><a href="#"><span>FAQ's</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-sub"><a href="#"><span>Products</span></a>
                                        <ul>
                                                <li><a href="#"><span>3 Columns products</span></a></li>
                                                <li><a href="#"><span>4 Columns products</span></a></li>
                                                <li><a href="#"><span>5 Columns products</span></a></li>
                                                <li><a href="#"><span>6 Columns products</span></a></li>
                                                <li><a href="#"><span>7 Columns products</span></a></li>
                                                <li><a href="#"><span>8 Columns products</span></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><span>Features</span></a></li>
                                    <li><a href="#"><span>Contact</span></a></li>
                                    <li class="has-sub"><a href="#"><span>Layouts</span></a>
                                        <ul>
                                                <li><a href="#"><span>With Left Sidebar</span></a></li>
                                                <li><a href="#"><span>With Right Sidebar</span></a></li>
                                                <li><a href="#"><span>Full Width banner</span></a></li>
                                                <li><a href="#"><span>Slider Banner</span></a></li>
                                                <li><a href="#"><span>Fill Width Search</span></a></li>
                                                <li><a href="#"><span>Boxed Layout</span></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><span>Buy Odex</span></a></li>
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
                                            <a href="{{ $item->url }}">{{ $item->title }} {{ $hasGrandchildren ? '<span class="submenu-indicator"></span>' : '' }}</a>
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
