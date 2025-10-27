@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon View</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon View</li>
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-white">Coupon Details</h6>
    </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
               <tr>
                  <td>Coupon Name</td>
                  <td>{{ $coupon->coupon_name }}</td>
               </tr>
               <tr>
                  <td>Coupon Discount</td>
                  <td>{{ $coupon->coupon_discount }}%</td>
               </tr>
               <tr>
                  <td>Coupon Validity</td>
                  <td>{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D,d F Y')}}</td>
               </tr>
               <tr>
                  <td>Valid</td>
                  <td>
                     @if($coupon->coupon_validity  >= Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge bg-success">Valid</span>
                     @else
                       <span class="badge bg-danger">InValid</span>
                     @endif
                  </td>
               </tr>
             <td>Status</td>
                <td>
                    @if ($coupon->status == 1)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Disable</span>
                    @endif

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
