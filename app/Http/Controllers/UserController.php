<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('dashboard');
    } // End Method

    private function calculateTotalPointsRecursive($placement, $date)
    {
        if ($placement === null) {
            return 0;
        }

        $user = User::where('username', $placement)->first();

        if (!$user) {
            return 0;
        }

        $points = Order::where('user_id', $user->id)->whereDate('created_at', $date)->sum('grand_point');

        $leftUserPoints = $this->calculateTotalPointsRecursive($user->left_placement, $date);
        $rightUserPoints = $this->calculateTotalPointsRecursive($user->right_placement, $date);

        return $points + $leftUserPoints + $rightUserPoints;
    }

    public function UserProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Mehtod


    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // End Mehtod


    public function UserUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");
    } // End Mehtod

    // start check register username //
    public function checkRegisterUsername($username)
    {
        $username = User::where('username', $username)->first();
        $message =  "Username Added Now";
        $done = "This Username Already matched ! Please Provide New Username";

        // return response()->json($message);
        if($username == true){
            return response()->json($done);
        }else{
            return response()->json($message);
        }

    }
    // end check register username //

    // start check register refer by //
    public function checkRegisterReferBy($referby)
    {
        $user_referby = User::where('username', $referby)->first();
        $user_refertop = User::where('id', $user_referby->refer_by)->first();

        $message =  "Not available Refer";
        $done = $user_refertop;

        // return response()->json($message);
        if($user_referby == true){
            return response()->json($done);
        }else{
            return response()->json($message);
        }

    }
    // end check register refer by //

    // start check register placement id //
    public function RegisterPlacement($placement_id)
    {
        $user_placement_by = User::where('username', $placement_id)->first();
        $user_placement_by_left = $user_placement_by->left_placement;
        $user_placement_by_right = $user_placement_by->right_placement;
        // dd($user_placement_by_top);

        $message =  "Not available Refer";


        // return response()->json($message);
        if($user_placement_by == true){
            return response()->json([
                'Left Placement: ', $user_placement_by_left ?? 'Available','</br>',
                'Right Placement:', $user_placement_by_right ?? 'Available']
                );

        }else{
            return response()->json($message);
        }

    }
    // end check register placement id //




}
