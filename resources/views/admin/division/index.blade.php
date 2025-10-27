@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Division List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Division List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleLargeModal"><i class="bx bxs-plus-square"></i>Add Division</button>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Division</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.division.store') }}" method="POST">
                                @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="division_en">Division Name <span class="text-danger">( English )</span></label>
                                            <input type="text" id="division_en" name="division_en" class="form-control" placeholder="Enter Division Name for (English)" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="division_bn">Division Name <span class="text-danger">( Bengali )</span></label>
                                            <input type="text" id="division_bn" name="division_bn" class="form-control" placeholder="Enter Division Name for (Bengali)" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="url">Division URL <span class="text-danger">( Optional )</span></label>
                                            <input type="text" id="url" name="url" class="form-control" placeholder="Enter Division URL">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!--end breadcrumb-->
          <span class="badge badge-success rounded-pill" style="font-size: 18px;"> Division Count ({{ count($divisions) }}) </span>
          <hr/>
          <div class="card">
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                          <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name EN</th>
                                    <th>Name BN</th>
                                    <th>URL</th>
                                    <th class="text-center">Action</th>
                                </tr>
                          </thead>
                          <tbody>
                            @foreach($divisions as $i => $division)
                            <tr>
                                <td style="vertical-align:middle;">
                                    {{ ++$i }}
                                </td>
                                <td style="vertical-align:middle;">
                                   {{ $division->name_en }}
                                </td>

                                <td style="vertical-align:middle;">
                                    {{ $division->name_bn }}
                                </td>

                                <td style="vertical-align:middle;">
                                    {{ $division->url }}
                                </td>

                                <td class="text-center" style="vertical-align:middle;">
                                    <a href="{{ route('admin.division.delete',$division->id) }}" id="delete" class="btn btn-sm btn-danger" style="border-radius: 5px;"><i style="font-size: 14px;" class="fas fa-trash"></i></a>
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
