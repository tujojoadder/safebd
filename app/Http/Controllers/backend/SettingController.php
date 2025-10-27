<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Color;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.setting.index',compact('settings'));
    }

    public function colorIndex()
    {
        $color_settings = Color::find(1);
        return view('admin.setting.color_index',compact('color_settings'));
    }

    public function colorUpdate(Request $request,$id)
    {

        $colorSetting = Color::find($id);

        $colorSetting->top_header = $request->top_header;
        $colorSetting->small_header = $request->small_header;
        $colorSetting->footer_color = $request->footer_color;
        $colorSetting->text_color = $request->text_color;
        $colorSetting->bg_color = $request->bg_color;
        $colorSetting->secondary_color = $request->secondary_color;
        $colorSetting->primary_color = $request->primary_color;
        $colorSetting->button_color = $request->button_color;
        $colorSetting->hover_color = $request->hover_color;

        $colorSetting->save();

        $notification = array(
            'message' => 'Color Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }


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
        //
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
    public function update(Request $request)
    {
        // dd($request->types);
        if($request->types !=null && count($request->types) > 0){
            foreach ($request->types as $key => $type) {
                $setting = Setting::where('name', $type)->first();
                $setting->value = $request[$type];
                // if ($request[$type] == ) {
                //     # code...
                // }
                $setting->save();
            }
        }

        //Setting Logo Update
        if ($request->file('site_logo')) {
            $logo = $request->file('site_logo');
            $logo_save = time().$logo->getClientOriginalName();
            $logo->move('upload/setting/logo/',$logo_save);
            $save_url_logo = 'upload/setting/logo/'.$logo_save;

            $setting = Setting::where('name', 'site_logo')->first();
            try {
                if(file_exists($setting->value)){
                    unlink($setting->value);
                }
            } catch (Exception $e) {

            }
            $setting->value = $save_url_logo;

            $setting->save();
        }

        //Setting Logo Update
        if ($request->file('site_footer_logo')) {
            $logo = $request->file('site_footer_logo');
            $logo_save = time().$logo->getClientOriginalName();
            $logo->move('upload/setting/logo/',$logo_save);
            $save_url_footer_logo = 'upload/setting/logo/'.$logo_save;

            $setting = Setting::where('name', 'site_footer_logo')->first();
            try {
                if(file_exists($setting->value)){
                    unlink($setting->value);
                }
            } catch (Exception $e) {

            }
            $setting->value = $save_url_footer_logo;

            $setting->save();
        }

        //Setting Favicon Update
        if ($request->file('site_favicon')) {
            $favicon = $request->file('site_favicon');
            $favicon_save = time().$favicon->getClientOriginalName();
            $favicon->move('upload/setting/favicon/',$favicon_save);
            $save_url_favicon = 'upload/setting/favicon/'.$favicon_save;

            $setting = Setting::where('name', 'site_favicon')->first();
            try {
                if(file_exists($setting->value)){
                    unlink($setting->value);
                }
            } catch (Exception $e) {

            }
            $setting->value = $save_url_favicon;

            $setting->save();
        }

        //Setting Contact Update
        if ($request->file('site_contact_logo')) {
            $favicon = $request->file('site_contact_logo');
            $favicon_save = time().$favicon->getClientOriginalName();
            $favicon->move('upload/setting/contact/',$favicon_save);
            $save_url_favicon = 'upload/setting/contact/'.$favicon_save;

            $setting = Setting::where('name', 'site_contact_logo')->first();
            try {
                if(file_exists($setting->value)){
                    unlink($setting->value);
                }
            } catch (Exception $e) {

            }
            $setting->value = $save_url_favicon;

            $setting->save();
        }

        $notification = array(
            'message' => 'Setting Updated Successfull.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
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

}
