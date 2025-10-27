<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Session;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {


        return view('frontend.user.dashboard');


    }
    // generation stroe data //

    /*=================== Start Logout Methoed ===================*/
    public function UserLogout(Request $request){


        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // end method
    /*=================== End Logout Methoed ===================*/



    public function editorHome()
    {
        return view('home',["msg"=>"I am Editor role"]);
    }

    /*=================== User Profile View Method ===================*/
    public function profileView()
    {
        return view('userpanel.user.setting.profile_view');
    }

    /*=================== User Profile Edit Method ===================*/
    public function profileEdit()
    {
        return view('userpanel.user.setting.profile_edit');
    }

    /*=================== User Profile Update Method ===================*/
    public function profileUpdate(Request $request, $id)
    {
        $adminData = User::find($id);
        // dd($adminData);

        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->country = $request->country;

        // if ($request->hasFile('profile_photo')) {

        //     $profile_photo  = $request->file('profile_photo');
        //     $filename    = uniqid() . '.' . $profile_photo->extension('profile_photo');
        //     $location    = public_path('upload/user_images');

        //     $profile_photo->move($location, $filename);

        //     $adminData->profile_photo = $filename;
        // }

        if ($request->file('profile_photo')) {
            $file = $request->file('profile_photo');
            @unlink(public_path('upload/user_images/'.$data->profile_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $adminData['profile_photo'] = $filename;
        }

        $adminData->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /*=================== User Password Change Method ===================*/
    public function UserChangePassword()
    {
        return view('userpanel.user.setting.password_change_view');
    }

    /*=================== User Password Update Method ===================*/
    // User Password Change
    public function UserUpdatePassword(Request $request){
        // Validation
        // $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|confirmed'

        // ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => "Old Password Doesn't Match!!.",
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Password Changed Successfully.',
            'alert-type' => 'success'
        );

       return redirect()->back()->with($notification);

    } // End Mehtod

}
