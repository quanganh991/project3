<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,DB,Session;

class HomeController extends Controller
{
    public function home(){
        $allMain = DB::table('main_category')->get();  //lấy tất cả main
        return view('user.home')
            ->with('allMain',$allMain);
    }
}
