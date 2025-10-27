@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Permission Create</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Permission Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('all.permission') }}" class="btn btn-primary">Permission List</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- DataTales Example -->
                <div class="row">
                    <form method="post" action="{{ route('permission.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 offset-1">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h4>Permission Create</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Permission Name:</label>
                                            <div class="input-group input-group-lg"> <span class="input-group-text"><i
                                                        class='bx bxs-user'></i></span>
                                                <input type="text" name="name" class="form-control border-start-0"
                                                    id="name" placeholder="Enter permission name" />
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="group_name" id="group_name"
                                                    required="">Group Name</label>
                                                <select class="single-select form-control form-select" name="group_name"
                                                    required>
                                                    <option value="" selected disabled>Select Group Name</option>
                                                    <option value="dashboard">Dashboard</option>
                                                    <option value="slider">Slider</option>
                                                    <option value="pos">Point Of Sales</option>
                                                    <option value="product">Product</option>
                                                    <option value="sales"> Sales</option>
                                                    <option value="report"> Reports</option>
                                                    <option value="stock">Manage Stock </option>
                                                    <option value="return_order"> Return Order </option>
                                                    <option value="review"> Review </option>
                                                    <option value="subscribe"> Subscribe </option>
                                                    <option value="brand"> Brand </option>
                                                    <option value="category"> Category </option>
                                                    <option value="blog"> Blog </option>
                                                    <option value="banner"> Banner </option>
                                                    <option value="checkout_notice"> Checkout Notice </option>
                                                    <option value="checkout_setting"> Checkout Settings </option>
                                                    <option value="country"> Country Information </option>
                                                    <option value="roles"> Roles And Permission </option>
                                                    <option value="setting_staff"> Setting Admin Staff </option>
                                                    <option value="coupon"> Coupon </option>
                                                    <option value="pages"> Pages </option>
                                                    <option value="setting"> Advance Setting </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right mt-3">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit"
                                                    style="float:right;">Save</button>
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
        $(document).ready(function() {
            $('.brand_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
