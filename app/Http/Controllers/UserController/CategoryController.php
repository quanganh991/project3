<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller, DB, Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    function ViewBranchList($id_main)
    {
        if($id_main != 2) {
            $mainSearch = DB::table('main_category')->where('id_main_category', $id_main)->get()->first();  //chứa $id_main
            $branchSearch = DB::table('branch_category')->where('id_main_category', $id_main)->get();   //chứa tất cả các branch có $id_main
            $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất có $id_main
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->orderBy('latest_update', 'DESC')
                ->take(5)
                ->get();
            $newsSearchPopular = DB::table('news') //chứa 4 tin tức có nhiều lượt xem nhất có $id_main
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->orderBy('views', 'DESC')
                ->take(4)
                ->get();
            $newsSearchImageOnly = DB::table('news') //chứa các tin tức chỉ toàn ảnh có $id_main
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->where('news.id_typeofnews', 5) //lấy tin tức kiểu là ảnh
                ->orWhere('news.id_typeofnews', 2)   //hoặc là kiểu infographic
                ->get();
            $newsSearchVideoOnly = DB::table('news') //chứa các tin tức chỉ toàn video có $id_main
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->where('news.id_typeofnews', 3) //lấy tin tức kiểu là video
                ->get();
            $newsSearchMultipleChoice = DB::table('news') //chứa các tin tức mang tính khảo sát người dùng có $id_main
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->where('news.id_typeofnews', 4)//lấy tin tức kiểu là trắc nghiệm
                ->get();
            return view('user.news.branch_list', [
                'branchSearch' => $branchSearch,
                'newsSearch' => $newsSearch,
                'mainSearch' => $mainSearch,
                'newsSearchPopular' => $newsSearchPopular,
                'newsSearchImageOnly' => $newsSearchImageOnly,
                'newsSearchVideoOnly' => $newsSearchVideoOnly,
                'newsSearchMultipleChoice' => $newsSearchMultipleChoice
            ]);
        } else {
            return Redirect::to('/all-goc-nhin');
        }
    }

    function ViewNewsList($id_branch)
    {//
        if($id_branch != 3) {
            $branchSearch = DB::table('branch_category')->where('id_branch_category', $id_branch)->get()->first();   //chứa $id_branch
            $mainSearch = DB::table('main_category')->where('id_main_category', $branchSearch->id_main_category)->get()->first();  //chứa $id_main
            //Sắp xếp theo mới nhất-cũ nhất
            $newsSearch = DB::table('news')->where('id_branch_category', $id_branch)
                ->orderBy('publish_date', 'DESC')
                ->take(6)
                ->get();
            //Sắp xếp theo nhiều lượt xem nhất
            $newsSearchPopular = DB::table('news')->where('id_branch_category', $id_branch)
                ->orderBy('views', 'DESC')
                ->take(6)
                ->get();
            //Ảnh hoặc infographic
            $newsSearchImageOnly = DB::table('news') //chứa các tin tức chỉ toàn ảnh có $id_branch
            ->where('id_branch_category', $id_branch)
                ->where('news.id_typeofnews', 5) //lấy tin tức kiểu là ảnh
                ->orWhere('news.id_typeofnews', 2)   //hoặc là kiểu infographic
                ->get();
            //Video
            $newsSearchVideoOnly = DB::table('news') //chứa các tin tức chỉ toàn video có $id_branch
            ->where('id_branch_category', $id_branch)
                ->where('news.id_typeofnews', 3) //lấy tin tức kiểu là video
                ->get();
            //Trắc nghiệm
            $newsSearchMultipleChoice = DB::table('news') //chứa các tin tức mang tính khảo sát người dùng có $id_branch
            ->where('id_branch_category', $id_branch)
                ->where('news.id_typeofnews', 4)//lấy tin tức kiểu là trắc nghiệm
                ->get();
            return view('user.news.news_list', [
                'newsSearch' => $newsSearch,
                'branchSearch' => $branchSearch,
                'mainSearch' => $mainSearch,
                'newsSearchPopular' => $newsSearchPopular,
                'newsSearchImageOnly' => $newsSearchImageOnly,
                'newsSearchVideoOnly' => $newsSearchVideoOnly,
                'newsSearchMultipleChoice' => $newsSearchMultipleChoice
            ]);
        } else {
            return Redirect::to('/all-goc-nhin');
        }
    }

    function ViewNewsDetail($id_news)
    {
        $newsDetail = DB::table('news')->where('id_news', $id_news)->get()->first(); //lấy thông tin về bài viết
        $newsDetailBranch = DB::table('branch_category')->where('id_branch_category', $newsDetail->id_branch_category)->get()->first();  //thông tin về branch của bài viết
        $newsDetailMain = DB::table('main_category')->where('id_main_category', $newsDetailBranch->id_main_category)->get()->first();  //thông tin về main của bài viết
        $relevantNewsDetail = DB::table('news')->where('id_branch_category', $newsDetailBranch->id_branch_category)->get();  //lấy tất cả các bài viết có cùng branch
        $branchInSameMain = DB::table('branch_category')
            ->where('id_main_category', $newsDetailBranch->id_main_category)->get();    //lấy tất cả các branch trong cùng main của $id_news
        $videoInSameBranch = DB::table('news') //chứa các tin tức chỉ toàn video có $id_branch
        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $newsDetailMain->id_main_category)
            ->where('news.id_typeofnews', 3) //lấy tin tức kiểu là video
            ->get();
        return view('user.news.news_detail', [
            'newsDetail' => $newsDetail,
            'newsDetailBranch' => $newsDetailBranch,
            'newsDetailMain' => $newsDetailMain,
            'relevantNewsDetail' => $relevantNewsDetail,
            'branchInSameMain' => $branchInSameMain,
            'videoInSameBranch' => $videoInSameBranch,
        ]);
    }

    function bookmark(Request $request)
    {
        if (Session::get('id_user')) {
            $id_news = $request->id_news;
            $id_customer = Session::get('id_user');
            DB::insert('insert into bookmarked (id_news, id_customer) values (?, ?)'
                , [$id_news, $id_customer]);
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function unbookmark(Request $request)
    {
        if (Session::get('id_user')) {
            $id_news = $request->id_news;
            $id_customer = Session::get('id_user');
            DB::table('bookmarked')
                ->where('id_news', $id_news)
                ->where('id_customer',$id_customer)
                ->delete();
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function unbookmark2($id_news)
    {
        if (Session::get('id_user')) {
            $id_customer = Session::get('id_user');
            DB::table('bookmarked')
                ->where('id_news', $id_news)
                ->where('id_customer',$id_customer)
                ->delete();
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function viewAllUserBookmark(){
        if (Session::get('id_user')) {
            $allUserBookmark = DB::table('bookmarked')
                ->join('news','bookmarked.id_news','=','news.id_news')
                ->where('bookmarked.id_customer',Session::get('id_user'))
                ->get();
            return view('user.news.viewAllBookmark',[
                'allUserBookmark'=> $allUserBookmark
            ]);
        }
        else {
            return Redirect::to('/login');
        }
    }

    function searchNews(Request $request){
        $keyword = $request->keyword;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        if ($dateTo == null){
            $dateTo = date('Y-m-d H:i:s');
        }

        if ($dateFrom == null){
            $dateFrom = mktime(0, 0, 0, 1, 1, 1970);
            $dateFrom = date('Y-m-d H:i:s',$dateFrom);
        }

        if($keyword != null) {
            $search_news = DB::table('news')
                ->where('title', 'like', '%' . $keyword . '%')
                ->whereDate('publish_date', '>', $dateFrom)
                ->whereDate('publish_date', '<', $dateTo)
                ->get();
        } else {
            $search_news = DB::table('news')
                ->where('title',$keyword)
                ->whereDate('publish_date', '>', $dateFrom)
                ->whereDate('publish_date', '<', $dateTo)
                ->get();
        }
        return view('user.news.search_news')
            ->with('search_news',$search_news);
    }
}
