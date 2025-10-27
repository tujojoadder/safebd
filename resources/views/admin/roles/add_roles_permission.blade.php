@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css">
    .form-check-label{
    text-transform: capitalize;
    }
 </style>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role In Permission Create</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role In Permission Create</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.roles.permission') }}" class="btn btn-primary">Role In Permission List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('role.permission.store') }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Roles Create</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="role_id" id="role_id">All Roles</label>
                                    <select class="single-select form-control form-select" name="role_id" required>
                                        <option value="" selected disabled>Select Roles</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" value="" id="customckeck15"  >
                                    <label class="form-check-label" for="customckeck15">Select All Permission</label>
                                 </div>
                            </div><hr>
                            @foreach($permission_groups as $group)
                           <div class="row">
                              <div class="col-3">
                                 <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" value="" id="customckeck1"  >
                                    <label class="form-check-label" for="customckeck1">{{ $group->group_name }}</label>
                                 </div>
                              </div>
                              <div class="col-9">
                                 @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                 @endphp
                                 @foreach($permissions as $permission)
                                 <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="customckeck{{ $permission->id }}"  >
                                    <label class="form-check-label" for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
                                 </div>
                                 @endforeach
                                 <br>
                              </div>
                           </div>
                           <!-- end row -->
                           @endforeach
                            <div class="col-md-12 text-right mt-3">
                              <div class="form-group">
                                <button class="btn btn-success" type="submit" style="float:right;">Save</button>
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

<script type="text/javascript">
    $('#customckeck15').click(function(){
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked',true);
        }else{
            $('input[type = checkbox]').prop('checked',false);
        }

    });
 </script>
@endsection
