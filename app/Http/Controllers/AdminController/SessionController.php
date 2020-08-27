<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function viewAllSession(){
        return view('admin.session.viewAllSession');
    }
}
