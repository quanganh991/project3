<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect, Session, DB;

class TournamentController extends Controller
{
    //show All
    function allTournament(){
        if(Session::get('id_admin')) {
            $allTournament = DB::table('tournament')    //giải đấu thì ko có quán quân và á quân
                ->where('tournament_or_event','tournament')
                ->get();

            $allEvent = DB::table('tournament') //sự kiện thì ko có muà giải và 2 đội chơi
            ->where('tournament_or_event','event')
                ->get();
            return view('admin.tournamentController.all_tournament')
                ->with('allTournament',$allTournament)
                ->with('allEvent',$allEvent);
        } else{
            return redirect('login');
        }
    }

    public function saveTournament(Request $request)
    {
        if (Session::get('id_admin')) {
            $name_tournament = $request->name_tournament;
            $id_news = $request->id_news;
            $start_time = $request->start_time;
            $finish_time = $request->finish_time;
            $season = $request->season;
            $team1 = $request->team1;
            $team2 = $request->team2;
            $result_team1 = $request->result_team1;
            $result_team2 = $request->result_team2;
            $location = $request->location;
            $organizer = $request->organizer;
            $info_organizer = $request->info_organizer;
            $audience_quantity = $request->audience_quantity;
            $max_participants = $request->max_participants;
            $id_champion = $request->id_champion;
            $id_runner_up = $request->id_runner_up;
            $tournament_or_event = $request->tournament_or_event;

            DB::insert('insert into tournament
                        (name_tournament,id_news,start_time,finish_time,season,team1,team2,result_team1,result_team2,location,organizer,
                        info_organizer,audience_quantity,max_participants,id_champion,id_runner_up,tournament_or_event)
                        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
                , [$name_tournament, $id_news, $start_time, $finish_time, $season, $team1, $team2, $result_team1, $result_team2, $location, $organizer, $info_organizer,
                    $audience_quantity, $max_participants, $id_champion, $id_runner_up,$tournament_or_event]);
            return back();
        } else {
            return redirect('login');
        }
    }

    //Edit
    public function editTournament($id_tournament)
    {
        if (Session::get('id_admin')) {//tìm id
            $edit_tournament = DB::table('tournament')->where('id_tournament', $id_tournament)->get()->first(); //lấy thông tin về tournament hiện tại có id
            //quăng sang trang edit
            return view('admin.tournamentController.edit_tournament')->with('edit_tournament', $edit_tournament);
        } else {
            return redirect('login');
        }
    }

    public function submitEditTournament(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_tournament = $request->id_tournament;
            $name_tournament = $request->name_tournament;
            $id_news = $request->id_news;
            $start_time = $request->start_time;
            $finish_time = $request->finish_time;
            $season = $request->season;
            $team1 = $request->team1;
            $team2 = $request->team2;
            $result_team1 = $request->result_team1;
            $result_team2 = $request->result_team2;
            $location = $request->location;
            $organizer = $request->organizer;
            $info_organizer = $request->info_organizer;
            $audience_quantity = $request->audience_quantity;
            $max_participants = $request->max_participants;
            $id_champion = $request->id_champion;
            $id_runner_up = $request->id_runner_up;
            $tournament_or_event = $request->tournament_or_event;

            DB::table('tournament')
                ->where('id_tournament', $id_tournament)
                ->update([
                    'name_tournament'=>$name_tournament,
                    'id_news'=>$id_news,
                    'start_time'=>$start_time,
                    'finish_time'=>$finish_time,
                    'season'=>$season,
                    'team1'=>$team1,
                    'team2'=>$team2,
                    'result_team1'=>$result_team1,
                    'result_team2'=>$result_team2,
                    'location'=>$location,
                    'organizer'=>$organizer,
                    'info_organizer'=>$info_organizer,
                    'audience_quantity'=>$audience_quantity,
                    'max_participants'=>$max_participants,
                    'id_champion'=>$id_champion,
                    'id_runner_up'=>$id_runner_up,
                    'tournament_or_event'=>$tournament_or_event,
                ]);

            //tìm người chiến thắng trong bình chọn tỉ số
            $result_team = DB::table('tournament')
                ->where('id_tournament', $id_tournament)
                ->get()->first();
            if($result_team->result_team1 > $result_team->result_team2){    //nếu đội 1 thắng đội 2
                $luckyCustomer = DB::table('predict_tournament')    //lấy tất cả các dự đoán mà đoán cho team1 thắng
                    ->where('team_name',$result_team->team1)
                    ->orderBy('predict_time','ASC') //thời gian từ cũ nhất đến mới nhất
                    ->take(3)->get();
                //người thứ nhất
                foreach($luckyCustomer as $key => $eachLuckyCustomer) {
                    $customer = DB::table('users')
                        ->where('id_user',$eachLuckyCustomer->id_customer)
                        ->get()->first();
                    DB::insert('insert into notification (context_noti,date_noti,isread_noti,id_customer,link_noti) values (?,?,?,?,?)'
                        , ['Chúc mừng bạn ' . $customer->name_user . ' đã trở thành 1 trong 3 người may mắn nhất bình chọn cho đội '.$result_team->team1.' giành chiến thắng trong '.$name_tournament.' vui lòng liên hệ ban tổ chức để nhận giải thưởng'
                            , date('Y-m-d H:i:s'),
                            'not seen',
                            $customer->id_user,
                            'detail-tournament-'.$result_team->id_tournament]);
                }
            } else if ($result_team->result_team1 < $result_team->result_team2){    //nếu đội 2 thắng đội 1
                $luckyCustomer = DB::table('predict_tournament')    //lấy tất cả các dự đoán mà đoán cho team2 thắng
                ->where('team_name',$result_team->team2)
                    ->orderBy('predict_time','ASC') //thời gian từ cũ nhất đến mới nhất
                    ->take(3)->get();
                //người thứ nhất
                foreach($luckyCustomer as $key => $eachLuckyCustomer) {
                    $customer = DB::table('users')
                        ->where('id_user',$eachLuckyCustomer->id_customer)
                        ->get()->first();
                    DB::insert('insert into notification (context_noti,date_noti,isread_noti,id_customer,link_noti) values (?,?,?,?,?)'
                        , ['Chúc mừng bạn ' . $customer->name_user . ' đã trở thành 1 trong 3 người may mắn nhất bình chọn cho đội '.$result_team->team2.' giành chiến thắng trong '.$name_tournament.' vui lòng liên hệ ban tổ chức để nhận giải thưởng'
                            , date('Y-m-d H:i:s'),
                            'not seen',
                            $customer->id_user,
                            'detail-tournament-'.$result_team->id_tournament]);
                }
            }
                //tìm quán quân và á quân

            return Redirect::to('/all-tournament');
        } else {
            return redirect('login');
        }
    }

    function viewAllParticipant($id_tournament){
        if (Session::get('id_admin')) {
            $allParticipant = DB::table('participant')
                ->where('id_tournament',$id_tournament)
                ->where('isapproved','!=','pending')
                ->get();
            $allPendingParticipant = DB::table('participant')
                ->where('id_tournament',$id_tournament)
                ->where('isapproved','pending')
                ->get();
            $tournament = DB::table('tournament')
                ->where('id_tournament',$id_tournament)
                ->get()->first();
            return view('admin.tournamentController.participant_tournament')
                ->with('allParticipant',$allParticipant)
                ->with('allPendingParticipant',$allPendingParticipant)
                ->with('tournament',$tournament);
        } else {
            return redirect('login');
        }
    }

    function approveParticipant($id_participant){
        if (Session::get('id_admin')) {
            DB::table('participant')
                ->where('id_participant', $id_participant)
                ->update([
                    'isapproved'=>'approved',
                ]);
            //gửi thông báo trả về cho người dùng
            $participant = DB::table('participant')
                ->where('id_participant',$id_participant)
                ->get()->first();
            $tournament = DB::table('tournament')
                ->where('id_tournament',$participant->id_tournament)
                ->get()->first();
            $customer = DB::table('users')
                ->where('id_user',$participant->id_customer)
                ->get()->first();
            DB::insert('insert into notification (context_noti,date_noti,isread_noti,id_customer,link_noti) values (?,?,?,?,?)'
                , ['Xin chúc mừng, yêu cầu tham gia ' . $tournament->name_tournament . '. đã được phê duyệt, vui lòng đến '.$tournament->location.' trước '.$tournament->start_time.' để ổn định chỗ ngồi '
                    , date('Y-m-d H:i:s'), 'not seen', $customer->id_user,
                    'user-control-tournament']);
            //gửi thông báo về cho người dùng

            return back();
        } else {
            return redirect('login');
        }
    }

    function denyParticipant($id_participant){
        if (Session::get('id_admin')) {
            DB::table('participant')
                ->where('id_participant', $id_participant)
                ->update([
                    'isapproved'=>'denied',
                ]);

            //gửi thông báo trả về cho người dùng
            $participant = DB::table('participant')
                ->where('id_participant',$id_participant)
                ->get()->first();
            $tournament = DB::table('tournament')
                ->where('id_tournament',$participant->id_tournament)
                ->get()->first();
            $customer = DB::table('users')
                ->where('id_user',$participant->id_customer)
                ->get()->first();
            DB::insert('insert into notification (context_noti,date_noti,isread_noti,id_customer,link_noti) values (?,?,?,?,?)'
                , ['Rất tiếc, yêu cầu tham gia ' . $tournament->name_tournament . '. đã bị từ chối, vui lòng liên hệ ban quản trị để biết thêm chi tiết'
                    , date('Y-m-d H:i:s'), 'not seen', $customer->id_user,
                    'user-control-tournament']);
            //gửi thông báo về cho người dùng

            return back();
        } else {
            return redirect('login');
        }
    }

    function viewAllPrediction(){
        if (Session::get('id_admin')) {
            $allPredictionTournament = DB::table('predict_tournament')
                ->orderBy('id_predict_tournament','DESC')
                ->get();
            return view('admin.tournamentController.all_predict_tournament')
                ->with('allPredictionTournament',$allPredictionTournament);
        } else {
            return redirect('login');
        }
    }
}
