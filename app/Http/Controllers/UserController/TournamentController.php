<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session, DB, Redirect;

class TournamentController extends Controller
{
    function viewAllTournament()
    {
        if (!Session::get('id_customer')) {
            return redirect('login');
        } else {
            $allTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'tournament')
                ->where('participant.isapproved', 'approved')
                ->get();

            $allCancelledTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'tournament')
                ->where('participant.isapproved', 'denied')
                ->get();

            $allPendingTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'tournament')
                ->where('participant.isapproved', 'pending')
                ->get();

            $me = DB::table('users')
                ->where('id_user', Session::get('id_customer'))
                ->get()->first();
            return view('user.tournament.all_tournament')
                ->with('allTournament', $allTournament)
                ->with('allCancelledTournament', $allCancelledTournament)
                ->with('allPendingTournament', $allPendingTournament)
                ->with('me', $me);
        }
    }

    function cancelParticipant($id_participant)
    {
        if (!Session::get('id_customer')) {
            return redirect('login');
        } else {
            DB::table('participant')
                ->where('id_participant', $id_participant)
                ->whereNot('isapproved', 'approved')
                ->update([
                    'isapproved' => 'denied'
                ]);
            return back();
        }
    }

    function viewAllEvent()
    {
        if (!Session::get('id_customer')) {
            return redirect('login');
        } else {
            $allTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'event')
                ->where('participant.isapproved', 'approved')
                ->get();

            $allCancelledTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'event')
                ->where('participant.isapproved', 'denied')
                ->get();

            $allPendingTournament = DB::table('tournament')
                ->join('participant', 'tournament.id_tournament', '=', 'participant.id_tournament')
                ->where('participant.id_customer', Session::get('id_customer'))
                ->where('tournament.tournament_or_event', 'event')
                ->where('participant.isapproved', 'pending')
                ->get();

            $me = DB::table('users')
                ->where('id_user', Session::get('id_customer'))
                ->get()->first();
            return view('user.tournament.all_event')
                ->with('allTournament', $allTournament)
                ->with('allCancelledTournament', $allCancelledTournament)
                ->with('allPendingTournament', $allPendingTournament)
                ->with('me', $me);
        }
    }

    function detailTournament($id_tournament)
    {  //xem chi tiết trận đấu, sự kiện
        $tournament = DB::table('tournament')
            ->where('id_tournament', $id_tournament)
            ->get()->first();
        $participant = DB::table('participant')
            ->where('id_tournament', $id_tournament)
            ->get();
        $newestTournament = DB::table('tournament')
            ->orderBy('start_time', 'DESC')
            ->take(4)
            ->get();
        return view('user.tournament.detail_tournament')
            ->with('tournament', $tournament)
            ->with('participant', $participant)
            ->with('newestTournament', $newestTournament);
    }

    function commingSoonTournament()
    {   //danh sách các trận đấu/sự kiện sắp diễn ra
        return view('user.tournament.commingsoon_tournament');
    }

    function championList()
    {    //á quân và quán quân
        $allEvent = DB::table('tournament')
            ->whereNotNull('id_champion')
            ->whereNotNull('id_runner_up')
            ->get();
        return view('user.tournament.champion_list')
            ->with('allEvent', $allEvent);
    }

    function allTournamentByTeam($team_name)
    {   //tìm kiếm giải đấu theo tên
        $allTournamentByTeam = DB::table('tournament')
            ->where('team1', $team_name)
            ->orWhere('team2', $team_name)
            ->get();
        return view('user.tournament.all_tournament_by_team')
            ->with('allTournamentByTeam', $allTournamentByTeam)
            ->with('team_name', $team_name);
    }

    function searchTournamentByTeam(Request $request)
    {//tìm kiếm giải đấu theo tên
        $team_name = $request->team_name;
        $allTournamentByTeam = DB::table('tournament')
            ->where('team1', $team_name)
            ->orWhere('team2', $team_name)
            ->get();
        return view('user.tournament.all_tournament_by_team')
            ->with('allTournamentByTeam', $allTournamentByTeam)
            ->with('team_name', $team_name);
    }

    function registerForTournament($id_tournament)
    {
        if (Session::get('id_customer')) {
            $check = DB::table('participant')
                ->where('id_customer', Session::get('id_customer'))
                ->where('id_tournament', $id_tournament)
                ->get()->first();
            $maximum = DB::table('tournament')
                ->where('id_tournament', $id_tournament)
                ->get()
                ->first();  //chứa sự kiện
            if ($check == false && $maximum->audience_quantity < $maximum->max_participants) {
                $information = DB::table('users')
                    ->where('id_user', Session::get('id_customer'))
                    ->get()->first();
                $tournament = DB::table('tournament')
                    ->where('id_tournament', $id_tournament)
                    ->get()
                    ->first();
                return view('user.tournament.register_for_tournament')
                    ->with('information', $information)
                    ->with('tournament', $tournament);
            } else {
                $reason = 'Bạn đã đăng ký tham gia sự kiện này hoặc sự kiện đã hết chỗ rồi, vui lòng check inbox để kiểm tra trạng thái đăng ký';
                return view('user.tournament.failedRegister')->with('reason', $reason);
            }
        } else {
            return Redirect::to('/login');
        }
    }

    function submitRegister(Request $request)
    {
        if (Session::get('id_customer')) {
            $note = $request->note;
            $tournament = $request->tournament;
            $id_user = $request->id_user;
            $email = $request->email;
            $name_user = $request->name_user;
            $address = $request->address;
            $phone_number = $request->phone_number;
            $fee = $request->fee;
            $bank = $request->bank;
            $id_tournament = $request->id_tournament;

            DB::insert('insert into participant (id_customer, id_tournament, isapproved, register_time) values (?, ?, ?, ?)'
                , [$id_user, $request->id_tournament, 'pending', date('Y-m-d H:i:s')]);

            DB::insert('insert into notification (context_noti,date_noti,isread_noti,id_customer,link_noti) values (?,?,?,?,?)'
                , ['Bạn đã đăng ký thành công ' . $tournament . '. Vui lòng chờ admin phê duyệt', date('Y-m-d H:i:s'), 'not seen', Session::get('id_customer'),
                    'detail-tournament-'.$request->id_tournament]);
            //tăng số lượng trong bảng tournament
            $audience_quantity = DB::table('tournament')
                ->where('id_tournament',$id_tournament)
                ->get()->first()->audience_quantity;
            $audience_quantity++;
            DB::table('tournament')->where('id_tournament', $id_tournament)->update(['audience_quantity' => $audience_quantity]);
            //
            return view('user.tournament.successfulRegister')
                ->with('note', $note)
                ->with('tournament', $tournament)
                ->with('id_user', $id_user)
                ->with('email', $email)
                ->with('name_user', $name_user)
                ->with('address', $address)
                ->with('phone_number', $phone_number)
                ->with('fee', $fee)
                ->with('bank', $bank);
        } else {
            return Redirect::to('/login');
        }
    }

    public function predictTournament(Request $request)
    {
        if (Session::get('id_customer')) {
            $check = DB::table('predict_tournament')
                ->where('id_customer', $request->id_customer)
                ->where('id_tournament', $request->id_tournament)
                ->get()->first();
            if ($check == false) {//NGƯỜI DÙNG CHƯA DỰ ĐOÁN
                DB::insert('insert into predict_tournament (id_customer, id_tournament, team_name) values (?, ?, ?)'
                    , [$request->id_customer, $request->id_tournament, $request->team_name]);
                return back();
            } else {
                $reason = 'Bạn đã tham gia bình chọn rồi!';
                return view('user.tournament.failedRegister')->with('reason', $reason);
            }
        } else {
            return Redirect::to('/login');
        }
    }
}
