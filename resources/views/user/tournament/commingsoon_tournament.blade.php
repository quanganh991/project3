@extends('user.tournament.header_footer')
@section('detail_tournament')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Tất cả sự kiện/ trận đấu</h2>
                        <div class="bt-option">
                            <a href="{{URL::to('/home')}}">Về NewsExpress</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Schedule Table Section Begin -->
    <section class="schedule-table-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="schedule-table-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#tabs-1" role="tab">Trận đấu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Sự kiện</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Xem tất cả</a>
                            </li>
                        </ul><!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane" id="tabs-1" role="tabpanel">   <!--Trận đấu-->
                                <?php
                                $dateTranDau1 = DB::table('tournament') //lấy tất cả các ngày của các trận đấu
//                                ->select('start_time')
                                    ->select(DB::raw('date(start_time) as start_time'))
                                    ->where('tournament_or_event', 'tournament')
                                    ->orderBy('start_time', 'ASC')   //sắp xếp từ cũ đến mới
                                    ->distinct()
                                    ->get();
                                ?>
                                <div class="schedule-table-content">
                                    <div   style="width: 4000px; overflow-x: scroll; overflow-y: hidden">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th></th>
                                            @for($hour = 0;$hour<=23;$hour++)
                                                <th class="event-time">{{$hour%24}}h - {{($hour+1)%24}}h</th>
                                            @endfor
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dateTranDau1 as $key => $eachDateTranDau)  <!--Duyệt tất cả các ngày có trận đấu-->
                                        <tr>
                                            <td class="event-time">{{date('d-m-Y',strtotime($eachDateTranDau->start_time))}}</td>
                                        <?php
                                        $tranDau = DB::table('tournament')  //chọn ra các trận đấu trong cùng ngày
                                            ->where('tournament_or_event', 'tournament')
                                            ->whereDate('start_time', $eachDateTranDau->start_time) //chỉ lấy ngày
                                            ->orderBy('start_time')
                                            ->get();
                                        ?>
                                        @for($hour = 0;$hour<=23;$hour++)
                                                <td class="break hover-bg">
                                            @foreach($tranDau as $eachTranDau)  <!--Duyệt tất cả các trận đấu có ngày thỏa mãn-->

                                                @if( date('H',strtotime($eachTranDau->start_time)) == ($hour%24))
                                                    <a href="{{URL::to('/detail-tournament-'.$eachTranDau->id_tournament)}}"><h5>{{$eachTranDau->name_tournament}}</h5></a>
                                                        <span>{{date('d-m-Y H:i:s',strtotime($eachTranDau->start_time))}}</span>
                                                @endif
                                            @endforeach
                                                </td>
                                        @endfor

                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-2" role="tabpanel">   <!--Sự kiện-->
                                <?php
                                $dateTranDau2 = DB::table('tournament') //lấy tất cả các ngày của các trận đấu
//                                ->select('start_time')
                                ->select(DB::raw('date(start_time) as start_time'))
                                    ->where('tournament_or_event', 'event')
                                    ->orderBy('start_time', 'ASC')   //sắp xếp từ cũ đến mới
                                    ->distinct()
                                    ->get();
                                ?>
                                <div class="schedule-table-content">
                                    <div   style="width: 4000px; overflow-x: scroll; overflow-y: hidden">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @for($hour = 0;$hour<=23;$hour++)
                                                    <th class="event-time">{{$hour%24}}h - {{($hour+1)%24}}h</th>
                                                @endfor
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dateTranDau2 as $key => $eachDateTranDau)  <!--Duyệt tất cả các ngày có trận đấu-->
                                            <tr>
                                                <td class="event-time">{{date('d-m-Y',strtotime($eachDateTranDau->start_time))}}</td>
                                                <?php
                                                $tranDau = DB::table('tournament')  //chọn ra các trận đấu trong cùng ngày
                                                ->where('tournament_or_event', 'event')
                                                    ->whereDate('start_time', $eachDateTranDau->start_time) //chỉ lấy ngày
                                                    ->orderBy('start_time')
                                                    ->get();
                                                ?>
                                                @for($hour = 0;$hour<=23;$hour++)
                                                    <td class="break hover-bg">
                                                    @foreach($tranDau as $eachTranDau)  <!--Duyệt tất cả các trận đấu có ngày thỏa mãn-->

                                                        @if( date('H',strtotime($eachTranDau->start_time)) == ($hour%24))
                                                            <a href="{{URL::to('/detail-tournament-'.$eachTranDau->id_tournament)}}"><h5>{{$eachTranDau->name_tournament}}</h5></a>
                                                            <span>{{date('d-m-Y H:i:s',strtotime($eachTranDau->start_time))}}</span>
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                @endfor

                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">   <!--Cả 2-->
                                <?php
                                $dateTranDau3 = DB::table('tournament') //lấy tất cả các ngày của các trận đấu
//                                ->select('start_time')
                                ->select(DB::raw('date(start_time) as start_time'))
                                    ->orderBy('start_time', 'ASC')   //sắp xếp từ cũ đến mới
                                    ->distinct()
                                    ->get();
                                ?>
                                <div class="schedule-table-content">
                                    <div   style="width: 4000px; overflow-x: scroll; overflow-y: hidden">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @for($hour = 0;$hour<=23;$hour++)
                                                    <th class="event-time">{{$hour%24}}h - {{($hour+1)%24}}h</th>
                                                @endfor
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dateTranDau3 as $key => $eachDateTranDau)  <!--Duyệt tất cả các ngày có trận đấu-->
                                            <tr>
                                                <td class="event-time">{{date('d-m-Y',strtotime($eachDateTranDau->start_time))}}</td>
                                                <?php
                                                $tranDau = DB::table('tournament')  //chọn ra các trận đấu trong cùng ngày
                                                    ->whereDate('start_time', $eachDateTranDau->start_time) //chỉ lấy ngày
                                                    ->orderBy('start_time')
                                                    ->get();
                                                ?>
                                                @for($hour = 0;$hour<=23;$hour++)
                                                    <td class="break hover-bg">
                                                    @foreach($tranDau as $eachTranDau)  <!--Duyệt tất cả các trận đấu có ngày thỏa mãn-->

                                                        @if( date('H',strtotime($eachTranDau->start_time)) == ($hour%24))
                                                            <a href="{{URL::to('/detail-tournament-'.$eachTranDau->id_tournament)}}"><h5>{{$eachTranDau->name_tournament}}</h5></a>
                                                            <span>{{date('d-m-Y H:i:s',strtotime($eachTranDau->start_time))}}</span>
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                @endfor

                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Table Section End -->

    <!-- Newslatter Section Begin -->
    <section class="newslatter-section about-newslatter">
        <div class="container">
            <div class="newslatter-inner set-bg" data-setbg="public/tournament/manup/img/newslatter-bg.jpg">
                <div class="ni-text">
                    <h3>Tìm kiếm trận đấu</h3>
                    <p>Nhanh, chính xác nhất</p>
                </div>
                <form action="{{URL::to('/search-tournament-by-team')}}" method="get" class="ni-form">
                    <input id="team_name" name="team_name" type="text" placeholder="Your email">
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </section>
    <br><br>
    <!-- Newslatter Section End -->
@endsection
