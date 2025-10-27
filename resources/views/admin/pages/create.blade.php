@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Pages Create</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pages Create</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('pages.index') }}" class="btn btn-primary">Pages List</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
         <!-- DataTales Example -->
         <div class="row">
            <form method="post" action="{{ route('pages.store') }}" enctype="multipart/form-data">
              @csrf
               <div class="col-md-10 offset-1">
                  <div class="card shadow mb-4">
                     <div class="card-body">
                        <h4>Pages Create</h4>
                        <hr>
                        <div class="row">
                          <div class="col-12">
                            <label for="name_en" class="form-label">Pages Name (English):</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="name_en" class="form-control border-start-0" id="name_en" placeholder="Enter Page Name English" />
                            </div>
                            @error('name_en')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                           <div class="col-12 mt-2">
                            <label for="name_bn" class="form-label">Pages Name (Bangla):</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="name_bn" class="form-control border-start-0" id="name_bn" placeholder="Enter Page Name Bangla" />
                            </div>
                            @error('name_bn')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="col-12 mt-2">
                            <label for="title" class="form-label">Title Name:</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
                              <input type="text" name="title" class="form-control border-start-0" id="title" placeholder="Enter Pages Title" />
                            </div>
                            @error('title')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="col-md-12 mt-2">
                            <div class="form-group">
                              <label for="description_en" class="col-sm-3 col-form-label">Description (English):</label>
                              <div class="col-sm-12">
                                <textarea class="form-control" name="description_en" id="description_en" rows="3" placeholder="Enter Description English"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="description_bn" class="col-sm-3 col-form-label">Description (Bangla):</label>
                              <div class="col-sm-12">
                                <textarea class="form-control" name="description_bn" id="description_bn" rows="3" placeholder="Enter Description Bangla"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12 mt-2">
                              <div class="form-group">
                                  <label for="status">Position:</label>
                                   <span class="text-danger">*</span>
                                  <select name="position" id="position" class="form-control form-select">
                                    <option value="1">Nav</option>
                                    <option value="2">Both</option>
                                    <option value="3">Bottom</option>
                                  </select>
                              </div>
                           </div>

                           <div class="col-md-12 mt-2">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                   <span class="text-danger">*</span>
                                  <select name="status" id="status" class="form-control form-select">
                                      <option value="1">Active</option>
                                      <option value="0">Disable</option>
                                  </select>
                              </div>
                           </div>
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
@endsection
