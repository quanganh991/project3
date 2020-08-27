@extends('admin.home')
@section('all_tournament')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách người tham gia {{$tournament->name_tournament}}</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Tất cả người tham
                            gia {{$tournament->name_tournament}}
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
                                                                <h3 class="card-title">Tất cả người tham
                                                                    gia {{$tournament->name_tournament}}</h3>
                                                            </div>
                                                            <table id="example1"
                                                                   class="table table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>ID tham gia</th>
                                                                    <th>Tên người tham gia</th>
                                                                    <th>Tham gia vào</th>
                                                                    <th>Tin tức về giải đấu/ sự kiện</th>
                                                                    <th>Phê duyệt</th>
                                                                    <th>Ngày đăng ký</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($allParticipant as $eachParticipant)
                                                                    <tr>
                                                                        <td>{{ $eachParticipant->id_participant }}</td>
                                                                        <td>
                                                                            <?php
                                                                            $participant = DB::table('users')
                                                                                ->where('id_user', $eachParticipant->id_customer)
                                                                                ->get()->first();
                                                                            ?>
                                                                            {{$participant->name_user}}
                                                                        </td>
                                                                        <td>{{ $tournament->name_tournament }}</td>

                                                                        <td>
                                                                            <?php
                                                                            $news = DB::table('news')->where('id_news', $tournament->id_news)->get()->first();
                                                                            ?>
                                                                            @if($news != null)
                                                                                <a style="color: darkorange"
                                                                                   href="{{URL::to('/news-detail-'.$news->id_news) }}">
                                                                                    {{$news->title}}
                                                                                </a>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($eachParticipant->isapproved == 'denied')
                                                                                <p style="color:red;">Bị từ chối</p>
                                                                                @elseif($eachParticipant->isapproved == 'approved')
                                                                                <p style="color:green;">Được phê duyệt</p>
                                                                            @endif
                                                                        </td>
                                                                        <td style="color: green">
                                                                            {{ $eachParticipant->register_time }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
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
                        <p>Danh sách chờ phê duyệt</p>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID tham gia</th>
                                <th>Tên người tham gia</th>
                                <th>Tham gia vào</th>
                                <th>Tin tức về giải đấu/ sự kiện</th>
                                <th>Phê duyệt</th>
                                <th>Ngày đăng ký</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allPendingParticipant as $eachPendingParticipant)
                                <tr>
                                    <td>{{ $eachPendingParticipant->id_participant }}</td>
                                    <td>
                                        <?php
                                        $participant = DB::table('users')
                                            ->where('id_user', $eachPendingParticipant->id_customer)
                                            ->get()->first();
                                        ?>
                                        {{$participant->name_user}}
                                    </td>
                                    <td>{{ $tournament->name_tournament }}</td>

                                    <td>
                                        <?php
                                        $news = DB::table('news')->where('id_news', $tournament->id_news)->get()->first();
                                        ?>
                                        @if($news != null)
                                            <a style="color: darkorange"
                                               href="{{URL::to('/news-detail-'.$news->id_news) }}">
                                                {{$news->title}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($eachPendingParticipant->isapproved == 'approved'){
                                        <p style="color: green">Đã được phê duyệt</p>
                                        @elseif($eachPendingParticipant->isapproved == 'denied')   <!--if ($eachNews->status==0)-->
                                        <p style="color: red">Bị từ chối</p>
                                        @elseif($eachPendingParticipant->isapproved == 'pending')
                                            <p style="color: blue">Đang chờ phê duyệt</p>
                                            <a style="color:green;" href="{{URL::to('/approve-participant-'.$eachPendingParticipant->id_participant)}}">Phê
                                                duyệt</a>
                                            <a style="color: red" href="{{URL::to('/deny-participant-'.$eachPendingParticipant->id_participant)}}">Từ
                                                chối</a>
                                        @endif
                                    </td>
                                    <td style="color: green">
                                        {{ $eachPendingParticipant->register_time }}
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
