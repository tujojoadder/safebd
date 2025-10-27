@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('category.index') }}" class="btn btn-primary">Category List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('category.update',['id'=>$category->id]) }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Category Create</h4>
                        <hr>
                        <div class="row">
                           <div class="col-12">
                                <label for="category_name_en" class="form-label">Category Name (English): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="category_name_en" class="form-control border-start-0" value="{{ $category->category_name_en }}" id="category_name_en" placeholder="Enter Category Name English" />
                                </div>
                                @error('category_name_en')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <label for="category_name_bn" class="form-label">Category Name (Bangla): </label>
                                <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                  <input type="text" name="category_name_bn" class="form-control border-start-0" value="{{ $category->category_name_bn }}" id="category_name_bn" placeholder="Enter Category Name Bangla" />
                                </div>
                                @error('category_name_bn')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                              <div class="form-group">
                                <label for="category_image">Brand Image</label>
                                <span class="text-danger">*</span>
                                @error('category_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="mb-2">
                                  <img id="showImage" class="rounded avatar-lg showImage" src="{{ asset($category->category_image) }}" alt="No Image" width="100px" height="80px;">
                                </div>
                                <div class="input-group mb-3">
                                  <input type="file" class="form-control category_image" name="category_image" id="category_image">
                                  <label class="input-group-text" for="category_image">Upload</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3">
                               <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="featured_category" name="featured_category"  value="1" {{ ($category->featured_category == 1) ? 'checked': ''}}>
                                        <label class="form-check-label" for="featured_category">Featured Category</label>
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-12 mt-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                   <span class="text-danger">*</span>
                                  <select name="status" id="status" class="form-control form-select">
                                      @if($category->status == 1)
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

<script type="text/javascript">
      $(document).ready(function(){
        $('.category_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    }); 
</script>
@endsection
