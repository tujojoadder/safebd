@extends('layouts.frontend')
@section('content-frontend')
@section('title')
    Eshop Ecommerce
@endsection
<style>
    #homepage-1 .ps-product-list {
        padding-bottom: 0px;
    }

    #homepage-1 .ps-deal-of-day {
        padding-bottom: 24px;
    }

    #homepage-9 .ps-home-blog {
        margin-bottom: -59px;
        padding-top: 0px;
    }

    .ps-best-sale-brands {
        padding-bottom: 60px;
    }

    #homepage-9 .ps-site-features {
        padding: 36px 0;
    }

    .ps-deal-of-day .ps-section__header {
        margin-bottom: 65px;
        padding: 16px 20px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        background-color: #f4f4f4;
        border-bottom: 1px solid #e3e3e3;
    }

    .ps-home-blog .ps-section__header {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        padding: 16px 20px;
        background-color: #f4f4f4;
        border-bottom: 1px solid #e3e3e3;
    }

    .ps-deal-of-day .ps-section__header {
        margin-bottom: 45px;
    }

    .ps-product-list .ps-section__content {
        padding-top: 30px;
    }
</style>
<div id="homepage-1">
    <!-- home slider/banner show -->
    <div class="ps-home-banner ps-home-banner--1">
        <div class="ps-container">
            <style>
                @media only screen and (max-width: 600px) {
                    .slider_image {
                        height: auto;
                    }

                    .slider_image {
                        height: auto;
                    }

                    #homepage-1 .ps-home-banner .owl-slider {
                        max-width: 100%;
                        height: auto !important;
                    }

                    /* #homepage-1 .ps-home-banner .ps-section__left {
                    padding-right: 30px;
                    max-width: calc(100% - 299px) !important;
                } */
                    /* #homepage-1 .ps-top-categories {
                    padding: 10px 0 50px !important;
                } */
                    .owl-carousel .owl-item img {
                        width: 100% important;
                    }

                }
            </style>
            <div class="ps-section__left">
                <div class="ps-carousel--nav-inside second owl-slider" data-owl-auto="true" data-owl-loop="true"
                    data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1"
                    data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1"
                    data-owl-duration="1000" data-owl-mousedrag="on">
                    @foreach ($sliders as $slider)
                        <a href="#">
                            <img class="slider_image" src="{{ asset($slider->slider_img) }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="ps-section__right">
                @foreach ($latest_banner as $banner)
                    <a class="ps-collection" href="#" style="padding-bottom: 5px !important;">
                        <img class="slider_image" src="{{ asset($banner->banner_image) }}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- today's deals product show -->
    @if (count($today_deals) > 0)
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>Deals of the day</h3>
                        </div>
                    </div><a href="{{ route('product.view.all') }}">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                        data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true"
                        data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4"
                        data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($today_deals as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        </a>
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                            alt="" />
                                    @endif
                                    <a class="ps-product__vendor mt-3" href="#">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->category->category_name_bn ?? 'NULL' }}
                                        @else
                                            {{ $product->category->category_name_en ?? 'NULL' }}
                                        @endif
                                    </a>
                                    @php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                    @endphp

                                    @if ($product->discount_price > 0)
                                        @if ($product->discount_type == 1)
                                            <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                        @elseif($product->discount_type == 2)
                                            <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
                                        @endif
                                    @endif
                                    <ul class="ps-product__actions">
                                        @if ($product->is_varient == 1)
                                            <!--<li>-->
                                            <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                            <!--</li>-->
                                            <!-- start varient product add to cart direct -->
                                            <li>
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <a onclick="addToCartDirect({{ $product->id }})" data-placement="top"
                                                    title="Add To Cart" style="cursor:pointer;"><i
                                                        class="icon-bag2"></i></a>
                                            </li>
                                            <!-- end varient product add to cart direct -->
                                            <li>
                                                <a href="#" id="{{ $product->id }}"
                                                    onclick="productView(this.id)" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#product-quickview"><i class="icon-eye"></i>
                                                </a>
                                            </li>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <li>
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"><i class="icon-bag2"
                                                        style="cursor:pointer;"></i></a>
                                            </li>
                                            <!-- end not varient product add to cart direct -->

                                            <!--<li>-->
                                            <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                        @endif
                                        <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist"
                                                style="cursor: pointer;"><i class="icon-heart"></i></a></li>

                                        <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                    class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                                <div class="ps-product__container">
                                    @if ($product->discount_price > 0)
                                        <p class="ps-product__price sale">
                                            ৳{{ $price_after_discount }}
                                            <del>৳ {{ $product->regular_price }}</del>

                                            @if ($product->discount_price > 0)
                                                @if ($product->discount_type == 1)
                                                    <small>৳{{ $product->discount_price }} off</small>
                                                @elseif($product->discount_type == 2)
                                                    <small>{{ $product->discount_price }}% off</small>
                                                @endif
                                            @endif
                                        </p>
                                    @else
                                        <p class="ps-product__price sale">
                                            ৳{{ $product->regular_price }}
                                        </p>
                                    @endif
                                    {{-- <p>{{ $product->product_point }}</p> --}}
                                    <div class="ps-product__content">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                        @endif
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                            @if ($product->is_varient == 1)
                                                <!-- start varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <!-- end varient product add to cart direct -->
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <!-- start not varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- featured category show -->
    @if (count($featured_category) > 0)
        <div class="ps-top-categories" style="padding: 10px 0 0px !important;">
            <div class="ps-container">
                <h3>Featured Categories</h3>
                <div class="row">
                    @foreach ($featured_category as $category)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                            <div class="ps-block--category">
                                <a class="ps-block__overlay" href="#"></a>
                                <img src="{{ asset($category->category_image) }}" alt="">
                                <p>
                                    @if (session()->get('language') == 'bangla')
                                        {{ Str::limit($category->category_name_bn, 14) }}
                                    @else
                                        {{ Str::limit($category->category_name_en, 14) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @php
        $featured_banner = App\Models\Banner::where('status', 1);
    @endphp
    <!-- collection banner show -->
    <div class="ps-home-ads" style="margin-bottom:30px;">
        <div class="ps-container">
            <div class="row">

                @foreach ($featured_banner->skip(2)->take(3)->get() as $banner)
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection"
                            href="#"><img width="530" height="285"
                                src="{{ asset($banner->banner_image) }}" alt=""></a>
                    </div>
                @endforeach

                <!--<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img width="530" height="285" src="{{ asset('frontend/assets/img/collection/2.jpg ') }}" alt=""></a>-->
                <!--</div>-->
                <!--<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img width="530" height="285" src="{{ asset('frontend/assets/img/collection/1.jpg ') }}" alt=""></a>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <!-- featured product show -->
    <div class="ps-product-list ps-clothings">
        <div class="ps-container">
            <div class="ps-section__header">
                <h3>Featured products</h3>
                <ul class="ps-section__links">
                    <!--  <li><a href="shop-grid.html">New Arrivals</a></li>
                    <li><a href="shop-grid.html">Best seller</a></li>
                    <li><a href="shop-grid.html">Must Popular</a></li> -->
                    <li><a href="{{ route('product.view.all') }}">View All</a></li>
                </ul>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                    data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true"
                    data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3"
                    data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    @include('frontend.common.product_grid_view')
                </div>
            </div>
        </div>
    </div>
    <!-- hot deals product show -->
    @if (count($hot_deals) > 0)
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header" style="background-color: #f4f4f4;">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>Hot Deals</h3>
                        </div>
                    </div>
                    <a href="{{ route('product.view.all') }}">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                        data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true"
                        data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4"
                        data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($hot_deals as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        </a>
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                            alt="" />
                                    @endif
                                    <a class="ps-product__vendor mt-3" href="#">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->category->category_name_bn ?? 'NULL' }}
                                        @else
                                            {{ $product->category->category_name_en ?? 'NULL' }}
                                        @endif
                                    </a>
                                    @php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                    @endphp

                                    @if ($product->discount_price > 0)
                                        @if ($product->discount_type == 1)
                                            <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                        @elseif($product->discount_type == 2)
                                            <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
                                        @endif
                                    @endif
                                    <ul class="ps-product__actions">
                                        @if ($product->is_varient == 1)
                                            <!--<li>-->
                                            <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                            <!--</li>-->
                                            <!-- start varient product add to cart direct -->
                                            <li>
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"
                                                    style="cursor:pointer;"><i class="icon-bag2"></i></a>
                                            </li>
                                            <!-- end varient product add to cart direct -->
                                            <li>
                                                <a href="#" id="{{ $product->id }}"
                                                    onclick="productView(this.id)" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#product-quickview"><i class="icon-eye"></i>
                                                </a>
                                            </li>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id"
                                                value="{{ $product->id }}" min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <li>
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"><i class="icon-bag2"
                                                        style="cursor:pointer;"></i></a>
                                            </li>
                                            <!-- end not varient product add to cart direct -->

                                            <!--<li>-->
                                            <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                        @endif
                                        <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist"
                                                style="cursor: pointer;"><i class="icon-heart"></i></a></li>
                                        <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                    class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                                <div class="ps-product__container">
                                    @if ($product->discount_price > 0)
                                        <p class="ps-product__price sale">
                                            ৳{{ $price_after_discount }}
                                            <del>৳ {{ $product->regular_price }}</del>

                                            @if ($product->discount_price > 0)
                                                @if ($product->discount_type == 1)
                                                    <small>৳{{ $product->discount_price }} off</small>
                                                @elseif($product->discount_type == 2)
                                                    <small>{{ $product->discount_price }}% off</small>
                                                @endif
                                            @endif
                                        </p>
                                    @else
                                        <p class="ps-product__price sale">
                                            ৳{{ $product->regular_price }}
                                        </p>
                                    @endif
                                    {{-- <p>{{ $product->product_point }}</p> --}}
                                    <div class="ps-product__content">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                        @endif
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                            @if ($product->is_varient == 1)
                                                <!-- start varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <!-- end varient product add to cart direct -->
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <!-- start not varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-danger">No Product Found</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- 1st category to product show -->
    @if (count($skip_product_0) > 0)
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header" style="background-color: #f4f4f4;">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>
                                @if (session()->get('language') == 'bangla')
                                    {{ $skip_category_0->category_name_bn ?? 'Null' }}
                                @else
                                    {{ $skip_category_0->category_name_en ?? 'Null' }}
                                @endif
                            </h3>
                        </div>
                    </div>
                    <a href="{{ route('product.view.all') }}">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                        data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true"
                        data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4"
                        data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($skip_product_0 as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        </a>
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                            alt="" />
                                    @endif

                                    <a class="ps-product__vendor mt-3" href="#">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->category->category_name_bn ?? 'NULL' }}
                                        @else
                                            {{ $product->category->category_name_en ?? 'NULL' }}
                                        @endif
                                    </a>

                                    @php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                    @endphp

                                    @if ($product->discount_price > 0)
                                        @if ($product->discount_type == 1)
                                            <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                        @elseif($product->discount_type == 2)
                                            <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
                                        @endif
                                    @endif
                                    <ul class="ps-product__actions">
                                        @if ($product->is_varient == 1)
                                            <!--<li>-->
                                            <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                            <!--</li>-->
                                            <!-- start varient product add to cart direct -->
                                            <li>
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"
                                                    style="cursor:pointer;"><i class="icon-bag2"></i></a>
                                            </li>
                                            <!-- end varient product add to cart direct -->
                                            <li>
                                                <a href="#" id="{{ $product->id }}"
                                                    onclick="productView(this.id)" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#product-quickview"><i class="icon-eye"></i>
                                                </a>
                                            </li>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id"
                                                value="{{ $product->id }}" min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <li>
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"><i class="icon-bag2"
                                                        style="cursor:pointer;"></i></a>
                                            </li>
                                            <!-- end not varient product add to cart direct -->

                                            <!--<li>-->
                                            <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                        @endif
                                        <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist"
                                                style="cursor: pointer;"><i class="icon-heart"></i></a></li>
                                        <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                    class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                                <div class="ps-product__container">
                                    @if ($product->discount_price > 0)
                                        <p class="ps-product__price sale">
                                            ৳{{ $price_after_discount }}
                                            <del>৳ {{ $product->regular_price }}</del>

                                            @if ($product->discount_price > 0)
                                                @if ($product->discount_type == 1)
                                                    <small>৳{{ $product->discount_price }} off</small>
                                                @elseif($product->discount_type == 2)
                                                    <small>{{ $product->discount_price }}% off</small>
                                                @endif
                                            @endif
                                        </p>
                                    @else
                                        <p class="ps-product__price sale">
                                            ৳{{ $product->regular_price }}
                                        </p>
                                    @endif
                                    {{-- <p>{{ $product->product_point }}</p> --}}
                                    <div class="ps-product__content">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                        @endif
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                            @if ($product->is_varient == 1)
                                                <!-- start varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <!-- end varient product add to cart direct -->
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <!-- start not varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-danger">No Product Found</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- 2nd category to product show -->
    @if (count($skip_product_2) > 0)
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header" style="background-color: #f4f4f4;">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>
                                @if (session()->get('language') == 'bangla')
                                    {{ $skip_category_2->category_name_bn ?? 'Null' }}
                                @else
                                    {{ $skip_category_2->category_name_en ?? 'Null' }}
                                @endif
                            </h3>
                        </div>
                    </div>
                    <a href="{{ route('product.view.all') }}">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                        data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true"
                        data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4"
                        data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($skip_product_2 as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        </a>
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                            alt="" />
                                    @endif

                                    <a class="ps-product__vendor mt-3" href="#">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->category->category_name_bn ?? 'NULL' }}
                                        @else
                                            {{ $product->category->category_name_en ?? 'NULL' }}
                                        @endif
                                    </a>

                                    @php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                    @endphp

                                    @if ($product->discount_price > 0)
                                        @if ($product->discount_type == 1)
                                            <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                        @elseif($product->discount_type == 2)
                                            <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
                                        @endif
                                    @endif
                                    <ul class="ps-product__actions">
                                        @if ($product->is_varient == 1)
                                            <!--<li>-->
                                            <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                            <!--</li>-->
                                            <!-- start varient product add to cart direct -->
                                            <li>
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"
                                                    style="cursor:pointer;"><i class="icon-bag2"></i></a>
                                            </li>
                                            <!-- end varient product add to cart direct -->
                                            <li>
                                                <a href="#" id="{{ $product->id }}"
                                                    onclick="productView(this.id)" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#product-quickview"><i class="icon-eye"></i>
                                                </a>
                                            </li>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id"
                                                value="{{ $product->id }}" min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <li>
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"><i class="icon-bag2"
                                                        style="cursor:pointer;"></i></a>
                                            </li>
                                            <!-- end not varient product add to cart direct -->

                                            <!--<li>-->
                                            <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                        @endif
                                        <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist"
                                                style="cursor: pointer;"><i class="icon-heart"></i></a></li>
                                        <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                    class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                                <div class="ps-product__container">
                                    @if ($product->discount_price > 0)
                                        <p class="ps-product__price sale">
                                            ৳{{ $price_after_discount }}
                                            <del>৳ {{ $product->regular_price }}</del>

                                            @if ($product->discount_price > 0)
                                                @if ($product->discount_type == 1)
                                                    <small>৳{{ $product->discount_price }} off</small>
                                                @elseif($product->discount_type == 2)
                                                    <small>{{ $product->discount_price }}% off</small>
                                                @endif
                                            @endif
                                        </p>
                                    @else
                                        <p class="ps-product__price sale">
                                            ৳{{ $product->regular_price }}
                                        </p>
                                    @endif
                                    {{-- <p>{{ $product->product_point }}</p> --}}
                                    <div class="ps-product__content">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                        @endif
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                            @if ($product->is_varient == 1)
                                                <!-- start varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <!-- end varient product add to cart direct -->
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <!-- start not varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-danger">No Product Found</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- 3rd category to product show -->
    @if (count($skip_product_7) > 0)
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header" style="background-color: #f4f4f4;">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>
                                @if (session()->get('language') == 'bangla')
                                    {{ $skip_category_7->category_name_bn ?? 'Null' }}
                                @else
                                    {{ $skip_category_7->category_name_en ?? 'Null' }}
                                @endif
                            </h3>
                        </div>
                    </div>
                    <a href="{{ route('product.view.all') }}">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false"
                        data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true"
                        data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4"
                        data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($skip_product_7 as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        </a>
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                            alt="" />
                                    @endif

                                    <a class="ps-product__vendor mt-3" href="#">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->category->category_name_bn ?? 'NULL' }}
                                        @else
                                            {{ $product->category->category_name_en ?? 'NULL' }}
                                        @endif
                                    </a>

                                    @php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                    @endphp

                                    @if ($product->discount_price > 0)
                                        @if ($product->discount_type == 1)
                                            <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                        @elseif($product->discount_type == 2)
                                            <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
                                        @endif
                                    @endif
                                    <ul class="ps-product__actions">
                                        @if ($product->is_varient == 1)
                                            <!--<li>-->
                                            <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                            <!--</li>-->
                                            <!-- start varient product add to cart direct -->
                                            <li>
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"
                                                    style="cursor:pointer;"><i class="icon-bag2"></i></a>
                                            </li>
                                            <!-- end varient product add to cart direct -->
                                            <li>
                                                <a href="#" id="{{ $product->id }}"
                                                    onclick="productView(this.id)" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#product-quickview"><i class="icon-eye"></i>
                                                </a>
                                            </li>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id"
                                                value="{{ $product->id }}" min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <li>
                                                <a onclick="addToCartDirect({{ $product->id }})"
                                                    data-placement="top" title="Add To Cart"><i class="icon-bag2"
                                                        style="cursor:pointer;"></i></a>
                                            </li>
                                            <!-- end not varient product add to cart direct -->

                                            <!--<li>-->
                                            <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                        @endif
                                        <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist"
                                                style="cursor: pointer;"><i class="icon-heart"></i></a></li>
                                        <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                    class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                                <div class="ps-product__container">
                                    @if ($product->discount_price > 0)
                                        <p class="ps-product__price sale">
                                            ৳{{ $price_after_discount }}
                                            <del>৳ {{ $product->regular_price }}</del>

                                            @if ($product->discount_price > 0)
                                                @if ($product->discount_type == 1)
                                                    <small>৳{{ $product->discount_price }} off</small>
                                                @elseif($product->discount_type == 2)
                                                    <small>{{ $product->discount_price }}% off</small>
                                                @endif
                                            @endif
                                        </p>
                                    @else
                                        <p class="ps-product__price sale">
                                            ৳{{ $product->regular_price }}
                                        </p>
                                    @endif
                                    {{-- <p>{{ $product->product_point }}</p> --}}
                                    <div class="ps-product__content">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                        @endif
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                            @if ($product->is_varient == 1)
                                                <!-- start varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <!-- end varient product add to cart direct -->
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <!-- start not varient product add to cart direct -->
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <input type="hidden" id="buyNowCheckHome" value="0">
                                                <input type="hidden" id="{{ $product->id }}-product_color"
                                                    value="{{ $product->product_color }}">
                                                <input type="hidden" id="{{ $product->id }}-product_size"
                                                    value="{{ $product->product_size }}">
                                                <div class="d-flex">
                                                    <a href="#" id="{{ $product->id }}"
                                                        onclick="productView(this.id)" data-toggle="modal"
                                                        data-target="#product-quickview"
                                                        class="btn btn-success btn-sm mt-3 btn-block ">
                                                        @if (session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add To Cart
                                                        @endif
                                                    </a>
                                                    <a onclick="buyNowHome({{ $product->id }})"
                                                        class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                        @if (session()->get('language') == 'bangla')
                                                            অর্ডার করুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-danger">No Product Found</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- new arrivals product show -->
    @if (count($new_arrivals) > 0)
        <div class="ps-product-list ps-new-arrivals">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Hot New Arrivals</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('product.view.all') }}">View All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        @foreach ($new_arrivals as $product)
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                                <div class="ps-product--horizontal">
                                    <div class="ps-product__thumbnail">
                                        @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                            <a href="{{ route('product.details', $product->slug) }}">
                                                <img src="{{ asset($product->product_thumbnail) }}"
                                                    alt="" />
                                            </a>
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                                alt="" />
                                        @endif
                                    </div>
                                    <div class="ps-product__content">
                                        <a class="ps-product__title"
                                            href="{{ route('product.details', $product->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                                {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                                            @else
                                                <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                                {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
                                            @endif
                                        </a>
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                @if ($avarage == 0)
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">1</option>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                    <option value="1">1</option>
                                                @endif
                                            </select><span>({{ count($reviewcount) }})</span>
                                            <!-- <span>01</span> -->
                                        </div>
                                        @php
                                            if ($product->discount_type == 1) {
                                                $price_after_discount = $product->regular_price - $product->discount_price;
                                            } elseif ($product->discount_type == 2) {
                                                $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                            }
                                        @endphp

                                        @if ($product->discount_price > 0)
                                            <p class="ps-product__price sale">
                                                ৳{{ $price_after_discount }}
                                                <del>৳ {{ $product->regular_price }}</del>
                                            </p>
                                        @else
                                            <p class="ps-product__price sale">
                                                ৳{{ $product->regular_price }}
                                            </p>
                                        @endif
                                        {{-- <p class="ps-product__title">{{ $product->product_point  }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- latest blog show -->
    @if (count($latest_blog) > 0)
        <div class="ps-section--default ps-home-blog">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>News</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('product.view.all') }}">See All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        @foreach ($latest_blog as $blog)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                <div class="ps-post">
                                    <div class="ps-post__thumbnail">
                                        <a class="ps-post__overlay"
                                            href="{{ route('blog.details', $blog->blog_slug_en) }}"></a>
                                        <img src="{{ asset($blog->blog_image) }}" alt="">
                                    </div>
                                    <div class="ps-post__content">
                                        <a class="ps-post__meta"
                                            href="{{ route('blog.details', $blog->blog_slug_en) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $blog->blog_title_bn }}
                                            @else
                                                {{ $blog->blog_title_en }}
                                            @endif
                                        </a>
                                        <a class="ps-post__title"
                                            href="{{ route('blog.details', $blog->blog_slug_en) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {!! Str::limit($blog->blog_description_bn ?? 'NULL', 25) !!}
                                            @else
                                                {!! Str::limit($blog->blog_description_en ?? 'NULL', 25) !!}
                                            @endif
                                        </a>
                                        <p>
                                            {{ $blog->created_at->format('l jS \\of F Y h:i:s A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- deliver/return section show -->
    {{-- <div class="ps-site-features">
        <div class="ps-container">
            <div class="ps-block--site-features">
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-rocket"></i></div>
                    <div class="ps-block__right">
                        <h4>Free Delivery</h4>
                        <p>For all oders over $99</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-sync"></i></div>
                    <div class="ps-block__right">
                        <h4>90 Days Return</h4>
                        <p>If goods have problems</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                    <div class="ps-block__right">
                        <h4>Secure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                    <div class="ps-block__right">
                        <h4>24/7 Support</h4>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-gift"></i></div>
                    <div class="ps-block__right">
                        <h4>Gift Service</h4>
                        <p>Support gift service</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- best seller brands  show -->
    @if (count($latest_brand) > 0)
        <div class="ps-best-sale-brands ps-section--furniture">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>BEST SELLER BRANDS</h3>
                </div>
                <div class="ps-section__content">
                    <ul class="ps-image-list">
                        @foreach ($latest_brand as $brand)
                            <li>
                                <a href="#">
                                    <img src="{{ asset($brand->brand_image) }}" alt="" width="114"
                                        height="105">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
