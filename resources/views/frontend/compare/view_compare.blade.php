@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   My Compare Product
@endsection
<div class="ps-compare ps-section--shopping">
    <div class="container">
        <div class="ps-section__header">
            <h1>Compare Product</h1>
        </div>
        <div class="ps-section__content">
            <div class="table-responsive">
                <table class="table ps-table--compare">
                    <tbody>
                        <tr>
                            <td class="heading" rowspan="2">Product</td>
                            <td class="" colspan="2"></td>
                            <td><a style="float:right;" href="{{ route('compare.reset') }}">Remove</a></td>
                        </tr>
                        @if(Session::has('compare'))
	                        @if(count(Session::get('compare')) > 0)
	                        <tr>
	                        	@foreach (Session::get('compare') as $key => $item)
	                            <td>
	                                <div class="ps-product--compare">
	                                    <div class="ps-product__thumbnail">
	                                    	<a href="{{ route('product.details', \App\Models\Product::find($item)->slug) }}">
	                                    	<img src="{{ asset(\App\Models\Product::find($item)->product_thumbnail) }}" alt=""></a>
	                                    </div>
	                                    <div class="ps-product__content">
	                                    	<a href="{{ route('product.details', \App\Models\Product::find($item)->slug) }}">{{ \App\Models\Product::find($item)->name_en }}</a>
	                                    </div>
	                                </div>
	                            </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <td class="heading">Rating</td>
	                            <td>
	                                <select class="ps-rating" data-read-only="true">
	                                    <option value="1">1</option>
	                                    <option value="1">2</option>
	                                    <option value="1">3</option>
	                                    <option value="1">4</option>
	                                    <option value="2">5</option>
	                                </select>
	                            </td>
	                            <td>
	                                <select class="ps-rating" data-read-only="true">
	                                    <option value="1">1</option>
	                                    <option value="1">2</option>
	                                    <option value="1">3</option>
	                                    <option value="1">4</option>
	                                    <option value="2">5</option>
	                                </select>
	                            </td>
	                            <td>
	                                <select class="ps-rating" data-read-only="true">
	                                    <option value="1">1</option>
	                                    <option value="1">2</option>
	                                    <option value="1">3</option>
	                                    <option value="1">4</option>
	                                    <option value="2">5</option>
	                                </select>
	                            </td>
	                        </tr>
	                        <tr>
	                        	<td class="heading">Product Price</td>
	                        	@foreach (Session::get('compare') as $key => $item)
		                        	@php
	                                    $product = \App\Models\Product::find($item);
	                                @endphp

	                                @php
	                                    if($product->discount_type == 1){
	                                        $price_after_discount = $product->regular_price - $product->discount_price;
	                                    }elseif($product->discount_type == 2){
	                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
	                                    }
	                                @endphp
		                            <td>
			                            @if ($product->discount_price > 0)
			                                <h4 class="price sale">
			                                	৳{{ $price_after_discount }}
			                                	<del>৳ {{ $product->regular_price }}</del> 
			                                </h4>
			                            @else
			                                <div class="mb-1 product-price">
			                                    <span class="text-white fs-5">৳{{ $product->regular_price }}</span>
			                                </div>
			                            @endif
			                        </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <td class="heading">Availability</td>
	                            @foreach (Session::get('compare') as $key => $item)
		                        	@php
	                                    $product = \App\Models\Product::find($item);
	                                @endphp
		                            <td>
			                            @if ($product->stock_qty > 0)
						                    <span class="in-stock">In Stock</span>
						                @else
						                   <span class="out-stock">Out of Stock</span>
						                @endif
		                            </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <td class="heading">Product Brand</td>
	                            @foreach (Session::get('compare') as $key => $item)
                                    <td>
                                        @if (\App\Models\Product::find($item)->brand != null)
                                            {{ \App\Models\Product::find($item)->brand->brand_name_en }}
                                        @endif
                                    </td>
                                @endforeach
	                        </tr>
	                        <tr>
	                            <td class="heading">Product Category</td>
	                            @foreach (Session::get('compare') as $key => $item)
                                    <td>
                                        @if (\App\Models\Product::find($item)->category != null)
                                            {{ \App\Models\Product::find($item)->category->category_name_en }}
                                        @endif  
                                    </td>
                                @endforeach
	                        </tr>
	                        <tr>
	                            <td class="heading"></td>
	                            @foreach (Session::get('compare') as $key => $item)
	                            @php
                                    $product = \App\Models\Product::find($item);
                                @endphp
	                            <td>
	                            	@if($product->is_varient == 1)
	                            		<a class="ps-btn" href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-toggle="modal" data-target="#product-quickview">Add To Cart</a>
                                    @else

                                    	<input type="hidden" id="pfrom" value="direct">
                                    	<input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                    	<input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                                        <a onclick="addToCartDirect({{ $product->id }})"  class="ps-btn"></i>Add to Cart</a>
                                    @endif
	                            </td>
	                            @endforeach
	                        </tr>
	                        @endif
	                    @else
	                    	<tr>
	                    		<td colspan="0"></td>
	                            <td class="">Your comparison list is empty</td>
	                        </tr>
                    	@endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection