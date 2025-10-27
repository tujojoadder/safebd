$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})


/* ============= Start Product View With Modal ========== */
function productView(id) {
    // alert(id)
    $.ajax({
        type: 'GET',
        url: '/product/view/modal/' + id,
        dataType: 'json',
        success: function(data) {
            console.log(data);

            $('#product_name').text(data.product.name_en);
            $('#pname').val(data.product.name_en);
            $('#product_id').val(id);
            $('#product_code').text(data.product.product_code);
            $('#pcode').text(data.product.product_code);
            $('#pcategory').text(data.product.category.category_name_en);
            $('#pbrand').text(data.product.brand.brand_name_en);
            $('#pimage').attr('src', '/' + data.product.product_thumbnail);

            $('#pavailable').hide();
            $('#pstockout').hide();

            /* =========== Start Product Price ========= */
            var discount = 0;
            if (data.product.discount_price > 0) {
                if (data.product.discount_type == 1) {
                    discount = data.product.discount_price;
                    $('#pprice').text(data.product.regular_price - discount);
                    $('#oldprice').text(data.product.regular_price);
                } else if (data.product.discount_type == 2) {
                    discount = data.product.discount_price * data.product.regular_price / 100;
                    $('#pprice').text(data.product.regular_price - discount);
                    $('#oldprice').text(data.product.regular_price);
                }
            } else {
                $('#pprice').text(data.product.regular_price);
                $('#oldprice').text('');
            }

            $('#discount_amount').val(discount);

            if (data.product.stock_qty > 0) {
                $('#pavailable').show();
            } else {
                $('#pstockout').show();
            }
            /* =========== End Product Price ========= */

            /* ========== Start Stock Option ========= */
            if (data.product.product_qty > 0) {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#aviable').text('aviable');

            } else {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#stockout').text('stockout');
            }
            /* ========== End Stock Option ========== */

            /* ========== Start Size Option ========= */
            $('select[name="size"]').empty();
            $.each(data.size, function(key, value) {
                $('select[name="size"]').append('<option value="' + value + ' ">' + value +
                    '  </option')
                if (data.size == "") {
                    $('#sizeArea').hide();
                } else {
                    $('#sizeArea').show();
                }
            })
            /* ========== End Size Option ========= */

            /* ========== Start Size Option ========= */
            $('select[name="color"]').empty();
            $.each(data.color, function(key, value) {
                $('select[name="color"]').append('<option value="' + value + ' ">' + value +
                    '  </option')
                if (data.color == "") {
                    $('#colorArea').hide();
                } else {
                    $('#colorArea').show();
                }
            })
            /* ========== End Size Option ========= */

            /* ========= Start Add To Cart Product id ======== */
            $('#product_id').val(id);
            $('#qty').val(1);
            /* ========== End Add To Cart Product id ======== */
        }
    });
}
/* ============= End Product View With Modal ========== */

/* ============= Start Add To Cart ========== */
function addToCart() {
    var product_name = $('#pname').val();
    var id = $('#product_id').val();
    var price = $('#product_price').val();
    var color = $('#color option:selected').val();
    var size = $('#size option:selected').val();
    var quantity = $('#qty').val();
    var varient = $('#pvarient').val();

    // Start Message
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 1200
    });

    $.ajax({
        type: 'POST',
        url: '/cart/data/store/' + id,
        dataType: 'json',
        data: {
            color: color,
            size: size,
            quantity: quantity,
            product_name: product_name,
            product_price: price,
            product_varient: varient,
        },
        success: function(data) {
            console.log(data);
            miniCart();
            $('#closeModel').click();

            // Start Sweertaleart Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            })

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    title: data.error
                })
            }
            // Start Sweertaleart Message


        }
    });
}
/* ============= End Add To Cart ========== */

/* ========== start single page buynow check ========== */
function buyNowHome(product_id) {
    $('#buyNowCheckHome').val(1);
    addToCartDirect(product_id);
}
/* ========== start single page buynow check ========== */

/* =========== Add to cart direct ============ */
function addToCartDirect(product_id) {
    var product_name = $('#' + product_id + '-product_pname').val();
    // var id = $('#product_product_id').val();
    // // var product_id = $(this).attr('data-id');
    // alert(id);
    var color = $('#' + product_id + '-product_color').val();
    var size = $('#' + product_id + '-product_size').val();
    var quantity = 1;


    // alert(product_name);

    // Start Message
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 1200
    });

    $.ajax({
        type: 'POST',
        url: '/cart/data/store/' + product_id,
        dataType: 'json',
        data: {
            quantity: quantity,
            product_name: product_name,
            color: color,
            size: size,
        },
        success: function(data) {
            // console.log(data);
            miniCart();
            $('#closeModel').click();

            // Start Sweertaleart Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            })

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    title: data.error
                })
            }
            // End Sweertaleart Message

            /* ========== start single page buynow check ========== */
            var buyNowCheck = $('#buyNowCheckHome').val();
            // alert(buyNowCheck);
            if (buyNowCheck && buyNowCheck == 1) {
                $('#buyNowCheckHome').val(0);
                window.location = '/checkout';
            }
            /* ========== end single page buynow check ========== */


        }
    });
}
/* ============= Start AddToCart direct ========== */

