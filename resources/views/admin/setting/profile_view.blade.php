@extends('layouts.backend')
@section('admin')
<div class="dashboard-wrapper">
    <!-- Container fluid Starts -->
    <div class="container-fluid">
    <!-- Top Bar Starts -->
       <div class="top-bar clearfix">
          <div class="row gutter">
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="page-title">
                   <h3>Admin Profile</h3>
                </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <ul class="right-stats" id="mini-nav-right">
                   <li>
                      <a href="javascript:void(0)" class="btn btn-danger"><span>76</span>Sales</a> 
                   </li>
                   <li>
                      <a href="tasks.html" class="btn btn-success">
                      <span>18</span>Tasks</a>
                   </li>
                   <li>
                      <a href="javascript:void(0)" class="btn btn-info"><i class="icon-download6"></i> Export</a>
                   </li>
                </ul>
             </div>
          </div>
       </div>
       <!-- Top Bar Ends -->

       <div class="top-bar clearfix">
          <div class="row gutter">
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="page-title">
                   <a href="{{ route('admin.profile.edit') }}" class="btn btn-warning">Edit Profile</a>
                </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!-- <ul class="right-stats" id="mini-nav-right">
                   <li>
                      <a href="javascript:void(0)" class="btn btn-danger"><span>76</span>Sales</a> 
                   </li>
                   <li>
                      <a href="tasks.html" class="btn btn-success">
                      <span>18</span>Tasks</a>
                   </li>
                   <li>
                      <a href="javascript:void(0)" class="btn btn-info"><i class="icon-download6"></i> Export</a>
                   </li>
                </ul> -->
             </div>
          </div>
       </div>

       <!-- Row starts -->
        <div class="row gutter">
            <div class="col-lg-5 col-md-5 col-sm-9 col-xs-12">
                <div class="panel height2 random-bg-five">
                    <div class="panel-body">
                        <div class="user-profile clearfix">
                            @php
                                $id = Auth::guard('web')->user()->id;
                                $adminData = App\Models\User::where('role',2)->find($id);
                            @endphp
                            <div class="user-img">
                                <img src="{{ (!empty($adminData->profile_photo)) ? url('public/upload/admin_images/'.$adminData->profile_photo):url('public/upload/no_image.jpg') }}" alt="User Info">
                                <span class="completed-info">100%</span>
                            </div>
                            <h5>Completed</h5>
                            <h3>{{ $adminData->name ?? 'Null' }}</h3>
                            <h4>{{ $adminData->email ?? 'Null' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="panel height2 random-bg-six">
                    <div class="panel-body no-padding">
                        <div class="current-location">
                            <h4 class="text-white no-margin"><i class="icon-location icon-2x"></i> Location</h4>
                            <div id="mapDenmark" class="chart-height1"></div>
                            <h5 class="location">{{ $adminData->country ?? 'Null' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Row inside row starts -->
                <div class="row gutter">
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="panel height1 random-bg-two">
                            <div class="panel-body text-center">
                                <div class="user-stats">
                                    <div>
                                        <i class="icon-user2 icon-4x text-white"></i>
                                    </div>
                                    <h5>1983</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="panel height1 random-bg-four">
                            <div class="panel-body text-center">
                                <div class="user-stats">
                                    <h1>14<small>yrs</small></h1>
                                    <h5>Experience</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="panel height1 random-bg-seven">
                            <div class="panel-body text-center">
                                <div class="user-stats">
                                    <h1>489</h1>
                                    <h5>Projects</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                        <div class="panel height1 random-bg-three">
                            <div class="panel-body no-padding">
                                <div class="user-stats">
                                    <div class="like-photo">
                                        <img src="{{ asset('backend/img/like-arise-dashboard.jpg ') }}" class="img-responsive" alt="Photos Liked" />
                                        <a href="javascript:void(0)" class="like">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row inside row ends -->
            </div>
        </div>
        <!-- Row ends -->
    </div>
</div>
@endsection
			