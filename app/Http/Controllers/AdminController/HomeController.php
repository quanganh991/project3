<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,DB,Session;

class HomeController extends Controller
{
    public function welcomeAdmin()
    {
        if (Session::get('id_admin')) {
            return view('admin.home');
        } else {
            return redirect('login');
        }
    }
}
