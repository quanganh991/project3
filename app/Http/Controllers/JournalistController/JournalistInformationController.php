<?php

namespace App\Http\Controllers\JournalistController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB,Session;

class JournalistInformationController extends Controller
{
    public function changeJournalistInformation()
    {
        if (!Session::get('id_journalist'))
            return redirect('login');
        else {
            $journalistInformation = DB::table('users')
                ->where('type_of_user','journalist')
                ->where('id_user', Session::get('id_journalist'))
                ->get()
                ->first();
            return view('journalist.information.journalistInformation')
                ->with('journalistInformation', $journalistInformation);
        }
    }

    public function alterJournalistInformation(Request $request)
    {
        if (!Session::get('id_journalist'))
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
                ->where('id_user', Session::get('id_journalist'))
                ->update(['name_user' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'address' => $address, 'status_user' => $status_user,
                    'avatar' => $avatar, 'job' => $job]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/welcome-journalist');
        }
    }
}
