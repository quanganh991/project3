<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session,DB;
use Illuminate\Support\Facades\Redirect;

class PeopleController extends Controller
{
    public function displayUser()
    {
        if (Session::get('id_admin')) {
            $allUser = DB::table('users')
                ->get();
            return view('admin.userManagement.view_all_users')->with('allUser', $allUser);
        } else {
            return redirect('login');
        }
    }

    public function blockUser($id_user)
    {
        if (Session::get('id_admin')) {
            DB::table('users')
                ->where('id_user', $id_user)
                ->update(['status_user' => 0]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function unBlockUser($id_user)
    {
        if (Session::get('id_admin')) {
            DB::table('users')
                ->where('id_user', $id_user)
                ->update(['status_user' => 1]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function deleteComment($id_comment)
    {
        if (Session::get('id_admin')) {
            DB::table('coment')
                ->where('id_coment', $id_comment)
                ->update(['isvalid' => 0]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function deleteReply($id_reply)
    {
        if (Session::get('id_admin')) {
            DB::table('reply')
                ->where('id_reply', $id_reply)
                ->update(['isvalid_reply' => 0]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function commentController(){
        if (Session::get('id_admin')) {
            $allUserComment = DB::table('coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->get();

            $allUserReply = DB::table('reply')
                ->join('coment','reply.id_coment','=','coment.id_coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->get();
            return view('admin.userManagement.commentController',[
                'allUserComment'=> $allUserComment,
                'allUserReply'=> $allUserReply,
            ]);
        }
        else {
            return Redirect::to('/login');
        }
    }
}
