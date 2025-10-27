<header class="header header--1" data-sticky="true">
    @php
        $color = App\Models\Color::orderBy('id', 'DESC')
            ->where('status', 1)
            ->first();
    @endphp
    <style>
        .mega-menu .mega-menu__column {
            min-width: 115px !important;
        }

        .sub_color {
            color: black !important;
            font-weight: 600;
        }

        .mega-menu {
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            padding: 7px 5px 5px;
            background-color: #fff;
            transition: all 0.4s ease;
            border: 1px solid #ccc;
        }

        .menu>li>a {
            display: inline-block;
            padding: 15px 18px !important;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
            color: {{ $color->text_color ?? 'null' }} !important;
        }

        .menu--product-categories .menu__toggle span {
            font-size: 20px;
            color: white;
            font-size: 16px;
            font-weight: 600;
        }

        .navigation__extra>li a {
            color: #fff;
        }

        .navigation__extra>li:after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 0;
            width: 2px;
            height: 15px;
            background-color: #fff;
        }

        .header .header__top {
            padding: 17px 0;
            background-color: #fcb800;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
        }

        #homepage-1 .ps-top-categories {
            padding: 30px 0 50px;
        }

        body {
            background-color: {{ $color->bg_color ?? 'null' }};
        }

        #back2top i {
            z-index: 10001;
            font-size: 14px;
            margin-bottom: -2px;
            color: #fff;
        }

        #back2top.active {
            bottom: 30px;
            visibility: visible;
            opacity: 1;
            background-color: #0cb8bb;
        }

        .header.header--sticky .menu--product-categories .menu__toggle i {
            font-size: 30px;
            color: #fff;
        }

        .ps-cart--mini .ps-cart__items {
            height: 400px;
            overflow-y: auto;
        }
    </style>
    <div class="header__top" style="background-color: {{ $color->top_header ?? 'null' }} !important;">
        <div class="container">
            <div class="header__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle">
                        <i class="icon-menu"></i>
                        @if (session()->get('language') == 'bangla')
                            বিভাগ দ্বারা কেনাকাটা
                        @else
                            <span> Shop by Department</span>
                        @endif
                    </div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            @php
                                $categories = App\Models\Category::orderBy('category_name_en', 'ASC')
                                    ->limit(10)
                                    ->Where('status', 1)
                                    ->get();
                            @endphp
                            @foreach ($categories as $category)
                                <li class="menu-item-has-children has-mega-menu">
                                    <a href="{{ route('product.category', $category->slug) }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $category->category_name_bn }}
                                        @else
                                            {{ $category->category_name_en }}
                                        @endif
                                    </a>
                                    <span class="sub-toggle"></span>
                                    <div class="mega-menu">
                                        @php
                                            $subcategories = App\Models\Subcategory::where('category_id', $category->id)
                                                ->orderBy('subcategory_name_en', 'ASC')
                                                ->get();
                                        @endphp
                                        @foreach ($subcategories as $subcategory)
                                            <div class="mega-menu__column">
                                                <a style="font-weight:700;!important;"
                                                    href="{{ route('product.subcategory', $subcategory->slug) }}">
                                                    @if (session()->get('language') == 'bangla')
                                                        {{ $subcategory->subcategory_name_bn }}
                                                    @else
                                                        {{ $subcategory->subcategory_name_en }}
                                                    @endif
                                                    <span class="sub-toggle"></span>
                                                </a>
                                                @php
                                                    $subsubcategories = App\Models\Subsubcategory::where('subcategory_id', $subcategory->id)
                                                        ->orderBy('sub_subcategory_name_en', 'ASC')
                                                        ->get();
                                                @endphp
                                                <ul class="mega-menu__list">
                                                    @foreach ($subsubcategories as $subsubcategory)
                                                        <li>
                                                            <a
                                                                href="{{ route('product.childcategory', $subsubcategory->slug) }}">
                                                                @if (session()->get('language') == 'bangla')
                                                                    {{ $subsubcategory->sub_subcategory_name_bn }}
                                                                @else
                                                                    {{ $subsubcategory->sub_subcategory_name_en }}
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @php
                    $logo = get_setting('site_logo');
                @endphp
                <a class="ps-logo" href="{{ route('home') }}">
                    @if ($logo != null)
                        <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}"
                            width="" height="">
                    @else
                        <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                            style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                    @endif
                </a>
            </div>
            @php
                $categories = App\Models\Category::orderBy('category_name_en', 'ASC')
                    ->limit('3')
                    ->get();
            @endphp
            <div class="header__center advance_search">
                <form class="ps-form--quick-search" action="{{ route('product.search') }}" method="post">
                    @csrf
                    <div class="form-group--icon" id="searchCategory"><i class="icon-chevron-down"></i>
                        <select name="searchCategory" class="form-control" style="width: 15.5rem;">
                            <option selected>All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    @if (session()->get('language') == 'bangla')
                                        {{ $cat->category_name_bn }}
                                    @else
                                        {{ $cat->category_name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input class="form-control search" name="search" type="text" placeholder="I'm shopping for..."
                        required onfocus="search_result_show()" onblur="search_result_hide()">
                    <button type="submit" style="cursor: pointer;">Search</button>
                </form>
            </div>

            <div class="searchProducts"></div>
            <style type="text/css">
                .header .header__top .ps-container>*,
                .header .header__top .container>* {
                    width: 94% !important;
                }

                .searchProducts {
                    z-index: 9;
                    position: absolute;
                }

                .advance_search {
                    position: relative;
                }
            </style>
            <!--end row-->
            <div class="header__right">
                <div class="header__actions">
                    <a class="header__extra" href="{{ route('compare') }}">
                        <i class="icon-chart-bars"></i>
                        @if (Session::has('compare'))
                            <span><i>{{ count(Session::get('compare')) }}</i></span>
                        @else
                            <span><i>0</i></span>
                        @endif
                    </a>
                    <a class="header__extra" href="{{ route('wishlist') }}">
                        <i class="icon-heart"></i>
                        <span class="pro-count" id="wishQty"><i>0</i></span>
                    </a>
                    <div class="ps-cart--mini">
                        <a class="header__extra" href="#">
                            <i class="icon-bag2"></i>
                            <span class="cartQty"><i></i></span>
                        </a>
                        <div class="ps-cart__content">
                            <!-- start minicart show all product -->
                            <div class="ps-cart__items miniCart">

                            </div>
                            <!-- Cart Show Total Checkout Section Show -->
                            <div class="ps-cart__footer miniCart_btn">
                                <h3>Total:<strong>৳<span id="cartSubTotal"></span></strong></h3>
                                <figure>
                                    <a class="ps-btn" href="{{ route('cart.show') }}">View Cart</a>
                                    <a class="ps-btn" href="{{ route('checkout') }}">Checkout</a>
                                </figure>
                            </div>

                            <!-- Cart Empty/No Cart Continue Shopping Section Show -->
                            <div class="ps-cart__footer miniCart_empty_btn">
                                <figure>
                                    <a class="ps-btn" href="{{ route('home') }}">Continue Shopping</a>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        @auth
                            <div class="ps-block__left">
                                <a href="{{ route('dashboard') }}" class="nav-link cart-link">
                                    <i class="icon-user"></i>
                                </a>
                            </div>
                        @else
                            <div class="ps-block__right">
                                <a href="{{ route('login') }}">Login</a>
                            </div>
                            <div class="ps-block__right">
                                <a href="{{ route('register') }}">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation" style="background-color: {{ $color->small_header ?? 'null' }} !important; color: #fff;">
        <div class="container">
            <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i>
                        @if (session()->get('language') == 'bangla')
                            বিভাগ দ্বারা কেনাকাটা
                        @else
                            <span> Shop by Department</span>
                        @endif
                    </div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            @php
                                $categories = App\Models\Category::orderBy('category_name_en', 'ASC')
                                    ->limit('10')
                                    ->Where('status', 1)
                                    ->get();
                            @endphp
                            @foreach ($categories as $category)
                                <li class="menu-item-has-children has-mega-menu">
                                    <a href="{{ route('product.category', $category->slug) }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $category->category_name_bn }}
                                        @else
                                            {{ $category->category_name_en }}
                                        @endif
                                    </a>
                                    <span class="sub-toggle"></span>
                                    <div class="mega-menu">
                                        @php
                                            $subcategories = App\Models\Subcategory::where('status', 1)
                                                ->where('category_id', $category->id)
                                                ->orderBy('subcategory_name_en', 'ASC')
                                                ->get();
                                        @endphp
                                        @foreach ($subcategories as $subcategory)
                                            <div class="mega-menu__column">
                                                <h4>
                                                    <a class="sub_color"
                                                        href="{{ route('product.subcategory', $subcategory->slug) }}">
                                                        @if (session()->get('language') == 'bangla')
                                                            {{ $subcategory->subcategory_name_bn }}
                                                        @else
                                                            {{ $subcategory->subcategory_name_en }}
                                                        @endif
                                                        <span class="sub-toggle"></span>
                                                    </a>
                                                </h4>
                                                @php
                                                    $subsubcategories = App\Models\Subsubcategory::where('status', 1)
                                                        ->where('subcategory_id', $subcategory->id)
                                                        ->orderBy('sub_subcategory_name_en', 'ASC')
                                                        ->get();
                                                @endphp
                                                <ul class="mega-menu__list">
                                                    @foreach ($subsubcategories as $subsubcategory)
                                                        <li>
                                                            <a
                                                                href="{{ route('product.childcategory', $subsubcategory->slug) }}">
                                                                @if (session()->get('language') == 'bangla')
                                                                    {{ $subsubcategory->sub_subcategory_name_bn }}
                                                                @else
                                                                    {{ $subsubcategory->sub_subcategory_name_en }}
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- main navigatio right category --}}
            <div class="navigation__right">
                <ul class="menu menu--organic">
                    @php
                        $categories = App\Models\Category::orderBy('id', 'ASC')
                            ->take('3')
                            ->Where('status', 1)
                            ->get();
                    @endphp
                    <li class="">
                        <a href="{{ route('home') }}">
                            @if (session()->get('language') == 'bangla')
                                হোম
                            @else
                                Home
                            @endif
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="menu-item-has-children has-mega-menu">
                            <a href="{{ route('product.category', $category->slug) }}">
                                @if (session()->get('language') == 'bangla')
                                    {{ $category->category_name_bn }}
                                @else
                                    {{ $category->category_name_en }}
                                @endif
                                <span class="sub-toggle"></span>
                            </a>
                            <span class="sub-toggle"></span>
                            <div class="mega-menu">
                                @php
                                    $subcategories = App\Models\Subcategory::where('category_id', $category->id)
                                        ->orderBy('subcategory_name_en', 'ASC')
                                        ->Where('status', 1)
                                        ->get();
                                @endphp
                                @foreach ($subcategories as $subcategory)
                                    <div class="mega-menu__column">
                                        <h4>
                                            <a class="sub_color"
                                                href="{{ route('product.subcategory', $subcategory->slug) }}">
                                                @if (session()->get('language') == 'bangla')
                                                    {{ $subcategory->subcategory_name_bn }}
                                                @else
                                                    {{ $subcategory->subcategory_name_en }}
                                                @endif
                                                <span class="sub-toggle"></span>
                                            </a>
                                        </h4>
                                        @php
                                            $subsubcategories = App\Models\Subsubcategory::where('subcategory_id', $subcategory->id)
                                                ->orderBy('sub_subcategory_name_en', 'ASC')
                                                ->Where('status', 1)
                                                ->get();
                                        @endphp
                                        <ul class="mega-menu__list">
                                            @foreach ($subsubcategories as $subsubcategory)
                                                <li>
                                                    <a
                                                        href="{{ route('product.childcategory', $subsubcategory->slug) }}">
                                                        @if (session()->get('language') == 'bangla')
                                                            {{ $subsubcategory->sub_subcategory_name_bn }}
                                                        @else
                                                            {{ $subsubcategory->sub_subcategory_name_en }}
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="navigation__extra">
                    <li><a href="{{ route('user.track.order') }}">
                            @if (session()->get('language') == 'bangla')
                                আপনার অর্ডার ট্র্যাক
                            @else
                                Tract your order
                            @endif
                        </a>
                    </li>
                    <li>
                        <div class="language">
                            @if (session()->get('language') == 'bangla')
                                <a href="{{ route('english.language') }}">English</a>
                            @else
                                <a href="{{ route('bangla.language') }}">বাংলা</a>
                            @endif
                        </div>
                    </li>
                </ul>
                <!-- <div class="ps-block--header-hotline inline">
                    <p><i class="icon-telephone"></i>Phone:<strong> {{ get_setting('phone')->value ?? 'null' }}</strong></p>
                </div> -->
            </div>
        </div>
    </nav>
