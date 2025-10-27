@extends('admin.admin_master')
@section('admin')

    <!-- Content Wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container-fluid">
                <div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Order detail</h2>
                        <p>Details for Order ID: {{ $order->invoice_no ?? 'Null' }}</p>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <header class="card-header bg-success text-white">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 mb-lg-0 mb-15">
                                <span class="text-white"> <i class="material-icons md-calendar_today"></i>
                                    <b>
                                        {{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY') }}
                                    </b> </span> <br />
                                <small class="text-white">Order ID: {{ $order->invoice_no ?? 'Null' }}</small>
                            </div>
                            @php
                                $payment_status = $order->payment_status;
                                $delivery_status = $order->delivery_status;
                            @endphp
                            <div class="col-lg-4 col-md-4 ms-auto text-md-end">
                                <select class="form-select form-control d-inline-block select2 mb-lg-0 mr-5 mw-200"
                                    id="update_payment_status">
                                    <option value="0" @if ($payment_status == '0') selected @endif>Unpaid</option>
                                    <option value="1" @if ($payment_status == '1') selected @endif>Paid</option>
                                </select>
                                @if ($delivery_status != 'delivered' && $delivery_status != 'cancelled')
                                    <select class="form-select d-inline-block select2 mb-lg-0 mr-5 mw-200"
                                        id="update_delivery_status">
                                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending
                                        </option>
                                        <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>
                                            Confirmed</option>
                                        <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped
                                        </option>
                                        <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked
                                            Up</option>
                                        <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>On The
                                            Way</option>
                                        <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>
                                            Delivered</option>
                                        <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel
                                        </option>
                                    </select>
                                @else
                                    <input type="text" class="form-control d-inline-block mb-lg-0 mr-5 mw-200"
                                        value="{{ $delivery_status }}" disabled>
                                @endif

                                <!-- <a class="btn btn-primary" href="#">Save</a> -->
                                <a class="btn btn-danger print ms-2 mt-2" onclick="window.print();"><i
                                        class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </header>
                    <!-- card-header end// -->
                    <div class="card-body">
                        <div class="row mb-50 mt-20 order-info-wrap">
                            <div class="col-md-4">
                                <article class="icontext align-items-start">
                                    <span class="icon icon-sm rounded-circle bg-primary-light">
                                        <i class="text-primary material-icons md-person"></i>
                                    </span>


                                    <div class="text">
                                        <h6 class="mb-1">Customer info</h6>
                                        <p class="mb-1">
                                            {{ $order->user->name ?? 'Null' }} <br />
                                            {{ $order->user->email ?? 'Null' }} <br />
                                            phone:{{ $order->phone ?? 'Null' }}
                                        </p>
                                    </div>
                                </article>
                            </div>
                            <!-- col// -->
                            <div class="col-md-4">
                                <article class="icontext align-items-start">
                                    <span class="icon icon-sm rounded-circle bg-primary-light">
                                        <i class="text-primary material-icons md-local_shipping"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1">Order info</h6>
                                        <p class="mb-1">
                                            Order Id: {{ $order->invoice_no ?? 'Null' }} </br>
                                            Shipping: Pickup <br />
                                            Pay method: Cash <br />
                                            Status: @php
                                                $status = $order->delivery_status;
                                                if ($order->delivery_status == 'cancelled') {
                                                    $status = 'Received';
                                                }

                                            @endphp
                                            {!! $status !!}
                                        </p>
                                    </div>
                                </article>
                            </div>
                            <!-- col// -->
                            <div class="col-md-4">
                                <article class="icontext align-items-start">
                                    <span class="icon icon-sm rounded-circle bg-primary-light">
                                        <i class="text-primary material-icons md-place"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="mb-1">Deliver to</h6>
                                        <p class="mb-1">
                                            Union: {{ ucwords($order->union->name_en ?? 'Null') }}, <br />
                                            Upazilla: {{ ucwords($order->upazilla->name_en ?? 'Null') }}, <br />
                                            District: {{ ucwords($order->district->name_en ?? 'Null') }},<br />
                                            Division: {{ ucwords($order->division->name_en ?? 'Null') }}
                                        </p>
                                    </div>
                                </article>
                            </div>
                            <!-- col// -->
                            <div class="col-md-12 mt-60">
                                <table class="table table-bordered table-responsive-sm">
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                                        @csrf
                                        <tbody>
                                            <tr>
                                                <th>Invoice No</th>
                                                <td>{{ $order->invoice_no ?? 'Null' }}</td>
                                                <th>Email</th>
                                                <td><input type="" class="form-control" name="email"
                                                        value="{{ $order->user->email ?? 'Null' }}"></td>
                                            </tr>
                                            <tr>
                                                <th class="col-2">Shipping Address</th>
                                                <td>
                                                    <label for="division_id" class="fw-bold text-black"><span
                                                            class="text-danger">*</span> Division</label>
                                                    <select class="form-select form-control select2" name="division_id"
                                                        id="division_id" required>
                                                        <option value="">Select Division</option>

                                                        @foreach (get_divisions($order->division_id) as $division)
                                                            <option value="{{ $division->id }}"
                                                                {{ $division->id == $order->division_id ? 'selected' : '' }}>
                                                                {{ ucwords($division->name_en) }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="district_id" class="fw-bold text-black"><span
                                                            class="text-danger">*</span> District</label>
                                                    <select class="form-control form-select select2" name="district_id"
                                                        id="district_id" required>
                                                        <option selected="" value="">Select District</option>
                                                        @foreach (get_district_by_division_id($order->division_id) as $district)
                                                            <option value="{{ $district->id }}"
                                                                {{ $district->id == $order->district_id ? 'selected' : '' }}>
                                                                {{ ucwords($district->name_en) }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="upazilla_id" class="fw-bold text-black"><span
                                                            class="text-danger">*</span> Upazila</label>
                                                    <select class="form-control form-select select2" name="upazilla_id"
                                                        id="upazilla_id" required>
                                                        <option selected="" value="">Select Upazila</option>
                                                        @foreach (get_upazilla_by_district_id($order->district_id) as $upazilla)
                                                            <option value="{{ $upazilla->id }}"
                                                                {{ $upazilla->id == $order->upazilla_id ? 'selected' : '' }}>
                                                                {{ ucwords($upazilla->name_en) }}</option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="upazilla_id" class="fw-bold text-black"><span
                                                            class="text-danger">*</span> Union</label>
                                                    <select class="form-control form-select select2" name="union_id"
                                                        id="union_id" required>
                                                        <option selected="" value="">Select Union</option>
                                                        @foreach (get_union_by_upazilla_id($order->upazilla_id) as $union)
                                                            <option value="{{ $union->id }}"
                                                                {{ $union->id == $order->union_id ? 'selected' : '' }}>
                                                                {{ $union->name_en }}</option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Method</th>
                                                <td>
                                                    <select class="form-control form-select select2" name="payment_method"
                                                        id="payment_method"> orders
                                                        @php
                                                            $payment_method = $order->payment_method;
                                                        @endphp
                                                        <option selected="" value="">Select Payment Method
                                                        </option>
                                                        <option value="cash"
                                                            @if ($payment_method == 'cash_on_delivery') selected @endif>Cash</option>
                                                        <option value="bikash"
                                                            @if ($payment_method == 'bkash') selected @endif>Bikash
                                                        </option>
                                                        <option value="nagad"
                                                            @if ($payment_method == 'nagad') selected @endif>Nagad
                                                        </option>
                                                    </select>
                                                </td>
                                                <th>Shipping Method</th>
                                                <td>
                                                    <select class="form-control form-select" name="shipping_type"
                                                        id="shipping_type">
                                                        @if ($order->shipping_cost == '60')
                                                            <option value="inside_dhaka" selected>Inside Dhaka</option>
                                                        @elseif($order->shipping_cost == '120')
                                                            <option value="outside_dhaka" selected>Outside Dhaka</option>
                                                        @else
                                                            <option value="free_shipping" selected>Free Shipping</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping Charge</th>
                                                <td><input type="" class="form-control" name="shipping_cost"
                                                        value="৳{{ number_format($order->shipping_cost ?? '0', 2) }}">
                                                </td>
                                                <th>Discount</th>
                                                <td>
                                                    @if ($order->order_type == '1')
                                                        <input type="" class="form-control" name="discount"
                                                            value="0.00">
                                                    @elseif($order->order_type = 2)
                                                        <input type="" class="form-control" name="discount"
                                                            value="{{ $order->coupon_discount ?? '0' }}">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Status</th>
                                                <td>
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if ($order->delivery_status == 'cancelled') {
                                                            $status = 'Received';
                                                        }

                                                    @endphp
                                                    <span
                                                        class="badge bg-success text-white
                                        ">{!! $status !!}</span>
                                                </td>
                                                <th>Payment Date</th>
                                                <td>{{ date_format($order->created_at, 'Y/m/d') ?? 'Null' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>৳{{ number_format($order->grand_total ?? '0', 2) }} <strong></strong>
                                                </td>
                                                <th>Sub Total</th>
                                                <td>৳{{ number_format($order->grand_total ?? '0', 2) }} <strong></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                            <!-- col// -->
                        </div>
                        <div class="row">
                            <h3>Total Order List:</h3>
                            <div class="col-sm-12">
                                <table id="example" class="table table-striped table-bordered table-responsive-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <!-- <th>Num. Of Products</th> -->
                                            <th>Product Image</th>
                                            <th>Product name</th>
                                            {{-- <th>Product Point</th> --}}
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="strong">
                                        @php
                                            $amount = 0;
                                        @endphp
                                        @foreach ($order->order_details as $key => $orderDetail)
                                            @if ($orderDetail->product != null)
                                                <tr class="">
                                                    <td>{{ $order->invoice_no }}</td>
                                                    <td class="col-1">
                                                        <img src="{{ asset($orderDetail->product->product_thumbnail) }}"
                                                            width="50" height="50">
                                                    </td>
                                                    <td>{{ $orderDetail->product->name_en }} ,@if ($orderDetail->is_varient)
                                                            ({{ $orderDetail->color ?? 'Null' }})
                                                            , ({{ $orderDetail->size ?? 'Null' }})
                                                        @endif
                                                    </td>
                                                    {{-- <td>({{ $orderDetail->product_point ?? '0' }})</td> --}}
                                                    <td class="">{{ $orderDetail->qty }}</td>
                                                    <td class="currency">
                                                        ৳{{ number_format($orderDetail->price ?? '0', 2) }}</td>
                                                    @if ($order->order_type == 1)
                                                        <td class="text-right currency">
                                                            ৳{{ number_format($orderDetail->qty * $orderDetail->price ?? '0', 2) }}
                                                            @php
                                                                $amount += $orderDetail->qty * $orderDetail->price;
                                                            @endphp
                                                        </td>
                                                    @elseif($order->order_type == 2)
                                                        <td class="text-right currency">
                                                            ৳{{ number_format($orderDetail->qty * $orderDetail->price ?? '0', 2) }}
                                                            @php
                                                                $amount += $orderDetail->qty * $orderDetail->price;
                                                            @endphp
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" style="font-weight: bold; text-align: right;">
                                                @if ($order->order_type == 1)
                                                    Total Amount: ৳{{ number_format($amount ?? '0', 2) }}
                                                @elseif($order->order_type == 2)
                                                    @php
                                                        $order_discount = $amount - $order->coupon_discount / 100;
                                                    @endphp
                                                    Sub Total : ৳{{ number_format($amount ?? '0', 2) }} </br></br>
                                                    Shipping Cost : ৳{{ number_format($order->shipping_cost ?? '0', 2) }}
                                                    </br></br>
                                                    Discount : {{ number_format($order->coupon_discount ?? '0', 2) }}%
                                                    </br></br>
                                                    Total Amount : ৳{{ number_format($order->grand_total ?? '0', 2) }}
                                                    </br></br>
                                                @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- row // -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="h-25 pt-4">
                                    <div class="mb-3">
                                        <label>Notes:</label>
                                        <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success" style="float: right;">Update
                                        Orders</button>
                                </div>
                                </form>
                            </div>
                            <!-- col// -->
                        </div>
                    </div>
                    <!-- card-body end// -->
                </div>
                <!-- card end// -->
            </div>
        </div>
    </div>
@endsection


@push('footer-script')
    <script type="text/javascript">
        /* ============ Update Payment Status =========== */
        $('#update_payment_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            });
        });

        /* ============ Update Delivery Status =========== */
        $('#update_delivery_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            });
        });
    </script>


    <!--===============  Start Division To District Show Ajax ===============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/orders/division-district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="district_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' +
                                    capitalizeFirstLetter(value.name_en) +
                                    '</option>');
                            });
                            $('select[name="upazilla_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                            );
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

        });
    </script>
    <!--===============  End Division To District Show Ajax ===============-->

    <!--===============  Start  District To Upazilla Show Ajax ===============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/orders/district-upazilla/ajax') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="upazilla_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="upazilla_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <!--===============  End  District To Upazilla Show Ajax ===============-->

    <!--===============  Start  Upazilla To Union Show Ajax ===============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="upazilla_id"]').on('change', function() {
                var upazilla_id = $(this).val();
                if (upazilla_id) {
                    $.ajax({
                        url: "{{ url('/orders/upazilla-union/ajax') }}/" + upazilla_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="union_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="union_id"]').append('<option value="' +
                                    value.id + '">' + value.name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <!--===============  End  Upazilla To Union Show Ajax ===============-->
@endpush
