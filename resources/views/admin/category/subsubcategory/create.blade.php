@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubSubcategory Create</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SubSubcategory Create</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('subsubcategory.index') }}" class="btn btn-primary">SubSubcategory List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form action="{{ route('subsubcategory.store') }}" method="POST">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>SubSubcategory Create</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category_id" name="category_id" id="category_id" required="">Select Category</label>
                                    <select class="single-select form-control form-select" name="category_id">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="subcategory_id" name="subcategory_id" id="subcategory_id" required="">Select SubCategory</label>
                                    <select class="single-select form-control form-select" name="subcategory_id">
                                        <option value="" selected disabled>Select SubCategory</option>
                                        @error('subcategory_id')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                           <div class="col-12 mt-2">
                                <label for="sub_subcategory_name_en" class="form-label">SubSubCategory Name (English): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="sub_subcategory_name_en" class="form-control border-start-0" id="sub_subcategory_name_en" placeholder="Enter SubSubCategory Name English" />
                                </div>
                                @error('sub_subcategory_name_en')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <label for="sub_subcategory_name_bn" class="form-label">Sub SubCategory Name (Bangla): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="sub_subcategory_name_bn" class="form-control border-start-0" id="sub_subcategory_name_bn" placeholder="Enter Sub SubCategory Name Bangla" />
                                </div>
                                @error('sub_subcategory_name_bn')
                                  <span class="text-danger" style="font-weight:bold;">{{ $message }}</span>
                                @enderror
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
                           <div class="col-md-12 text-right mt-3">
                              <div class="form-group">
                                <button class="btn btn-success" type="submit" style="float:right;">Save</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- End of Main Content -->
</div>

<!-- Category Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('subcategory/category-subcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                     var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
</script>
@endsection