</header>
<header class="header header--mobile" data-sticky="true"
    style="background-color:{{ $color->top_header ?? 'null' }} !important;">
    <div class="header__top" style="background-color: {{ $color->top_header ?? 'null' }} !important;">
        <div class="header__left">
            <p>Welcome to Martfury Online Shopping Store !</p>
        </div>
        <div class="header__right">
            <ul class="navigation__extra">
                <li><a href="{{ route('user.track.order') }}">
                        @if (session()->get('language') == 'bangla')
                            আপনার অর্ডার ট্র্যাক
                        @else
                            Tract your order
                        @endif
                    </a></li>
                <li>
                    <div class="language">
                        @if (session()->get('language') == 'bangla')
                            <a href="{{ route('english.language') }}">English</a>
                        @else
                            <a href="{{ route('bangla.language') }}">বাংলা</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile" style="background-color: {{ $color->top_header ?? 'null' }} !important;">
        <div class="navigation__left">
            @php
                $logo = get_setting('site_logo');
            @endphp
            <a class="ps-logo" href="{{ route('home') }}">
                @if ($logo != null)
                    <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}"
                        width="110" height="33">
                @else
                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                        style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                @endif
            </a>
        </div>
        <div class="navigation__right">
            <div class="header__actions">
                <div class="ps-cart--mini">
                    <a class="header__extra" href="{{ route('compare') }}">
                        <i class="icon-chart-bars"></i>
                        @if (Session::has('compare'))
                            <span><i>{{ count(Session::get('compare')) }}</i></span>
                        @else
                            <span><i>0</i></span>
                        @endif
                    </a>
                    <a class="header__extra" href="#">
                        <i class="icon-bag2"></i>
                        <span class="cartQty"><i></i></span>
                    </a>
                    <div class="ps-cart__content">
                        <!-- start minicart show all product -->
                        <div class="ps-cart__items miniCart">

                        </div>
                        <!-- Cart Show Total Checkout Section Show -->
                        <div class="ps-cart__footer miniCart_btn">
                            <h3>Total:<strong>৳<span id="cartSubTotal"></span></strong></h3>
                            <figure>
                                <a class="ps-btn" href="{{ route('cart.show') }}">View Cart</a>
                                <a class="ps-btn" href="{{ route('checkout') }}">Checkout</a>
                            </figure>
                        </div>

                        <!-- Cart Empty/No Cart Continue Shopping Section Show -->
                        <div class="ps-cart__footer miniCart_empty_btn">
                            <figure>
                                <a class="ps-btn" href="{{ route('home') }}">Continue Shopping</a>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="ps-block--user-header">
                    @auth
                        <div class="ps-block__left">
                            <a href="{{ route('dashboard') }}" class="nav-link cart-link">
                                <i class="icon-user"></i>
                            </a>
                        </div>
                    @else
                        <div class="ps-block__right">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile advance_search">
        <form class="ps-form--search-mobile" action="{{ route('product.search') }}" method="post">
            @csrf
            <div class="form-group--nest">
                <input class="form-control search" name="search" type="text" placeholder="I'm shopping for..."
                    required onfocus="search_result_show()" onblur="search_result_hide()">
                <button type="submit" style="cursor: pointer;">
                    <i class="icon-magnifier"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="searchProducts"></div>
    <style type="text/css">
        .header .header__top .ps-container>*,
        .header .header__top .container>* {
            width: 94% !important;
        }

        .searchProducts {
            z-index: 9;
            position: absolute;
        }

        .advance_search {
            position: relative;
        }
    </style>
