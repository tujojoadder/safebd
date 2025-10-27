<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Auth;

class OrderTrackingController extends Controller
{
    /*================= start user track order method show ============= */
    public function UserTrackOrder(){
        return view('frontend.traking.user_track_order');
    }// End Method
    /*================= end user track order method show ============= */

    /*================= start OrderTracking order method show ============= */
    public function OrderTracking(Request $request){

        $request->validate([
            'code' => 'required',
        ]);

        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();
        // dd($track);

        if ($track) {
           return view('frontend.traking.track_order',compact('track'));

        } else{
            $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

        }

    }// End Method
    /*================= end OrderTracking order method show ============= */

    /*================= start ReturnOrder  method show ============= */
    public function ReturnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('return.order.page')->with($notification);

    }// End Method
    /*================= end ReturnOrder  method show ============= */

    /*================= start ReturnOrder  method show ============= */
    public function ReturnOrderPage(){

        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.traking.return_order_view',compact('orders'));

    }// End Method
    /*================= end ReturnOrder  method show ============= */
}
