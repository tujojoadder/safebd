@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   {{ $product->name_en }}
@endsection
 <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li>
                	<a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                	@if(session()->get('language') == 'bangla')
						{{ $product->name_bn ?? 'NULL' }}
					@else
						{{ $product->name_en ?? 'NULL' }}
					@endif
                </li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            <div class="ps-page__container">
                <div class="ps-page__left">
                    <div class="ps-product--detail ps-product--fullwidth">
                        <div class="ps-product__header">
                            <div class="ps-product__thumbnail" data-vertical="false">
                                <figure>
                                    <div class="ps-wrapper">
                                        <div class="ps-product__gallery" data-arrow="true">
                                        	@foreach($product->multi_imgs as $img)
                                            <div class="item">
                                            	<a href="{{ asset($img->photo_name) }}">
                                            		<img src="{{ asset($img->photo_name) }}" alt="">
                                            	</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </figure>
                                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                	@foreach($product->multi_imgs as $img)
                                    <div class="item">
                                    	<img src="{{ asset($img->photo_name) }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ps-product__info">
                                <h1>
                                	@if(session()->get('language') == 'bangla')
										{{ $product->name_bn ?? 'NULL' }}
									@else
										{{ $product->name_en ?? 'NULL' }}
									@endif
                                </h1>
                                <div class="ps-product__meta">
                                    <p>Brand:
                                    	<a href="#">
	                                    	@if(session()->get('language') == 'bangla')
												{{ $product->brand->brand_name_bn ?? 'NULL' }}
											@else
												{{ $product->brand->brand_name_en ?? 'NULL' }}
											@endif
                                    	</a>
                                    </p>
                                    @php
                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                    @endphp
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            @if($avarage == 0)
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
                                        </select><span>({{ count($reviewcount)}})</span>
                                    </div>
                                </div>
                                @php
					                if($product->discount_type == 1){
					                    $price_after_discount = $product->regular_price - $product->discount_price;
					                }elseif($product->discount_type == 2){
					                    $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
					                }
					            @endphp

                                @if ($product->discount_price > 0)
	                                <h4 class="ps-product__price sale">
	                                	৳{{ $price_after_discount }}
						                <del>৳ {{ $product->regular_price }}</del>
	                                </h4>
					            @else
						            <h4 class="ps-product__price sale">
	                                	৳{{ $product->regular_price }}

	                                </h4>
					            @endif
                                <div class="ps-product__desc">
                                    <ul class="ps-list--dot">
                                        <li>
                                        	@if(session()->get('language') == 'bangla')
						                        {!! $product->description_bn ?? 'No Decsription' !!}
						                    @else
						                        {!! $product->description_en ?? 'No Decsription' !!}
						                    @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="row">
                                	<div class="col-md-6">
                                		@if($product->product_size == NULL)

		                                @else
										    <div class="attr-detail attr-size mb-30">
										        <strong class="mr-10" style="width:50px;">Size : </strong>
										         <select class="form-control unicase-form-control" id="dsize">
										         	{{-- <option selected="" disabled="">--Choose Size--</option> --}}
										         	@foreach($product_size as $size)
										         	<option value="{{ $size }}">{{ ucwords($size)  }}</option>
										         	@endforeach
										         </select>
										    </div>
									    @endif
                                	</div>
                                	<div class="col-md-6">
                                		@if($product->product_color == NULL)

                                		@else
                                		<div class="attr-detail attr-size mb-30">
									        <strong class="mr-10" style="width:50px;">Color : </strong>
									        <select class="form-control unicase-form-control" id="dcolor">
									         	{{-- <option selected="" disabled="">--Choose Color--</option> --}}
									         	@foreach($product_color as $color)
									         	<option value="{{ $color }}">{{ ucwords($color)  }}</option>
									         	@endforeach
									         </select>
									    </div>
									    @endif
                                	</div>
                                </div>

                                <!-- <div class="ps-product__variations">
                                    <figure>
                                        <figcaption>Color</figcaption>
                                        <div class="ps-variant ps-variant--color color--1"><span class="ps-variant__tooltip">Black</span></div>
                                        <div class="ps-variant ps-variant--color color--2"><span class="ps-variant__tooltip"> Gray</span></div>
                                    </figure>
                                </div> -->
                                <div class="ps-product__shopping">
                                    <figure>
                                        <figcaption>Quantity</figcaption>
                                        <div class="form-group--number">
                                           <!--  <button class="up"><i class="fa fa-plus"></i></button>
                                            <button class="down"><i class="fa fa-minus"></i></button> -->
                                            <input type="number" name="quantity" class="qty-val form-control" value="1" min="1" id="qtyd">
                                        </div>
                                    </figure>
                                    @php
	                            		$discount = 0;
										$amount = $product->regular_price;

	                            		if($product->discount_price > 0){
	                            			if($product->discount_type == 1){
	                            				$discount = $product->discount_price;
	                            				$amount = $product->regular_price - $discount;
	                            			}else if($product->discount_type == 2){
	                            				$discount = $product->regular_price * $product->discount_price / 100;
	                            				$amount = $product->regular_price - $discount;
	                            			}else{
	                            				$amount = $product->regular_price;
	                            			}
	                            		}

	                          		@endphp

                                    <input type="hidden" id="product_idd" value="{{ $product->id }}"  min="1">

                                	<input type="hidden" id="pnamed" value="{{ $product->name_en }}">

                                	<input type="hidden" id="product_priced" value="$amount">

                                	<input type="hidden" id="pvarientd" value="">

                                    <input type="hidden" id="buyNowCheck" value="0">

                                	<figure>
                                    	<figcaption></figcaption>
                                    	<a class="btn btn-success btn-lg text-light" onclick="addToCartDetails()">Add to cart</a>
                                    </figure>
                                    <figure>
                                    	<figcaption></figcaption>
                                    	<a class="btn btn-danger btn-lg text-light" onclick="buyNow()">Buy Now</a>
                                    </figure>
                                    <!-- <a class="ps-btn" href="#">Buy Now</a> -->
                                   <!--  <div class="ps-product__actions">
                                    	<a href="#"><i class="icon-heart"></i></a>
                                    	<a href="#"><i class="icon-chart-bars"></i></a>
                                    </div> -->
                                </div>
                                <div class="ps-product__specification">
                                	<!-- <a class="report" href="#">Report Abuse</a>
                                    <p><strong>SKU:</strong> SF1133569600-1</p> -->
                                    <div class="row">
                                    	<div class="col-md-6">
                                    		<p class="categories">
		                                    	<strong> Categories:</strong>
		                                    	<a href="#">
		                                    		@if(session()->get('language') == 'bangla')
										            	{{ $product->category->category_name_bn ?? 'NULL' }}
										            @else
										            	{{ $product->category->category_name_en ?? 'NULL' }}
										            @endif
		                                    	</a>
		                                    </p>
		                                    <p class="categories">
		                                    	<strong> Tags:</strong>
		                                    	<a href="#">
		                                    		{{ $product->product_tag ?? 'NULL' }}
		                                    	</a>
		                                    </p>
		                                    {{-- <p class="categories">
		                                    	<strong> Product Point:</strong>
		                                    	<a href="#">
		                                    		{{ $product->product_point ?? '0' }}
		                                    	</a>
		                                    </p> --}}
                                    	</div>
                                    	<div class="col-md-6">
                                    		<p class="categories">
		                                    	<strong> Product Code:</strong>
		                                    	<a href="#">
		                                    		{{ $product->product_code ?? 'NULL' }}
		                                    	</a>
		                                    </p>
		                                    <p class="categories">
		                                    	<strong> Regular Price:</strong>
		                                    	<a href="#">
		                                    		{{ $product->regular_price ?? 'NULL'}}
		                                    	</a>
		                                    </p>
		                                    <p class="categories">
		                                    	<strong> Product Stock (Qty):</strong>
		                                    	<a href="#">
		                                    		{{ $product->stock_qty ?? 'NULL'}}
		                                    	</a>
		                                    </p>
                                    	</div>
                                    </div>
                                </div>
                                <!-- <div class="ps-product__sharing">
                                	<a class="facebook" href="#">
                                		<i class="fa fa-facebook"></i>
                                	</a>
                                	<a class="twitter" href="#">
                                		<i class="fa fa-twitter"></i>
                                	</a>
                                	<a class="google" href="#">
                                		<i class="fa fa-google-plus"></i>
                                	</a>
                                	<a class="linkedin" href="#">
                                		<i class="fa fa-linkedin"></i>
                                	</a>
                                	<a class="instagram" href="#">
                                		<i class="fa fa-instagram"></i>
                                	</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="ps-product__content ps-tab-root">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#tab-1">Description</a></li>
                                <li><a href="#tab-2">Specification</a></li>
                                {{-- <li><a href="#tab-3">Vendor</a></li> --}}
                                @php
                                    $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                    $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                    $avarage_sum = App\Models\Review::where('product_id',$product->id)->where('status',1)->sum('rating');
                                    // dd($avarage_sum);
                                    $review = App\Models\Review::where('status',0)->orderBy('id','DESC')->get();
                                @endphp
                                <li><a href="#tab-4">Reviews ({{ count($reviewcount)}})</a></li>
                                {{-- <li><a href="#tab-5">Questions and Answers</a></li>
                                <li><a href="#tab-6">More Offers</a></li> --}}
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="ps-document">
                                        <p>
                                        	@if(session()->get('language') == 'bangla')
								            	{{ $product->description_bn ?? 'NULL' }}
								            @else
								            	{{ $product->description_en ?? 'NULL' }}
								            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-2">
                                    <div class="table-responsive">
                                        <table class="table table-bordered ps-table ps-table--specification">
                                            <tbody>
                                            	<tr>
                                                    <td>Product Name</td>
                                                    <td>
                                                    	@if(session()->get('language') == 'bangla')
															{{ $product->name_bn ?? 'NULL' }}
														@else
															{{ $product->name_en ?? 'NULL' }}
														@endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Color</td>
                                                    <td>{{ $product->product_color}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Size</td>
                                                    <td>{{ $product->product_size}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tag</td>
                                                    <td>{{ $product->product_tag}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Brand</td>
                                                    <td>
                                                    	@if(session()->get('language') == 'bangla')
															{{ $product->brand->brand_name_bn ?? 'NULL' }}
														@else
															{{ $product->brand->brand_name_en ?? 'NULL' }}
														@endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>
                                                    	@if(session()->get('language') == 'bangla')
												            {{ $product->category->category_name_bn ?? 'NULL' }}
												        @else
												            {{ $product->category->category_name_en ?? 'NULL' }}
												        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Regular Price</td>
                                                    <td>{{ $product->regular_price ?? '0' }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Product Point</td>
                                                    <td>{{ $product->product_point ?? '0' }}</td>
                                                </tr> --}}
                                                <tr>
                                                    <td>Product Code</td>
                                                    <td>{{ $product->product_code ?? '0' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Product Stock (Qty):</td>
                                                    <td>{{ $product->stock_qty ?? '0' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-3">
                                    <h4>GoPro</h4>
                                    <p>Digiworld US, New York’s no.1 online retailer was established in May 2012 with the aim and vision to become the one-stop shop for retail in New York with implementation of best practices both online</p><a href="#">More Products from gopro</a>
                                </div>
                                <div class="ps-tab" id="tab-4">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                            <div class="ps-block--average-rating">
                                                @if(count($reviewcount) > 0)
                                                <div class="ps-block__header">
                                                    <h3>{{ floor($avarage)}}</h3>
                                                    <select class="ps-rating" data-read-only="true">
                                                        @if($avarage == 0)
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
                                                    </select>

                                                    <span>{{ count($reviewcount)}} Review</span>
                                                </div>
                                                @endif
                                                @if($avarage == 0)

                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <div class="ps-block__star"><span>{{ floor($avarage)}} Star</span>
                                                        <div class="ps-progress" data-value="20"><span></span></div><span>20%</span>
                                                    </div>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <div class="ps-block__star"><span>{{ floor($avarage)}} Star</span>
                                                        <div class="ps-progress" data-value="40"><span></span></div><span>40%</span>
                                                    </div>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <div class="ps-block__star"><span>{{ floor($avarage)}} Star</span>
                                                        <div class="ps-progress" data-value="60"><span></span></div><span>60%</span>
                                                    </div>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <div class="ps-block__star"><span>{{ floor($avarage)}} Star</span>
                                                        <div class="ps-progress" data-value="80"><span></span></div><span>80%</span>
                                                    </div>
                                                @elseif($avarage == 5 || $avarage < 6)
                                                    <div class="ps-block__star"><span>{{ floor($avarage)}} Star</span>
                                                        <div class="ps-progress" data-value="100"><span></span></div><span>100%</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                            @guest
                                            <p> <b>For Add Product Review. You Need To Login First <a href="{{ route('login')}}" class="btn btn-success text-white btn-lg">Login Here </a> </b></p>

                                            @else
                                            <form class="ps-form--review" action="{{ route('store.review') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <h4>Submit Your Review</h4>
                                                <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                                                <div class="form-group form-group__rating">
                                                    <label>Your rating of this product</label>
                                                    <select class="ps-rating" data-read-only="false">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <style>
                                                    input[type=checkbox], input[type=radio] {
                                                        box-sizing: border-box;
                                                        margin: 27px 0px !important;
                                                    }
                                                </style>
                                                <tr>
                                                    <td class="cell-level p-5">Quality</td>
                                                    <td><input type="radio" name="quality" class="radio-sm" value="1"></td>
                                                    <td><input type="radio" name="quality" class="radio-sm" value="2"></td>
                                                    <td><input type="radio" name="quality" class="radio-sm" value="3"></td>
                                                    <td><input type="radio" name="quality" class="radio-sm" value="4"></td>
                                                    <td><input type="radio" name="quality" class="radio-sm" value="5"></td>
                                                </tr>

                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment" id="comment" rows="6" placeholder="Write your review here"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}" readonly placeholder="Your Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" readonly placeholder="Your Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group submit">
                                                    <button class="ps-btn" type="submit">Submit Review</button>
                                                </div>
                                            </form>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-5">
                                    <div class="ps-block--questions-answers">
                                        <h3>Questions and Answers</h3>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Have a question? Search for answer?">
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-tab active" id="tab-6">
                                    <p>Sorry no more offers available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-page__right">
                    <aside class="widget widget_product widget_features">
                        <p><i class="icon-network"></i> Shipping worldwide</p>
                        <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                        <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                        <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                    </aside>
                    <aside class="widget widget_sell-on-site">
                        <p><i class="icon-store"></i> Sell on Martfury?<a href="#"> Register Now !</a></p>
                    </aside>
                    <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>
                   <!--  <aside class="widget widget_same-brand">
                        <h3>Same Brand</h3>
                        <div class="widget__content">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail">
                                	<a href="product-default.html">
                                		<img src="{{ asset('frontend/img/products/shop/5.jpg ')}}" alt="" />
                                	</a>
                                    <div class="ps-product__badge">-37%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/6.jpg" alt="" /></a>
                                    <div class="ps-product__badge">-5%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside> -->
                </div>
            </div>

            <div class="ps-section--default">
                <div class="ps-section__header">
                    <h3>Related products</h3>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($relatedProduct as $product)
                        <div class="ps-product ps-product--inner">
                            <div class="ps-product__thumbnail">
                                @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                <a href="{{ route('product.details',$product->slug) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                                </a>
                                @else
                                    <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                @endif

                                <a class="ps-product__vendor mt-3" href="#">
                                    @if(session()->get('language') == 'bangla')
                                    {{ $product->category->category_name_bn ?? 'NULL' }}
                                    @else
                                    {{ $product->category->category_name_en ?? 'NULL' }}
                                    @endif
                                </a>

                                @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                @endphp

                                @if($product->discount_price > 0)
                                    @if($product->discount_type == 1)
                                    <div class="ps-product__badge">৳{{ $product->discount_price }} off</div>
                                    @elseif($product->discount_type == 2)
                                    <div class="ps-product__badge">{{ $product->discount_price }}% off</div>
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

                                        <li>
                                            <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Add To Cart"><i class="icon-bag2" style="cursor:pointer;"></i></a>
                                        </li>
                                        <!-- end not varient product add to cart direct -->

                                        <!--<li>-->
                                        <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View"><i class="icon-eye" style="cursor:pointer;"></i>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                    @endif
                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a>
                                    </li>
                                    <li><a  style="cursor: pointer;" onclick="addToCompare({{ $product->id }})"  data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            @php
                                if($product->discount_type == 1){
                                    $price_after_discount = $product->regular_price - $product->discount_price;
                                }elseif($product->discount_type == 2){
                                    $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                }
                            @endphp
                            <div class="ps-product__container">
                                @if ($product->discount_price > 0)
                                <p class="ps-product__price sale">
                                    ৳{{ $price_after_discount }}
                                    <del>৳ {{ $product->regular_price }}</del>

                                    @if($product->discount_price > 0)
                                        @if($product->discount_type == 1)
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
                                    @if(session()->get('language') == 'bangla')
                                        <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                        {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                    @else
                                        <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                        {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                    @endif
                                    @php
                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                    @endphp
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            @if($avarage == 0)
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
                                        </select><span>({{ count($reviewcount)}})</span>
                                        <!-- <span>01</span> -->
                                        @if($product->is_varient == 1)
                                            <!-- start varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                            <input type="hidden" id="buyNowCheckHome" value="0">
                                            <input type="hidden" id="{{ $product->id }}-product_color" value="{{ $product->product_color }}">
                                            <input type="hidden" id="{{ $product->id }}-product_size" value="{{ $product->product_size }}">
                                            <!-- end varient product add to cart direct -->
                                            <div class="d-flex">
                                                <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" class="btn btn-success btn-sm mt-3 btn-block ">
                                                    @if(session()->get('language') == 'bangla')
                                                        কার্টে যোগ করুন
                                                    @else
                                                        Add To Cart
                                                    @endif
                                                </a>
                                                <a  onclick="buyNowHome({{ $product->id }})" class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                    @if(session()->get('language') == 'bangla')
                                                        অর্ডার করুন
                                                    @else
                                                        Buy Now
                                                    @endif
                                                </a>
                                           </div>
                                        @else
                                            <!-- start not varient product add to cart direct -->
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                            <input type="hidden" id="buyNowCheckHome" value="0">
                                            <input type="hidden" id="{{ $product->id }}-product_color" value="{{ $product->product_color }}">
                                            <input type="hidden" id="{{ $product->id }}-product_size" value="{{ $product->product_size }}">
                                            <div class="d-flex">
                                                <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview" class="btn btn-success btn-sm mt-3 btn-block ">
                                                    @if(session()->get('language') == 'bangla')
                                                        কার্টে যোগ করুন
                                                    @else
                                                        Add To Cart
                                                    @endif
                                                </a>
                                                <a  onclick="buyNowHome({{ $product->id }})" class="btn btn-danger btn-sm mt-3 btn-block ml-2 text-light">
                                                    @if(session()->get('language') == 'bangla')
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
    </div>
@endsection
