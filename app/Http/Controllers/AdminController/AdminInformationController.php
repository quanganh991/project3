<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session,DB;

class AdminInformationController extends Controller
{
    public function changeAdminInformation()
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {
            $adminInformation = DB::table('users')
                ->where('type_of_user','admin')
                ->where('id_user', Session::get('id_admin'))
                ->get()
                ->first();
            return view('admin.adminManagement.adminInformation')
                ->with('adminInformation', $adminInformation);
        }
    }

    public function alterAdminInformation(Request $request)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            $name = $request->name;
            $avatar = $request->avatar;
            $email = $request->email;
            $password = $request->password;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $job = $request->job;
            $status_user = $request->status_user;

            DB::table('users')
                ->where('id_user', Session::get('id_admin'))
                ->update(['name_user' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'address' => $address, 'status_user' => $status_user,
                    'avatar' => $avatar, 'job' => $job]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/welcome-admin');
        }
    }

    public function addAdmin()
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            return view('admin.adminManagement.addAdmin');
        }
    }

    public function saveAdmin(Request $request)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            $name = $request->admin_name;
            $email = $request->admin_email;
            $password = $request->admin_password;
            $address = $request->admin_address;
            $phone_number = $request->admin_phone_number;
            $avatar = $request->admin_avatar;
            $job = $request->admin_job;
            $type_of_user = $request->type_of_user;

            DB::insert('insert into users (name_user,email, password, address, phone_number, avatar, job, type_of_user, status_user) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name,$email,$password,$address, $phone_number,$avatar, $job,$type_of_user, 1]);
            return Redirect('/welcome-admin');
        }
    }
}
