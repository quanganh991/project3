<?php

namespace App\Http\Controllers\JournalistController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session;

class HomeController extends Controller
{
    public function welcomeJournalist()
    {
        if (Session::get('id_journalist')) {
            return view('journalist.home');
        } else {
            return redirect('login');
        }
    }
}
