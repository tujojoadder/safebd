<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminNotificationController extends Controller
{
    /*=================== start admin user all order notification ===============*/
    public function index() {

        $notifications = auth()->user()->notifications()->paginate(15);

        auth()->user()->unreadNotifications->markAsRead();

        return view('admin.notification.index', compact('notifications'));
        
    }
    /*=================== end admin user all order notification ===============*/
}
