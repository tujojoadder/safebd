<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::latest()->get();
        return view('admin.coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ]);

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->first();

        if($request->status == Null){
            $request->status = 0;
        }

        if($coupon){
            Session::flash('warning','Coupon already Created.');
            return redirect()->back(); 
        }else{
            $coupon = Coupon::insert([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount'=>$request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'status' => $request->status,
                'created_at' => Carbon::now()
            ]);
        }

        Session::flash('success','Coupon Inserted Successfully.');
        return redirect()->route('coupon.index');
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupons = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupons'));
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
        $this->validate($request,[
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ]);

        if($request->status == Null){
            $request->status = 0;
        }

        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('coupon.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    
    public function active($id){

        $coupon = Coupon::find($id);
        $coupon->status = 1;
        $coupon->save();

        Session::flash('success','coupon Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $coupon = Coupon::find($id);
        $coupon->status = 0;
        $coupon->save();

        $notification = array(
            'message' => 'coupon Disabled Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function view($id){
        $coupon = Coupon::find($id);
        return view('admin.coupon.view', compact('coupon'));
    }
}
