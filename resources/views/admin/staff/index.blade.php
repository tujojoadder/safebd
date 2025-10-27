@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Staffs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Staffs</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('staff.create') }}" class="btn btn-light"><i class="bx bxs-plus-square"></i>Add New Staffs</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <span class="badge badge-success rounded-pill" style="font-size: 18px;"> Staff Count ({{ count($staffs) }}) </span>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffs as $key => $staff)
                                @if($staff->user != null)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $staff->user->name }}</td>
                                        <td>{{ $staff->user->email }}</td>
                                        <td>{{ $staff->user->phone }}</td>
                                        <td>
                                            @if ($staff->role != null)
                                                <span class="badge bg-danger"> {{ $staff->role->name }}</span>
                                            @endif
                                            {{-- <span class="badge bg-danger"> {{ $item->role }} </span> --}}
                                            {{-- @foreach($item->roles as $role)
                                                <span class="badge bg-danger"> {{ $role->name }} </span>
                                            @endforeach --}}
                                        </td>
                                        <td>
                                            @can('edit_staff')
                                            <a href="{{route('staff.edit', encrypt($staff->id))}}" class="btn btn-primary btn-sm px-1"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('delete_staff')
                                            <a href="{{route('staff.destroy', $staff->id)}}"class="btn btn-danger btn-sm px-1" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
