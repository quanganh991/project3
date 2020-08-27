<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect,DB,Session;

class MultipleChoiceController extends Controller
{
    public function addMultipleChoice()
    {
        if (Session::get('id_admin')) {
            return view('admin.multipleChoiceController.add_multiple_choice');
        } else {
            return redirect('login');
        }
    }

    public function saveMultipleChoice(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_news = $request->id_news;
            $stt = $request->stt;
            $question = $request->question;
            $a_answer = $request->a_answer;
            $b_answer = $request->b_answer;
            $c_answer = $request->c_answer;
            $d_answer = $request->d_answer;
            $key_answer = $request->key_answer;
            $explanation = $request->explanation;
            $img_explanation = $request->img_explanation;

            DB::insert('insert into multiple_choice (id_news,stt,question,a_answer,b_answer,c_answer,d_answer,key_answer,explanation,img_explanation)
                        values (?,?,?,?,?,?,?,?,?,?)'
                , [$id_news,$stt, $question, $a_answer, $b_answer, $c_answer, $d_answer, $key_answer, $explanation, $img_explanation]);
            return back();
        } else {
            return redirect('login');
        }
    }

    //show

    public function showAllMultipleChoice()
    {
        if (Session::get('id_admin')) {
            $allMultipleChoice = DB::table('multiple_choice')
                ->paginate(10);

            return view('admin.multipleChoiceController.all_multiple_choice')
                ->with('allMultipleChoice', $allMultipleChoice);
        } else {
            return redirect('login');
        }
    }

    //Edit

    public function editMultipleChoice($id_multiple_choice)
    {
        if (Session::get('id_admin')) {//tìm id
            $edit_multiple_choice = DB::table('multiple_choice')->where('id_multiple_choice', $id_multiple_choice)->get()->first();
            //quăng sang trang edit
            return view('admin.multipleChoiceController.edit_multiple_choice')
                ->with('edit_multiple_choice', $edit_multiple_choice);
        } else {
            return redirect('login');
        }
    }

    public function submitEditMultipleChoice(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_multiple_choice = $request->id_multiple_choice;
            $id_news = $request->id_news;
            $stt = $request->stt;
            $question = $request->question;
            $a_answer = $request->a_answer;
            $b_answer = $request->b_answer;
            $c_answer = $request->c_answer;
            $d_answer = $request->d_answer;
            $key_answer = $request->key_answer;
            $explanation = $request->explanation;
            $img_explanation = $request->img_explanation;

            DB::table('multiple_choice')
                ->where('id_multiple_choice', $id_multiple_choice)
                ->update([
                    'id_news' => $id_news,
                    'stt' => $stt,
                    'question' => $question,
                    'a_answer' => $a_answer,
                    'b_answer' => $b_answer,
                    'c_answer' => $c_answer,
                    'd_answer' => $d_answer,
                    'key_answer' => $key_answer,
                    'explanation' =>$explanation,
                    'img_explanation' => $img_explanation
                ]);

            return Redirect::to('/all-multiple-choice');
        } else {
            return redirect('login');
        }
    }
}
