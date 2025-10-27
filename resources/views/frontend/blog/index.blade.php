@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   Popular Blog
@endsection
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Blogs</a></li>
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
            <div class="ps-page--blog">
                <div class="ps-post--detail">
                  <div class="ps-post__header">
                    <div class="container">
                      <h1>
                        @if(session()->get('language') == 'bangla')
                            {{ $blog->blog_title_bn }}
                        @else
                            {{ $blog->blog_title_en }}
                        @endif
                      </h1>
                       <p>{{ $blog->created_at->format('l jS \\of F Y h:i:s A') }}
                            {{-- <a href="blog-list.html">Life Style</a><a href="blog-list.html">Others</a> --}}
                       </p>
                    </div>
                  </div>
                  <div class="container">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <img class="mb-30" src="{{ asset($blog->blog_image) }}" alt="" width="1170" height="635">
                    </div>
                    {{-- <div class="ps-post__carousel">
                        <div class="ps-carousel--nav-inside second owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"><img src="img/blog/detail/carousel/1.jpg" alt="">
                            <img src="{{ asset($blog->blog_image) }}" alt="">
                        </div>
                    </div> --}}
                    <div class="ps-post__content">
                      <p>
                        @if(session()->get('language') == 'bangla')
                            {{ $blog->blog_description_bn }}
                        @else
                            {{ $blog->blog_description_en }}
                        @endif
                      </p>
                    </div>
                    <div class="ps-post__footer">
                      {{-- <p class="ps-post__tags">Tags:<a href="#">business</a><a href="#">technology</a></p> --}}
                      <h4>Social Media Share</h4>
                        <div class="ps-post__social">
                            <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000//{{ $blog->blog_title_en }}">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a class="linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite?mini=true&amp;url=http://127.0.0.1:8000//{{ $blog->blog_title_en }}&amp;title=Share+your+linkedin+profile&amp;summary=">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a class="twitter" target="_blank" href="https://wa.me/?text=http:http://127.0.0.1:8000//{{ $blog->blog_title_en }}">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a class="pinterest" target="_blank" href="https://telegram.me/share/url?url=http://127.0.0.1:8000//{{ $blog->blog_title_en }}&amp;text=Share+your+telegram+profile">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                  </div>
                </div>
                {{-- <div class="ps-related-posts">
                  <h3>Related Posts</h3>
                  <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                      <div class="ps-post">
                        <div class="ps-post__thumbnail">
                            <a class="ps-post__overlay" href="blog-detail.html"></a>
                            <img src="{{ asset('frontend/assets/img/blog/grid/1.jpg ') }}" alt=""/>
                          <div class="ps-post__badge"><i class="icon-volume-high"></i></div>
                        </div>
                        <div class="ps-post__content">
                          <div class="ps-post__top">
                            <div class="ps-post__meta"><a href="#">Entertaiment</a><a href="#">Technology</a>
                            </div><a class="ps-post__title" href="#">Experience Great Sound With Beats’s Headphone</a>
                          </div>
                          <div class="ps-post__bottom">
                            <p>December 17, 2017 by<a href="#"> drfurion</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                      <div class="ps-post">
                        <div class="ps-post__thumbnail">
                            <a class="ps-post__overlay" href="blog-detail.html"></a>
                            <img src="{{ asset('frontend/assets/img/blog/grid/2.jpg ')}}" alt=""/>
                        </div>
                        <div class="ps-post__content">
                          <div class="ps-post__top">
                            <div class="ps-post__meta"><a href="#">Life Style</a><a href="#">Others</a>
                            </div><a class="ps-post__title" href="#">Products Necessery For Mom</a>
                          </div>
                          <div class="ps-post__bottom">
                            <p>December 17, 2017 by<a href="#"> drfurion</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                      <div class="ps-post">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="blog-detail.html"></a><img src="{{ asset('frontend/assets/img/blog/grid/3.jpg ')}}" alt=""/>
                        </div>
                        <div class="ps-post__content">
                          <div class="ps-post__top">
                            <div class="ps-post__meta"><a href="#">Life Style</a><a href="#">Others</a>
                            </div><a class="ps-post__title" href="#">Home Interior: Modern Style 2017</a>
                          </div>
                          <div class="ps-post__bottom">
                            <p>December 17, 2017 by<a href="#"> drfurion</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ps-block--post--navigation"><a class="ps-block__link" href="#"><span class="ps-block__arrow"><i class="icon-arrow-left"></i> Previous</span><span class="ps-block__title">Experience Great Sound With Beats’s Headphone</span></a><a class="ps-block__link" href="#"><span class="ps-block__arrow"> Next<i class="icon-arrow-right"></i></span><span class="ps-block__title">Products Necessery For Mom</span></a></div>
                <div class="ps-post-comments">
                  <h3>4 Comments</h3>
                  <div class="ps-block--comment">
                    <div class="ps-block__thumbnail"><img src="http://1.gravatar.com/avatar/af7935f33b10cec23f77b8d9717641df?s=70&amp;d=mm&amp;r=g" alt=""></div>
                    <div class="ps-block__content">
                      <h5>Jason bradley<small>MARCH 12, 2013 AT 1:17 PM</small></h5>
                      <p>Cras id nulla at metus congue auctor. Suspendisse auctor dictum orci quis interdum. Nullam et eleifend metus. Integer in est orci. Duis hendrerit ex metus, vel tempor sem aliquet nec. Donec ornare hend rerit bibendum.</p><a class="ps-block__reply" href="#">Reply</a>
                    </div>
                  </div>
                  <div class="ps-block--comment">
                    <div class="ps-block__thumbnail"><img src="http://2.gravatar.com/avatar/b2c1febfd11117eef66c351c1d4c10f1?s=70&amp;d=mm&amp;r=g" alt=""></div>
                    <div class="ps-block__content">
                      <h5>Jared Erickson<small>MARCH 12, 2013 AT 1:17 PM</small></h5>
                      <p>Ut tellus ligula, interdum a interdum ut, egestas ut ipsum. Vivamus viverra consequat ipsum, nec auctor dolor eleifend sit amet. Nulla cursus fringilla metus a dictum</p><a class="ps-block__reply" href="#">Reply</a>
                      <div class="ps-block--comment">
                        <div class="ps-block__thumbnail"><img src="http://2.gravatar.com/avatar/25df3939b2e33bd19783411afd5bc6e3?s=70&amp;d=mm&amp;r=g" alt=""></div>
                        <div class="ps-block__content">
                          <h5>Chris Ames<small>MARCH 14, 2013 AT 8:01 AM</small></h5>
                          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><a class="ps-block__reply" href="#">Reply</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form class="ps-form--post-comment" action="do_action" method="post">
                    <h3>Leave a comment</h3>
                    <div class="form-group">
                      <textarea class="form-control" rows="8" placeholder="Your comment *" required></textarea>
                    </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="Your name*">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="your email*">
                        </div>
                      </div>
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="your website">
                        </div>
                      </div>
                    </div>
                    <div class="form-group submit">
                      <button class="ps-btn">Post Comment</button>
                    </div>
                  </form>
                </div> --}}
              </div>
        </div>
        </div>
    </div>
</div>
@endsection
