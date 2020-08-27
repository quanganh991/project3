<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,DB,Session;
use Redirect;
class NotificationController extends Controller
{
    function viewAllNotification(){
        if(Session::get('id_customer')) {
            $allNotification = DB::table('notification')
                ->where('id_customer',Session::get('id_customer'))
                ->orderBy('date_noti','DESC')
                ->get();
            return view('user.notification.view_all_notification')
                ->with('allNotification',$allNotification)
            ->with('me',Session::get('id_customer'));
        } else {
            return Redirect::to('/login');
        }
    }

    function markAsReadNotification($id_notification){
        if (Session::get('id_customer')) {
            DB::table('notification')->where('id_notification', $id_notification)->update(['isread_noti' => 'seen']);
            return Redirect::to('/user-view-notification');
        } else {
            return redirect('login');
        }
    }
}
