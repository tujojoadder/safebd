<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderNotification;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $customers = User::where('role', 'user')->latest()->get();
        return view('admin.pos.index', compact('products', 'categories', 'brands', 'customers'));
    }

    /* ============= Start Dealer getProduct product list show =============== */
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return json_encode($product);
    }
    /* ============= End Dealer getProduct product list show =============== */

    /* ============= Start filter getProduct product list show =============== */
    public function filter()
    {
        $products = Product::where('status', 1);
        if(isset($_GET['search_term'])){
            $products = $products->where('name_en', 'like', '%'.$_GET['search_term'].'%');
        }
        if(isset($_GET['category_id'])){
            $products = $products->where('category_id', $_GET['category_id']);
        }
        if(isset($_GET['brand_id'])){
            $products = $products->where('brand_id', $_GET['brand_id']);
        }
        $products = $products->get();
        return json_encode($products);
    }
    /* ============= End filter getProduct product list show =============== */

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
        // dd($request->all());
        $product_ids = $request->product_id;

        if(!$product_ids || count($product_ids)<=0){
            $notification = array(
                'message' => 'Add at least one product.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $user = User::findOrFail($request->customer_id);

            if($request->payment_method == NULL) {
                $request->payment_method = "cash_on_delivery";
            }

            if($request->payment_status == NULL) {
                $request->payment_status = 0;
            }

            if($user->phone == NULL) {
                $user->phone = "";
            }

            if($user->email == NULL) {
                $user->email = "";
            }

            // foreach($product_ids as $value){
            //     $product = Product::findOrFail($value);

            //     if($product->stock_qty < $request->qty[$i]) {
            //         $notification = array(
            //             'message' => 'Stock is not available.',
            //             'alert-type' => 'error'
            //         );
            //         return redirect()->back()->with($notification);
            //     }

            // }



            /* ============== Start Product Order Store ============ */

            /* ============== start shipping grand total check ============= */
            if($request->ship_charge == null){
                $order_total = $request->total;
                // dd($order_total);
            }elseif($request->discount == null){
                $order_total = $request->total;
            }else{
                $price = $request->shipping_order_total;
                // dd($price);
                $discount = $request->discount;

                $order_total = $price - ($discount * $price / 100);
                // dd($total_price);
            }
            /* ============== end shipping grand total check ============= */

            /* ============== start shipping cost total check ============= */
            if($request->ship_charge == null){
                $ship_charge = 0;
            }else{
                $ship_charge = $request->ship_charge;
            }
            /* ============== end shipping cost total check ============= */

            $order = Order::create([
                'user_id' => $request->customer_id,
                'grand_total' => $order_total,
                'shipping_cost' => $ship_charge,
                'coupon_discount' => $request->discount,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,
                'invoice_no' => date('Ymd-His') . rand(10, 99),
                'delivery_status' => 'pending',
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => $user->address,
                'type' => 5,
                'order_type' => 2,
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now(),
                'created_by' => Auth::guard('web')->user()->id,
            ]);
            /* ============== End Product Order Store ============ */

            $invoice = Order::findOrFail($order->id);

            $data = [
                'invoice_no' => $invoice->invoice_no,
                'grand_total' => $request->total,
                'name' => Auth::user()->name ?? 'Null',
                'email' => $invoice->email,

            ];

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

            /* ======================= start order details add ================ */
            for($i=0; $i<count($product_ids); $i++) {
                //$product = Product::find($product_ids[$i]);
                $product = Product::where('id', $product_ids[$i])->first();

                if($product->stock_qty < $request->qty[$i]) {
                    $notification = array(
                        'message' => 'Stock is not available.',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }

                /* ============== Start Product Stock Qty Calculation  ============ */
                $qty =  $request->qty[$i];
                $product_qty =  $product->stock_qty;
                $product->stock_qty = $product_qty - $qty;
                $product->save();
                /* ============== End Product Stock Qty Calculation  ============ */

                /* ============== start shipping grand total check ============= */
                if($request->ship_charge == null){
                    $shipping_order_total = $request->total;
                }else{
                    $order_total = $request->shipping_order_total;
                }
                /* ============== end shipping grand total check ============= */

                /* ============== start discount grand total check ============= */
                if($request->discount == null){
                    $shipping_order_total = $request->total;
                }else{
                    $order_total = $request->shipping_order_total;
                }
                /* ============== end discount grand total check ============= */

                /* ============== start shipping cost total check ============= */
                if($request->ship_charge == null){
                    $ship_charge = 0;
                }else{
                    $ship_charge = $request->ship_charge;
                }
                /* ============== end shipping cost total check ============= */

                OrderDetail::insert([
                    'user_id' => $request->customer_id,
                    'order_id' => $order->id,
                    'product_id' => $product_ids[$i],
                    'is_varient' => 0,
                    'qty' => $request->qty[$i],
                    'price' => $request->price[$i],
                    'created_at' => Carbon::now(),
                    'invoice_no' =>  date('Ymd-His') . rand(10, 99),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),
                    'product_sales_quantity' => $order->id,
                    'is_varient' => 1,
                    'color' => $product->product_color,
                    'size' => $product->product_size,
                    'shipping_cost' => $ship_charge,
                ]);

            }

            $notification = array(
                'message' => 'Your order has been placed successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
            /* ======================= end order details add ================ */
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // pos all orders list //
    public function allOrders(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;

        //dd($request);

        if($request->delivery_status != null && $request->payment_status != null && $date != null){

            $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status)->where('order_type',2)->orderBy('id','desc');

            $delivery_status = $request->delivery_status;
            $payment_status = $request->payment_status;

        }else if($request->delivery_status == null && $request->payment_status == null && $date == null){
            $orders = Order::orderBy('id', 'desc')->where('order_type',2);
        }else{
            if($request->delivery_status == null){
                if($request->payment_status != null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('payment_status', $request->payment_status)->where('order_type',2)->orderBy('id','desc');
                    $payment_status = $request->payment_status;
                }else if($request->payment_status == null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('order_type',2)->orderBy('id','desc');
                }else{
                    $orders = Order::where('payment_status', $request->payment_status)->where('order_type',2)->orderBy('id','desc');
                    $payment_status = $request->payment_status;
                }
            }else if($request->payment_status == null){
                if($request->delivery_status != null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status)->where('order_type',2)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }else if($request->delivery_status == null && $date != null){
                    $orders = Order::where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('order_type',2)->orderBy('id','desc');
                }else{
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('order_type',2)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }
            }else if($request->date == null){
                if($request->delivery_status != null && $request->payment_status != null){
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status)->where('order_type',2)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                    $payment_status = $request->payment_status;
                }else if($request->delivery_status == null && $request->payment_status != null){
                    $orders = Order::where('payment_status', $request->payment_status)->where('order_type',2)->orderBy('id','desc');
                    $payment_status = $request->payment_status;
                }else{
                    $orders = Order::where('delivery_status', $request->delivery_status)->where('order_type',2)->orderBy('id','desc');
                    $delivery_status = $request->delivery_status;
                }
            }
        }

        $orders = $orders->paginate(100);
        return view('admin.pos.all_orders.index', compact('orders', 'delivery_status', 'date','payment_status'));

    }


}
