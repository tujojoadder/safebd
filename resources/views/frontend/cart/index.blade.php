@extends('layouts.frontend')
@section('content-frontend')
@section('title')
    My Cart Page
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>Shopping Cart</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart ps-table--responsive">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th>Remove Item</th>
                            </tr>
                        </thead>
                        <tbody id="cartPage">
                            <h5 class="text-body text-danger">There are <span class="text-brand"
                                    id="total_cart_qty"></span> products in your cart</h5>
                        </tbody>
                    </table>
                </div>
                <div class="ps-section__cart-actions">
                    <a class="ps-btn" href="{{ route('home') }}">
                        <i class="icon-arrow-left"></i> Continue Shoping
                    </a>
                    <!-- <a class="ps-btn ps-btn--outline" href="#">
                <i class="icon-sync"></i> Update cart
                </a> -->
                </div>
            </div>
            <div class="ps-section__footer">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <!-- Start Coupon Apply Show -->
                        <figure id="couponField">
                            <figcaption>Coupon Discount</figcaption>
                            <div class="form-group">
                                <input class="form-control" id="coupon_name" type="text"
                                    placeholder="Enter Coupon Discount" required>
                            </div>
                            <div class="form-group">
                                <button class="ps-btn ps-btn--outline" onclick="applyCoupon()">Apply</button>
                            </div>
                        </figure>
                        <!-- End Coupon Apply Show -->
                    </div>
                    <!-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>Calculate shipping</figcaption>
                            <div class="form-group">
                                <select class="ps-select">
                                    <option value="1">America</option>
                                    <option value="2">Italia</option>
                                    <option value="3">Vietnam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Town/City">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Postcode/Zip">
                            </div>
                            <div class="form-group">
                                <button class="ps-btn ps-btn--outline">Update</button>
                            </div>
                        </figure>
                    </div> -->
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <!-- Start Coupon Calculation Show -->
                        <div class="ps-block--shopping-total" id="couponCalField">

                        </div>
                        <!-- End Coupon Calculation Show -->
                        <a class="ps-btn ps-btn--fullwidth" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
