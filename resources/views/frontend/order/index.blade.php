@extends('layouts.frontend')
@section('content-frontend')
    <main class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>My Orders</li>
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
                                <h5 class="mb-0 fs-18 fw-700 text-dark">My Orders List</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-responsive-sm">
                                            <thead class="">
                                                <tr style="background: #e2e2e2;">
                                                    <th>Invoice No</th>
                                                    <th>Date & Time</th>
                                                    <th>Total Amount</th>
                                                    <th>Status</th>
                                                    <th colspan="2">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($orders->count() > 0)
                                                    @foreach ($orders as $key => $order)
                                                        <tr>
                                                            <td class="col-md-1">
                                                                <label for=""> {{ $order->invoice_no }}</label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for="">
                                                                    {{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY') }}
                                                                </label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                <label for="">৳{{ $order->grand_total }}</label>
                                                            </td>
                                                            <td class="col-md-1">
                                                                @if ($order->delivery_status == 'pending')
                                                                    <span
                                                                        class="badge badge-warning text-white px-3 py-2">Pending</span>
                                                                @elseif($order->delivery_status == 'confirmed')
                                                                    <span
                                                                        class="badge badge-primary text-white px-3 py-2">Confirmed</span>
                                                                    badge badge-success
                                                                @elseif($order->delivery_status == 'shipped')
                                                                    <span
                                                                        class="badge badge-primary text-white px-3 py-2">Shipped</span>
                                                                @elseif($order->delivery_status == 'picked_up')
                                                                    <span
                                                                        class="badge badge-primary text-white px-3 py-2">Picked
                                                                        Up</span>
                                                                @elseif($order->delivery_status == 'on_the_way')
                                                                    <span
                                                                        class="badge badge-primary text-white px-3 py-2">On
                                                                        The Way</span>
                                                                @elseif($order->delivery_status == 'delivered')
                                                                    <span
                                                                        class="badge badge-success text-white px-3 py-2">Delivered</span>
                                                                @elseif($order->delivery_status == 'cancel')
                                                                    <span
                                                                        class="badge badge-danger text-white px-3 py-2">Cancel</span>
                                                                @endif
                                                            </td>
                                                            <td class="col-md-2">
                                                                <a href="{{ route('order.view', $order->invoice_no) }}"
                                                                    class="btn btn-lg btn-primary"><i class="fa fa-eye"></i>
                                                                    View</a>
                                                                <a target="_blank"
                                                                    href="{{ route('order.invoice.download', $order->id) }}"
                                                                    class="btn btn-lg btn-danger"><i class="fa fa-download"
                                                                        style="color: white;"></i> Invoice </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td>
                                                            <span class="text-center text-white">Your Order Empty!</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- / end col md 8 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
