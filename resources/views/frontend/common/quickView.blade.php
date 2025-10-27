<div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <span class="modal-close" data-dismiss="modal"  id="closeModel"><i class="icon-cross2"></i>
            </span>
            <!-- <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> -->
            <style type="text/css">
                @media screen and (max-width: 767px)  {
                  .ps-product--quickview {
                    height: 1300px !important;
                  }
                  #ps_btn_add{
                    background-color: red !important;
                    color:white !important;
                  }
                }

            </style>
            <article class="ps-product--detail ps-product--fullwidth" id="mobile_menu">
                <div class="ps-product__header">
                    <div class="ps-product__thumbnail" data-vertical="false">
                        <div class="ps-product__images" data-arrow="true">
                            <!-- start product image show -->
                            <div class="item">
                                <img src="" id="pimage" alt="product image" width="404" height="404">
                            </div>
                            <!-- end product image show -->
                        </div>
                    </div>
                    <div class="ps-product__info">
                        <h1 id="product_name"></h1>
                        <div class="ps-product__meta">
                            <!-- start product category/brand/code show -->
                            <p>Brand:<a  id="pbrand" href="#"></a></p>
                            <p>Category:<a id="pcategory"  href="#"></a></p>
                            <p>Product(c):<a id="product_code"  href="#"></a></p>
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select>
                                <!-- <span>(1 review)</span> -->
                            </div>
                            <!-- end product category/brand/code show -->
                        </div>

                        <!-- product current price/old price show -->
                        <div class="d-flex">
                            <h4 class="ps-product__price" id="pprice">৳</h4>
                            <h4 class="pt-1 pl-2"><del id="oldprice">৳</del></h4>
                        </div>

                        <div class="ps-product__desc">
                            <!-- start product size & color show -->
                            <div class="row">
                                <div class="col-md-6" id="sizeArea">
                                    <p class="mr-10">Size : </p>
                                    <select class="form-control unicase-form-control" id="size" name="size">
                                    </select>
                                </div>
                                <div class="col-md-6" id="colorArea">
                                    <p class="mr-10">Color : </p>
                                    <select class="form-control unicase-form-control" id="color" name="color">
                                    </select>
                                </div>
                            </div>
                            <!-- end product size & color show -->

                            <!-- start product stock/available show -->
                            <div class="row mt-5">
                                <div class="col-md-12 d-flex">
                                    <p class="mr-10">Stock : </p>
                                    <span class="badge badge-pill badge-success pt-3" id="pavailable" style="background: green; color: white; width: 80px;">Available</span>
                                    <span class="badge badge-pill badge-danger pt-3" id="pstockout" style="background: red; color: white; width: 80px;">Stock Out</span>
                                </div>
                            </div>
                            <!-- end product stock/available show -->

                            <!-- start product qty show -->
                            <div class="row mt-5 mb-5">
                                <div class="col-md-12">
                                    <p class="mr-10">Product Qty : </p>
                                    <input type="number" name="qty" id="qty" class="qty-val form-control" value="1" min="1">
                                </div>
                            </div>
                            <!-- end product qty show -->
                        </div>
                        <!-- start product add to cart show -->
                        <div class="ps-product__shopping">

                            <input type="hidden" id="product_id">
                            <input type="hidden" id="pname">
                            <input type="hidden" id="product_price">
                            <input type="hidden" id="discount_amount">
                            <input type="hidden" id="pfrom" value="modal">
                            <input type="hidden" id="pvarient" value="">

                            <a class="btn btn-primary btn-lg text-light" onclick="addToCart()">Add to cart</a>
                            <!-- <a class="ps-btn" href="#">Buy Now</a>
                            <div class="ps-product__actions">
                                <a href="#"><i class="icon-heart"></i></a>
                                <a href="#"><i class="icon-chart-bars"></i></a>
                            </div> -->
                        </div>
                        <!-- end product add to cart show -->
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
