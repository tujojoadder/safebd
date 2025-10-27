<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserListController extends Controller
{

     /*=================== User List Show Methoed ===================*/
    public function userList()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('admin.users.index', compact('users'));
    }

    /*=================== Admin User Edit Methoed ===================*/
    public function userEdit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', compact('user'));
    }

    /*=================== Admin User Update Methoed ===================*/
    public function userUpdate(Request $request, $id){

       $userupdate = User::findOrFail($id);

       $request->validate([
        'name' => 'string',
        'email'=> 'email',
       ]);

       $userupdate = $userupdate->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'country' => $request->country,
       ]);

       if($userupdate){
            $notification = array(
                'message' => 'User Updated Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.user.index')->with($notification);
       }else{
            $notification = array(
                'message' => 'User Updated Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
       }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
