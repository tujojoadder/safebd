@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('category.create') }}" class="btn btn-success">Add Category</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <span class="badge badge-success rounded-pill" style="font-size: 18px;"> Category Count ({{ count($categories) }}) </span>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Image</th>
                                <th>Category Name (English)</th>
                                <th>Category Name (Bangla)</th>
                                <th>Featured Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($categories as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td>
                                        <img src="{{ asset($item->category_image) }}" width="50px" height="30px;" class="img-sm img-avatar" alt="No Image">
                                    </td>
                                    <td> {{ $item->category_name_en ?? 'NULL' }} </td>
                                    <td> {{ $item->category_name_bn ?? 'NULL' }} </td>
                                    <td class="col-1">
                                        @if ($item->featured_category == 1)
                                        <div class="icon-badge position-relative bg-light me-lg-5">
                                            <i class="fadeIn animated bx bx-check align-middle font-22 text-white"></i>
                                        </div>
                                        @else
                                        <div class="icon-badge position-relative bg-light me-lg-5">
                                            <i class="fadeIn animated bx bx-x align-middle font-22 text-white"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 1)
                                        <a href="{{ route('category.in_active',['id'=>$item->id]) }}" class="badge badge-success"><span class="badge bg-success">Active</span></a>
                                        @else
                                          <a href="{{ route('category.active',['id'=>$item->id]) }}" class="badge badge-danger"><span class="badge bg-danger">Disable</span></a>
                                        @endif
                                    </td>
                                    <td>
                                      <a href="{{ route('category.view',$item->id) }}" class="btn btn-success btn-sm px-1"><i class="fas fa-eye"></i></a>

                                      <a href="{{ route('category.edit',$item->id) }}" class="btn btn-primary btn-sm px-1"><i class="fas fa-edit"></i></a>

                                      <a href="{{ route('category.delete',$item->id) }}"class="btn btn-danger btn-sm px-1" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
