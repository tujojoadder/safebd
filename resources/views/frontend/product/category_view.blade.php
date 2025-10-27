
@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   {{ $category->category_name_en }}
@endsection
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li>
            	<a href="{{ route('home') }}">Home</a>
            </li>
            <li>
            	@if(session()->get('language') == 'bangla')
					{{ $category->category_name_bn ?? 'NULL' }}
				@else
					{{ $category->category_name_en ?? 'NULL' }}
				@endif
            </li>
        </ul>
    </div>
</div>
<div class="ps-page--shop mt-5">
    <div class="ps-container">
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <form action="{{ URL::current() }}" method="GET">
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">BY BRANDS</h4>
                        <figure class="ps-custom-scrollbar" data-height="250">
                            @foreach($filter_brands as $brand)
                                @php
                                    $brand_product = App\Models\Product::where('brand_id',$brand->id)->paginate(10);

                                @endphp
                                @php
                                    $checked = [];
                                    if(isset($_GET['filterbrand'])){
                                        $checked = $_GET['filterbrand'];
                                    }
                                @endphp
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand_filter{{$brand->id}}" name="filterbrand[]" value="{{$brand->brand_name_en}}" @if(in_array($brand->brand_name_en, $checked)) checked @endif />

                                <label for="brand_filter{{$brand->id}}">{{ $brand->brand_name_en }} ({{ count($brand_product) }})</label>
                            </div>
                            @endforeach
                        </figure>
                        <h4 class="widget-title mt-5">BY CATEGORIES</h4>
                        <figure class="ps-custom-scrollbar" data-height="250">
                            @foreach($filter_categories as $category)

                                @php
                                    $category_product = App\Models\Product::where('category_id',$category->id)->paginate(10);

                                @endphp
                                @php
                                    $checked = [];
                                    if(isset($_GET['filtercategory'])){
                                        $checked = $_GET['filtercategory'];
                                    }
                                @endphp
                                <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" id="category_filter{{$category->id}}" name="filtercategory[]" value="{{$category->category_name_en}}" @if(in_array($category->category_name_en, $checked)) checked @endif />

                                    <label  for="category_filter{{$category->id}}">{{ $category->category_name_en }} ({{ count($category_product) }})</label>
                                </div>
                            @endforeach
                        </figure>
                        <button type="submit" class="ps-btn ps-btn--fullwidth" >
                            <i class="fi-rs-filter"></i> Fillter</button>
                    </aside>
                </form>
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong>{{ count($products) }}</strong> Products found</p>
                        <div class="ps-shopping__actions">
                            <select class="ps-select" data-placeholder="Sort Items">
                                <option>Sort by latest</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by price: low to high</option>
                                <option>Sort by price: high to low</option>
                            </select>
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
                                        <div class="ps-product ps-product--inner mb-5">
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
        <div class="modal" id="shop-filter-lastest" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action" href="#">Sort by</a>
                            <a class="list-group-item list-group-item-action" href="#">Sort by average rating</a>
                            <a class="list-group-item list-group-item-action" href="#">Sort by latest</a>
                            <a class="list-group-item list-group-item-action" href="#">Sort by price: low to high</a>
                            <a class="list-group-item list-group-item-action" href="#">Sort by price: high to low</a>
                            <a class="list-group-item list-group-item-action text-center" href="#" data-dismiss="modal"><strong>Close</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
