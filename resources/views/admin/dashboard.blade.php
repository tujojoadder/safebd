@extends('admin.admin_master')
@section('admin')
@can('dashboard.menu')
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="card radius-10">
			<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-group g-0">
				<div class="col">
					<div class="card-body">
						@php
							$total_order = App\Models\Order::count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $total_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-cart fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Orders</p>
							{{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card-body">
						@php
							$paid_order = App\Models\Order::where('payment_status', 1)->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $paid_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-dollar fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Paid Order</p>
							{{-- <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card-body">
						@php
							$un_paid_order = App\Models\Order::where('payment_status', 0)->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $un_paid_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-group fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Unpaid Order</p>
							{{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card-body">
						@php
							$pending_order = App\Models\Order::where('delivery_status', 'pending')->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $pending_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Pending Order</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$confirmed_order = App\Models\Order::where('delivery_status', 'confirmed')->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $confirmed_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Confirmed Order</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$delivered_order = App\Models\Order::where('delivery_status', 'delivered')->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $delivered_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Delivered Order</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$total_customer = App\Models\User::where('role', 'user')->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $total_customer ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-cart fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Customer</p>
							{{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$total_product = App\Models\Product::where('status',1)->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $total_product ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Product</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$stock_qty = App\Models\Product::where('status',1)->sum('stock_qty');
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $stock_qty ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Product Stock</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$pending_return_order = App\Models\Order::where('status',1)->where('return_order',1)->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $pending_return_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Pending Return Order</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$paid_return_order = App\Models\Order::where('status',1)->where('return_order',2)->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $paid_return_order ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-envelope fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Paid Return Order</p>
							{{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card-body">
						@php
							$total_customer = App\Models\User::where('role', 'user')->count();
						@endphp
						<div class="d-flex align-items-center">
							<h5 class="mb-0">{{ $total_customer ?? '0'}}</h5>
							<div class="ms-auto">
                                <i class='bx bx-cart fs-3 text-white'></i>
							</div>
						</div>
						<div class="progress my-3" style="height:4px;">
							<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="d-flex align-items-center text-white">
							<p class="mb-0">Total Customer</p>
							{{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
						</div>
					</div>
				</div>
			</div><!--end row-->
		</div>

		<div class="row">
			<div class="col-12 col-lg-8 col-xl-8 d-flex">
			   <div class="card radius-10 w-100">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0">Site Traffic</h5>
						</div>
						<div class="dropdown options ms-auto">
							<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
							  <i class='bx bx-dots-horizontal-rounded'></i>
							</div>
							<ul class="dropdown-menu">
							  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
							  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
							  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
							</ul>
						  </div>
					</div>
					<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-white"></i>New Visitor</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-light-1"></i>Old Visitor</span>
					</div>
				   <div class="chart-container-1">
					 <canvas id="chart1"></canvas>
				   </div>
				</div>
				<div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
				  <div class="col">
					<div class="p-3">
					  <h5 class="mb-0">45.87M</h5>
					  <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
					</div>
				  </div>
				  <div class="col">
					<div class="p-3">
					  <h5 class="mb-0">15:48</h5>
					  <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
					</div>
				  </div>
				  <div class="col">
					<div class="p-3">
					  <h5 class="mb-0">245.65</h5>
					  <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
					</div>
				  </div>
				</div>
			   </div>
			</div>

			<div class="col-12 col-lg-4 col-xl-4 d-flex">

			   <div class="card radius-10 overflow-hidden w-100">
				  <div class="card-body">
					<div class="d-flex align-items-center mb-2">
						<div>
							<h5 class="mb-0">Weekly sales</h5>
						</div>
						<div class="dropdown options ms-auto">
							<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
							  <i class='bx bx-dots-horizontal-rounded'></i>
							</div>
							<ul class="dropdown-menu">
							  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
							  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
							  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
							</ul>
						  </div>
					</div>
					<div class="chart-js-container2">
					<div class="piechart-legend">
					  <h3 class="mb-1">95K</h3>
					  <h6 class="mb-0">Total sales</h6>
					 </div>
					  <canvas id="chart2"></canvas>
					 </div>
				  </div>
				  <div class="table-responsive">
					<table class="table align-items-center mb-0">
					  <tbody>
						<tr class="border-top">
						  <td><i class="bx bxs-circle text-white me-2"></i> Direct</td>
						  <td>$5856</td>
						  <td>+55%</td>
						</tr>
						<tr>
						  <td><i class="bx bxs-circle text-light-2 me-2"></i>Affiliate</td>
						  <td>$2602</td>
						  <td>+25%</td>
						</tr>
						<tr>
						  <td><i class="bx bxs-circle text-light-3 me-2"></i>E-mail</td>
						  <td>$1802</td>
						  <td>+15%</td>
						</tr>
					  </tbody>
					</table>
				  </div>
				</div>
			</div>
		</div><!--End Row-->
	</div>
</div>
<!--end page wrapper -->
@endcan
@endsection
