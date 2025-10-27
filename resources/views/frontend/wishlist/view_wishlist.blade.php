@extends('layouts.frontend')
@section('content-frontend')
    <style>
        .ps-section--shopping {
            padding: 18px 0;
        }

        .ps-section--shopping .ps-section__header {
            text-align: center;
            padding-bottom: 10px;
        }
    </style>
@section('title')
    My Wishlist Page
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li>Wishlist</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-whishlist">
        <div class="container">
            <div class="ps-section__header">
                <h1>Wishlist</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--whishlist ps-table--responsive">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                                <th>Remove Item</th>
                            </tr>
                        </thead>
                        <tbody id="wishlist">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
