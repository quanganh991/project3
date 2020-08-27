<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session,DB;
use Illuminate\Support\Facades\Redirect;

class GocNhinController extends Controller
{
    function viewAllUserGocNhin(){
        if (Session::get('id_admin')) {
            $allUserGocNhin = DB::table('gocnhin')
                ->orderBy('publish_date_gocnhin','DESC')
                ->whereNotNull('id_admin')
                ->get();

            $allGocNhinPending = DB::table('gocnhin')
                ->orderBy('publish_date_gocnhin','DESC')
                ->whereNull('id_admin')
                ->get();
            return view('admin.userManagement.viewAllUserGocNhin')
                ->with('allUserGocNhin',$allUserGocNhin)
                ->with('allGocNhinPending',$allGocNhinPending);
        } else {
            return redirect('login');
        }
    }

    //Ẩn, hiển thị góc nhìn
    public function activeGocNhin($id_gocnhin){
        if (Session::get('id_admin')) {
            DB::table('gocnhin')->where('id_gocnhin', $id_gocnhin)->update(['status_gocnhin' => 1]);
            Session::put('message', 'Active gocnhin thành công');
            return Redirect::to('/admin-view-all-user-gocnhin');
        } else {
            return redirect('login');
        }
    }

    public function unactiveGocNhin($id_gocnhin){
        if (Session::get('id_admin')) {
            DB::table('gocnhin')->where('id_gocnhin', $id_gocnhin)->update(['status_gocnhin' => 0]);
            Session::put('message', 'Unactive gocnhin thành công');
            return Redirect::to('/admin-view-all-user-gocnhin');
        } else {
            return redirect('login');
        }
    }

    //Đánh dấu là góc nhìn hot
    public function makeHotGocNhin($id_gocnhin){
        if (Session::get('id_admin')) {
            DB::table('gocnhin')->where('id_gocnhin', $id_gocnhin)->update(['ishot_gocnhin' => 1]);
            Session::put('message', 'Đánh dấu gocnhin thành công');
            return Redirect::to('/admin-view-all-user-gocnhin');
        } else {
            return redirect('login');
        }
    }

    public function unmakeHotGocNhin($id_gocnhin){
        if (Session::get('id_admin')) {
            DB::table('gocnhin')->where('id_gocnhin', $id_gocnhin)->update(['ishot_gocnhin' => 0]);
            Session::put('message', 'Bỏ đánh dấu gocnhin thành công');
            return Redirect::to('/admin-view-all-user-gocnhin');
        } else {
            return redirect('login');
        }
    }

    //Phê duyệt bài viết
    function approveUserGocnhin($id_gocnhin){
        if (Session::get('id_admin')) {
            DB::table('gocnhin')
                ->where('id_gocnhin', $id_gocnhin)
                ->update(['id_admin' => Session::get('id_admin')]);

            return Redirect::to('/admin-view-all-user-gocnhin');
        } else {
            return redirect('login');
        }
    }
}
