@extends('admin.admin_master')
@section('slider_create') active @endsection
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blog Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('blog.index') }}" class="btn btn-primary">Blog List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('blog.update',$blog->id)}}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Blog Edit</h4>
                        <hr>
                        <div class="row">
                          <div class="col-12">
                            <label for="brand_name_en" class="form-label">Blog Title (English):</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="blog_title_en" class="form-control border-start-0" id="blog_title_en" value="{{ $blog->blog_title_en }}" placeholder="Enter Blog Title English" />
                            </div>
                            @error('blog_title_en')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-12 mt-2">
                            <label for="blog_title_bn" class="form-label">Blog Title (Bangla):</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="blog_title_bn" class="form-control border-start-0" id="blog_title_bn" value="{{ $blog->blog_title_bn }}" placeholder="Enter Blog Title Bangla" />
                            </div>
                            @error('blog_title_bn')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                           <div class="col-md-12 mt-3">
                              <div class="form-group">
                                <label for="slider_img">Blog Image <span class="text-light font-weaight-bolder">(Size:380,300):</span></label>
                                <span class="text-danger">*</span>
                                @error('blog_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="mb-2">
                                  <img id="showImage" class="rounded avatar-lg showImage" src="{{ asset($blog->blog_image) }}" alt="No Image" width="100px" height="80px;">
                                </div>
                                <div class="input-group mb-3">
                                  <input type="file" class="form-control blog_image" name="blog_image" id="blog_image">
                                  <label class="input-group-text" for="blog_image">Upload</label>
                                </div>
                              </div>
                            </div>

                          <div class="col-md-12 mt-2">
                            <div class="form-group">
                              <label for="description_en" class="col-sm-3 col-form-label">Description (English):</label>
                              <div class="col-sm-12">
                                <textarea class="form-control" name="blog_description_en" id="blog_description_en" rows="3" placeholder="Enter Description English">{{ $blog->blog_description_en }}</textarea>
                              </div>
                            </div>
                            @error('blog_description_en')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="description_bn" class="col-sm-3 col-form-label">Description (Bangla):</label>
                              <div class="col-sm-12">
                                <textarea class="form-control" name="blog_description_bn" id="blog_description_bn" rows="3" placeholder="Enter Description Bangla">{{ $blog->blog_description_bn }}</textarea>
                              </div>
                            </div>
                          </div>

                           <div class="col-md-12">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                   <span class="text-danger">*</span>
                                  <select name="status" id="status" class="form-control form-select">
                                    @if ($blog->status == 1)
                                      <option value="1" selected>Active</option>
                                      <option value="0">Disable</option>
                                    @else
                                      <option value="1">Active</option>
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
        $('.blog_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    }); 
</script>
@endsection
