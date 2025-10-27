@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blog View</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Blog View</li>
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-white">Blog Details</h6>
    </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
             <tr>
                <td>Blog  Title En</td>
                <td>{{ $blog->blog_title_en }}</td>
             </tr>
             <tr>
                <td>Blog  Title Bn</td>
                <td>{{ $blog->blog_title_bn }}</td>
             </tr>
            <tr>
                <td>Description (English):</td>
                <td>{!! Str::limit($blog->blog_description_en, 600) !!}</td>
             </tr>
             <tr>
                <td>Description (Bangla):</td>
                <td>{!! Str::limit($blog->blog_description_bn, 1100) !!}</td>
             </tr>
             <tr>
                <td>Slider Image</td>
                <td><img src="{{ asset($blog->blog_image) }}" alt="" style="height:70px; width:80px;"></td>
             </tr>
             <td>Status</td>
                <td>
                    @if ($blog->status == 1)
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
