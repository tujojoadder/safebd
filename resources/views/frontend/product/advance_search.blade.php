<!-- <ul>
    @foreach($products as $item)
        <li>
            <img src="{{ asset($item->product_thumbnail) }}" style="width: 30px; height: 30px;">
            {{ $item->name_en }}</li>
    @endforeach
</ul> -->

<style>
.container{
    margin-left: 60px;
}
.card {
    background-color: #fff;
    padding: 15px;
    border: none;
    z-index: 1;
    max-height: 400px;
    overflow-y: auto;
    border-radius: 10px;

}
.input-box {
    position: relative
}
.input-box i {
    position: absolute;
    right: 13px;
    top: 15px;
    color: #ced4da
}
.form-control {
    height: 50px;
    background-color: #eeeeee69
}
.form-control:focus {
    background-color: #eeeeee69;
    box-shadow: none;
    border-color: #eee
}
.list {
    padding-top: 20px;
    padding-bottom: 10px;
    display: flex;
    align-items: center
    color:#fff;
}
.border-bottom {
    border-bottom: 2px solid #eee;
}
.list i {
    font-size: 19px;
    color: red
}
.list small {
    color: #dedddd

}
.price{
    font-size: 18px;
    font-weight: bold;
    color: #f30;
}
.old-price{
    font-size: 14px;
    color: #666;
    margin: 0 0 0 7px;
    text-decoration: line-through;
}

</style>

<style>
    @media(max-width: 767px) { 
        .backgroundbg { 
            margin-left: none;
            text-align: center;
        }
        .backgroundbg1{
            margin-left: none;
            text-align: center;
        }
    }
    @media(min-width: 768px) { 
        .backgroundbg {
            margin-left: 225px;
            margin-right: 50px;
            margin-top: 40px;
        }
        .backgroundbg1{
            text-align: center;
        }
    }
</style>

@if($products -> isEmpty())
<div class="container mt-2">
    <div class="row">
        <div class="col-md-6 backgroundbg">
            <div class="card">
                <h4 class="text-secondary p-2 backgroundbg1">Product Not Found </h4> 
            </div>
        </div>
    </div>
</div>
@else

<div class="container mt-2">
    <div class="row">
        <div class="col-md-6 backgroundbg">
            <div class="card">
                @foreach($products as $product)
                    <a href="{{ route('product.details',$product->slug) }}">
                        <div class="list border-bottom">
                            <img src="{{ asset($product->product_thumbnail) }}" style="width: 50px; height: 50px;"> 
                            <div class="d-flex flex-column ml-3" style="margin-left: 10px;"> <span style="color: #06c;">{{ $product->name_en }} </span>
                                <!-- start product discount section -->
                                @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                @endphp

                                @if ($product->discount_price > 0)
                                    <div class="product-price">
                                        <span class="price"> ৳{{ $price_after_discount }} </span>
                                        <span class="old-price">৳ {{ $product->regular_price }}</span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="price"> ৳{{ $product->regular_price }} </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach 
            </div>
        </div>
    </div>
</div>
@endif
