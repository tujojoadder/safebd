<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Order;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.order.index', compact('orders'));
    }

    /* ============= Order View ============= */
    public function orderView($invoice_no)
    {
        // $order = Order::where('user_id',Auth::id())->orderBy('id','DESC')->first();
        $order = Order::where('invoice_no', $invoice_no)->first();
        // dd($order);
        // $orders = Order::with('address_id')->where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.order.order_view', compact('order'));
    }

    /* ============= Order UserOrderInvoice ============= */
    public function UserOrderInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End Method
}