</header>

<div id="back2top">
    <i class="icon icon-arrow-up"></i>
</div>
<div class="ps-site-overlay"></div>
<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
    </div>
    <div class="navigation__content">
        <div class="ps-cart--mobile">
            <div class="ps-cart__content">
                <div class="ps-product--cart-mobile">
                    <!-- start minicart show all product -->
                    <div class="ps-cart__items miniCart">

                    </div>
                </div>
            </div>
            <!-- Cart Show Total Checkout Section Show -->
            <div class="ps-cart__footer miniCart_btn">
                <h3>Total:<strong>৳<span id="cartSubTotal"></span></strong></h3>
                <figure>
                    <a class="ps-btn" href="{{ route('cart.show') }}">View Cart</a>
                    <a class="ps-btn" href="{{ route('checkout') }}">Checkout</a>
                </figure>
            </div>

            <!-- Cart Empty/No Cart Continue Shopping Section Show -->
            <div class="ps-cart__footer miniCart_empty_btn">
                <figure>
                    <a class="ps-btn" href="{{ route('home') }}">Continue Shopping</a>
                </figure>
            </div>
        </div>
    </div>
</div>
<!--include ../../data/menu/menu-product-categories-->
<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
        <h3>Categories</h3>
    </div>
    <div class="ps-panel__content">
        <div class="menu--product-categories">
            <div class="menu__toggle">
                <i class="icon-menu"></i>
                @if (session()->get('language') == 'bangla')
                    বিভাগ দ্বারা কেনাকাটা
                @else
                    <span> Shop by Department</span>
                @endif
            </div>
            <div class="menu__content">
                <ul class="menu--mobile">
                    @php
                        $categories = App\Models\Category::orderBy('category_name_en', 'ASC')
                            ->Where('status', 1)
                            ->get();
                    @endphp
                    @foreach ($categories as $category)
                        <li class="menu-item-has-children has-mega-menu">
                            <a href="{{ route('product.category', $category->slug) }}">
                                @if (session()->get('language') == 'bangla')
                                    {{ $category->category_name_bn }}
                                @else
                                    {{ $category->category_name_en }}
                                @endif
                            </a>
                            <span class="sub-toggle"></span>
                            <div class="mega-menu">
                                @php
                                    $subcategories = App\Models\Subcategory::where('category_id', $category->id)
                                        ->orderBy('subcategory_name_en', 'ASC')
                                        ->get();
                                @endphp
                                @foreach ($subcategories as $subcategory)
                                    <div class="mega-menu__column">
                                        <a class="sub_color"
                                            href="{{ route('product.subcategory', $subcategory->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $subcategory->subcategory_name_bn }}
                                            @else
                                                {{ $subcategory->subcategory_name_en }}
                                            @endif
                                            <span class="sub-toggle"></span>
                                        </a>
                                        @php
                                            $subsubcategories = App\Models\Subsubcategory::where('subcategory_id', $subcategory->id)
                                                ->orderBy('sub_subcategory_name_en', 'ASC')
                                                ->get();
                                        @endphp
                                        <ul class="mega-menu__list">
                                            @foreach ($subsubcategories as $subsubcategory)
                                                <li>
                                                    <a
                                                        href="{{ route('product.childcategory', $subsubcategory->slug) }}">
                                                        @if (session()->get('language') == 'bangla')
                                                            {{ $subsubcategory->sub_subcategory_name_bn }}
                                                        @else
                                                            {{ $subsubcategory->sub_subcategory_name_en }}
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--+createMenu(product_categories, 'menu--mobile')-->
    </div>
