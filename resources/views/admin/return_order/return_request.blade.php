@extends('admin.admin_master')
@section('admin')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Return Order</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Return Order List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <span class="badge badge-success rounded-pill" style="font-size: 18px;"> Return Order List Count ({{ count($orders) }}) </span>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date </th>
                                <th>Invoice </th>
                                <th>Amount </th>
                                <th>Payment </th>
                                <th>Status </th>
                                <th>Reason </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($orders as $key => $item)
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->invoice_no }}</td>
                                    <td> ৳{{ number_format($item->grand_total ?? '0', 2)}}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>
                                        @if($item->return_order == 1)
                                            <span class="badge bg-danger"> Pending </span>
                                        @elseif($item->return_order == 2)
                                            <span class="badge bg-success"> Success </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->return_reason }}</td>
                                    <td>
                                        <a href="{{ route('order.show',$item->id) }}" class="btn btn-success" title="Details"><i class="fa fa-eye"></i> </a>
                                        <a href="{{ route('return.request.approved',$item->id) }}" class="btn btn-danger" title="Approved" id="approved"><i class="fa-solid fa-person-circle-check"></i> </a>
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