/* ========== start single page buynow check ========== */
function buyNow() {
    $('#buyNowCheck').val(1);
    addToCartDetails();
}
/* ========== start single page buynow check ========== */

/* ============= Start Details Page Add To Cart Product  ========== */
function addToCartDetails() {
    var product_name = $('#pnamed').val();
    // alert(product_name);
    var id = $('#product_idd').val();
    // alert(id);
    var price = $('#product_priced').val();
    var color = $('#dcolor option:selected').val();
    var size = $('#dsize option:selected').val();
    var quantity = $('#qtyd').val();
    var varient = $('#pvarientd').val();

    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            color: color,
            size: size,
            quantity: quantity,
            product_name: product_name,
            product_varient: varient,
        },

        url: "/dcart/product/details/store/" + id,

        success: function(data) {
            console.log(data);
            miniCart();
            // console.log(data)
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                Toast.fire({
                    type: 'success',
                    title: data.success,
                })
            } else {

                Toast.fire({
                    type: 'error',
                    title: data.error,
                })
            }
            // End Message

            /* ========== start single page buynow check ========== */
            var buyNowCheck = $('#buyNowCheck').val();
            // alert(buyNowCheck);
            if (buyNowCheck && buyNowCheck == 1) {
                $('#buyNowCheck').val(0);
                window.location = '/checkout';
            }
            /* ========== end single page buynow check ========== */
        }
    })
}
/* ============= End Details Page Add To Cart Product  ========== */

/* ============= Start MiniCart Add ========== */
function miniCart() {
    $.ajax({
        type: 'GET',
        url: '/product/mini/cart',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            //alert(response);

            $('span[id="cartSubTotal"]').text(response.cartTotal);
            $('.cartQty').text(Object.keys(response.carts).length);
            $('#total_cart_qty').text(Object.keys(response.carts).length);

            var miniCart = "";

            if (Object.keys(response.carts).length > 0) {
                $.each(response.carts, function(key, value) {
                    var slug = value.options.slug;
                    var base_url = window.location.origin;
                    miniCart += `
                    <div class="ps-product--cart-mobile">
                        <div class="ps-product__thumbnail">
                            <a href="#">
                                <img src="/${value.options.image}" alt="">
                            </a>
                        </div>
                        <div class="ps-product__content">
                            <a class="ps-product__remove" id="${value.rowId}" onclick="miniCartRemove(this.id)" >
                                <i style="cursor:pointer" class="icon-cross"></i>
                            </a>
                            <a>${value.name}</a>
                            <p>
                                <strong></strong>
                            </p>
                            <small>${value.qty} x ${value.price}</small>
                        </div>
                    </div>

                `
                });

                $('.miniCart').html(miniCart);
                $('.miniCart_empty_btn').hide();
                $('.miniCart_btn').show();
            } else {
                html = '<h4 class="text-center pt-4">Cart empty!</h4>';
                $('.miniCart').html(html);
                $('.miniCart_btn').hide();
                $('.miniCart_empty_btn').show();
            }
        }
    });
}
/* ============ Function Call ========== */
miniCart();

/* ==================== Start MiniCart Remove =============== */
function miniCartRemove(rowId) {
    $.ajax({
        type: 'GET',
        url: '/minicart/product-remove/' + rowId,
        dataType: 'json',
        success: function(data) {

            miniCart();
            couponCalculation();
            cart();

            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    title: data.error
                })
            }
            // End Message
        }
    });
}
/* ==================== End MiniCart Remove =============== */