</div>
<div class="navigation--list">
    <div class="navigation__content">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile">
            <i class="icon-menu"></i>
            <span> Menu</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
            <i class="icon-list4"></i>
            <span> Categories</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
            <i class="icon-magnifier"></i>
            <span> Search</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile">
            <i class="icon-bag2"></i>
            <span> Cart</span>
        </a>
    </div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header advance_search">
        <form class="ps-form--search-mobile" action="{{ route('product.search') }}" method="post">
            @csrf
            <div class="form-group--nest">
                <input class="form-control search" name="search" type="text" placeholder="I'm shopping for..."
                    required onfocus="search_result_show()" onblur="search_result_hide()">
                <button type="submit" style="cursor: pointer;"><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
    <div class="navigation__content"></div>
</div>
<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <li class="menu-item-has-children">
                <a href="{{ route('home') }}">Home</a>
                <span class="sub-toggle"></span>
            </li>
            <li class="menu-item-has-children has-mega-menu">
                <a href="shop-default">Shop</a>
                <span class="sub-toggle"></span>
                <!-- <div class="mega-menu">
                        <div class="mega-menu__column">
                            <h4>Catalog Pages
                                <span class="sub-toggle"></span>
                            </h4>
                            <ul class="mega-menu__list">
                                <li><a href="shop-default.html">Shop Default</a>
                                </li>
                                <li><a href="shop-default.html">Shop Fullwidth</a>
                                </li>
                                <li><a href="shop-categories.html">Shop Categories</a>
                                </li>
                                <li><a href="shop-sidebar.html">Shop Sidebar</a>
                                </li>
                                <li><a href="shop-sidebar-without-banner.html">Shop Without Banner</a>
                                </li>
                                <li><a href="shop-carousel.html">Shop Carousel</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mega-menu__column">
                            <h4>Product Layout<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li><a href="product-default.html">Default</a>
                                </li>
                                <li><a href="product-extend.html">Extended</a>
                                </li>
                                <li><a href="product-full-content.html">Full Content</a>
                                </li>
                                <li><a href="product-box.html">Boxed</a>
                                </li>
                                <li><a href="product-sidebar.html">Sidebar</a>
                                </li>
                                <li><a href="product-default.html">Fullwidth</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mega-menu__column">
                            <h4>Product Types<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li><a href="product-default.html">Simple</a>
                                </li>
                                <li><a href="product-default.html">Color Swatches</a>
                                </li>
                                <li><a href="product-image-swatches.html">Images Swatches</a>
                                </li>
                                <li><a href="product-countdown.html">Countdown</a>
                                </li>
                                <li><a href="product-multi-vendor.html">Multi-Vendor</a>
                                </li>
                                <li><a href="product-instagram.html">Instagram</a>
                                </li>
                                <li><a href="product-affiliate.html">Affiliate</a>
                                </li>
                                <li><a href="product-on-sale.html">On sale</a>
                                </li>
                                <li><a href="product-video.html">Video Featured</a>
                                </li>
                                <li><a href="product-groupped.html">Grouped</a>
                                </li>
                                <li><a href="product-out-stock.html">Out Of Stock</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mega-menu__column">
                            <h4>Woo Pages<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li><a href="shopping-cart.html">Shopping Cart</a>
                                </li>
                                <li><a href="checkout.html">Checkout</a>
                                </li>
                                <li><a href="whishlist.html">Whishlist</a>
                                </li>
                                <li><a href="compare.html">Compare</a>
                                </li>
                                <li><a href="order-tracking.html">Order Tracking</a>
                                </li>
                                <li><a href="my-account.html">My Account</a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
            </li>
            <li class="menu-item-has-children has-mega-menu">
                <a href="">Pages</a>
                <span class="sub-toggle"></span>
                <div class="mega-menu">
                    <div class="mega-menu__column">
                        @foreach (get_pages_nav_header() as $page)
                            <ul class="mega-menu__list">
                                <li>
                                    <a href="#">{{ $page->name_en }}</a>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </li>
            <li class="menu-item-has-children has-mega-menu"><a href="">Blogs</a><span
                    class="sub-toggle"></span>
                <div class="mega-menu">
                    <!-- <div class="mega-menu__column">
                            <h4>Blog Layout<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li>
                                    <a href="blog-grid.html">Grid</a>
                                </li>
                                <li>
                                    <a href="blog-list.html">Listing</a>
                                </li>
                                <li>
                                    <a href="blog-small-thumb.html">Small Thumb</a>
                                </li>
                                <li>
                                    <a href="blog-left-sidebar.html">Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="blog-right-sidebar.html">Right Sidebar</a>
                                </li>
                            </ul>
                        </div> -->
                </div>
            </li>
            <li class="menu-item-has-children has-mega-menu">
                <a href="{{ route('login') }}">Login</a>
                <span class="sub-toggle"></span>
                <div class="mega-menu">
                </div>
            </li>
            <li class="menu-item-has-children has-mega-menu">
                <a href="{{ route('register') }}">Register</a>
                <span class="sub-toggle"></span>
                <div class="mega-menu">
                </div>
            </li>
            <li class="menu-item-has-children has-mega-menu">
                <a href="{{ route('user.track.order') }}">Tract your order</a>
                <span class="sub-toggle"></span>
                <div class="mega-menu">
                </div>
            </li>
        </ul>
    </div>
