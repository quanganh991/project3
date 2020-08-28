<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,DB,Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function login_check(Request $request)
    {
        $email = $request->email_account;
        $password = $request->password_account;
        $save_login = $request->save_login;
            $resultUser = DB::table('users')->where('email', $email)->where('password', $password)->first();    //chứa thông tin người dùng
            //Nếu đăng nhập đúng và sai
            if ($resultUser == null) $check = false;
            else $check = true;
            //nếu lưu thông tin đăng nhập
            if($save_login==true){
                cookie('email',$email,720);
                cookie('password',$password,720);
            }
            //
            if ($resultUser) {    //nếu người dùng đăng nhập đúng
                Session::put('login', true);
                Session::put('id_user', $resultUser->id_user);  //dùng chung cho cả 3 người
                if($resultUser->type_of_user == 'customer') {   //nếu độc giả đăng nhập
                    Session::put('id_customer',$resultUser->id_user);
                    Session::remove('id_admin');
                    Session::remove('id_journalist');
                    return redirect('/');
                } else if($resultUser->type_of_user == 'admin'){//nếu quản trị viên đăng nhập
                    Session::put('id_admin',$resultUser->id_user);
                    Session::remove('id_customer');
                    Session::remove('id_journalist');
        //            return view('admin.home');
                    return redirect('/home-admin');
                } else if($resultUser->type_of_user == 'journalist'){//nếu nhà báo đăng nhập
                    Session::put('id_journalist',$resultUser->id_user);
                    Session::remove('id_customer');
                    Session::remove('id_admin');
        //            return view('journalist.home');
                    return redirect('/home-journalist');
                }
            } else {
                $alert = 'Tài khoản hoặc mật khẩu không chính xác';
                return view('login', compact('check', 'alert'));
            }
    }

    public function signup_check(Request $request){
        $name = $request->customer_name;
        $email = $request->customer_email;
        $password = $request->customer_password;
        $phone = $request->customer_phone;
        $address = $request->customer_address;
        $avatar = $request->customer_avatar;
        $job = $request->customer_job;
        $result = DB::table('users')->where('email',$email)->first();

        //Nếu đăng ký đúng và sai
        if ($result == null) $check = true; //ko tìm thấy thì check đúng
        else $check = false;

        if($result){    //nếu email đã tồn tại (được tìm thấy trong csdl)
            $alert = 'Tài khoản đã tồn tại';
            return view('signup', compact('check', 'alert'));
        }else{  //nếu ko tìm thấy email trong csdl-> Hợp lệ
            Session::put('email',$email);
            DB::insert('insert into users (name_user, email, password, address, phone_number, avatar,job,type_of_user,status_user) values (?, ?, ?, ?, ?, ?, ?,?,?)', [$name, $email,$password, $address, $phone, $avatar, $job,"customer",1]);
            return redirect('/');
        }
    }

    public function signup(){
        return view('signup');
    }



    public function logout(){
        Session::remove('id_user');
        Session::remove('id_journalist');
        Session::remove('id_customer');
        Session::remove('id_admin');
        Session::remove('login');
        Session::remove('email');
        Session::remove('notification');
        Session::put('login',false);
        return redirect('/');
    }
}
