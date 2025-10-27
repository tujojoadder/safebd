<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;
use Session;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    } // End Index Mathod
    public function index()
    {
        $brands = Brand::all();
       return view('admin.brand.index',compact('brands'));
    } // End Index Mathod

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'brand_name_en'=>'required',
            'brand_image'=>'required'
        ]);

        if($request->hasfile('brand_image')){
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(114,105)->save('upload/brand/'.$name_gen);
            $brand_image = 'upload/brand/'.$name_gen;
        }else{
            $brand_image = $request->brand_images;
        }

      $brand = new Brand;

       $brand->brand_name_en = $request->brand_name_en;
        if($request->brand_name_bn == ''){
            $brand->brand_name_bn = $request->brand_name_en;
        }else{
            $brand->brand_name_bn = $request->brand_name_bn;
        }

        if($request->status == Null){
            $request->status = 0;
        }
        $brand->brand_slug_en = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->brand_name_en)));
        $brand->status = $request->status;
        $brand->brand_image = $brand_image;
        $brand->created_at = Carbon::now();
        $brand->save();



        Session::flash('success','brand Inserted Successfully');
        return redirect()->route('brand.index');
    } // End Store Mathod

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

       $brand = Brand::find($id);
    return view('admin.brand.edit', compact('brand'));
    } // End Edit Mathod

    public function view($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.view',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
       $brand = Brand::find($id);

        if($request->hasfile('brand_image')){
            try {
                if(file_exists($brand->brand_image)){
                    unlink($brand->brand_image);
                }
            } catch (Exception $e) {

            }
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(114,105)->save('upload/brand/'.$name_gen);
            $brand_image = 'upload/brand/'.$name_gen;
        }else{
            $brand_image = $brand->brand_image;
        }

        $brand->brand_name_en = $request->brand_name_en;
        if($request->brand_name_bn == ''){
            $brand->brand_name_bn = $request->brand_name_en;
        }else{
            $brand->brand_name_bn = $request->brand_name_bn;
        }

        if($request->status == Null){
            $request->status = 0;
        }
        $brand->brand_slug_en = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->brand_name_en)));
        $brand->status = $request->status;

        $brand->brand_image = $brand_image;

        $brand->created_at = Carbon::now();

        $brand->save();

        Session::flash('success','brand Updated Successfully');
        return redirect()->route('brand.index');

    } // End Update Mathod

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand_image = $brand->brand_image;
        unlink($brand_image);
        $brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);


    } // End destroy Mathod


    public function active($id){

        $brand = Brand::find($id);
        $brand->status = 1;
        $brand->save();

        Session::flash('success','Brand Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $brand = Brand::find($id);
        $brand->status = 0;
        $brand->save();

        Session::flash('success','Brand Disabled Successfully.');
        return redirect()->back();
    }
}
