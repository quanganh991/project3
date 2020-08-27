<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB,Session;

class UserInformationController extends Controller
{
    public function changeUserInformation()
    {
        if (!Session::get('id_customer'))
            return redirect('login');
        else {
            $customerInformation = DB::table('users')
                ->where('id_user', Session::get('id_customer'))
                ->where('type_of_user','customer')
                ->get()
                ->first();
            return view('user.information.userInformation')
                ->with('customerInformation', $customerInformation);
        }
    }

    public function alterUserInformation(Request $request)
    {
        if (!Session::get('id_customer'))
            return redirect('login');
        else {

            $name = $request->name_user;
            $email = $request->email;
            $password = $request->password;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $avatar = $request->avatar;
            $job = $request->job;

            DB::table('users')
                ->where('id_user', Session::get('id_customer'))
                ->update(['name_user' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number,
                    'address' => $address, 'avatar' => $avatar,'job'=>$job]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/');
        }
    }
}
