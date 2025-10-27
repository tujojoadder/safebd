@extends('admin.admin_master')
@section('slider') active @endsection
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product View</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product View</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Product List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

<div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-white">Product Details</h6>
    </div>
      <div class="card-body">
         <div class="table-responsive">
           <table class="table table-bordered">
               <tr>
                  <td>Product Name (En)</td>
                  <td>{{ $product->name_en ?? 'NULL' }}</td>
               </tr>
                <tr>
                  <td>Product Name (En)</td>
                  <td>{{ $product->name_bn ?? 'NULL' }}</td>
               </tr>
               <tr>
                  <td>Product Regular Price</td>
                  <td>{{ $product->regular_price ?? 'NULL' }}</td>
               </tr>
               <tr>
               <td>Product Purchase Price</td>
               <td>{{ $product->purchase_price ?? 'NULL' }}</td>
            </tr>
             <tr>
               <td>Product Point</td>
               <td>{{ $product->product_point ?? '0' }}</td>
            </tr>
             <tr>
               <td>Product WholeSell Price</td>
               <td>{{ $product->wholesell_price ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product WholeSell Quntity</td>
               <td>{{ $product->wholesell_minimum_qty ?? 'NULL' }}</td>
            </tr>
             <tr>
               <td>Product Discount Price</td>
               <td>
                  @if($product->discount_price > 0)
                     @if($product->discount_type == 1)
                        <span class="badge bg-info text-white">৳{{ $product->discount_price }} off</span>
                     @elseif($product->discount_type == 2)
                        <span class="badge bg-success text-white">{{ $product->discount_price }}% off</span>
                     @endif
                  @else
                     <span class="badge bg-danger text-white">No Discount</span>
                  @endif
               </td>
            </tr>
            <tr>
               <td>Product Quntity</td>
               <td>{{ $product->minimum_buy_qty ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Stock Quntity</td>
               <td>{{ $product->stock_qty ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Category</td>
               <td>{{ $product->category->category_name_en ?? 'NULL' }}</td>
            </tr>
             <tr>
               <td>Product SubCategory</td>
               <td>{{ $product->subcategory->subcategory_name_en ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product ChildCategory</td>
               <td>{{ $product->subsubcategory->sub_subcategory_name_en ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Brand</td>
               <td>{{ $product->brand->brand_name_en ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Tags</td>
               <td>{{ $product->product_tag ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Color</td>
               <td>{{ $product->product_color ?? 'NULL' }}</td>
            </tr>
            <tr>
               <td>Product Size</td>
               <td>{{ $product->product_size ?? 'NULL' }}</td>
            </tr>
             <td>Status</td>
                <td>
                    @if ($product->status == 1)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Disable</span>
                    @endif
                </td>
             </tr>
             <tr>
                <td>Product Image</td>
                <td><img src="{{ asset($product->product_thumbnail) }}" alt="" style="height:70px; width:80px;"></td>
             </tr>
             <tr>
               <td>Product Gallery Image</td>
               <td>
               @foreach($product->multi_imgs as $product)
               
                  <img src="{{ asset($product->photo_name) }}" alt="" style="height:50px; width:40px;">
              
               @endforeach
                </td>
             </tr>
          </table>
       </div>
    </div>
 </div>
 </div>
      <!-- /.container-fluid -->
   </div>
   <!-- End of Main Content -->
</div>
@endsection
