@extends('admin.home')
@section('all_tournament')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý sự kiện/ giải đấu</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm giải đấu mới
                        </button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm giải đấu mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/save-tournament')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="name_tournament">Tên giải đấu</label>
                                                                        <input type="text" name="name_tournament"
                                                                               class="form-control" id="name_tournament"
                                                                               placeholder="Tên giải đấu">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tournament">Tin tức của giải đấu</label>
                                                                        <?php
                                                                        $news = DB::table('news')
                                                                            ->where('id_typeofnews',7)  //lấy các tin tức giải đấu
                                                                            ->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_news"
                                                                                id="id_news">
                                                                            @foreach($news as $eachNews)
                                                                                <option
                                                                                    value="{{$eachNews->id_news}}">{{$eachNews->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Bắt đầu</label>
                                                                        <input type="datetime-local" name="start_time" id="start_time">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Kết thúc</label>
                                                                        <input type="datetime-local" name="finish_time" id="finish_time">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="season">Mùa giải</label>
                                                                        <input type="number" name="season"
                                                                               class="form-control" id="season"
                                                                               placeholder="Mùa giải">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="team1">Đội 1</label>
                                                                        <input type="text" name="team1"
                                                                               class="form-control" id="team1"
                                                                               placeholder="Đội 1">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="team2">Đội 2</label>
                                                                        <input type="text" name="team2"
                                                                               class="form-control" id="team2"
                                                                               placeholder="Đội 2">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="result_team1">Tỉ số đội 1</label>
                                                                        <input type="number" name="result_team1" readonly value="0"
                                                                               class="form-control" id="result_team1"
                                                                               placeholder="Tỉ số Đội 1">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="result_team2">Tỉ số đội 2</label>
                                                                        <input type="number" name="result_team2" readonly value="0"
                                                                               class="form-control" id="result_team2"
                                                                               placeholder="Tỉ số Đội 2">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="location">Nơi diễn ra</label>
                                                                        <input type="text" name="location"
                                                                               class="form-control" id="location"
                                                                               placeholder="Nơi diễn ra">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="organizer">Ban tổ chức giải đấu</label>
                                                                        <input type="text" name="organizer"
                                                                               class="form-control" id="organizer"
                                                                               placeholder="Ban tổ chức giải đấu">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="info_organizer">Thông tin về ban tổ chức</label>
                                                                        <textarea name="info_organizer"
                                                                               class="form-control" id="info_organizer"
                                                                                  placeholder="Ban tổ chức giải đấu"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="audience_quantity">Số lượng khán giả đã đăng ký</label>
                                                                        <input type="text" name="audience_quantity" readonly
                                                                               class="form-control" id="audience_quantity"
                                                                               value="0">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="max_participants">Số lượng khán giả tối đa</label>
                                                                        <input type="number" name="max_participants"
                                                                               class="form-control" id="max_participants"
                                                                               placeholder="Số khán giả tối đa">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tournament_or_event">Loại</label>
                                                                        <input type="text" name="tournament_or_event" readonly
                                                                               class="form-control" id="tournament_or_event" value="tournament">
                                                                    </div>

                                                                    <!-- /.card-body -->
                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_tournament"
                                                                                class="btn btn-primary">Thêm giải đấu mới
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
                        <br></br>
                        <p>Giải đấu</p>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID giải đấu</th>
                                <th>Tên giải đấu</th>
                                <th>Tin tức của giải đấu</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Mùa giải</th>
                                <th>Đội 1</th>
                                <th>Đội 2</th>
                                <th>Tỉ số</th>
                                <th>Nơi diễn ra</th>
                                <th>Ban tổ chức</th>
                                <th>Thông tin về ban tổ chức</th>
                                <th>Số khán giả</th>
                                <th>Loại</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allTournament as $eachTournament)
                                <?php
                                $news = DB::table('news')->where('id_news', $eachTournament->id_news)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachTournament->id_tournament }}</td>
                                    <td>{{ $eachTournament->name_tournament }}</td>

                                    <td   style="text-align: center">
                                        @if($news != null)
                                        <a style="color: darkorange"
                                           href="{{URL::to('/news-detail-'.$news->id_news) }}">
                                            <img height="100px" width="100px"
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>"
                                                 alt=""><br>
                                            {{$news->title}}
                                        </a>
                                            @endif
                                    </td>
                                    <td>
                                        {{ $eachTournament->start_time }}
                                    </td>
                                    <td>
                                        {{ $eachTournament->finish_time }}
                                    </td>
                                    <td style="color: green">
                                        {{ $eachTournament->season }}
                                    </td>
                                    <td style="color: #0f401b">
                                        {{ $eachTournament->team1 }}
                                    </td>
                                    <td style="color: #0f401b">
                                        {{ $eachTournament->team2 }}
                                    </td>
                                    <td>
                                        {{$eachTournament->result_team1}} - {{$eachTournament->result_team2}}
                                    </td>
                                    <td>{{ $eachTournament->location }}</td>
                                    <td>{{ $eachTournament->organizer }}</td>
                                    <td style="color: #0f401b">
                                        {{ $eachTournament->info_organizer }}
                                    </td>
                                    <td>{{ $eachTournament->audience_quantity }} / {{$eachTournament->max_participants}}</td>
                                    <td>
                                        <a href="{{URL::to('/all-participant-'.$eachTournament->id_tournament)}}">Ds tham gia {{ $eachTournament->tournament_or_event }}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-tournament/'.$eachTournament->id_tournament)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br><br><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-2g">Thêm sự kiện mới
                        </button>
                        <div class="modal fade bs-example-modal-2g" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm sự kiện mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/save-tournament')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="name_tournament">Tên sự kiện</label>
                                                                        <input type="text" name="name_tournament"
                                                                               class="form-control" id="name_tournament"
                                                                               placeholder="Tên sự kiện">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tournament">Tin tức của sự kiện</label>
                                                                        <?php
                                                                        $news = DB::table('news')
                                                                            ->where('id_typeofnews',7)  //lấy các tin tức sự kiện
                                                                            ->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_news"
                                                                                id="id_news">
                                                                            @foreach($news as $eachNews)
                                                                                <option
                                                                                    value="{{$eachNews->id_news}}">{{$eachNews->title}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Bắt đầu</label>
                                                                        <input type="datetime-local" name="start_time" id="start_time">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Kết thúc</label>
                                                                        <input type="datetime-local" name="finish_time" id="finish_time">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="location">Nơi diễn ra</label>
                                                                        <input type="text" name="location"
                                                                               class="form-control" id="location"
                                                                               placeholder="Nơi diễn ra">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="organizer">Ban tổ chức sự kiện</label>
                                                                        <input type="text" name="organizer"
                                                                               class="form-control" id="organizer"
                                                                               placeholder="Ban tổ chức sự kiện">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="info_organizer">Thông tin về ban tổ chức</label>
                                                                        <textarea name="info_organizer"
                                                                                  class="form-control" id="info_organizer"
                                                                                  placeholder="Ban tổ chức sự kiện"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="audience_quantity">Số lượng khán giả đã đăng ký</label>
                                                                        <input type="text" name="audience_quantity" readonly
                                                                               class="form-control" id="audience_quantity"
                                                                               value="0">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="max_participants">Số lượng khán giả tối đa</label>
                                                                        <input type="number" name="max_participants"
                                                                               class="form-control" id="max_participants"
                                                                               placeholder="Số khán giả tối đa">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="id_champion">Quán quân</label>
                                                                        <input type="text" name="id_champion"
                                                                               class="form-control" id="id_champion">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="id_runner_up">Á quân</label>
                                                                        <input type="text" name="id_runner_up"
                                                                               class="form-control" id="id_runner_up">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tournament_or_event">Loại</label>
                                                                        <input type="text" name="tournament_or_event" readonly
                                                                               class="form-control" id="tournament_or_event" value="event">
                                                                    </div>

                                                                    <!-- /.card-body -->
                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_tournament"
                                                                                class="btn btn-primary">Thêm sự kiện mới
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <p>Sự kiện</p>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID sự kiện</th>
                                <th>Tên sự kiện</th>
                                <th>Tin tức của sự kiện</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Nơi diễn ra</th>
                                <th>Ban tổ chức</th>
                                <th>Thông tin về ban tổ chức</th>
                                <th>Số khán giả</th>
                                <th>Người chiến thắng</th>
                                <th>Loại</th>
                                <th>Sửa</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allEvent as $eachEvent)
                                <?php
                                $news = DB::table('news')->where('id_news', $eachEvent->id_news)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachEvent->id_tournament }}</td>
                                    <td>{{ $eachEvent->name_tournament }}</td>

                                    <td   style="text-align: center">
                                        @if($news != null)
                                            <a style="color: darkorange"
                                               href="{{URL::to('/news-detail-'.$news->id_news) }}">
                                                <img height="100px" width="100px"
                                                     src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>"
                                                     alt=""><br>
                                                {{$news->title}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $eachEvent->start_time }}
                                    </td>
                                    <td>
                                        {{ $eachEvent->finish_time }}
                                    </td>
                                    <td>{{ $eachEvent->location }}</td>
                                    <td>{{ $eachEvent->organizer }}</td>
                                    <td style="color: #0f401b">
                                        {{ $eachEvent->info_organizer }}
                                    </td>
                                    <td>{{ $eachEvent->audience_quantity }} / {{$eachEvent->max_participants}}</td>
                                    <td>
                                        <?php
                                        $quanquan = DB::table('users')->where('id_user',$eachEvent->id_champion)->get()->first();
                                        $aquan = DB::table('users')->where('id_user',$eachEvent->id_runner_up)->get()->first();
                                        ?>
                                        @if($quanquan!=null)
                                            <p>Á quân: {{$quanquan->name_user}}</p>
                                        @endif
                                            @if($aquan!=null)
                                            <p>Quán quân: {{$aquan->name_user}}</p>
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/all-participant-'.$eachEvent->id_tournament)}}">Ds tham gia {{ $eachEvent->tournament_or_event }}</a>
                                    </td>

                                    <td>
                                        <a href="{{URL::to('/edit-tournament/'.$eachEvent->id_tournament)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
