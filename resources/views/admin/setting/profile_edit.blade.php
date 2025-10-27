@extends('layouts.backend')
@section('admin')
<div class="dashboard-wrapper">
    <!-- Container fluid Starts -->
    <div class="container-fluid">
    <!-- Top Bar Starts -->
       <div class="top-bar clearfix">
          <div class="row gutter">
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="page-title">
                   <h3>Admin Profile Update</h3>
                </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <ul class="right-stats" id="mini-nav-right">
                   <li>
                      <a href="javascript:void(0)" class="btn btn-danger"><span>76</span>Sales</a> 
                   </li>
                   <li>
                      <a href="tasks.html" class="btn btn-success">
                      <span>18</span>Tasks</a>
                   </li>
                   <li>
                      <a href="javascript:void(0)" class="btn btn-info"><i class="icon-download6"></i> Export</a>
                   </li>
                </ul>
             </div>
          </div>
       </div>
       <!-- Top Bar Ends -->

       <!-- Row starts -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h4>Admin Profile Update</h4>
                    </div>
                    <div class="panel-body">
                        @php
                            $id = Auth::guard('web')->user()->id;
                            $adminData = App\Models\User::where('role',2)->find($id);
                        @endphp
                        <form id="paymentForm" method="POST" action="{{ route('admin.profile.update',$adminData->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-user text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $adminData->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-user-check text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="{{ $adminData->username }}">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-old-phone text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="enterMobile">Phone</label>
                                        <input type="number" class="form-control" name="phone" id="enterMobile" placeholder="Mobile Number" value="{{ $adminData->phone }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-mail text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="enterEmail">Email</label>
                                        <input type="email" class="form-control" name="email" id="enterEmail" placeholder="Enter your Email ID" value="{{ $adminData->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-globe4 text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="EnterWebsite">Country</label>
                                        <input type="text" class="form-control" name="country" id="EnterWebsite" placeholder="Enter Country Name" value="{{ $adminData->country }}">
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="styled-input-wrapper">
                                <div class="input-icon">
                                    <i class="icon-photo text-green"></i>
                                </div>
                                <div class="styled-input">
                                    <div class="form-group">
                                        <label for="image">Profile Photo</label>
                                        <input type="file" id="image" class="form-control" name="profile_photo"  placeholder="Enter Website URL">
                                        @error('profile_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <img id="showImage" class="rounded avatar-lg mt-3" src="{{ (!empty($adminData->profile_photo)) ? url('upload/admin_images/'.$adminData->profile_photo):url('upload/no_image.jpg') }}" alt="No Image" width="70px" height="60px;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit" style="float:right;">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--Site Contact logo Show -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
			