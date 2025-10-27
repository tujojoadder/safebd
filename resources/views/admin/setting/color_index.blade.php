@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Website Color Settings</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Website Color Settings</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('color.index') }}" class="btn btn-primary">Color List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('color_settings.update', $color_settings->id) }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Color Updated</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="top_header text-light">Main Header Color</label>
                                <input type="color" name="top_header" value="{{ $color_settings->top_header ?? 'Null' }}" id="top_header" class="form-control"/>
                                @error('top_header')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="small_header text-light">Small Header Color</label>
                                <input type="color" name="small_header" value="{{ $color_settings->small_header ?? 'Null' }}" id="small_header" class="form-control"/>
                                @error('small_header')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="text_color text-light">Text Color</label>
                                <input type="color" name="text_color" value="{{ $color_settings->text_color ?? 'Null' }}" id="text_color" class="form-control"/>
                                @error('text_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="footer_color text-light">Footer Color</label>
                                <input type="color" name="footer_color" value="{{ $color_settings->footer_color ?? 'Null' }}" id="footer_color" class="form-control"/>
                                @error('footer_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="primary_color text-light">Footer Title Color</label>
                                <input type="color" name="primary_color" value="{{ $color_settings->primary_color ?? 'Null' }}" id="primary_color" class="form-control"/>
                                @error('primary_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="secondary_color text-light">Footer Text Color</label>
                                <input type="color" name="secondary_color" value="{{ $color_settings->secondary_color ?? 'Null' }}" id="secondary_color" class="form-control"/>
                                @error('secondary_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="bg_color text-light">Background Color</label>
                                <input type="color" name="bg_color" value="{{ $color_settings->bg_color ?? 'Null' }}" id="footer_color" class="form-control"/>
                                @error('bg_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="col-12 mt-3">
                                <label for="primary_color">Background Color</label>
                                <input type="color" name="primary_color" value="{{ $color_settings->primary_color }}" id="primary_color" class="form-control"/>
                                @error('primary_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                           <div class="col-md-12 mt-3">
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
        $('.image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
