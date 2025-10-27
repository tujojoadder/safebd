<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

class UserCouponController extends Controller
{
    /*=================== Start CouponApply  Methoed ===================*/
    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
            
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    } // end method 
    /*=================== End CouponApply  Methoed ===================*/

    /*=================== Start CouponCalculation  Methoed ===================*/
    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(

                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
                
                
            ));
        }else{
            return response()->json(array(

                'total' => Cart::total(),
            ));

        }
    } // end method 
    /*=================== End CouponCalculation  Methoed ===================*/

    /* ============ Start Coupon Remove =============== */
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }
    /* ============ End Coupon Remove =============== */
}
