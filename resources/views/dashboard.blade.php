@extends('layouts.frontend')
@section('content-frontend')
<main class="ps-page--my-account">
   <div class="ps-breadcrumb">
      <div class="container">
         <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>User Information</li>
         </ul>
      </div>
   </div>
   <section class="ps-section--account">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="card p-5">
                    @include('frontend.common.user_side_nav')
               </div>
            </div>
            @php
                $id = Auth::guard('web')->user()->id;
                $adminData = App\Models\User::where('role','user')->find($id);
            @endphp
            <div class="col-lg-8">
               <div class="card rounded-0 shadow-none border">
                  <div class="card-header pt-4 border-bottom-0">
                     <h5 class="mb-0 fs-18 fw-700 text-dark">Basic Info</h5>
                  </div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update',$adminData->id) }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name-->
                        <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14 fs-14">Your Name</label>
                           <div class="col-md-10">
                              <input type="text" class="form-control rounded-0" placeholder="Your Name" name="name" value="{{ $adminData->name }}">
                           </div>
                        </div>
                        <!-- Phone-->
                        <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14">Your Phone</label>
                           <div class="col-md-10">
                              <input type="number" class="form-control rounded-0" placeholder="Your Phone" name="phone" value="{{ $adminData->phone }}" min="0">
                           </div>
                        </div>
                        <!-- Email-->
                        <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14">Your Email</label>
                           <div class="col-md-10">
                              <input type="email" class="form-control rounded-0" placeholder="Your Email" name="email" value="{{ $adminData->email }}">
                           </div>
                        </div>
                        <!-- Photo-->
                        <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14">Photo</label>
                           <div class="col-md-10">
                                <div class="form-group local-forms">
                                   <label>Photo <span class="login-danger">*</span></label>
                                   <input class="form-control" name="profile_photo" type="file" onChange="photoUrl(this)" placeholder="Enter photo">
                                   <img src="{{ (!empty($adminData->profile_photo)) ? url('upload/user_images/'.$adminData->profile_photo):url('upload/no_image.jpg') }}" width="100" height="80" class="p-2" id="photoThmb">
                                </div>
                           </div>
                        </div>
                        <!-- Password-->
                        {{-- <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14">Your Password</label>
                           <div class="col-md-10">
                              <input type="password" class="form-control rounded-0" placeholder="New Password" name="new_password">
                           </div>
                        </div>
                        <!-- Confirm Password-->
                        <div class="form-group row">
                           <label class="col-md-2 col-form-label fs-14">Confirm Password</label>
                           <div class="col-md-10">
                              <input type="password" class="form-control rounded-0" placeholder="Confirm Password" name="confirm_password">
                           </div>
                        </div> --}}
                        <!-- Submit Button-->
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="ps-btn mt-3">Update Profile</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
<!-- Start photo Photo Show Image -->
   <script type="text/javascript">
    function photoUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          $('#photoThmb').attr('src',e.target.result).width(100).height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
<!-- End photo Photo Show Image -->
@endsection

