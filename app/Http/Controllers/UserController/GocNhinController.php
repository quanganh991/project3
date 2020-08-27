<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session,DB;
use Illuminate\Support\Facades\Redirect;

class GocNhinController extends Controller
{
    function allGocNhin(){
        $allGocNhin = DB::table('gocnhin')  //lấy tất cả góc nhìn của NGƯỜI DÙNG đăng lên từ mới đến cũ
            ->orderBy('publish_date_gocnhin')
            ->get();

        $quanTamNhieu = DB::table('gocnhin')    //lấy tất cả góc nhìn của NGƯỜI DÙNG đăng lên xếp theo lượt xem
            ->orderBy('views_gocnhin')
            ->get();

        $theoDongSuKien = DB::table('gocnhin')
            ->where('ishot_gocnhin',1)
            ->get();

        $cacTacGia = DB::table('gocnhin')   //lấy các tác giả của góc nhìn
            ->join('users','users.id_user','=','gocnhin.id_customer')
            ->where('users.type_of_user','customer')
            ->get();

        return view('user.news.all_goc_nhin')
            ->with('quanTamNhieu',$quanTamNhieu)
            ->with('allGocNhin',$allGocNhin)
            ->with('cacTacGia',$cacTacGia)
            ->with('theoDongSuKien',$theoDongSuKien);
    }

    function gocNhinTacGia($id_customer){
        $allGocNhin = DB::table('gocnhin')  //lấy tất cả góc nhìn của NGƯỜI DÙNG đăng lên từ mới đến cũ
            ->orderBy('publish_date_gocnhin')
            ->where('id_customer',$id_customer)
            ->get();

        $quanTamNhieu = DB::table('gocnhin')    //lấy tất cả góc nhìn của NGƯỜI DÙNG đăng lên xếp theo lượt xem
        ->orderBy('views_gocnhin')
            ->where('id_customer',$id_customer)
            ->get();

        $theoDongSuKien = DB::table('gocnhin')
            ->where('ishot_gocnhin',1)
            ->where('id_customer',$id_customer)
            ->get();


        $author = DB::table('users')  //lấy thông tin về tác giả
            ->where('id_user',$id_customer)
            ->get()->first();

        return view('user.news.goc_nhin_tac_gia')
            ->with('quanTamNhieu',$quanTamNhieu)
            ->with('allGocNhin',$allGocNhin)
            ->with('author',$author)
            ->with('theoDongSuKien',$theoDongSuKien);
    }

    function detailGocNhin($id_gocnhin){
        $detailGocNhin = DB::table('gocnhin')
            ->where('id_gocnhin',$id_gocnhin)
            ->get()
            ->first();

        $author = DB::table('users')  //lấy thông tin về tác giả
        ->where('id_user',$detailGocNhin->id_customer)
            ->get()->first();

        $relevantGocNhin = DB::table('gocnhin')  //Bài viết khác
            ->orderBy('publish_date_gocnhin','DESC')->take(6)->get();

        return view('user.news.detail_goc_nhin')
            ->with('detailGocNhin',$detailGocNhin)
            ->with('author',$author)
            ->with('relevantGocNhin',$relevantGocNhin);
    }

    function upGocNhin(Request $request){
        if(Session::get('id_customer')) {
            DB::insert('insert into gocnhin(id_customer, publish_date_gocnhin, latest_update_gocnhin, title_gocnhin, context_gocnhin, ishot_gocnhin)
                        values (?,?,?,?,?,?)',
                [$request->id_user, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $request->title_gocnhin, $request->context_gocnhin, 0]);//thêm góc nhìn
            $id_gocnhin = DB::table('gocnhin')->get()->last();

            DB::insert('insert into news (id_branch_category,id_typeofnews,id_gocnhin)
                        values (?,?,?)', [3, 6, $id_gocnhin->id_gocnhin]);  //thêm tin tức chứa góc nhìn
            return Redirect::to('/all-goc-nhin');
        } else return Redirect::to('/login');
    }

    function userControlGocNhin(){
        if(Session::get('id_customer')) {
            $controlUserGocNhin = DB::table('gocnhin')
                ->where('id_customer',Session::get('id_customer'))
                ->whereNotNull('id_admin')
                ->get();

            $pendingUserGocNhin = DB::table('gocnhin')
                ->where('id_customer',Session::get('id_customer'))
                ->whereNull('id_admin')
                ->get();
            return view('user.news.controlUserGocNhin')
                ->with('controlUserGocNhin',$controlUserGocNhin)
                ->with('pendingUserGocNhin',$pendingUserGocNhin);
        } else return Redirect::to('/login');
    }
}
