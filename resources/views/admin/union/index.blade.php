@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Union List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Union List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleLargeModal"><i class="bx bxs-plus-square"></i>Add Union</button>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Union</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.union.store') }}" method="POST">
                                @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="division">Select Division <span class="text-danger">( English )</span></label>
                                            <select name="division" id="division" class="form-control" required>
                                                <option value> -- Select -- </option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" style="color:black;"> {{ $division->name_en }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="District">Select District <span class="text-danger">( English )</span></label>
                                            <select name="district" id="District" class="form-control" required>
                                                <option value style="color:black;"> -- Select -- </option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="Subdistrict">Select Sub District</label>
                                            <select name="subdistrict" id="Subdistrict" class="form-control" required>
                                                <option value style="color: black;"> -- Select -- </option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="en">Union Name <span class="text-danger">( English )</span></label>
                                            <input type="text" id="en" name="en" class="form-control" placeholder="Enter Union Name for (English)" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="bn">Union Name <span class="text-danger">( Bengali )</span></label>
                                            <input type="text" id="bn" name="bn" class="form-control" placeholder="Enter Union Name for (Bengali)" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="url">Union URL <span class="text-danger">( Optional )</span></label>
                                            <input type="text" id="url" name="url" class="form-control" placeholder="Enter Union URL">
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
          <span class="badge badge-success rounded-pill" style="font-size: 18px;"> Union Count ({{ count($unions) }}) </span>
          <hr/>
          <div class="card">
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                          <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Sub District</th>
                                    <th>Union Name EN</th>
                                    <th>Union Name BN</th>
                                    <th>URL</th>
                                    <th class="text-center">Action</th>
                                </tr>
                          </thead>
                          <tbody>
                            @foreach( $unions as $i => $union)
                            <tr>
                                <td style="vertical-align:middle;">
                                    {{ ++$i }}
                                </td>
                                <td style="vertical-align:middle;">
                                   {{ get_sub_district($union->upazilla_id) }}
                                </td>
                                <td style="vertical-align:middle;">
                                   {{ $union->name_en }}
                                </td>

                                <td style="vertical-align:middle;">
                                    {{ $union->name_bn }}
                                </td>

                                <td style="vertical-align:middle;">
                                    {{ $union->url }}
                                </td>
                               
                                <td class="text-center" style="vertical-align:middle;">
                                    <a href="{{ route('admin.union.delete',$union->id) }}" id="delete" class="btn btn-sm btn-danger" style="border-radius: 5px;"><i style="font-size: 14px;" class="fas fa-trash"></i></a>
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
@push('footer-script')
    <script type="text/javascript">
        $('#division').change(function(){
            var data = $('#division').val();
            if(data){
                $.ajax({
                    type: "GET",
                    url: "{{ url('subdistrict/ajax') }}/"+data,
                    success:function(res){
                        if(res){
                            $("#District").empty();
                            $("#District").append('<option value="" selected>-- Select --</option>');
                            $.each(res,function(key,value){
                                $("#District").append('<option style="color:black;" value="'+value.id+'">'+value.name_en+'</option>');
                            });
                        }else{
                            $("#District").empty();
                        }
                    }
                });
            }
            else{
                $("#District").empty();
            }
        });
        $('#District').change(function(){
            var data2 = $('#District').val();
            if(data2){
                $.ajax({
                    type: "GET",
                    url: "{{ url('union/ajax') }}/"+data2,
                    success:function(res){
                        if(res){
                            $("#Subdistrict").empty();
                            $("#Subdistrict").append('<option value="" selected>-- Select --</option>');
                            $.each(res,function(key,value){
                                $("#Subdistrict").append('<option style="color:black;" value="'+value.id+'">'+value.name_en+'</option>');
                            });
                        }else{
                            $("#Subdistrict").empty();
                        }
                    }
                });
            }
            else{
                $("#Subdistrict").empty();
            }
        });
    </script>
@endpush
