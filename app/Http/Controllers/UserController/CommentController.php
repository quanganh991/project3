<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect,Session,DB;

class CommentController extends Controller
{
    function viewAllUserComment(){
        if (Session::get('id_user')) {
            $allUserComment = DB::table('coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->where('coment.id_customer',Session::get('id_user'))
                ->get();

            $allUserReply = DB::table('reply')
                ->join('coment','reply.id_coment','=','coment.id_coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->where('reply.id_customer',Session::get('id_user'))
                ->get();
            return view('user.comment.viewAllComment',[
                'allUserComment'=> $allUserComment,
                'allUserReply'=> $allUserReply,
            ]);
        }
        else {
            return Redirect::to('/login');
        }
    }
}
