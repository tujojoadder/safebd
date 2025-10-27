@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add New Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
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
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card">
          <div class="card-body p-4">
            <h5 class="card-title">Add New Product</h5>
            <hr/>
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" >
            @csrf
              <h4>Basic Info</h4>
              <div class="form-body mt-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="border border-3 p-4 rounded">
                      <div class="mb-3">
                        <label for="name_en" class="form-label">Product Name (En):</label>
                        <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Enter product name english" value="{{ old('name_en') }}" required>
                      </div>
                      <div class="mb-3">
                        <label for="name_bn" class="form-label">Product Name (Bn):</label>
                        <input type="text" class="form-control" name="name_bn" id="name_bn" placeholder="Enter product name bangla" value="{{ old('name_bn') }}">
                      </div>
                      <div class="mb-3 d-none">
                        <label for="product_code" class="form-label">Product Code:</label>
                        <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter product code">
                      </div>
                      <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <select class="single-select form-control form-select"  id="category" name="category_id">
                          <option value="" disabled>---Select Category---</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="subcategory_id" class="form-label">SubCategory:</label>
                        <select name="subcategory_id" class="form-select single-select" id="subcategory_id">
                          <option value="" selected disabled>---Select SubCategory---</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="subsubcategory_id" class="form-label">Sub->SubCategory:</label>
                        <select name="subsubcategory_id" id="subsubcategory_id" class="form-select single-select" >
                          <option value="" selected disabled>---Select SubSubCategory---</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand:</label>
                        <select name="brand_id" id="brand_id" class="form-select single-select" >
                          <option value="" selected disabled>---Select Brand---</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                          @endforeach
                        </select>
                      </div>
                      {{-- <div class="mb-3">
                        <label for="campaing_id" class="form-label">Campaing:</label>
                        <select name="campaing_id" class="form-select single-select" id="campaing_id">
                          <option value="" selected disabled>---Select Campaing---</option>
                          @foreach ($campaings as $campaing)
                            <option value="{{ $campaing->id }}">{{ $campaing->name_en }}</option>
                          @endforeach
                        </select>
                      </div> --}}
                      <div class="mb-3">
                        <label for="tags1" class="form-label">Product Tags:</label>
                        <input type="text" class="form-control"  name="tags[]" id="tags1" data-role="tagsinput" placeholder="Type and hit enter to add a color">
                      </div>
                      <div class="mb-3">
                        <label for="size1" class="form-label">Product Size:</label>
                        <input type="text" class="form-control"  name="size[]" id="size1" data-role="tagsinput" placeholder="Type and hit enter to add a color">
                      </div>
                      <div class="mb-3">
                        <label for="color1" class="form-label">Product Color:</label>
                        <input type="text" class="form-control"  name="color[]" id="color1" data-role="tagsinput" placeholder="Type and hit enter to add a color">
                      </div>
                    </div>
                  </div>
                </div><!--end row-->
              </div>
              <h4 class="mt-3">Pricing</h4>
              <div class="form-body mt-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="border border-3 p-4 rounded">
                      <div class="row g-3">
                      <div class="mb-3 col-md-6">
                        <label for="purchase_price" class="form-label">Product Buying Price:</label>
                        <input type="number" name="purchase_price" class="form-control" id="purchase_price" placeholder="Enter product bying price" value="{{ old('purchase_price') }}">
                      </div>
                      @error('purchase_price')
                        <p class="text-danger text-light" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                      <div class="mb-3 col-md-6">
                        <label for="whole_sell_price" class="form-label">Whole Sell Price:</label>
                        <input type="number" name="wholesell_price" class="form-control" id="wholesell_price" placeholder="Enter product whole sell price" value="{{ old('wholesell_price') }}">
                      </div>
                      @error('whole_sell_price')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                      <div class="mb-3 col-md-6">
                        <label for="wholesell_minimum_qty" class="form-label">Whole Sell Minimum Quantity:</label>
                        <input type="number" name="wholesell_minimum_qty" class="form-control" id="wholesell_minimum_qty" placeholder="Enter product whole sell qty" value="{{ old('wholesell_minimum_qty') }}">
                      </div>
                      @error('wholesell_minimum_qty')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                      <div class="mb-3 col-md-6">
                        <label for="regular_price" class="form-label">Regular Price:</label>
                        <input type="number" name="regular_price" class="form-control" id="regular_price" placeholder="Enter product regular price" value="{{ old('regular_price') }}">
                      </div>
                      @error('discount_price')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                      <div class="mb-3 col-md-6">
                        <label for="discount_price" class="form-label">Discount Price:</label>
                        <input type="number" name="discount_price" class="form-control" id="discount_price" placeholder="Enter product discount price" value="{{ old('discount_price') }}">
                      </div>
                      @error('discount_price')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                       <div class="mb-3 col-md-6">
                        <label for="minimum_buy_qty" class="form-label">Minimum Buy Quantity:</label>
                        <input type="number" name="minimum_buy_qty" class="form-control" id="minimum_buy_qty" placeholder="Enter product qty" value="{{ old('minimum_buy_qty') }}">
                      </div>
                      @error('minimum_buy_qty')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                       {{-- <div class="mb-3 col-md-6">
                        <label for="product_point" class="form-label">Product  Point:</label>
                        <input type="number" name="product_point" class="form-control" id="product_point" placeholder="Enter product point" value="{{ old('product_point') }}">
                      </div> --}}
                      {{-- <div class="mt-5 col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_point" name="is_point"  value="1">
                            <label class="form-check-label" for="is_point">Point Show Home Page</label>
                        </div>
                      </div> --}}
                      <div class="mb-3 col-md-6">
                        <label for="stock_qty" class="form-label">Stock Quantity:</label>
                        <input type="number" name="stock_qty" class="form-control" id="stock_qty" placeholder="Enter product stock  qty" value="{{ old('stock_qty') }}">
                      </div>
                      @error('stock_qty')
                        <p class="text-danger" style="font-weight:bolder:">{{$message}}</p>
                      @enderror
                      <div class="mb-3 col-md-6">
                          <label for="inputProductType" class="form-label">Product Type:</label>
                          <select name="discount_type" class="form-select single-select" id="inputProductType">
                              <option value="" selected disabled>---Select Discount---</option>
                              <option value="1">Flat</option>
                              <option value="2">Parcent %</option>
                            </select>
                          </div>
                      </div>
                    </div>
                  </div>
                </div><!--end row-->
              </div>
              <h4 class="mt-3">Description</h4>
              <div class="form-body mt-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="border border-3 p-4 rounded">
                      <div class="row g-3">
                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description (En):</label>
                            <textarea class="form-control" name="description_en" id="description_en" rows="3">{{ old('description_en')}}</textarea>
                        </div>
                        @error('description_en')
                          <p class="text-danger text-light" style="font-weight:bolder:">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="description_bn" class="form-label">Description (Bn):</label>
                            <textarea class="form-control" name="description_bn" id="description_bn" rows="3">{{ old('description_bn')}}</textarea>
                        </div>
                        @error('description_bn')
                          <p class="text-danger text-light" style="font-weight:bolder:">{{$message}}</p>
                        @enderror
                    </div>
                  </div>
                </div><!--end row-->
              </div>
              <h4 class="mt-3">Product Image</h4>
              <div class="form-body mt-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="border border-3 p-4 rounded">
                      <div class="row g-3">
                        <div class="mb-2">
                          <label for="product_thumbnail" class="form-label">Product Image <span class="text-light font-weaight-bolder">(Size:300,300):</span></label>
                          <input type="file" name="product_thumbnail" class="form-control product" id="product_thumbnail" required >
                        </div>
                        <div class="mb-1">
                          <img id="showImage" class="rounded avatar-lg showImage" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="No Image" width="100px" height="80px;">
                        </div>
                        <div class="mb-3">
                          <label for="multiImg" class="form-label">Product Gallery Image <span class="text-light font-weaight-bolder">(Size:1200,1200):</span></label>
                          <input id="multiImg" multiple="" type="file" class="form-control" name="multi_img[]">
                          <div class="row pt-2" id="preview_img">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!--end row-->
              </div>
              <div class="form-body mt-3">
                <div class="row">
                  <div class="col-md-12 mt-3">
                    <div class="form-group">
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"  value="1">
                          <label class="form-check-label" for="is_featured">Featured Product</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="form-group">
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="is_deals" name="is_deals"  value="1">
                          <label class="form-check-label" for="is_deals">Today's Deal</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="form-group">
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="is_varient" name="is_varient"  value="1">
                          <label class="form-check-label" for="is_varient">Is Varient</label>
                      </div>
                    </div>
                  </div>
                 <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                         <span class="text-danger">*</span>
                        <select name="status" id="status" class="form-control form-select">
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                 </div>
                </div>
              </div>
              <div class="form-group mt-3"  style="float: right;">
                <input type="submit" class="btn btn-light" value="Save Product">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- End of Main Content -->
</div>

<!-- Product Image -->
<script type="text/javascript">
      $(document).ready(function(){
        $('.product').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<!-- Category with subcategory show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('products/category-subcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    $('select[name="subcategory_id"]').html('<option value="" selected="" disabled="">---Select SubCategory---</option>');
                    $.each(data, function(key, value){
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                    });
                    $('select[name="subsubcategory_id"]').html('<option value="" selected="" disabled="">---Select SubSubCategory---</option>');
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
</script>

<!-- Sub Category with subsubcategory show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="subcategory_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('products/subcategory-subsubcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    $('select[name="subsubcategory_id"]').html('<option value="" selected="" disabled="">---Select SubSubCategory---</option>');
                    $.each(data, function(key, value){
                        $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.sub_subcategory_name_en + '</option>');
                    });
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
</script>

<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

</script>
@endsection
