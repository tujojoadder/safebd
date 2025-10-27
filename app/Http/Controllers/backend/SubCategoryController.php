<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Carbon;
use Session;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.category.subcategory.index',compact('categories','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories = Category::all();
        return view('admin.category.subcategory.create',compact('categories'));
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
        'subcategory_name_en'=>'required',
       ]);
       $subcategory = new Subcategory;
       $subcategory->subcategory_name_en = $request->subcategory_name_en;
       if($request->subcategory_name_bn == ''){
        $subcategory->subcategory_name_bn = $request->subcategory_name_en;
       }else{
        $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
       }
       if($request->status == Null){
        $request->status = 0;
       }
       $subcategory->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->subcategory_name_en)));
       $subcategory->status = $request->status;
       $subcategory->category_id = $request->category_id;
       $subcategory->created_at = Carbon::now();
       $subcategory->save();

      Session::flash('success','Subcategory Inserted Successfully');
      return redirect()->route('subcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
      $subcategory = Subcategory::find($id);
      return view('admin.category.subcategory.view',compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.category.subcategory.edit',compact('subcategory','categories'));
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
        $subcategory = Subcategory::find($id);
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        if($request->subcategory_name_bn == ''){
         $subcategory->subcategory_name_bn = $request->subcategory_name_en;
        }else{
         $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
        }
       if($request->status == Null){
            $request->status = 0;
        }
        $subcategory->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->subcategory_name_en)));
        $subcategory->status = $request->status;
        $subcategory->category_id = $request->category_id;
        $subcategory->created_at = Carbon::now();
        $subcategory->save();
        Session::flash('success','SubCategory Updated Successfully');
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {    $subcategory = Subcategory::find($id);
         $subcategory->delete();

        $notification = array(
            'message' => 'Subcategory Deleted Successfully.',
            'alert-type' => 'error'
        );
         return redirect()->route('subcategory.index')->with($notification);
    }

    public function active($id){
        $subcategory = Subcategory::find($id);
        $subcategory->status = 1;
        $subcategory->save();
        Session::flash('success','Subcategory Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $subcategory = Subcategory::find($id);
        $subcategory->status = 0;
        $subcategory->save();
        Session::flash('success','Subcategory Disabled Successfully.');
        return redirect()->back();
    }


    public function getsubcategory($category_id){

        $subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function getsubsubcategory($subcategory_id){

        $subsubbcat = Subsubcategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubbcat);
    }

}
