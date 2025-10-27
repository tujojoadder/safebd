@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category View</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category View</li>
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-white">Category Details</h6>
    </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
             <tr>
                <td>Category Name En</td>
                <td>{{ $category->category_name_en }}</td>
             </tr>
             <tr>
                <td>Category Name Bn</td>
                <td>{{ $category->category_name_bn }}</td>
             </tr>
              <tr>
                <td>Category Image</td>
                <td><img src="{{ asset($category->category_image) }}" alt="" style="height:70px; width:80px;"></td>
             </tr>
             <tr>
                 <td>Featured Category</td>
                 <td>
                    @if ($category->featured_category == 1)
                    <div class="icon-badge position-relative bg-light me-lg-5">
                        <i class="fadeIn animated bx bx-check align-middle font-22 text-white"></i>
                    </div>
                    @else
                    <div class="icon-badge position-relative bg-light me-lg-5">
                        <i class="fadeIn animated bx bx-x align-middle font-22 text-white"></i>
                    </div>
                    @endif
                </td>
             </tr>
             <tr>
             <td>Status</td>
                 <td>
                    @if ($category->status == 1)
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
