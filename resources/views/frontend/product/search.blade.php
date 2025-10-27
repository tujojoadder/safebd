
@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   Product Search
@endsection
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li>
            	<a href="{{ route('home') }}">Home</a>
            </li>
            <li>
            	Search Product
            </li>
        </ul>
    </div>
</div>
<style type="text/css">
	.ps-layout--shop .ps-layout__right {
		max-width: calc(125% - 320px) !important; 
    }
</style>
<style>
    @media(max-width: 767px) { 
        .ps-container { 
           width: 100%;
        }
        .ps-layout__left{
            display: none;
        }
        .ps-layout--shop .ps-layout__right {
		    max-width: calc(181% - 320px) !important;
		}
        .ps-layout__right{
        	width: 100%;
        }
    }
</style>
<div class="ps-page--shop mt-5">
    <div class="ps-container">
        <div class="ps-layout--shop">
        	
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong>{{ count($products) }}</strong> Products found</p>
                        <div class="ps-shopping__actions">
                            <!-- <select class="ps-select" data-placeholder="Sort Items">
                                <option>Sort by latest</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by price: low to high</option>
                                <option>Sort by price: high to low</option>
                            </select> -->
                            <div class="ps-shopping__view">
                                <p>View</p>
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                    <!-- <li><a href="#tab-2"><i class="icon-list4"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product">
                                <div class="row">
                                    @forelse($products as $product)
                                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                        <div class="ps-product">
                                            <div class="ps-product__thumbnail">
                                            	@if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                                    <a href="{{ route('product.details',$product->slug) }}">
                                                        <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                                    </a>

                                                @else
                                                    <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                                @endif

                                                @php
                                                    if($product->discount_type == 1){
                                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                                    }elseif($product->discount_type == 2){
                                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                                    }
                                                @endphp

                                                @if($product->discount_price > 0)
                                                    @if($product->discount_type == 1)
                                                        <div class="ps-product__badge">
                                                            ৳{{ $product->discount_price }} off
                                                        </div>
                                                    @elseif($product->discount_type == 2)
                                                        <div class="ps-product__badge">
                                                            {{ $product->discount_price }}% off
                                                        </div>
                                                    @endif
                                                @endif
                                                <ul class="ps-product__actions">
                                                    @if($product->is_varient == 1)
                                                        <!--<li>-->
                                                        <!--    <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a>-->
                                                        <!--</li>-->
                                                        <!-- start varient product add to cart direct -->
                                                        <li>
                                                            <input type="hidden" id="pfrom" value="direct">
                                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                                            <a  onclick="addToCartDirect({{ $product->id }})"  data-placement="top" title="Add To Cart"  style="cursor:pointer;"><i class="icon-bag2"></i></a>
                                                        </li>
                                                        <!-- end varient product add to cart direct -->
                                                        <li>
                                                            <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <!-- start not varient product add to cart direct -->
                                                        <input type="hidden" id="pfrom" value="direct">
                                                        <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                                        <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                                                        <!--<li>-->
                                                        <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Add To Cart" style="cursor:pointer;"><i class="icon-bag2"></i></a>  -->
                                                        <!--</li>-->

                                                        <li>
                                                            <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View" style="cursor:pointer;"><i class="icon-eye"></i>
                                                            </a>
                                                        </li>
                                                         <!-- end not varient product add to cart direct -->
                                                    @endif
                                                    <li>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__container">
                                                <a class="ps-product__vendor" href="{{ route('product.category', $product->category->slug) }}">
                                                    @if(session()->get('language') == 'bangla')
                                                        {{ $product->category->category_name_bn ?? 'NULL' }}
                                                    @else
                                                        {{ $product->category->category_name_en ?? 'NULL' }}
                                                    @endif
                                                </a>
                                                <div class="ps-product__content">
                                                    <a class="ps-product__title" href="{{ route('product.details',$product->slug) }}">
                                                        @if(session()->get('language') == 'bangla')
                                                            <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                                            {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                                        @else
                                                            <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                                        @endif
                                                    </a>
                                                    @php
                                                        if($product->discount_type == 1){
                                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                                        }elseif($product->discount_type == 2){
                                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
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
                                                </div>
                                                <div class="ps-product__content hover">
                                                    <a class="ps-product__title" href="{{ route('product.details',$product->slug) }}">
                                                        @if(session()->get('language') == 'bangla')
                                                            <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                                            {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                                        @else
                                                            <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                                        @endif
                                                    </a>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        @if(session()->get('language') == 'bangla') 
                                            <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
                                        @else 
                                            <h5 class="text-danger">No products were found here!</h5> 
                                        @endif
                                    @endforelse
                                </div>
                            </div>
                            <div class="ps-pagination">
                                <ul class="pagination">
                                    {{ $products->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection