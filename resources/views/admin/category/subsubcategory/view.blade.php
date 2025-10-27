@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubSubCategory View</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SubSubCategory View</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('subsubcategory.index') }}" class="btn btn-primary">SubSubCategory List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

<div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-white">SubSubCategory Details</h6>
    </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
             <tr>
                <td>Category Name(En)</td>
                <td>{{ $subsubcategory->category->category_name_en ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Category Name(Bn)</td>
                <td>{{ $subsubcategory->category->category_name_bn ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>SubCategory Name(En)</td>
                <td>{{ $subsubcategory->subcategory->subcategory_name_en ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>SubCategory Name(Bn)</td>
                <td>{{ $subsubcategory->subcategory->subcategory_name_bn ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>SubSubCategory Name(En)</td>
                <td>{{ $subsubcategory->sub_subcategory_name_en ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>SubSubCategory Name(Bn)</td>
                <td>{{ $subsubcategory->sub_subcategory_name_bn ?? 'NULL' }}</td>
             </tr>
             <td>Status</td>
                 <td>
                    @if ($subsubcategory->status == 1)
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
