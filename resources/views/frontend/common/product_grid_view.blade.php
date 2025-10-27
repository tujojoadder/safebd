@forelse($products as $product)
    <div class="ps-product">
        <div class="ps-product__thumbnail">
            @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                <a href="{{ route('product.details', $product->slug) }}">
                    <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                </a>
            @else
                <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
            @endif

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
                    <!-- start varient product add to cart direct -->
                    <li>
                        <input type="hidden" id="pfrom" value="direct">
                        <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                        <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                        <a onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Add To Cart"
                            style="cursor:pointer;"><i class="icon-bag2"></i></a>
                    </li>
                    <!-- end varient product add to cart direct -->
                    <li>
                        <a href="#" id="{{ $product->id }}" onclick="productView(this.id)" data-placement="top"
                            title="Quick View" data-toggle="modal" data-target="#product-quickview"><i
                                class="icon-eye"></i>
                        </a>
                    </li>
                @else
                    <!-- start not varient product add to cart direct -->
                    <input type="hidden" id="pfrom" value="direct">
                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                    <li>
                        <a onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Add To Cart"
                            style="cursor:pointer;"><i class="icon-bag2"></i></a>
                    </li>
                    <!-- end not varient product add to cart direct -->

                    <!--<li>-->
                    <!--    <a  onclick="addToCartDirect({{ $product->id }})" data-placement="top" title="Quick View" style="cursor:pointer;"><i class="icon-eye"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                @endif
                <li><a id="{{ $product->id }}" onclick="addToWishList(this.id)" data-toggle="tooltip"
                        data-placement="top" title="Add to Whishlist" style="cursor: pointer;"><i
                            class="icon-heart"></i></a></li>
                <li><a style="cursor: pointer;" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                        data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
            </ul>
        </div>
        <div class="ps-product__container">
            <a class="ps-product__vendor" href="#">
                @if (session()->get('language') == 'bangla')
                    {{ $product->category->category_name_bn ?? 'NULL' }}
                @else
                    {{ $product->category->category_name_en ?? 'NULL' }}
                @endif
            </a>

            <div class="ps-product__content">
                <a class="ps-product__title" href="{{ route('product.details', $product->slug) }}">
                    @if (session()->get('language') == 'bangla')
                        <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                        {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                    @else
                        <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                        {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
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
                    <p class="ps-product__price sale">
                        ৳{{ $price_after_discount }}
                        <del>৳ {{ $product->regular_price }}</del>
                    </p>
                @else
                    <p class="ps-product__price sale">
                        ৳{{ $product->regular_price }}
                    </p>
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
                    </select>
                    <span>({{ count($reviewcount) }})</span>
                    <!-- <span>01</span> -->
                </div>

                @if ($product->is_varient == 1)
                    <!-- start varient product add to cart direct -->
                    <input type="hidden" id="pfrom" value="direct">
                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                    <input type="hidden" id="buyNowCheckHome" value="0">
                    <input type="hidden" id="{{ $product->id }}-product_color"
                        value="{{ $product->product_color }}">
                    <input type="hidden" id="{{ $product->id }}-product_size"
                        value="{{ $product->product_size }}">
                    <!-- end varient product add to cart direct -->
                    <div class="d-flex">
                        <a href="#" id="{{ $product->id }}" onclick="productView(this.id)"
                            data-toggle="modal" data-target="#product-quickview"
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
                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                    <input type="hidden" id="{{ $product->id }}-product_color"
                        value="{{ $product->product_color }}">
                    <input type="hidden" id="{{ $product->id }}-product_size"
                        value="{{ $product->product_size }}">
                    <div class="d-flex">
                        <a href="#" id="{{ $product->id }}" onclick="productView(this.id)"
                            data-toggle="modal" data-target="#product-quickview"
                            class="btn btn-success btn-sm mt-3 btn-block ">
                            @if (session()->get('language') == 'bangla')
                                কার্টে যোগ করুন
                            @else
                                Add To Cart
                            @endif
                        </a>
                        <a onclick="buyNowHome({{ $product->id }})"
                            class="btn btn-danger btn-sm mt-3 btn-block ml-2">
                            @if (session()->get('language') == 'bangla')
                                অর্ডার করুন
                            @else
                                Buy Now
                            @endif
                        </a>
                    </div>
                @endif

                {{-- <p class="ps-product__title">Point: {{ $product->product_point ?? '0'  }}</p> --}}
            </div>
            <div class="ps-product__content hover">
                <a class="ps-product__title" href="{{ route('product.details', $product->slug) }}">
                    @if (session()->get('language') == 'bangla')
                        <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                        {{ Str::limit($p_name_bn, $limit = 18, $end = '. . .') }}
                    @else
                        <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                        {{ Str::limit($p_name_en, $limit = 18, $end = '. . .') }}
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

                @if ($product->is_varient == 1)
                    <!-- start varient product add to cart direct -->
                    <input type="hidden" id="pfrom" value="direct">
                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                    <input type="hidden" id="{{ $product->id }}-product_color"
                        value="{{ $product->product_color }}">
                    <input type="hidden" id="{{ $product->id }}-product_size"
                        value="{{ $product->product_size }}">
                    <!-- end varient product add to cart direct -->
                    <div class="d-flex">
                        <a href="#" id="{{ $product->id }}" onclick="productView(this.id)"
                            data-toggle="modal" data-target="#product-quickview"
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
                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                    <input type="hidden" id="{{ $product->id }}-product_color"
                        value="{{ $product->product_color }}">
                    <input type="hidden" id="{{ $product->id }}-product_size"
                        value="{{ $product->product_size }}">
                    <div class="d-flex">
                        <a href="#" id="{{ $product->id }}" onclick="productView(this.id)"
                            data-toggle="modal" data-target="#product-quickview"
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
@empty
    <h5 class="text-danger">No Product Found</h5>
@endforelse
