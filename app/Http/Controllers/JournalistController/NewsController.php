<?php

namespace App\Http\Controllers\JournalistController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect,DB,Session;

class NewsController extends Controller
{
    public function showAllNews()
    {
        if (Session::get('id_journalist')) {
            $allNews = DB::table('news')
                ->where('id_journalist',Session::get('id_journalist'))
                ->orderBy('latest_update','DESC')
                ->paginate(10);

            return view('journalist.newsController.all_news')->with('allNews', $allNews);
        } else {
            return redirect('login');
        }
    }

    public function activeNews($id_news){
        if (Session::get('id_journalist')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 1]);
            Session::put('message', 'Active news thành công');
            return Redirect::to('/jnl-all-news');
        } else {
            return redirect('login');
        }
    }

    public function unactiveNews($id_news){
        if (Session::get('id_journalist')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 0]);
            Session::put('message', 'Unactive news thành công');
            return Redirect::to('/jnl-all-news');
        } else {
            return redirect('login');
        }
    }

    public function editNews($id_news)
    {
        if (Session::get('id_journalist')) {//tìm id
            $edit_news = DB::table('news')
                ->where('id_news', $id_news)
                ->where('id_journalist',Session::get('id_journalist'))
                ->get()->first();
            //quăng sang trang edit
            return view('journalist.newsController.edit_news')->with('edit_news', $edit_news);
        } else {
            return redirect('login');
        }
    }

    public function submitEditNews(Request $request)
    {
        if (Session::get('id_journalist')) {
            $id_news = $request->id_news;
            $id_branch_category = $request->id_branch_category;
            $news_title = $request->news_title;
            $news_context = $request->news_context;
            $id_author = Session::get('id_journalist');
            $id_admin = $request->id_admin;
            $news_status = $request->news_status;
            $id_typeofnews = $request->id_typeofnews;
            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $multimedia = $request->multimedia;
            $describ_multimedia = $request->describ_multimedia;

            DB::table('news')->where('id_news', $id_news)
                ->update(['id_branch_category' => $id_branch_category, 'title' => $news_title, 'context' => $news_context,
                    'id_journalist' => $id_author, 'id_admin' => $id_admin, 'status' => $news_status, 'latest_update' => $latest_update, 'publish_date' =>$publish_date,
                    'id_typeofnews' => $id_typeofnews, 'multimedia'=>$multimedia, 'describ_multimedia'=>$describ_multimedia]);

            return Redirect::to('/jnl-all-news');
        } else {
            return redirect('login');
        }
    }

    public function saveNews(Request $request)
    {
        if (Session::get('id_journalist')) {
            $id_branch_category = $request->id_branch_category;
            $news_title = $request->news_title;
            $news_context = $request->news_context;
            $id_journalist = Session::get('id_journalist');
            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $id_typeofnews = $request->id_typeofnews;
            $multimedia = $request->multimedia;
            $describ_multimedia = $request->describ_multimedia;

            DB::insert('insert into news (id_branch_category,title,context,id_journalist,status,publish_date,latest_update,id_typeofnews,views,multimedia,describ_multimedia)
                        values (?,?,?,?,?,?,?,?,?,?,?)'
                , [$id_branch_category, $news_title, $news_context, $id_journalist, 1, $publish_date, $latest_update, $id_typeofnews,0,$multimedia,$describ_multimedia]);
            return back();
        } else {
            return redirect('login');
        }
    }
}
