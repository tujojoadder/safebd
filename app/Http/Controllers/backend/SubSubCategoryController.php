<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Carbon;
use App\Models\Subsubcategory;
use Session;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $subsubcategories = Subsubcategory::all();
        return view('admin.category.subsubcategory.index',compact('subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = Subcategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = Subsubcategory::latest()->get();
       return view('admin.category.subsubcategory.create',compact('categories','subsubcategory','subcategories'));

    }


  //  json File



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $this->validate($request,[
            'sub_subcategory_name_en'=>'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);
        $subsubcategory = new Subsubcategory;
        $subsubcategory->sub_subcategory_name_en = $request->sub_subcategory_name_en;
       if($request->sub_subcategory_name_bn == ''){
        $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_en;
       }else{
        $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_bn;
       }
       if($request->status == Null){
        $request->status = 0;
       }
       $subsubcategory->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->sub_subcategory_name_en)));
       $subsubcategory->status = $request->status;
       $subsubcategory->category_id = $request->category_id;
       $subsubcategory->subcategory_id = $request->subcategory_id;
       $subsubcategory->created_at = Carbon::now();
       $subsubcategory->save();
       Session::flash('success','SubSubCategory Inserted Successfully');
       return redirect()->route('subsubcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $subsubcategory = Subsubcategory::find($id);
        return view('admin.category.subsubcategory.view',compact('subsubcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $categories = Category::orderby('category_name_en', 'ASC')->get();
         $subcategories = Subcategory::orderby('subcategory_name_en', 'ASC')->get();
         $subsubcategory = Subsubcategory::find($id);
        return view('admin.category.subsubcategory.edit',compact('categories','subcategories','subsubcategory'));
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
        $subsubcategory =Subsubcategory::find($id);
        $subsubcategory->sub_subcategory_name_en = $request->sub_subcategory_name_en;
        if($request->sub_subcategory_name_bn == ''){
         $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_en;
        }else{
         $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_bn;
        }
        if($request->status == Null){
         $request->status = 0;
        }
        $subsubcategory->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->sub_subcategory_name_en)));
        $subsubcategory->status = $request->status;
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->created_at = Carbon::now();
        $subsubcategory->save();
        Session::flash('success','SubSubCategory Updated Successfully');
        return redirect()->route('subsubcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Subsubcategory = Subsubcategory::find($id);
        $Subsubcategory->delete();

        $notification = array(
            'message' => 'SubSubCategory Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }


    public function active($id){
        $Subsubcategory = Subsubcategory::find($id);
        $Subsubcategory->status = 1;
        $Subsubcategory->save();
        Session::flash('success','Subsubcategory Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $Subsubcategory = Subsubcategory::find($id);
        $Subsubcategory->status = 0;
        $Subsubcategory->save();
        Session::flash('success','Subsubcategory Disabled Successfully.');
        return redirect()->back();
    }
}
