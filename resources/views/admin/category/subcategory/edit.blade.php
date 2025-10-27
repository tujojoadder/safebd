@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubCategory Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SubCategory Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('subcategory.index') }}" class="btn btn-primary">SubCategory List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('subcategory.update',['id'=>$subcategory->id]) }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Subcategory Edit</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category_id" name="category_id" id="category_id" required="">Select Category</label>
                                    <select class="single-select form-control form-select" name="category_id">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($category->id == $subcategory->category_id) ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           <div class="col-12 mt-2">
                                <label for="subcategory_name_en" class="form-label">SubCategory Name (English): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="subcategory_name_en" value="{{ $subcategory->subcategory_name_en }}" class="form-control border-start-0" id="subcategory_name_en" placeholder="Enter SubCategory Name English" />
                                </div>
                                @error('subcategory_name_en')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <label for="subcategory_name_bn" class="form-label">SubCategory Name (Bangla): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="subcategory_name_bn" value="{{ $subcategory->subcategory_name_bn }}" class="form-control border-start-0" id="subcategory_name_bn" placeholder="Enter SubCategory Name Bangla" />
                                </div>
                                @error('subcategory_name_bn')
                                  <span class="text-danger" style="font-weight:bold;">{{ $message }}</span>
                                @enderror
                            </div>
                           <div class="col-md-12 mt-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                   <span class="text-danger">*</span>
                                  <select name="status" id="status" class="form-control form-select">
                                       @if($subcategory->status == 1)
                                          <option value="1" selected>Active</option>
                                          <option value="0">Disable</option>
                                       @else
                                          <option value="1" >Active</option>
                                          <option value="0" selected>Disable</option>
                                       @endif
                                  </select>
                              </div>
                           </div>
                           <div class="col-md-12 text-right mt-3">
                              <div class="form-group">
                                <button class="btn btn-success" type="submit" style="float:right;">Update</button>
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
@endsection
