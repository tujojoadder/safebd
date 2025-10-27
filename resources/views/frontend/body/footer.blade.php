
@php
  $color = App\Models\Color::orderBy('id', 'DESC')->where('status',1)->first();
@endphp
<style type="text/css">
    #homepage-9 .ps-footer {
        border-top: 1px solid #e1e1e1;
        background-color: {{ $color->footer_color ?? 'null' }};
    }
    .widget_footer .widget-title {
        font-size: 16px;
        margin-bottom: 30px;
        font-weight: 600;
        color: {{ $color->primary_color ?? 'null' }};
    }
    .ps-list--link li a {
        display: inline-block;
        line-height: 20px;
        position: relative;
        color: {{ $color->secondary_color ?? 'null' }};
    }
    .widget-title{
        color:  {{ $color->primary_color ?? 'null' }};
    }
    .ps-list--social li a.facebook i {
        color:{{ $color->text_color ?? 'null' }};
    }
    .ps-footer__copyright p {
        margin-bottom: 0;
        line-height: 30px;
        color:{{ $color->text_color ?? 'null' }};
    }
    .ps-footer__copyright p {
        margin-bottom: 0;
        line-height: 30px;
        color:{{ $color->text_color ?? 'null' }};
    }
 </style>
<footer class="ps-footer ps-footer--2 ps-footer--organic">
    <div class="container">
        <div class="ps-footer__content">
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="row">
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <aside class="widget widget_footer widget_contact-us">
                                <h4 class="widget-title">Contact us</h4>
                                <div class="widget_content">
                                    <p style="color: #fff;">Call Us</p>
                                    <h3 style="color: #fff;">{{ get_setting('phone')->value ?? 'null' }}</h3>
                                    <p style="color: #fff;">{{ get_setting('business_address')->value ?? 'null' }} <br><a href="mailto:{{ get_setting('email')->value ?? 'null' }}">{{ get_setting('email')->value ?? 'null' }}</a></p>
                                    <ul class="ps-list--social">
                                       <li>
                                            <a target="_blank" class="facebook" target="_blank" href="{{ get_setting('facebook_url')->value ?? 'null' }}"><i class="fab fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" class="twitter" href="{{ get_setting('twitter_url')->value ?? 'null' }}"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" class="google-plus" href="{{ get_setting('linkedin_url')->value ?? 'null' }}"><i class="fa-brands fa-linkedin"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" class="instagram" href="{{ get_setting('instagram_url')->value ?? 'null' }}"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <aside class="widget widget_footer">
                                <h4 class="widget-title">Popular Pages</h4>
                                <ul class="ps-list--link">
                                    @foreach(get_pages_both_footer() as $page)
                                    <li>
                                        <a href="{{ route('page.about', $page->slug) }}">{{ $page->name_en }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </aside>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-12 ">
                            <aside class="widget widget_footer">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="ps-list--link">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('checkout') }}">Order History</a></li>
                                    <li><a href="{{ route('user.track.order') }}">Track Order</a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <aside class="widget widget_newletters">
                        <h4 class="widget-title">Newsletter</h4>
                        <form class="ps-form--newletter" action="{{ route('subs.store') }}" method="post">
                            @csrf
                            <div class="form-group--nest">
                                <input class="form-control" name="email" type="email" placeholder="Enter Your Email" required />
                                <button type="submit" class="ps-btn">Subscribe</button>
                            </div>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
        <div class="ps-footer__copyright">
            <p>{{ get_setting('copy_right')->value ?? 'null' }} All Rights Reserved</p>

            <p><span>We Using Safe Payment For:</span>
                <a href="#"><img width="80px;" src="{{ asset('frontend/payment/bkash.png ')}}" alt="" /></a>
                <a href="#"><img width="80px;" src="{{ asset('frontend/payment/nagad.png') }}" alt="" /></a>
                <a href="#"><img width="80px;" src="{{ asset('frontend/payment/sslcommerz.png ')}}" alt="" /></a>
                <a href="#"><img width="80px;" src="{{ asset('frontend/payment/aamarpay.png ') }}" alt="" /></a>
            </p>
        </div>
    </div>
</footer>
