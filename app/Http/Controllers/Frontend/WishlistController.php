<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $id){

        if (Auth::check()) {

            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now(),

                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist' ]);
            }else{
                return response()->json(['error' => 'This Product Has Already on Your Wishlist' ]);

            }
        }else{
            return response()->json(['error' => 'At First Login Your Account' ]);
        }

    } // End Method


    public function AllWishlist(){
        return view('frontend.wishlist.view_wishlist');

    }// End Method


    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = Wishlist::count();

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method


    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method
}
