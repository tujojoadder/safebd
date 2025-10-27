@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin User Profile Update</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin User Profile Update</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- DataTales Example -->
                <div class="row">
                    <form method="post" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 offset-1">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h4>Create a New Commission</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Name:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="text" name="name" value="{{ $user->name }}"
                                                    class="form-control border-start-0" id="name"
                                                    placeholder="Enter name" />
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-1">
                                            <label for="username" class="form-label">User Name:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="text" name="username" value="{{ $user->username }}"
                                                    class="form-control border-start-0" id="username"
                                                    placeholder="Enter username" />
                                            </div>
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-1">
                                            <label for="phone" class="form-label">Phone:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="number" name="phone" value="{{ $user->phone }}"
                                                    class="form-control border-start-0" id="phone"
                                                    placeholder="Enter phone" />
                                            </div>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-1">
                                            <label for="email" class="form-label">Email:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="email" name="email" value="{{ $user->email }}"
                                                    class="form-control border-start-0" id="email"
                                                    placeholder="Enter phone" />
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-1">
                                            <label for="country" class="form-label">Country:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="text" name="country" value="{{ $user->country }}"
                                                    class="form-control border-start-0" id="country"
                                                    placeholder="Enter phone" />
                                            </div>
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-right mt-3">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit"
                                                    style="float:right;">Update</button>
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
