@extends('admin.admin_master')
@section('admin')
    <style>
        .product-discount {
            color: #fff;
            align-items: center;
            width: 2.5rem;
            height: 2.5rem;
            font-size: 14px;
            background-color: #23d58b;
            text-align: center;
        }

        .product-grid .card {
            cursor: pointer;
        }

        /* product discount style change */
        #checkout_list {
            background-color: #1e61a1;
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
        }

        .btn i {
            vertical-align: middle;
            margin-top: -1em;
            margin-bottom: -1em;
            color: #23d58b;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-xl-2">
                                    <a href="#" class="btn btn-light mb-3 mb-lg-0"><i class="bx bxs-plus-square"></i>New
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="position-relative">
                                                <input type="text" class="form-control ps-5" name="search_term"
                                                    id="search_term" placeholder="Search Product..." onkeyup="filter()">
                                                <span class="position-absolute top-50 product-show translate-middle-y"><i
                                                        class="bx bx-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="custom_select">
                                                <select name="category_id" id="category_id"
                                                    class="form-control single-select w-100 form-select select-nice"
                                                    onchange="filter()">
                                                    <option value="">-- Select Category --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="custom_select">
                                                <select name="brand_id" id="brand_id"
                                                    class="form-control single-select w-100 form-select select-nice"
                                                    onchange="filter()">
                                                    <option value="">-- Select Brand --</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- card-body end// -->
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid"
                        id="product_wrapper">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card" onclick="addToList({{ $product->id }})">
                                    @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                        <img class="card-img-top" src="{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    @else
                                        <img class="card-img-top" src="{{ asset('upload/no_image.jpg') }}" alt="" />
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
                                            <div class="">
                                                <div class="position-absolute top-0 end-0 m-3 product-discount">
                                                    <span class="">৳{{ $product->discount_price }} off</span>
                                                </div>
                                            </div>
                                        @elseif($product->discount_type == 2)
                                            <div class="">
                                                <div class="position-absolute top-0 end-0 m-3 product-discount">
                                                    <span class="">{{ $product->discount_price }}% off</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title cursor-pointer">{{ Str::limit($product->name_en, 30) }}</h6>
                                        <div class="clearfix">
                                            <p class="mb-0 float-start"><strong>134</strong> Sales</p>
                                            @if ($product->discount_price > 0)
                                                @php
                                                    if ($product->discount_type == 1) {
                                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                                    } elseif ($product->discount_type == 2) {
                                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                                    }
                                                @endphp
                                                <p class="mb-0 float-start fw-bold">
                                                    <span class="text-white">৳{{ $price_after_discount }}</span>
                                                    <span
                                                        class="me-2 text-decoration-line-through">৳{{ $product->regular_price }}</span>
                                                </p>
                                            @else
                                                <p class="mb-0 float-start fw-bold">
                                                    <span class="text-white">৳{{ $product->regular_price }}</span>
                                                </p>
                                            @endif
                                            <p class="mb-0 mt-2 float-start fw-bold">Stock Qty
                                                <span class="text-white"><strong
                                                        class="text-white font-weaight-bolder">{{ $product->stock_qty }}</strong></span>
                                            </p>
                                        </div>
                                        @php
                                            $reviewcount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $avarage = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--end row-->
                </div>
                <div class="col-sm-4">
                    <form action="{{ route('customer.pos.store') }}" method="POST">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex border-bottom pb-3">
                                    <div class="flex-grow-1">
                                        <select name="customer_id" id="customer_id"
                                            class="form-control single-select w-100 form-select select-nice" required>
                                            <option value="">-- Select Customer --</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" data-contact="{{ $customer->email }}">
                                                    {{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success" data-target="#new-customer"
                                        data-toggle="modal">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </button>
                                </div>
                                <div>
                                    <div class="row" id="checkout_list">
                                        <div class="text-center pt-10 pb-10" id="no_product_text">
                                            <span>No Product Added</span>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td style="float: right;">৳ <span id="subtotal_text">0.00</span></td>
                                                <input type="hidden" id="subtotal" name="subtotal" value="0">
                                            </tr>
                                            <tr>
                                                <td>Shipping Area</td>
                                                <td style="float: right;">
                                                    <select name="shipping_cost" class="form-control" id="shipping_cost">
                                                        <option value="" selected>Please select shipping</option>
                                                        <option value="inside" style="color:black;">Inside Dhaka</option>
                                                        <option value="outside" style="color:black;">Outside Dhaka
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Charge</td>
                                                <td style="float: right;">৳ <span class="ship_charge">0.00</span></td>
                                                <input type="hidden" name="ship_charge" class="ship_charge_val"
                                                    value="">
                                            </tr>
                                            <tr>
                                                <td>Discount</td>
                                                <td style="float: right;">
                                                    <input type="number" class="form-control" id="discount"
                                                        name="discount" min="0" placeholder="Enter Discount">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table">
                                        <tbody>
                                            <tr style="font-size: 20px; font-weight: bold">
                                                <td>Total</td>
                                                <td style="float: right;">৳ <span id="total_text">0.00</span></td>
                                                <input type="hidden" id="total" name="total" value="0">
                                                <input type="hidden" class="shipping_order_total"
                                                    name="shipping_order_total" value="">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-light mb-3 mb-lg-0" value="Place Order"
                                            style="float: right;">
                                    </div>
                                </div>
                            </div>
                            <!-- card-body end// -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-script')
    <script>
        /* ================ start wrapper toggled section =============== */
        $(document).ready(function() {
            $('.sidebar-header .toggle-icon').trigger('click');

        });
        /* ================ end wrapper toggled section =============== */

        /* ================ start add to cart list product =============== */
        function addToList(id) {
            // alert(id);
            $.ajax({
                type: 'GET',
                url: '/pos/customer/product/' + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // alert('hi');
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 1000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: 'Product Added To Cart List Successfully.'
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message

                    // alert(total);
                    if (data.discount_price == 0) {
                        price = data.regular_price - 0;
                        // alert(price);
                        point = data.product_point;
                        // alert(point);
                        var subtotal = parseFloat($('#subtotal').val());
                        var total = parseFloat($('#total').val());

                        // var product_point =  parseFloat($('#product_point').val());

                        subtotal = parseFloat(subtotal + price).toFixed(2);
                        total = parseFloat(total + price).toFixed(2);
                        // alert(total);
                        p_point = parseFloat(product_point + point).toFixed(2);
                        // alert(p_point);

                        $('#subtotal').val(subtotal);
                        $('#total').val(total);
                        $('#product_point').val(p_point);

                        $('#subtotal_text').html(subtotal);
                        $('#total_text').html(total);
                        $('#product_point_text').html(p_point);
                    } else {
                        if (data.discount_price > 0) {
                            if (data.discount_type == 1) {
                                price = data.regular_price - data.discount_price;
                            } else if (data.discount_type == 2) {
                                price = data.regular_price - (data.regular_price * data.discount_price / 100);
                            }
                        }

                        point = data.product_point;

                        var subtotal = parseFloat($('#subtotal').val());
                        var total = parseFloat($('#total').val());
                        var product_point = parseFloat($('#product_point').val());

                        subtotal = parseFloat(subtotal + price).toFixed(2);
                        total = parseFloat(total + price).toFixed(2);
                        p_point = parseFloat(product_point + point).toFixed(2);

                        $('#subtotal').val(subtotal);
                        $('#total').val(total);
                        $('#product_point').val(p_point);

                        $('#subtotal_text').html(subtotal);
                        $('#total_text').html(total);
                        $('#product_point_text').html(p_point);
                    }


                    $('#no_product_text').html('');

                    // Check if product already exists in the cart
                    if ($(`#qty${data.id}`).length) {
                        // If it exists, update the quantity
                        let newQty = parseInt($(`#qty${data.id}`).val()) + 1;
                        $(`#qty${data.id}`).val(newQty);
                        let newTotalPrice = newQty * parseFloat(price);
                        $(`#qty${data.id}`).closest('tr').find('.cartTotalPrice').text(`${newTotalPrice}৳`);
                    } else {
                        // If not, add a new entry
                        html = `<div id="${data.id}">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item py-0 pl-2">
                                            <div class="row gutters-5 align-items-center">
                                                <div class="col-1">
                                                    <div class="row no-gutters align-items-center flex-column aiz-plus-minus">
                                                        <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_increase(${data.id})">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                        <input type="text" name="qty[]" id="qty${data.id}" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="999" onchange="updateQuantity(0)"style="margin-left: 6px;margin-right: -11px;padding: 3px;background: #23d58b;color: #fff;border-radius: 10px;">
                                                        <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_decrease(${data.id})">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-5" style="margin-left:5px;">
                                                    <div class="text-truncate-2">${data.name_en}</div>
                                                    <input type="hidden" name="product_id[]" value="${data.id}">
                                                </div>
                                                <div class="col-3">
                                                    <div class="fs-12 opacity-60">${price} x <span id="itemMultiplyQtyTxt${data.id}">1</span></div>
                                                    <div class="fs-15 fw-600" id="itemTotalPriceTxt${data.id}">${price}</div>
                                                    <input type="hidden" name="price[]" id="price${data.id}" value="${price}">
                                                    <input type="hidden" name="point[]" id="point${data.id}" value="${point}">
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-light" onclick="removeItem(${data.id})"><i class="fa fa-trash me-0"></i></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul><hr>
                                <div>`;
                        $('#checkout_list').append(html);
                    }

                }
            });
        }
        /* ================ end add to cart list product =============== */

        /* ================ start add to cart removeItem product =============== */
        function removeItem(id) {
            // alert(id);
            var qty = parseInt($('#qty' + id).val());
            var price = parseFloat($('#price' + id).val());

            var point = parseFloat($('#point' + id).val());

            var subtotal = parseFloat($('#subtotal').val());
            var total = parseFloat($('#total').val());

            var product_point = parseFloat($('#product_point').val());

            // alert(price);

            subtotal = parseFloat(subtotal - (price * qty)).toFixed(2);
            //alert(subtotal);
            total = parseFloat(total - (price * qty)).toFixed(2);
            // alert(total);

            p_point = parseFloat(product_point - point).toFixed(2);


            $('#subtotal').val(subtotal);
            $('#total').val(total);
            $('#product_point').val(p_point);

            $('#subtotal_text').html(subtotal);
            $('#total_text').html(total);
            $('#product_point_text').html(p_point);

            $('#' + id).html('');
            location.reload();

        }
        /* ================ start add to cart removeItem product =============== */

        /* ================ start add to cart increase product =============== */
        function cart_increase(id) {
            var qty = parseInt($('#qty' + id).val());
            var point = parseFloat($('#point' + id).val());
            var price = parseFloat($('#price' + id).val());
            $('#qty' + id).val(qty + 1);
            $('#itemMultiplyQtyTxt' + id).html(qty + 1);

            var totalPrice = price * (qty + 1);
            $('#itemTotalPriceTxt' + id).html(totalPrice);

            var subtotal = parseFloat($('#subtotal').val());
            var total = parseFloat($('#total').val());
            var product_point = parseFloat($('#product_point').val());

            subtotal = subtotal + price;
            total = total + price;
            p_point = product_point + point;

            $('#subtotal').val(subtotal);
            $('#total').val(total);
            $('#product_point').val(p_point);

            $('#subtotal_text').html(subtotal);
            $('#total_text').html(total);
            $('#product_point_text').html(p_point);
        }
        /* ================ end add to cart increase product ================= */

        /* ================ start add to cart decrease product =============== */
        function cart_decrease(id) {
            var qty = parseInt($('#qty' + id).val());
            if (qty > 1) {
                $('#qty' + id).val(qty - 1);

                var price = parseFloat($('#price' + id).val());
                $('#itemMultiplyQtyTxt' + id).html(qty - 1);

                var totalPrice = price * (qty - 1);
                $('#itemTotalPriceTxt' + id).html(totalPrice);

                var point = parseFloat($('#point' + id).val());
                // alert(point);

                var subtotal = parseFloat($('#subtotal').val());
                var total = parseFloat($('#total').val());
                var product_point = parseFloat($('#product_point').val());

                subtotal = parseFloat(subtotal - price).toFixed(2);
                total = parseFloat(total - price).toFixed(2);
                p_point = parseFloat(product_point - point).toFixed(2);

                $('#subtotal').val(subtotal);
                $('#total').val(total);
                $('#product_point').val(p_point);

                $('#subtotal_text').html(subtotal);
                $('#total_text').html(total);
                $('#product_point_text').html(p_point);
            }
        }
        /* ================ end add to cart decrease product ================= */

        /* ================ start filter product ================= */
        function filter() {
            var search_term = $('#search_term').val();
            var category_id = $('#category_id').val();
            var brand_id = $('#brand_id').val();

            var url = '/pos/customer/get-products?filter=1';
            var search_status = 0;
            if (search_term) {
                if (/\S/.test(search_term)) {
                    search_term = search_term.replace(/^\s+/g, '');
                    search_term = search_term.replace(/\s+$/g, '');
                    url += '&search_term=' + search_term;
                    //alert( '--'+search_term+'--' );
                    search_status = 1;
                }
            }
            if (category_id) {
                url += '&category_id=' + category_id;
                //alert( category_id );
                search_status = 1;
            }
            if (brand_id) {
                url += '&brand_id=' + brand_id;
                //alert( brand_id );
                search_status = 1;
            }

            if (search_status == 0) {
                url = '/pos/customer/get-products';
            }

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    if (Object.keys(data).length > 0) {
                        $.each(data, function(key, value) {
                            var product_name = value.name_en;
                            product_name = product_name.slice(0, 30) + (product_name.length > 30 ?
                                "..." : "");

                            var price_after_discount = value.regular_price;
                            if (value.discount_type == 1) {
                                price_after_discount = value.regular_price - value.discount_price;
                            } else if (value.discount_type == 2) {
                                price_after_discount = value.regular_price - (value.regular_price *
                                    value.discount_price / 100);
                            }

                            html += `<div class="col" onclick="addToList(${value.id})">
                                            <div class="card mb-4">
                                                    <div class="product-image">`;
                            if (value.product_thumbnail && value.product_thumbnail != '' && value
                                .product_thumbnail != 'Null') {
                                html +=
                                    `<img class="card-img-top" src="/${value.product_thumbnail}" alt="" />`;
                            } else {
                                html +=
                                    `<img class="card-img-top" src="/upload/no_image.jpg" alt="" />`;
                            }
                            if (value.discount_price > 0) {
                                html +=
                                    `<div class="position-absolute top-0 end-0 m-3 product-discount">`;
                                if (value.discount_type == 1) {
                                    html += `<span class="">৳ ${value.discount_price} off</span>`;
                                } else if (value.discount_type == 2) {
                                    html += `<span class="">${value.discount_price}% off</span>`;
                                }
                                html += `</div>`;
                            }
                            html += `</div>
                                                <div class="card-body">
                                                        <h6 class="card-title cursor-pointer"> ${product_name}</h6>`;
                            if (value.discount_price > 0) {

                                html += `<div class="mb-0 float-start fw-bold">
                                                                    <span class="text-white font-weaight-bolder">৳ ${price_after_discount}</span>
                                                                    <span class="me-2 text-decoration-line-through font-weaight-bolder">৳ ${value.regular_price }</span>
                                                                </div>`;
                            } else {
                                html += `<div class="mb-0 float-start fw-bold">
                                                                    <span class="text-white font-weaight-bolder">৳ ${value.regular_price }</span>
                                                                </div>`;
                            }
                            html += `<p class="mb-0 mt-2 float-start fw-bold">Stock Qty
                                                                <span class="text-white"><strong class="text-white font-weaight-bolder">${value.stock_qty }</strong></span>
                                                            </p>`;
                            html += `</div>
                                                </div>
                                            </div>
                                        </div>`;

                        });
                    } else {
                        html = '<div class="text-center"><p>No products found!</p></div>'
                    }
                    $('#product_wrapper').html(html);
                }
            });
        };
        /* ================ end filter product ================= */

        /* ================ start total product discount product ================= */
        $('input').on('keyup input', function() {
            // alert('hi');
            var subtotal = parseFloat($('#subtotal').val());
            // alert(subtotal);
            var discount = Number($("#discount").val().trim());
            // alert(discount);
            var result = subtotal - (discount * subtotal) / 100;
            // alert(result);
            $('#total_text').html(result);

        });
        /* ================ end total product discount product ================= */

        /* ================ start product shipping cost  ================= */
        $(document).on('change', '#shipping_cost', function(e) {
            let shipping_cost = $(this).val();
            if (shipping_cost == 'inside') {
                // alert('dhaka');
                $('.ship_charge').text('60');
                var delivery_charge = 60;
                $('.ship_charge_val').val(delivery_charge);
            } else {
                // alert('others');
                $('.ship_charge').text('120');
                var delivery_charge = 120;
                $('.ship_charge_val').val(delivery_charge);

            }

            var subtotal = parseFloat($('#subtotal').val());

            var cart_total = parseFloat($('.total').val());
            var cart_order_total = parseFloat($('.order_total_amount').val());

            var cart_total = parseFloat(delivery_charge) + parseFloat(subtotal);
            // alert(cart_total);
            $('#total_text').html(cart_total);
            // $('.order_total').html("৳"+cart_total);
            $('.shipping_order_total').val(cart_total);
            // console.log( parseFloat(cart_total) );
        });
        /* ================ end product shipping cost  ================= */
    </script>
@endpush
