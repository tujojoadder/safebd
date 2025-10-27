@extends('layouts.frontend')
@section('content-frontend')
<main class="ps-page--my-account">
   <div class="ps-breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>Return Order Page</li>
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
                    <h5 class="mb-0 fs-18 fw-700 text-dark">Return Order</h5>
                  </div>
                  <div class="card-body">
                    <table class="table" style="background:#e0d0d0;font-weight: 600;" >
                        <thead>
                           <tr>
                              <th>Sl</th>
                              <th>Date</th>
                              <th>Totaly</th>
                              <th>Payment</th>
                              <th>Invoice</th>
                              <th>Reason</th>
                              <th>Status</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $key=> $order)
                           <tr>
                              <td>{{ $key+1 }}</td>
                              <td> {{ $order->order_date }}</td>
                              <td> ৳{{ number_format($order->grand_total ?? '0', 2)}}</td>
                              <td> {{ $order->payment_method }}</td>
                              <td> {{ $order->invoice_no }}</td>
                              <td> {{ $order->return_reason }}</td>
                              <td>
                                @if($order->return_order == 0)
                                    <span class="badge rounded-pill bg-warning text-light">No Retrun Request</span>
                                @elseif($order->return_order == 1)
                                    <span class="badge rounded-pill bg-danger text-light">Pedding</span>
                                @elseif($order->return_order == 2)
                                    <span class="badge rounded-pill bg-success text-light">Success</span>
                                @endif
                              </td>
                              <td class="d-flex">
                                <a href="{{ route('user.orders.index') }}" class="btn-lg btn-success" style="margin-right:3px;"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('order.invoice.download',$order->id) }}" class="btn-lg btn-danger"><i class="fa fa-download"></i></a>
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
   </section>
</main>
@endsection

