<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Carbon;
use Session;


class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages = Pages::all();
       return view('admin.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',
        ]);

        $pages = new Pages();
        $pages->title = $request->title;

        $pages->name_en = $request->name_en;
        if($request->name_bn == ''){
            $pages->name_bn = $request->name_en;
        }else{
            $pages->name_bn = $request->name_bn;
        }

        $pages->description_en = $request->description_en;
        if($request->description_bn == ''){
            $pages->description_bn = $request->description_en;
        }else{
            $pages->description_bn = $request->description_bn;
        }

        $pages->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $pages->status = $request->status;
        $pages->position = $request->position;
        $pages->created_at = Carbon::now();

        $pages->save();

        Session::flash('success','Pages Inserted Successfully');
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {  $page = Pages::find($id);
       return view('admin.pages.view',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $page = Pages::find($id);
       return view('admin.pages.edit',compact('page'));
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
        $pages = Pages::find($id);
        $pages->title = $request->title;

        $pages->name_en = $request->name_en;
        if($request->name_bn == ''){
            $pages->name_bn = $request->name_en;
        }else{
            $pages->name_bn = $request->name_bn;
        }

        $pages->description_en = $request->description_en;
        if($request->description_bn == ''){
            $pages->description_bn = $request->description_en;
        }else{
            $pages->description_bn = $request->description_bn;
        }

        $pages->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $pages->status = $request->status;
        $pages->position = $request->position;
        $pages->created_at = Carbon::now();

        $pages->save();

        Session::flash('success','Pages Updated Successfully');
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = Pages::find($id);
        $page->delete();

        $notification = array(
            'message' => 'Pages Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    public function active($id){
        $page = Pages::find($id);
        $page->status = 1;
        $page->save();

        Session::flash('success','Pages Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $page = Pages::find($id);
        $page->status = 0;
        $page->save();

        $notification = array(
            'message' => 'Pages Disabled Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
