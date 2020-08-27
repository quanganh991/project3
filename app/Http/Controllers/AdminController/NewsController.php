<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect,Session,DB;

class NewsController extends Controller
{
    //Add
    public function addBranchCategory()
    {
        if (Session::get('id_admin')) {
            return view('admin.newsController.add_branch_category');
        } else {
            return redirect('login');
        }
    }

    public function saveBranchCategory(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_main_category = $request->id_main_category;
            $name_branch = $request->name_branch;

            DB::insert('insert into branch_category (id_main_category, name_branch) values (?, ?)'
                , [$id_main_category, $name_branch]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function addMainCategory()
    {
        if (Session::get('id_admin')) {
            return view('admin.newsController.add_main_category');
        } else {
            return redirect('login');
        }
    }

    public function saveMainCategory(Request $request)
    {
        if (Session::get('id_admin')) {
            $name_main = $request->name_main;

            DB::insert('insert into main_category (name_main) values (?)'
                , [$name_main]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function addNews()
    {
        if (Session::get('id_admin')) {
            return view('admin.newsController.add_news');
        } else {
            return redirect('login');
        }
    }

    public function saveNews(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_branch_category = $request->id_branch_category;
            $news_title = $request->news_title;
            $news_context = $request->news_context;
            $id_journalist = $request->id_journalist;
            $id_admin = Session::get('id_admin');
            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $id_typeofnews = $request->id_typeofnews;
            $multimedia = $request->multimedia;
            $describ_multimedia = $request->describ_multimedia;
            DB::insert('insert into news (id_branch_category,title,context,id_journalist,id_admin,status,publish_date,latest_update,id_typeofnews,views,multimedia,describ_multimedia)
                        values (?,?,?,?,?,?,?,?,?,?,?,?)'
                , [$id_branch_category, $news_title, $news_context, $id_journalist, $id_admin, 1, $publish_date, $latest_update, $id_typeofnews,0,$multimedia,$describ_multimedia]);
            return back();
        } else {
            return redirect('login');
        }
    }

    //show
    public function showAllBranchCategory()
    {
        if (Session::get('id_admin')) {
            $allBranchCategory = DB::table('branch_category')
                ->paginate(10);
            return view('admin.newsController.all_branch_category')->with('allBranchCategory', $allBranchCategory);
        } else {
            return redirect('login');
        }
    }

    public function showAllMainCategory()
    {
        if (Session::get('id_admin')) {
            $allMainCategory = DB::table('main_category')
                ->paginate(10);
            return view('admin.newsController.all_main_category')->with('allMainCategory', $allMainCategory);
        } else {
            return redirect('login');
        }
    }

    public function showAllNews()
    {
        if (Session::get('id_admin')) {
            $allNews = DB::table('news')->orderBy('latest_update','DESC')
                ->paginate(10);

            return view('admin.newsController.all_news')->with('allNews', $allNews);
        } else {
            return redirect('login');
        }
    }

    //Edit
    public function editBranchCategory($id_branch_category)
    {
        if (Session::get('id_admin')) {//tìm id
            $edit_branch_category = DB::table('branch_category')->where('id_branch_category', $id_branch_category)->get()->first();
            //quăng sang trang edit
            return view('admin.newsController.edit_branch_category')->with('edit_branch_category', $edit_branch_category);
        } else {
            return redirect('login');
        }
    }

    public function submitEditBranch(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_branch_category = $request->id_branch_category;
            $id_main_category = $request->id_main_category;
            $name_branch = $request->name_branch;

            DB::table('branch_category')->where('id_branch_category', $id_branch_category)
                ->update(['id_main_category' => $id_main_category, 'name_branch' => $name_branch]);
            $checkedit= true;
            $alert= 'Edit Branch Success';
            return Redirect::to('/all-branch-category')->with('checkedit', 'alert');
        } else {
            return redirect('login');
        }
    }

    public function editNews($id_news)
    {
        if (Session::get('id_admin')) {//tìm id
            $edit_news = DB::table('news')->where('id_news', $id_news)->get()->first();
            //quăng sang trang edit
            return view('admin.newsController.edit_news')->with('edit_news', $edit_news);
        } else {
            return redirect('login');
        }
    }

    public function submitEditNews(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_news = $request->id_news;
            $id_branch_category = $request->id_branch_category;
            $news_title = $request->news_title;
            $news_context = $request->news_context;
            $id_author = $request->id_author;
            $id_admin = Session::get('id_admin');
            $news_status = $request->news_status;
            $id_typeofnews = $request->id_typeofnews;
//            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $multimedia = $request->multimedia;
            $describ_multimedia = $request->describ_multimedia;

            DB::table('news')->where('id_news', $id_news)
                ->update([
                    'id_branch_category' => $id_branch_category,
                    'title' => $news_title,
                    'context' => $news_context,
                    'id_journalist' => $id_author,
                    'id_admin' => $id_admin,
                    'status' => $news_status,
                    'latest_update' => $latest_update,
//                    'publish_date' =>$publish_date,
                    'id_typeofnews' => $id_typeofnews,
                    'multimedia'=>$multimedia,
                    'describ_multimedia'=>$describ_multimedia]);

            return Redirect::to('/all-news');
        } else {
            return redirect('login');
        }
    }

    public function editMainCategory($id_main_category)
    {
        if (Session::get('id_admin')) {//tìm id
            $edit_main_category = DB::table('main_category')->where('id_main_category', $id_main_category)->get()->first();
            //quăng sang trang edit
            return view('admin.newsController.edit_main_category')->with('edit_main_category', $edit_main_category);
        } else {
            return redirect('login');
        }
    }

    public function submitEditMain(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_main_category = $request->id_main_category;
            $name_main = $request->name_main;

            DB::table('main_category')
                ->where('id_main_category', $id_main_category)
                ->update(['name_main' => $name_main]);

            return Redirect::to('/all-main-category');
        } else {
            return redirect('login');
        }
    }

    //Ẩn, hiển thị news
    public function activeNews($id_news){
        if (Session::get('id_admin')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 1]);
            Session::put('message', 'Active news thành công');
            return Redirect::to('/all-news');
        } else {
            return redirect('login');
        }
    }

    public function unactiveNews($id_news){
        if (Session::get('id_admin')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 0]);
            Session::put('message', 'Unactive news thành công');
            return Redirect::to('/all-news');
        } else {
            return redirect('login');
        }
    }

}
