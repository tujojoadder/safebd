@extends('layouts.frontend')
@section('content-frontend')
    <main class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>User Information</li>
                </ul>
            </div>
        </div>
        <section class="ps-section--account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card p-5">
                            @include('frontend.common.user_side_nav')
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card rounded-0 shadow-none border">
                            <div class="card-header pt-4 border-bottom-0">
                                <h5 class="mb-0 fs-18 fw-700 text-dark">User Order View</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Shipping Details</h4>
                                                </div>
                                                <hr>
                                                <div class="card-body">
                                                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                        <tr>
                                                            <th>Shipping Name:</th>
                                                            <th>{{ $order->user->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping Phone:</th>
                                                            <th>{{ $order->phone }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping Email:</th>
                                                            <th>{{ $order->email }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping Address:</th>
                                                            <th>{{ $order->address }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Division:</th>
                                                            <th>{{ $order->division->name_en ?? 'Null' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>District:</th>
                                                            <th>{{ $order->district->name_en ?? 'Null' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Upazilla :</th>
                                                            <th>{{ $order->upazilla->name_en ?? 'Null' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Union :</th>
                                                            <th>{{ $order->union->name_en ?? 'Null' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Post Code :</th>
                                                            <th>{{ $order->post_code }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Date :</th>
                                                            <th>{{ $order->order_date }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // End col-md-6  -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Order Details
                                                        <span class="text-danger">Invoice : {{ $order->invoice_no }}
                                                        </span>
                                                    </h4>
                                                </div>
                                                <hr>
                                                <div class="card-body">
                                                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                        <tr>
                                                            <th> Name :</th>
                                                            <th>{{ $order->user->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone :</th>
                                                            <th>{{ $order->user->phone }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Type:</th>
                                                            <th>{{ $order->payment_method }}</th>
                                                        </tr>
                                                        {{-- <tr>
                                          <th>Transx ID:</th>
                                          <th>{{ $order->transaction_id }}</th>
                                       </tr> --}}
                                                        <tr>
                                                            <th>Invoice:</th>
                                                            <th class="text-danger">{{ $order->invoice_no }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Amonut:</th>
                                                            <th>৳{{ number_format($order->grand_total ?? '0', 2) }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Status:</th>
                                                            <th><span
                                                                    class="badge rounded-pill bg-warning">{{ $order->delivery_status }}</span>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // End col-md-6  -->
                                    </div>
                                    <!-- // End Row  -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table" style="font-weight: 600;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-md-1">
                                                                <label>Image </label>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <label>Product Name </label>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <label>Vendor Name </label>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <label>Product Code </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label>Color </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label>Size </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label>Quantity </label>
                                                            </td>
                                                            <td class="col-md-3">
                                                                <label>Price </label>
                                                            </td>
                                                        </tr>
                                                        @foreach ($order->order_details as $key => $item)
                                                            <tr>
                                                                <td class="col-md-1">
                                                                    <label>
                                                                        <img src="{{ asset($item->product->product_thumbnail) }}"
                                                                            style="width:50px; height:50px;"> </label>
                                                                </td>
                                                                <td class="col-md-2">
                                                                    <label>{{ $item->product->name_en }}</label>
                                                                </td>
                                                                @if ($item->vendor_id == null)
                                                                    <td class="col-md-2">
                                                                        <label>Owner </label>
                                                                    </td>
                                                                @else
                                                                    <td class="col-md-2">
                                                                        <label>{{ $item->product->vendor->name }} </label>
                                                                    </td>
                                                                @endif
                                                                <td class="col-md-2">
                                                                    <label>{{ $item->product->product_code }} </label>
                                                                </td>
                                                                @if ($item->color == null)
                                                                    <td class="col-md-1">
                                                                        <label>.... </label>
                                                                    </td>
                                                                @else
                                                                    <td class="col-md-1">
                                                                        <label>{{ $item->color }} </label>
                                                                    </td>
                                                                @endif
                                                                @if ($item->size == null)
                                                                    <td class="col-md-1">
                                                                        <label>.... </label>
                                                                    </td>
                                                                @else
                                                                    <td class="col-md-1">
                                                                        <label>{{ $item->size }} </label>
                                                                    </td>
                                                                @endif
                                                                <td class="col-md-1">
                                                                    <label>{{ $item->qty }} </label>
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <label>
                                                                        ৳{{ number_format($item->price ?? '0', 2) }}
                                                                        <br>
                                                                        Total = ৳{{ $item->price * $item->qty }}
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <!--  // Start Return Order Option  -->
                                            @if ($order->delivery_status !== 'delivered')
                                            @else
                                                @php
                                                    $order = App\Models\Order::where('id', $order->id)
                                                        ->where('return_reason', '=', null)
                                                        ->first();
                                                    // dd($order);
                                                @endphp
                                                @if ($order)
                                                    <form action="{{ route('return.order', $order->id) }}" method="post">
                                                        @csrf
                                                        <div class="form-group"
                                                            style=" font-weight: 600; font-size: initial; color: #000000; ">
                                                            <label>Order Return Reason</label>
                                                            <textarea name="return_reason" class="form-control" style="width:100%;" placeholder="some text here" required></textarea>
                                                        </div>
                                                        <button type="submit" class="ps-btn" style=";">Order
                                                            Return</button>
                                                    </form>
                                                @else
                                                    <h5><span class=" " style="color:red;">You have send return request
                                                            for this product</span></h5>
                                                    <br><br>
                                                @endif
                                            @endif
                                            <!--  // End Return Order Option  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
