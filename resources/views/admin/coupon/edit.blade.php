@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('coupon.index') }}" class="btn btn-primary">Coupon List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('coupon.update',$coupons->id) }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Coupon Edit</h4>
                        <hr>
                        <div class="row">
                          <div class="col-12">
                            <label for="coupon_name" class="form-label">Coupon Name:</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="coupon_name" class="form-control border-start-0" value="{{ $coupons->coupon_name }}" id="coupon_name" placeholder="Enter the coupon name" />
                            </div>
                            @error('coupon_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                           <div class="col-12 mt-2">
                            <label for="coupon_discount" class="form-label">Coupon Discount(%):</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="coupon_discount" class="form-control border-start-0" id="coupon_discount" value="{{ $coupons->coupon_discount }}" placeholder="Enter the coupon discount" />
                            </div>
                            @error('coupon_discount')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="col-12 mt-2">
                            <label for="coupon_validity" class="form-label">Coupon Validity Date:</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="date" name="coupon_validity" class="form-control border-start-0" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_validity }}" id="coupon_validity" placeholder="Enter the coupon date" />
                            </div>
                            @error('coupon_validity')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                           <div class="col-md-12 mt-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                   <span class="text-danger">*</span>
                                  <select name="status" id="status" class="form-control form-select">
                                    @if ($coupons->status == 1)
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