/* ==================== Start My Cart Function  =============== */
function cart() {
    $.ajax({
        type: 'GET',
        url: '/get-cart-product',
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            var rows = "";
            // alert(Object.keys(response.carts).length);
            $('#total_cart_qty').text(Object.keys(response.carts).length);
            if (Object.keys(response.carts).length > 0) {
                $.each(response.carts, function(key, value) {
                    console.log(response.carts);
                    var slug = value.options.slug;
                    var base_url = window.location.origin;
                    rows += `
                    <tr>
                        <td data-label="Product">
                            <div class="ps-product--cart">
                                <div class="ps-product__thumbnail">
                                    <a href="#">
                                    <img src="/${value.options.image}" alt="" /></a></div>
                                    <div class="ps-product__content">
                                    <a href="#">
                                        ${value.name}
                                    </a>
                                    <p class="mb-0">Size: <span>${value.options.color}</span>
                                    </p>
                                    <p class="mb-2">Color: <span>${value.options.size}</span>
                                    </p>

                                </div>
                            </div>
                        </td>
                        <td class="price" data-label="Price">৳${value.price}</td>
                        <td data-label="Quantity">

                            ${value.qty > 1

                                ? `<button type="submit" style="margin-right: 5px; background-color: #2dc5cc !important; font-size: 12px;" class="btn btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button>`

                                : `  <button type="submit" style="margin-right: 5px;" class="btn btn-danger btn-sm" disabled >-</button> `

                            }

                            <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width: 34px;height: 29px;text-align: center;padding-left: 0px;">

                            <button type="submit" style="margin-left: 5px; font-size: 12px;" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>

                        </td>
                        <td data-label="Total">৳${value.subtotal} </td>
                        <td data-label="Actions">
                            <a id="${value.rowId}" onclick="cartRemove(this.id)" style="cursor:pointer;">
                                <i class="icon-cross"></i>
                            </a>
                        </td>
                    </tr>
                `
                });

                $('#cartPage').html(rows);

            } else {
                html =
                    '<tr><td class="text-center" style="font-size: 18px; font-weight: bold;">Cart empty!</td></tr>';
                $('#cartPage').html(html);
            }
        }
    });
}
cart();
/* ==================== End My Cart Function  =============== */

/* ==================== Start  cartIncrement ================== */
function cartIncrement(rowId) {
    $.ajax({
        type: 'GET',
        url: "/cart-increment/" + rowId,
        dataType: 'json',
        success: function(data) {
            // console.log(data)
            cart();
            miniCart();
            couponCalculation();
        }
    });
}
/* ==================== End  cartIncrement ================== */

/* ==================== Start  Cart Decrement ================== */
function cartDecrement(rowId) {
    $.ajax({
        type: 'GET',
        url: "/cart-decrement/" + rowId,
        dataType: 'json',
        success: function(data) {
            // console.log(data)
            cart();
            miniCart();
            couponCalculation();
        }
    });
}
/* ==================== End  Cart Decrement ================== */

/* ================ Start My Cart Remove Product =========== */
function cartRemove(id) {
    $.ajax({
        type: 'GET',
        url: '/cart-remove/' + id,
        dataType: 'json',
        success: function(data) {
            cart();
            miniCart();
            couponCalculation();


            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
            // End Message
        }
    });
}

/* ==================== End My Cart Remove Product ================== */



/* ==================== End My Cart Remove Product ================== */

/*--==================== Start Coupon Apply  ===================== --*/
        function applyCoupon() {

            var coupon_name = $('#coupon_name').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },
                url: "{{ url('/coupon-apply') }}",
                success: function(data) {
                    couponCalculation();
                    // $('#couponField').hide();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }
        /*--==================== End Coupon Apply  ===================== --*/

        /* ==================== Start couponCalculation  ===================== */
        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-calculation') }}",
                dataType: 'json',
                success: function(data) {
                    console.log(data);

                    if (data.total) {

                        $('#couponCalField').html(

                            `<div class="ps-block__header">
                            <p>Total:<span style="float:right;">৳${data.total}</span></p>
                        </div>
                        <div class="ps-block__content">
                            <h3>SubTotal<span style="float:right;">৳${data.total}</span></h3>
                        </div>
                        <div class="my-3 border-top"></div>
                        `

                        )
                    } else {
                        $('#couponCalField').html(

                            `<div class="ps-block__header">
                            <p>Total:<span style="float:right;">৳${data.subtotal}</span></p>
                        </div>
                        <div class="ps-block__content">
                            <h3>SubTotal<span style="float:right;">৳${data.subtotal}</span></h3>
                        </div>
                        <div class="my-3 border-top"></div>
                        <div class="my-3 border-top"></div>
                        <div class="cart-sub-total">
                            Coupon Name: <span class="inner-left-md">${data.coupon_name}</span>
                            <button type="submit" class="btn btn-light rounded-0 btn-ecomm" style="float:right;" onclick="couponRemove()"> <i class="fa fa-times"></i></button>
                        </div>

                        <p class="mb-2 mt-3">Coupon Discount Amount: <span class="float-end">৳${data.discount_amount}</span>
                        </p>
                        <div class="my-3 border-top"></div>
                        <div class="ps-block__content">
                            <h3>Grand Total:<span style="float:right;">৳${data.total_amount}</span></h3>
                        </div>
                        `
                        )
                    } //end else
                }
            });


        }
        couponCalculation();
        /* ==================== End couponCalculation  ===================== */

        /* ==================== Start Coupon Remove  ===================== */
        function couponRemove() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-remove') }}",
                dataType: 'json',
                success: function(data) {

                    $('#couponField').show();
                    $('#coupon_name').val('');

                    couponCalculation();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message


                }
            })
        }
        /* ==================== End Coupon Remove  ===================== */

         function addToCompare(id) {

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '/compare/addToCompare/' + id,

                success: function(data) {

                    location.reload();

                    $('#compare_list').html(data);
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }

            })
        }
