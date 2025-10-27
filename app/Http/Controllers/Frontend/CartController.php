<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class CartController extends Controller
{
    /* ============ Start AddToCart Methoed ============ */
    public function AddToCart(Request $request, $id){

        // dd($id);
        $product = Product::findOrFail($id);
        // alert($product);
        // dd($product);

        if($request->product_price){
            $price = $request->product_price;
        }else{
            if($product->discount_price > 0){
                if($product->discount_type == 1){
                    $price = $product->regular_price - $product->discount_price;
                }else{
                    $price = $product->regular_price - ($product->discount_price * $product->regular_price / 100);
                }
            }else{
                $price = $product->regular_price;
            }
        }
        

    	if($product->is_varient){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name, 
                'point' => $request->product_point,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'is_varient' => 1,
                    'color' => $request->color,
                    'size' => $request->size,
                    'varient' => $request->product_varient,
                    'ppoint' => $product->product_point,
                ],
            ]);

            return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'point' => $request->product_point,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => $product->slug,
                    'is_varient' => 0,
                    'ppoint' => $product->product_point,
                ],
            ]);

		    return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }
    }
    /* ============ End AddToCart Methoed =========== */
    
     /* ============ Start AddToCartDetails Methoed ============ */
    public function AddToCartDetails(Request $request, $id){

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if($request->product_price){
            $price = $request->product_price;
        }else{
            if($product->discount_price > 0){
                if($product->discount_type == 1){
                    $price = $product->regular_price - $product->discount_price;
                }else{
                    $price = $product->regular_price - ($product->discount_price * $product->regular_price / 100);
                }
            }else{
                $price = $product->regular_price;
            }
        }

        if($product->is_varient){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name, 
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'is_varient' => 1,
                    'color' => $request->color,
                    'size' => $request->size,
                    'varient' => $request->product_varient,
                     'ppoint' => $product->product_point,
                ],
            ]);

            return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name, 
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => $product->slug,
                    'is_varient' => 0,
                     'ppoint' => $product->product_point,
                ],
            ]);

            return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }

    }// End Method
    /* ============ End AddToCartDetails Methoed ============ */

    /*=================== Start Mini Cart  Methoed ===================*/
    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));

    } // end method

    /*=================== End Mini Cart  Methoed ===================*/

    /*=========== Start Remove Mini Cart  Methoed ============*/
    public function RemoveMiniCart($rowId){

        Cart::remove($rowId);
        return response()->json(['success'=> 'Product Removed from Cart']);
    }

    /*============== End Remove Mini Cart  Methoed =============*/

    /*=========== Start  Cart Index  Methoed ============*/
    public function index(){
        $carts = Cart::content();
        //dd($carts);
        return view('frontend.cart.index',compact('carts'));
    }
    /*=========== End Cart Index  Methoed ============*/

    /* ================= Start GetCartProduct Method =================== */
    public function getCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));

    } //end method
    /* ================= End GetCartProduct Method =================== */

    /* ================= Start CartIncrement Method =================== */
    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
 
        return response()->json('increment');

    } // end mehtod 

    /* ================= End CartIncrement Method =================== */

    /* ================= Start CartDecrement Method =================== */
    public function cartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json($row->qty);
    } // end method

    /* ================= End CartDecrement Method =================== */

    /* ================= Start RemoveCartProduct Method ============== */
    public function removeCartProduct($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);
    } // end method
    /* ================= End RemoveCartProduct Method ============== */

    /* ================= Start Destroy Method ============== */
    public function destroy()
    {
        Cart::destroy();
        Session::flash('success','Cart Permanently Deleted Successfully.');
        return back();
    } // end method

    /* ================= Start Destroy Method ============== */
    
}
