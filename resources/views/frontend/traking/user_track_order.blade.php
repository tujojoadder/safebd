
@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   Order Tracking
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li>
                	<a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                	Order Tracking
                </li>
            </ul>
        </div>
    </div>
    <div class="ps-order-tracking">
        <div class="container">
            <div class="ps-section__header">
                <h3>Order Tracking</h3>
                <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given to youon your receipt and in the confirmation email you should have received.</p>
            </div>
            <div class="ps-section__content">
                <form class="ps-form--order-tracking" action="{{ route('order.tracking') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Order ID</label>
                        <input class="form-control" name="code" type="text" placeholder="Enter your order id">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="ps-btn ps-btn--fullwidth">Track Your Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection