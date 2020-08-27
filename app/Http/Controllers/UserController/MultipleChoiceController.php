<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session,DB;

class MultipleChoiceController extends Controller
{
    function checkMultipleChoice(Request $request)
    {
        $id_news = $request->id_news;   //chứa tin tức mang các câu hỏi trắc nghiệm
        $multiple_choice = DB::table('multiple_choice') //chứa tất cả các câu hỏi trắc nghiệm
            ->where('id_news', $request->id_news)
            ->get();
        $question_qty = count($multiple_choice);
        $choice = array();  //Chứa các đáp án mà người dùng đã nhập
        $result = array();  //Chứa kết quả đúng/sai mà người dùng đã nhập
        $KEY = array();
        $sum = array();
        $qty_a = array();   //chứa tỉ lệ người dùng chọn đáp án A
        $qty_b = array();
        $qty_c = array();
        $qty_d = array();

        for ($i = 0; $i < $question_qty; $i++) {  //gán tất cả đáp án của người dùng đã chọn vào mảng choice
            $choice[$i] = $request->choice[$i];

        }
        foreach ($multiple_choice as $key => $eachOfMultipleChoice) {  //duyệt tất cả các câu trả lời của người dùng
            if ($eachOfMultipleChoice->key_answer != null) {    //nếu câu hỏi có đáp án
                $KEY[$key] = $eachOfMultipleChoice->key_answer;
                if ($KEY[$key] == $choice[$key]) {    //trả lời đúng
                    $result[$key] = 1;
                } else if ($KEY[$key] != $choice[$key]) {    //trả lời sai
                    $result[$key] = 0;
                }
            }
            //đưa câu trả lời của người dùng vào CSDL
            $cau_hoi = DB::table('multiple_choice')
                ->where('id_news',$id_news)
                ->where('stt', $key + 1)
                ->get()
                ->first();
            $qty_a[$key] = $cau_hoi->a_quantity;   //lấy số lượng người dùng chọn phương án A
            $qty_b[$key] = $cau_hoi->b_quantity;
            $qty_c[$key] = $cau_hoi->c_quantity;
            $qty_d[$key] = $cau_hoi->d_quantity;
//            echo $qty_a[$key];
//            echo $qty_b[$key];
//            echo $qty_c[$key];
//            echo $qty_d[$key];

            if ($choice[$key] == 'A') {
                DB::table('multiple_choice')
                    ->where('id_news', $id_news)
                    ->where('stt', $key + 1)
                    ->update(['a_quantity' => ++$qty_a[$key]]);
            } else if ($choice[$key] == 'B') {
                DB::table('multiple_choice')
                    ->where('id_news', $id_news)
                    ->where('stt', $key + 1)
                    ->update(['b_quantity' => ++$qty_b[$key]]);
            } else if ($choice[$key] == 'C') {
                DB::table('multiple_choice')
                    ->where('id_news', $id_news)
                    ->where('stt', $key + 1)
                    ->update(['c_quantity' => ++$qty_c[$key]]);
            } else if ($choice[$key] == 'D') {
                DB::table('multiple_choice')
                    ->where('id_news', $id_news)
                    ->where('stt', $key + 1)
                    ->update(['d_quantity' => ++$qty_d[$key]]);
            }
            $sum[$key] = $qty_a[$key] + $qty_b[$key] + $qty_c[$key] + $qty_d[$key];
        }

        return view('user.news.result_multiple_choice')
            ->with('id_news',$id_news)
            ->with('qty_a',$qty_a)
            ->with('qty_b',$qty_b)
            ->with('qty_c',$qty_c)
            ->with('qty_d',$qty_d)
            ->with('choice',$choice)    //chứa lựa chọn của người dùng
            ->with('result',$result)    //chứa kết quả đúng/sai
            ->with('sum',$sum)  //chứa tổng số bình luận
            ->with('KEY',$KEY);
    }
}
