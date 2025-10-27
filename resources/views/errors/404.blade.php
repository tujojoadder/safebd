@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   404 Page Not Found
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home')}}">Home</a></li>
                <li><a href="#">Account</a></li>
                <li>404 Page</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--404">
        <div class="container">
            <div class="ps-section__content"><img src="{{ asset('frontend/assets/img/404.jpg ') }}" alt="">
                <h3>ohh! page not found</h3>
                <p>It seems we can't find what you're looking for. Perhaps searching can help or go back to<a href="{{ route('home')}}"> Homepage</a></p>
            </div>
        </div>
    </div>
</div>
@endsection