</div>
<div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<div class="ps-search" id="site-search">
    <a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content advance_search">
        <form class="ps-form--primary-search" action="{{ route('product.search') }}" method="post">
            @csrf
            <input class="form-control search" name="search" type="text" placeholder="I'm shopping for..."
                required onfocus="search_result_show()" onblur="search_result_hide()">
            <button type="submit" style="cursor: pointer;"><i class="aroma-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="searchProducts"></div>
    <style type="text/css">
        .header .header__top .ps-container>*,
        .header .header__top .container>* {
            width: 94% !important;
        }

        .searchProducts {
            z-index: 9;
            position: absolute;
        }

        .advance_search {
            position: relative;
        }
    </style>
</div>
<!-- Modal -->
@include('frontend.common.quickView')
<!--end quick view product-->

@push('footer-script')
    <script type="text/javascript">
        /* ================ Advance Product Search ============ */
        $("body").on("keyup", ".search", function() {
            let text = $(".search").val();
            let category_id = $("#searchCategory").val();
            // alert(category_id);
            // console.log(text);

            if (text.length > 0) {

                $.ajax({
                    data: {
                        search: text,
                        category: category_id
                    },
                    url: "/search-product",
                    method: 'post',
                    beforSend: function(request) {
                        return request.setReuestHeader('X-CSRF-Token', ("meta[name='csrf-token']"))

                    },
                    success: function(result) {
                        $(".searchProducts").html(result);
                    }

                }); // end ajax
            } // end if
            if (text.length < 1) $(".searchProducts").html("");
        }); // end function

        /* ================ Advance Product slideUp/slideDown ============ */
        function search_result_hide() {
            $(".searchProducts").slideUp();
        }

        function search_result_show() {
            $(".searchProducts").slideDown();
        }
    </script>

    <script>
        $(document).ready(function() {
            $(".show").click(function() {
                $(".advance-search").show();
            });
            $(".hide").click(function() {
                $(".advance-search").hide();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".show").click(function() {
                $(".advance-search").show();
            });
            $(".hide").click(function() {
                $(".advance-search").hide();
            });
        });
    </script>
@endpush
