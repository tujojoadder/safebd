<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class StaffController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_all_staffs'])->only('index');
        $this->middleware(['permission:add_staff'])->only('create');
        $this->middleware(['permission:edit_staff'])->only('edit');
        $this->middleware(['permission:delete_staff'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::latest()->get();
        return view('admin.staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','!=',1)->orderBy('id', 'desc')->get();
        return  view ('admin.staff.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email', $request->email)->first() == null){
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            // role name check //
            // $role_check = Role::where('id',$request->roles)->first();
            // $name = $role_check->name;
            // dd($role_check);
            $user->role = "admin";
            $user->password = Hash::make($request->password);
            $user->show_password = $request->password;
            $user->active_status = '0';

            if($user->save()){
                $staff = new Staff;
                $staff->user_id = $user->id;
                $staff->role_id = $request->role_id;
                $user->assignRole(Role::findOrFail($request->role_id)->name);

                if($staff->save()){
                    $notification = array(
                        'message' => 'Staff has been inserted successfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('staff.index')->with($notification);
                }
            }
        }

        $notification = array(
            'message' => 'Email already used',
            'alert-type' => 'error'
        );

        return back()->with($notification);
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
        $staff = Staff::findOrFail(decrypt($id));
        $roles = $roles = Role::where('id','!=',1)->orderBy('id', 'desc')->get();
        return view('admin.staff.edit',compact('staff','roles'));
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
        $staff = Staff::findOrFail($id);
        $user = $staff->user;
        $user->name = $request->name;
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            $staff->role_id = $request->role_id;
            if($staff->save()){
                $user->syncRoles(Role::findOrFail($request->role_id)->name);
                $notification = array(
                    'message' => 'Staff has been updated successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('staff.index')->with($notification);
            }
        }

        $notification = array(
            'message' => 'Something went wrong',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy(Staff::findOrFail($id)->user->id);
        if(Staff::destroy($id)){
            $notification = array(
                'message' => 'Staff has been deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('staff.index')->with($notification);
        }

        $notification = array(
            'message' => 'Something went wrong',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
