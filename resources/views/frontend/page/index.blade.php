@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   Popular Pages
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
            </ul>
        </div>
    </div>
    <div class="ps-faqs">
        <div class="container">
        <style>
            .ps-faqs {
                padding: 45px 0;
            }
            .ps-faqs .ps-section__header {
                padding-bottom: 20px;
            }
        </style>
        <div class="ps-section__content">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="ps-section__header">
                            <h1 class="text-center">
                                @if(session()->get('language') == 'bangla')
                                    {{ $page->name_bn ?? 'Null' }}
                                @else
                                    {{ $page->name_en ?? 'Null' }}
                                @endif
                            </h1>
                        </div>
                        <p style="text-align:justify;">
                            @if(session()->get('language') == 'bangla')
                                {{ $page->description_bn ?? 'Null' }}
                            @else
                                {{ $page->description_en ?? 'Null' }}
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="ps-section__left">
                          <aside class="ps-widget--account-dashboard">
                            <div class="ps-widget__content">
                            <h4 class="text-success">Popular Pages</h4>
                              <ul>
                                @foreach(get_pages_both_footer() as $page)
                                    <li class="{{ route('page.about', $page->slug) == url()->current() ? 'active' : '' }}">
                                        <a href="{{ route('page.about', $page->slug) }}">
                                            @if(session()->get('language') == 'bangla')
                                                {{ $page->name_bn ?? 'Null' }}
                                            @else
                                                {{ $page->name_en ?? 'Null' }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                              </ul>
                            </div>
                          </aside>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
