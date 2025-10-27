<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\SmsTemplate;
use App\Utility\SmsUtility;
use App\Utility\SendSMSUtility;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\DateBinaryCalculation;
use Mail;
use App\Mail\OrderMail;

use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderNotification;

class CheckoutController extends Controller
{
	/* ========= Start Checkout Index Method ============ */
    public function index()
    {
        if(!guest_checkout() && !auth()->check()){
            return redirect()->route('login');
        }

        $carts = Cart::content();
        // dd($carts);

        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return view('frontend.checkout.index',compact('carts','cartQty','cartTotal'));
    } // end method
    /* ========= End Checkout Index Method ============ */

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


    /* ============= Start Payment Method ============== */
    public function payment(Request $request){
        // dd($request->all());
        // dd($request->payment_option);
        if($request->payment_option == 'cash_on_delivery'){
            $checkout = new CheckoutController;
            return $checkout->store($request);
        }

        $payment_method = $request->payment_option;
        $total_amount = Cart::total();
        $last_order = Order::orderBy('id','DESC')->first();
        $order_id = $last_order->id+1;
        $invoice_no = date('YmdHi').$order_id;
        Session::put('invoice_no', $invoice_no);

        if($request->payment_option == 'cash_on_delivery'){
            return redirect()->route('checkout.store');
        }else{
            Session::put('payment_method', $request->payment_option);
            Session::put('payment_type', 'cart_payment');
            Session::put('payment_amount', $total_amount);
            if($request->payment_option == 'nagad'){
               	$notification = array(
					'message' => 'Comming Soon.',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
            }else if($request->payment_option == 'bkash'){
                	$notification = array(
					'message' => 'Comming Soon.',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
            }elseif ($request->payment_option == 'sslcommerz') {
               	$notification = array(
					'message' => 'Comming Soon.',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
            }elseif($payment_method =='aamarpay'){
                	$notification = array(
					'message' => 'Comming Soon.',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
            }
        }

        return view('frontend.checkout.payment', compact('payment_method', 'total_amount', 'invoice_no'));
    }
    /* ============= End Payment Method ============== */

    /* ============= Start Checkout Store Method ============== */
    public function store(Request $request)
    {
        $carts = Cart::content();
        // dd($carts);

        if($carts->isEmpty()){
            $notification = array(
                'message' => 'Your cart is empty.',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }

        // dd($request->all());

        if(Auth::check()){
            $user_id = Auth::id();
            $type = 1;
        }else{
            $user_id = 1;
            $type = 2;
        }

        if($request->payment_option == 'cash_on_delivery'){
            $payment_status = 0;
        }else{
            $payment_status = 1;
        }

        $user = User::where('role','admin')->get();

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }

        foreach($carts as $cart){

            // shipping grand total check //
            if($request->shipping_order_total == null){
                $shipping_order_total = $total_amount;
            }else{
                $shipping_order_total = $request->shipping_order_total;
            }

            // shipping cost total check //
            if($request->shipping_order_total == null){
                $ship_charge = 0;
            }else{
                $ship_charge = $request->ship_charge;
            }

            // order add //
            $order = Order::create([
                'user_id' => $user_id,
                'grand_total' => $shipping_order_total,
                'grand_point' => $cart->options->ppoint,
                'shipping_cost' => $ship_charge,
                'payment_method' => $request->payment_option,
                'payment_status' => $payment_status,
                'invoice_no' => date('Ymd-His') . rand(10, 99),
                'delivery_status' => 'pending',
                'phone' => $request->phone,
                'email' => $request->email,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazilla_id' => $request->upazilla_id,
                'union_id' => $request->union_id,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'type' => $type,
                'order_type' => 1,
                'created_by' => Auth::user()->id ?? '0',
                'invoice_no' =>  date('Ymd-His') . rand(10, 99),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now(),
            ]);
        } // End Foreach


        $invoice = Order::findOrFail($order->id);

        $data = [
            'invoice_no' => $invoice->invoice_no,
            'grand_total' => $shipping_order_total,
            'name' => Auth::user()->name ?? 'Null',
            'email' => $invoice->email,

        ];



        $carts = Cart::content();

        /* ==================  start send notifications ================== */
        if ($order->user_id == \App\Models\User::where('role', 'admin')->first()->id) {
            $users = User::findMany([$order->user->id, $order->user_id]);
        }else {
            $users = User::findMany([$order->user->id, $order->user_id, \App\Models\User::where('role', 'admin')->first()->id]);
        }

        $order_notification = [
            'order_code' => $invoice->invoice_no,
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'status' => $order->delivery_status,

        ];

        // $user = User::first();
        Notification::send($users, new OrderNotification($order_notification));

        /* ==================  end send notifications ================== */

        // foreach($carts as $cart){

        //     OrderDetail::insert([
        //         'order_id' => $order->id,
        //         'user_id' => $user_id,
        //         'invoice_no' =>  date('Ymd-His') . rand(10, 99),
        //         'order_date' => Carbon::now()->format('d F Y'),
        //         'order_month' => Carbon::now()->format('F'),
        //         'order_year' => Carbon::now()->format('Y'),
        //         'product_sales_quantity' => $order->id,
        //         'product_id' => $cart->id,
        //         'is_varient' => 1,
        //         'color' => $cart->options->color,
        //         'size' => $cart->options->size,
        //         'product_point' => $cart->options->ppoint,
        //         'qty' => $cart->qty,
        //         'price' => $cart->price,
        //         'tax' => $cart->tax,
        //         'created_at' =>Carbon::now(),
        //     ]);


        // } // End Foreach

        // order details add //
        foreach ($carts as $cart) {
            $product = Product::find($cart->id);

            if($cart->options->is_varient == 1){
                // shipping cost total check //
                if($request->shipping_order_total == null){
                    $ship_charge = 0;
                }else{
                    $ship_charge = $request->ship_charge;
                }
                OrderDetail::insert([
                    'user_id' => $user_id,
                    'invoice_no' =>  date('Ymd-His') . rand(10, 99),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),
                    'order_id' => $order->id,
                    'product_sales_quantity' => $order->id,
                    'product_id' => $cart->id,
                    'is_varient' => 1,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'shipping_cost' => $ship_charge,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);

                /* ============= start product stock calculation  ============= */
                    $product->stock_qty = $product->stock_qty - $cart->qty;
                    $product->save();
                /* ============= end product stock calculation  ============= */

                // // stock calculation //
                // $stock = ProductStock::where('varient', $cart->options->varient)->first();
                // // dd($cart);
                // if($stock){
                //     // dd($stock);
                //     $stock->qty = $stock->qty - $cart->qty;
                //     $stock->save();
                // }

            }else{
                OrderDetail::insert([
                    'user_id' => $user_id,
                    'invoice_no' =>  date('Ymd-His') . rand(10, 99),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),
                    'order_id' => $order->id,
                    'product_sales_quantity' => $order->id,
                    'product_id' => $cart->id,
                    'is_varient' => 0,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'shipping_cost' => $ship_charge,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);

                /* ============= start product stock calculation  ============= */
                if($cart->options->is_varient == 0){
                    $product->stock_qty = $product->stock_qty - $cart->qty;
                    $product->save();
                }
                /* ============= end product stock calculation  ============= */
            }

        }

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        // $fund_wallet = Auth::user()->fund_wallet;

        // $current_user = Auth::user()->id;
        // $user = User::where('id', $current_user)->first();

        // if($total_amount > Auth::user()->fund_wallet){
        //     $notification = array(
        //         'message' => 'You have not enough credit to fund wallet! .',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->back()->with($notification);
        // }else{
        //     // start user fund wallet decrement //
        //     $amount = $user->fund_wallet - $total_amount;
        //     $user->fund_wallet = $amount;
        //     $user->save();
        //     // end user fund wallet decrement //
        // }


        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    /* ============= End Checkout Store Method ============== */

    /* ============= Start Show Method ============== */
    public function show($id)
    {
        $order = Order::where('invoice_no', $id)->first();

        $notification = array(
            'message' => 'Your Order Successfully.',
            'alert-type' => 'success'
        );

        return view('frontend.order.order_confirmed', compact('order'))->with($notification);
    }
    /* ============= End Show Method ============== */


}
