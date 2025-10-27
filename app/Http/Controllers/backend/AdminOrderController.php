<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use PDF;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;

        //dd($request);

        if($request->delivery_status != null && $request->payment_status != null && $date != null){

            $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status)->where('order_type',1)->orderBy('id','desc');

            $delivery_status = $request->delivery_status;
            $payment_status = $request->payment_status;

        }else if($request->delivery_status == null && $request->payment_status == null && $date == null){
            $orders = Order::orderBy('id', 'desc')->where('order_type',1);
        }else{
            if($request->delivery_status == null){
                if($request->payment_status != null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('payment_status', $request->payment_status)->where('order_type',1)->orderBy('id','desc');
                    $payment_status = $request->payment_status;
                }else if($request->payment_status == null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('order_type',1)->orderBy('id','desc');
                }else{
                    $orders = Order::where('payment_status', $request->payment_status)->where('order_type',1)->orderBy('id','desc');;
                    $payment_status = $request->payment_status;
                }
            }else if($request->payment_status == null){
                if($request->delivery_status != null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status)->where('order_type',1)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }else if($request->delivery_status == null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('order_type',1)->orderBy('id','desc');
                }else{
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('order_type',1)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }
            }else if($request->date == null){
                if($request->delivery_status != null && $request->payment_status != null){
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status)->where('order_type',1)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                    $payment_status = $request->payment_status;
                }else if($request->delivery_status == null && $request->payment_status != null){
                    $orders = Order::where('payment_status', $request->payment_status)->where('order_type',1)->orderBy('id','desc');
                    $payment_status = $request->payment_status;
                }else{
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('order_type',1)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }
            }
        }

        $orders = $orders->paginate(100);
        return view('admin.sales.all_orders.index', compact('orders', 'delivery_status', 'date','payment_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.sales.all_orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->division_id = $request->division_id;
        $order->district_id = $request->district_id;
        $order->upazilla_id = $request->upazilla_id;
        $order->union_id    = $request->union_id;
        $order->payment_method = $request->payment_method;

        OrderDetail::where('id', $id)->update([
            'shipping_cost' => $request->shipping_cost,
            'shipping_type' => $request->shipping_type
        ]);

        $order->save();

        $notification = array(
            'message' => "Admin Orders Information Updated Successfully.!",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        $notification = array(
            'message' => 'Order Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*================= Start update_payment_status Methoed ================*/
    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $order->payment_status = $request->status;
        $order->save();

        // dd($order);

        return response()->json(['success'=> 'Payment status has been updated']);

    }

    /*================= Start update_delivery_status Methoed ================*/
    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_status = $request->status;
        $order->save();

        return response()->json(['success'=> 'Delivery status has been updated']);

    }

    /* ============= Start invoice_download Method ============== */
    public function invoice_download($id){
        $order = Order::findOrFail($id);

        $pdf = PDF::loadView('admin.invoices.invoice',compact('order'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // end method
    /* ============= End invoice_download Method ============== */

    /* ============= Start invoice_download Method ============== */
    public function invoice_show($id){
        $order = Order::findOrFail($id);
        return view('admin.invoices.invoice_show',compact('order'));


    } // end method
    /* ============= End invoice_download Method ============== */

    /* ============= Start getdivision Method ============== */
    public function getdivision($division_id){
    $division = District::where('division_id', $division_id)->orderBy('name_en','ASC')->get();

        return json_encode($division);
    }
    /* ============= End getdivision Method ============== */

    /* ============= Start getupazilla Method ============== */
    public function getupazilla($district_id){
        $upazilla = Upazila::where('district_id', $district_id)->orderBy('name_en','ASC')->get();

        return json_encode($upazilla);
    }
    /* ============= End getupazilla Method ============== */

    /* ============= Start getunion Method ============== */
    public function getunion($upazilla_id){
        $union = Union::where('upazilla_id', $upazilla_id)->orderBy('name_en','ASC')->get();

        return json_encode($union);
    }
    /* ============= End getunion Method ============== */

    /* ============= Start ReturnRequest Method ============== */
    public function ReturnRequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('admin.return_order.return_request',compact('orders'));

    } // End Method
    /* ============= End ReturnRequest Method ============== */

    /* ============= Start ReturnRequestApproved Method ============== */
    public function ReturnRequestApproved($order_id){

        Order::where('id',$order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
    /* ============= End ReturnRequestApproved Method ============== */

    /* ============= Start CompleteReturnRequest Method ============== */
    public function CompleteReturnRequest(){

        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('admin.return_order.complete_return_request',compact('orders'));

    } // End Method
    /* ============= End CompleteReturnRequest Method ============== */
}
