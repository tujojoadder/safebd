@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubCategory List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SubCategory List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('subcategory.create') }}" class="btn btn-success">Add SubCategory</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <span class="badge badge-success rounded-pill" style="font-size: 18px;"> SubCategory Count ({{ count($subcategories) }}) </span>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category(En)</th>
                                <th>SubCategory(En)</th>
                                <th>SubCategory(Bn)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($subcategories as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td>{{  $item->category->category_name_en ?? 'NULL' }}</td>
                                    <td> {{ $item->subcategory_name_en ?? 'NULL' }} </td>
                                    <td> {{ $item->subcategory_name_bn ?? 'NULL' }} </td>
                                    <td>
                                        @if($item->status == 1)
                                        <a href="{{ route('subcategory.in_active',['id'=>$item->id]) }}" class="badge badge-success"><span class="badge bg-success">Active</span></a>
                                        @else
                                          <a href="{{ route('subcategory.active',['id'=>$item->id]) }}" class="badge badge-danger"><span class="badge bg-danger">Disable</span></a>
                                        @endif
                                    </td>
                                    <td>
                                      <a href="{{ route('subcategory.view',$item->id) }}" class="btn btn-success btn-sm px-1"><i class="fas fa-eye"></i></a>

                                      <a href="{{ route('subcategory.edit',$item->id) }}" class="btn btn-primary btn-sm px-1"><i class="fas fa-edit"></i></a>

                                      <a href="{{ route('subcategory.delete',$item->id) }}"class="btn btn-danger btn-sm px-1" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
