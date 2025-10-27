<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {


        $input = $request->all();
        // dd($input);

        if(Auth()->attempt(['password'=>$input['password'],'username'=>$input['username']]))
        {
            $url = '';

            if ($request->user()->role === 'admin') {
                // $url = 'admin/dashboard';
                $notification = array(
                    'message' => 'Admin Login Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('admin.dashobard')->with($notification);

            } elseif ($request->user()->role === 'vendor') {
                // $url = 'vendor/dashboard';

                $notification = array(
                    'message' => 'Vendor Login Successfully',
                    'alert-type' => 'success'
                );
                // $url = '/dashboard';
                return redirect()->route('vendor.dashobard')->with($notification);
            } elseif ($request->user()->role === 'user') {

                $notification = array(
                    'message' => 'User Login Successfully',
                    'alert-type' => 'success'
                );
                // $url = '/dashboard';
                return redirect()->route('dashboard')->with($notification);
            }

            return redirect()->intended($url)->with($notification);

        }else{

            $notification = array(
                'message' => 'Incorrect email or password.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }



        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully.',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
}
