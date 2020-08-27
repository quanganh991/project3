@extends('user.tournament.header_footer')
@section('detail_tournament')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        @if($team_name ?? '' == null)
                        <h2>Các trận đấu của đội {{$team_name ?? ''}}</h2>
                        @else
                            <h2>Tìm kiếm</h2>
                        @endif
                            <div class="bt-option">
                            <a href="{{URL::to('/home')}}">Về NewsExpress</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                @if($allTournamentByTeam ?? '' != null)
                    @foreach($allTournamentByTeam ?? '' as $eachTournamentByTeam)
                        <div class="col-lg-6">
                            <?php
                            $news = DB::table('news')
                                ->where('id_news', $eachTournamentByTeam->id_news)
                                ->get()
                                ->first();
                            ?>
                            <div class="blog-item set-bg" data-setbg="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>">
                                <div class="bi-tag bg-gradient">{{$news->title}}</div>
                                <div class="bi-text">
                                    <h3>
                                        <a href="{{URL::to('/detail-tournament-'.$eachTournamentByTeam->id_tournament)}}">{{$eachTournamentByTeam->name_tournament}}</a>
                                    </h3>
                                    <span><i class="fa fa-clock-o"></i>{{$eachTournamentByTeam->start_time}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

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
