@extends('admin.home')
@section('all_news')
    @if($edit_tournament->tournament_or_event == 'tournament')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa giải đấu</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-tournament')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_tournament" value="{{$edit_tournament->id_tournament}}">

                            <div class="form-group">
                                <label>Tên giải đấu</label>
                                <input type="text" name="name_tournament" class="form-control" id="name_tournament"
                                       value="{{$edit_tournament->name_tournament}}">
                            </div>

                            <div class="form-group">
                                <label>Tin tức của giải đấu</label>
                                <?php
                                $news = DB::table('news')
                                    ->where('id_typeofnews',7)
                                    ->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_news" id="id_news" >
                                    @foreach($news as $indexnews)
                                        <option
                                            <?php if($indexnews->id_news ==  $edit_tournament->id_news) echo "selected" ?>
                                            value="{{$indexnews->id_news}}">{{$indexnews->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Bắt đầu</label>
                                <input style="resize: none" class="form-control" name="start_time" type="datetime-local"
                                          id="start_time" value="{{$edit_tournament->start_time}}">
                            </div>

                            <div class="form-group">
                                <label>Kết thúc</label>
                                <input style="resize: none" class="form-control" name="finish_time" type="datetime-local"
                                       id="finish_time" value="{{$edit_tournament->finish_time}}">
                            </div>

                            <div class="form-group">
                                <label>Mùa giải</label>
                                <input style="resize: none" class="form-control" name="season" type="text"
                                       id="season" value="{{$edit_tournament->season}}">
                            </div>

                            <div class="form-group">
                                <label>Đội 1</label>
                                <input style="resize: none" class="form-control" name="team1" type="text"
                                       id="team1" value="{{$edit_tournament->team1}}">
                            </div>

                            <div class="form-group">
                                <label>Đội 2</label>
                                <input style="resize: none" class="form-control" name="team2" type="text"
                                       id="team2" value="{{$edit_tournament->team2}}">
                            </div>

                            <div class="form-group">
                                <label>Kết quả đội 1</label>
                                <input style="resize: none" class="form-control" name="result_team1" type="number"
                                       id="result_team1" value="{{$edit_tournament->result_team1}}">
                            </div>

                            <div class="form-group">
                                <label>Kết quả đội 2</label>
                                <input style="resize: none" class="form-control" name="result_team2" type="number"
                                       id="result_team2" value="{{$edit_tournament->result_team2}}">
                            </div>

                            <div class="form-group">
                                <label>Nơi diễn ra trận đấu</label>
                                <input style="resize: none" class="form-control" name="location" type="text"
                                       id="location" value="{{$edit_tournament->location}}">
                            </div>

                            <div class="form-group">
                                <label>Ban tổ chức trận đấu</label>
                                <input style="resize: none" class="form-control" name="organizer" type="text"
                                       id="organizer" value="{{$edit_tournament->organizer}}">
                            </div>

                            <div class="form-group">
                                <label>Thông tin ban tổ chức</label>
                                <textarea style="resize: none" class="form-control" name="info_organizer"
                                          id="info_organizer" >{{$edit_tournament->info_organizer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Số lượng đăng ký</label>
                                <input style="resize: none" class="form-control" name="audience_quantity" type="number" readonly
                                       id="audience_quantity" value="{{$edit_tournament->audience_quantity}}">
                            </div>

                            <div class="form-group">
                                <label>Số lượng khán giả tối đa</label>
                                <input style="resize: none" class="form-control" name="max_participants" type="number"
                                       id="max_participants" value="{{$edit_tournament->max_participants}}">
                            </div>

                            <div class="form-group">
                                <label>Loại</label>
                                <input style="resize: none" class="form-control" name="tournament_or_event" type="text" readonly
                                       id="tournament_or_event" value="{{$edit_tournament->tournament_or_event}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa giải đấu</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    @elseif($edit_tournament->tournament_or_event == 'event')
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sửa sự kiện</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{URL::to('/submit-edit-tournament')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_tournament" value="{{$edit_tournament->id_tournament}}">

                                <div class="form-group">
                                    <label>Tên sự kiện</label>
                                    <input type="text" name="name_tournament" class="form-control" id="name_tournament"
                                           value="{{$edit_tournament->name_tournament}}">
                                </div>

                                <div class="form-group">
                                    <label>Tin tức của sự kiện</label>
                                    <?php
                                    $news = DB::table('news')
                                        ->where('id_typeofnews',7)  //lấy tất cả các tin tức kiểu sự kiện/ giải đấu
                                        ->get();
                                    ?>
                                    <select  class="form-control input-sm m-bot15" name="id_news" id="id_news" >
                                        @foreach($news as $indexnews)
                                            <option
                                                <?php if($indexnews->id_news ==  $edit_tournament->id_news) echo "selected" ?>
                                                value="{{$indexnews->id_news}}">{{$indexnews->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Bắt đầu</label>
                                    <input style="resize: none" class="form-control" name="start_time" type="datetime-local"
                                           id="start_time" value="{{$edit_tournament->start_time}}">
                                </div>

                                <div class="form-group">
                                    <label>Kết thúc</label>
                                    <input style="resize: none" class="form-control" name="finish_time" type="datetime-local"
                                           id="finish_time" value="{{$edit_tournament->finish_time}}">
                                </div>

                                <div class="form-group">
                                    <label>Nơi diễn ra sự kiện</label>
                                    <input style="resize: none" class="form-control" name="location" type="text"
                                           id="location" value="{{$edit_tournament->location}}">
                                </div>

                                <div class="form-group">
                                    <label>Ban tổ chức sự kiện</label>
                                    <input style="resize: none" class="form-control" name="organizer" type="text"
                                           id="organizer" value="{{$edit_tournament->organizer}}">
                                </div>

                                <div class="form-group">
                                    <label>Thông tin ban tổ chức</label>
                                    <textarea style="resize: none" class="form-control" name="info_organizer"
                                              id="info_organizer" >{{$edit_tournament->info_organizer}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Số lượng đăng ký</label>
                                    <input style="resize: none" class="form-control" name="audience_quantity" type="number" readonly
                                           id="audience_quantity" value="{{$edit_tournament->audience_quantity}}">
                                </div>

                                <div class="form-group">
                                    <label>Số lượng khán giả tối đa</label>
                                    <input style="resize: none" class="form-control" name="max_participants" type="number"
                                           id="max_participants" value="{{$edit_tournament->max_participants}}">
                                </div>

                                <div class="form-group">
                                    <label>Quán quân</label>
                                    <?php
                                    $participant = DB::table('participant') //lấy danh sách người tham gia giải đấu/sự kiện này, chọn ra người vô địch
                                        ->join('users','participant.id_customer','=','users.id_user')
                                        ->where('id_tournament',$edit_tournament->id_tournament)
                                        ->get();
                                    ?>
                                    <select  class="form-control input-sm m-bot15" name="id_champion" id="id_champion" >
                                        @foreach($participant as $eachOfParticipant)
                                            <option
                                                <?php
                                                if($eachOfParticipant->id_customer ==  $edit_tournament->id_champion) echo "selected" ?>
                                                value="{{$eachOfParticipant->id_customer}}">{{$eachOfParticipant->name_user}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Á quân</label>
                                    <?php
                                    $participant = DB::table('participant') //lấy danh sách người tham gia, chọn ra người vô địch
                                    ->join('users','participant.id_customer','=','users.id_user')
                                        ->where('id_tournament',$edit_tournament->id_tournament)
                                        ->get();
                                    ?>
                                    <select  class="form-control input-sm m-bot15" name="id_runner_up" id="id_runner_up" >
                                        @foreach($participant as $eachOfParticipant)
                                            <option
                                                <?php
                                                if($eachOfParticipant->id_customer ==  $edit_tournament->id_runner_up) echo "selected" ?>
                                                value="{{$eachOfParticipant->id_customer}}">{{$eachOfParticipant->name_user}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Loại</label>
                                    <input style="resize: none" class="form-control" name="tournament_or_event" type="text" readonly
                                           id="tournament_or_event" value="{{$edit_tournament->tournament_or_event}}">
                                </div>

                                <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa sự kiện</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
