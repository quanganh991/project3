@extends('welcome')
@section('viewAllComment')
    <p style="color: red">Tất cả sự kiện mà {{$me->name_user}} đã đăng ký tham gia</p>
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
            <th>Nhà vô địch</th>
            <th>Trạng thái</th>
            <th>Ngày đăng ký</th>
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

                <td>
                    @if($news != null)
                        <a style="color: darkorange"
                           href="{{URL::to('/news-detail-'.$news->id_news) }}">
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
                <td>{{ $eachTournament->location }}</td>
                <td>{{ $eachTournament->organizer }}</td>
                <td style="color: #0f401b">
                    {{ $eachTournament->info_organizer }}
                </td>
                <td>{{ $eachTournament->audience_quantity }} / {{$eachTournament->max_participants}}</td>
                <td>
<?php
                                        $quanquan = DB::table('users')->where('id_user',$eachTournament->id_champion)->get()->first();
                                        $aquan = DB::table('users')->where('id_user',$eachTournament->id_runner_up)->get()->first();
                                        ?>
                                            <p>Á quân: {{$quanquan->name_user}}</p>
                                            <p>Quán quân: {{$aquan->name_user}}</p>
                </td>
                <td>
                    @if($eachTournament->isapproved == 'pending')
                        <p style="color: blue">Chờ phê duyệt</p>
                        <a style="color: red" href="{{URL::to('/cancel-participant-'.$eachTournament->id_participant)}}">Hủy tham gia</a>
                    @elseif($eachTournament->isapproved == 'denied')
                        <p style="color: red">Bị từ chối</p>
                    @elseif($eachTournament->isapproved == 'approved')
                        <p style="color: green">Đã được duyệt</p>
                    @endif
                </td>
                <td>
                    {{$eachTournament->register_time}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <p style="color: red">Tất cả sự kiện đang chờ phê duyệt của {{$me->name_user}}</p>
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
            <th>Nhà vô địch</th>
            <th>Trạng thái</th>
            <th>Ngày đăng ký</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allPendingTournament as $eachPendingTournament)
            <?php
            $news = DB::table('news')->where('id_news', $eachPendingTournament->id_news)->get()->first();
            ?>
            <tr>
                <td>{{ $eachPendingTournament->id_tournament }}</td>
                <td>{{ $eachPendingTournament->name_tournament }}</td>

                <td>
                    @if($news != null)
                        <a style="color: darkorange"
                           href="{{URL::to('/news-detail-'.$news->id_news) }}">
                            {{$news->title}}
                        </a>
                    @endif
                </td>
                <td>
                    {{ $eachPendingTournament->start_time }}
                </td>
                <td>
                    {{ $eachPendingTournament->finish_time }}
                </td>
                <td>{{ $eachPendingTournament->location }}</td>
                <td>{{ $eachPendingTournament->organizer }}</td>
                <td style="color: #0f401b">
                    {{ $eachPendingTournament->info_organizer }}
                </td>
                <td>{{ $eachPendingTournament->audience_quantity }} / {{$eachPendingTournament->max_participants}}</td>
                <td>
                                        <?php
                                        $quanquan = DB::table('users')->where('id_user',$eachPendingTournament->id_champion)->get()->first();
                                        $aquan = DB::table('users')->where('id_user',$eachPendingTournament->id_runner_up)->get()->first();
                                        ?>
                    @if($quanquan != null && $aquan != null)
                                            <p>Á quân: {{$quanquan->name_user}}</p>
                                            <p>Quán quân: {{$aquan->name_user}}</p>
                    @endif
                </td>
                <td>
                    @if($eachPendingTournament->isapproved == 'pending')
                        <p style="color: blue">Chờ phê duyệt</p>
                        <a style="color: red" href="{{URL::to('/cancel-participant-'.$eachPendingTournament->id_participant)}}">Hủy tham gia</a>
                    @elseif($eachPendingTournament->isapproved == 'denied')
                        <p style="color: red">Bị từ chối</p>
                    @elseif($eachPendingTournament->isapproved == 'approved')
                        <p style="color: green">Đã được duyệt</p>
                    @endif
                </td>
                <td>
                    {{$eachPendingTournament->register_time}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <p style="color: red">Tất cả sự kiện đã bị hủy của {{$me->name_user}}</p>
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
            <th>Nhà vô địch</th>
            <th>Trạng thái</th>
            <th>Ngày đăng ký</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allCancelledTournament as $eachCancelledTournament)
            <?php
            $news = DB::table('news')->where('id_news', $eachCancelledTournament->id_news)->get()->first();
            ?>
            <tr>
                <td>{{ $eachCancelledTournament->id_tournament }}</td>
                <td>{{ $eachCancelledTournament->name_tournament }}</td>

                <td>
                    @if($news != null)
                        <a style="color: darkorange"
                           href="{{URL::to('/news-detail-'.$news->id_news) }}">
                            {{$news->title}}
                        </a>
                    @endif
                </td>
                <td>
                    {{ $eachCancelledTournament->start_time }}
                </td>
                <td>
                    {{ $eachCancelledTournament->finish_time }}
                </td>
                <td>{{ $eachCancelledTournament->location }}</td>
                <td>{{ $eachCancelledTournament->organizer }}</td>
                <td style="color: #0f401b">
                    {{ $eachCancelledTournament->info_organizer }}
                </td>
                <td>{{ $eachCancelledTournament->audience_quantity }} / {{$eachCancelledTournament->max_participants}}</td>
                <td>
                                        <?php
                                        $quanquan = DB::table('users')->where('id_user',$eachCancelledTournament->id_champion)->get()->first();
                                        $aquan = DB::table('users')->where('id_user',$eachCancelledTournament->id_runner_up)->get()->first();
                                        ?>
                    @if($quanquan != null && $aquan != null)
                                            <p>Á quân: {{$quanquan->name_user}}</p>
                                            <p>Quán quân: {{$aquan->name_user}}</p>
                        @endif
                </td>
                <td>
                    @if($eachCancelledTournament->isapproved == 'pending')
                        <p style="color: blue">Chờ phê duyệt</p>
                        <a style="color: red" href="{{URL::to('/cancel-participant-'.$eachCancelledTournament->id_participant)}}">Hủy tham gia</a>
                    @elseif($eachCancelledTournament->isapproved == 'denied')
                        <p style="color: red">Bị từ chối</p>
                    @elseif($eachCancelledTournament->isapproved == 'approved')
                        <p style="color: green">Đã được duyệt</p>
                    @endif
                </td>
                <td>
                    {{$eachCancelledTournament->register_time}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
