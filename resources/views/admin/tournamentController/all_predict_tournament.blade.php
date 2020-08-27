@extends('admin.home')
@section('all_tournament')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý bình chọn</h3>
                    </div>
                    <div class="card-body">
                        <!-- end form -->
                        <br>
                        <p>Giải đấu</p>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID bình chọn</th>
                                <th>Người bình chọn</th>
                                <th>Giải đấu</th>
                                <th>Bình chọn cho đội</th>
                                <th>Thời gian bình chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allPredictionTournament as $eachPredictionTournament)
                                <?php
                                $customer = DB::table('users')->where('id_user', $eachPredictionTournament->id_customer)->get()->first();
                                $tournament = DB::table('tournament')->where('id_tournament', $eachPredictionTournament->id_tournament)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachPredictionTournament->id_predict_tournament }}</td>
                                    <td>
                                        {{ $customer->name_user }}
                                    </td>

                                    <td>
                                        <a href="{{URL::to('/detail-tournament-'.$tournament->id_tournament)}}" >{{$tournament->name_tournament}}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/all-tournament-by-team-'.$eachPredictionTournament->team_name)}}" >{{ $eachPredictionTournament->team_name }}</a>
                                    </td>
                                    <td>{{$eachPredictionTournament->predict_time}}</td>
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
