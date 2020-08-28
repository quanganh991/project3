@extends('user.tournament.header_footer')
@section('detail_tournament')
    <!-- Hero Section Begin -->
    <?php
    $newsOfDetailTournament = DB::table('news')
        ->where('id_news',$tournament->id_news)
        ->get()->first();
    ?>
    <section class="hero-section set-bg" data-setbg="<?php echo (explode("***<paragraph/>***", nl2br($newsOfDetailTournament->multimedia)))[0] ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text">
                        <span>{{$tournament->start_time}},{{$tournament->location}}</span>
                        <h2>
                            {{$tournament->name_tournament}}
                            <br>
                            <span>Đã có </span>{{$tournament->audience_quantity}}/{{$tournament->max_participants}}
                            <span>người đăng ký</span>
                        </h2>
                        <br><br><br>
                        <a href="{{URL::to('/register-for-tournament-'.$tournament->id_tournament)}}" class="primary-btn">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Counter Section Begin -->
    <section class="counter-section bg-gradient">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="counter-text">
                        <span>Thời gian:<br> {{$tournament->start_time}} -> {{$tournament->finish_time}}</span>
                        <h3>Chỉ còn:</h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cd-timer" id="countdown">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <img src="<?php echo (explode("***<paragraph/>***", nl2br($newsOfDetailTournament->multimedia)))[0] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ha-text">
                        <h2>{{$tournament->name_tournament}}</h2>
                        <p>{{$tournament->info_organizer}}</p>
                        <ul>
                            <li><span class="icon_check"></span>Địa điểm: {{$tournament->location}}</li>
                            <li><span class="icon_check"></span>Ban tổ chức: {{$tournament->organizer}}</li>
                            <li><span class="icon_check"></span>Số lượng giới hạn: {{$tournament->max_participants}}</li>
                            <li><span class="icon_check"></span>Thời gian: {{date('i',strtotime($tournament->start_time)) - date('i',strtotime($tournament->finish_time))}} phút</li>
                        </ul>
                        <a href="{{URL::to('/register-for-tournament-'.$tournament->id_tournament)}}" class="ha-btn">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home About Section End -->

    <!-- Team Member Section Begin -->
    <section class="team-member-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Đã có {{$tournament->audience_quantity}} người đăng ký tham gia</h2>
                        <p>Bạn còn chần chừ gì nữa, đăng ký ngay thôi</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach($participant as $key => $eachParticipant)
            <?php
            $people = DB::table('users')
                ->where('id_user', $eachParticipant->id_customer)
                ->get()
                ->first();
            ?>
            <div class="member-item set-bg" data-setbg="{{$people->avatar}}">
                <div class="mi-social">
                    <div class="mi-social-inner bg-gradient">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="mi-text">

                    <h5>{{$people->name_user}}</h5>
                    <span>{{$people->job}}</span>
                </div>
            </div>
        @endforeach
    </section>
    <!-- Team Member Section End -->

    <!-- Schedule Section Begin -->
    <section class="schedule-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Xem các sự kiện/ giải đấu của cùng ban tổ chức</h2>
                        <p>{{$tournament->organizer}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="schedule-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            $dateSimilarTournament = DB::table('tournament') //lấy tất cả các ngày của các sự kiện cùng ban tổ chức
//                            ->select('start_time')
                            ->select(DB::raw('date(start_time) as start_time'))
                                ->where('organizer', $tournament->organizer)   //Cùng ban tổ chức
                                ->orderBy('start_time', 'ASC')   //sắp xếp từ cũ đến mới
                                ->distinct()
                                ->get();
                            ?>
                            @foreach($dateSimilarTournament as $key => $eachDateSimilarTournament)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{$key}}" role="tab">
                                        <h5>Ngày {{$key+1}}</h5>
                                        <p>{{$eachDateSimilarTournament->start_time}}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul><!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($dateSimilarTournament as $key => $eachDateSimilarTournament)
                                <?php
                                $similarTournament = DB::table('tournament')
                                    ->where('organizer', $tournament->organizer)   //Cùng ban tổ chức
                                    ->whereDate('start_time', $eachDateSimilarTournament->start_time)   //chỉ lấy ngày
                                    ->orderBy('start_time', 'ASC')   //sắp xếp từ cũ đến mới
                                    ->get();
                                ?>
                                <div class="tab-pane active" id="tabs-{{$key}}" role="tabpanel">
                                    @foreach($similarTournament as $eachSimilarTournament)
                                        <?php
                                        $news = DB::table('news')
                                            ->where('id_news',$eachSimilarTournament->id_news)
                                            ->get()->first();
                                        ?>
                                        <div class="st-content">

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="sc-pic">
                                                            <img src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="sc-text">
                                                            <h4>{{$eachSimilarTournament->name_tournament}}</h4>
                                                            <ul>
                                                                <li>
                                                                    <i class="fa fa-user"></i>{{$eachSimilarTournament->organizer}}
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-envelope"></i> {{$eachSimilarTournament->organizer}}
                                                                    @gmail.com
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul class="sc-widget">
                                                            <li>
                                                                <i class="fa fa-clock-o"></i>{{$eachSimilarTournament->start_time}}
                                                                -> {{$eachSimilarTournament->start_time}}</li>
                                                            <li>
                                                                <i class="fa fa-map-marker"></i>{{$eachSimilarTournament->location}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Section End -->

    @if($tournament->tournament_or_event == 'tournament')
        <?php
        $news = DB::table('news')
            ->where('id_news',$tournament->id_news)
            ->get()->first();
        ?>
    <!-- Pricing Section Begin -->
    <section class="pricing-section set-bg spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Tỉ số trận đấu</h2>
                        <p>{{$tournament->team1}} <span>vs</span> {{$tournament->team2}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="price-item">
                        <h4>Đội 1</h4>
                        <div class="pi-price">
                            <h2>{{$tournament->result_team1}}</h2>
                        </div>
                        <ul>
                            Tên đội: <li>{{$tournament->team1}}</li>
                            <?php
                            $won = DB::table('tournament')
                                ->where('team1',$tournament->team1)
                                ->where('result_team1','>','result_team2')
                                ->count();
                            $lost = DB::table('tournament')
                                ->where('team1',$tournament->team1)
                                ->where('result_team1','<','result_team2')
                                ->count();
                            $draw = DB::table('tournament')
                                ->where('team1',$tournament->team1)
                                ->where('result_team1','=','result_team2')
                                ->count();
                            ?>
                            Số trận thắng: <li>{{$won}}</li>
                            Số trận thua: <li>{{$lost}}</li>
                            Số trận hòa: <li>{{$draw}}</li>

                        </ul>
                        <a href="{{URL::to('/all-tournament-by-team-'.$tournament->team1)}}" class="price-btn">Trận đấu của đội {{$tournament->team1}}<span class="arrow_right"></span></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="price-item top-rated">
                        <div class="tr-tag">
                            <i class="fa fa-star"></i>
                        </div>
                        <h4>Trận đấu</h4>
                        <div class="pi-price">
                            <h2>{{$tournament->name_tournament}}</h2>
                        </div>
                        <ul>
                            Bắt đầu: <li>{{$tournament->start_time}}</li>
                            Kết thúc: <li>{{$tournament->finish_time}}</li>
                            Mùa giải: <li>{{$tournament->season}}</li>
                            Diễn ra tại: <li>{{$tournament->location}}</li>
                            Đơn vị tổ chức: <li>{{$tournament->organizer}}</li>
                        </ul>
                        <a href="{{URL::to('/comming-soon-tournament')}}" class="price-btn">Tất cả các trận đấu<span class="arrow_right"></span></a>

                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="price-item">
                        <h4>Đội 2</h4>
                        <div class="pi-price">
                            <h2>{{$tournament->result_team2}}</h2>
                        </div>
                        <ul>
                            Tên đội: <li>{{$tournament->team2}}</li>
                            <?php
                            $won = DB::table('tournament')
                                ->where('team2',$tournament->team2)
                                ->where('result_team2','>','result_team1')
                                ->count();
                            $lost = DB::table('tournament')
                                ->where('team2',$tournament->team2)
                                ->where('result_team2','<','result_team1')
                                ->count();
                            $draw = DB::table('tournament')
                                ->where('team2',$tournament->team2)
                                ->where('result_team2','=','result_team1')
                                ->count();
                            ?>
                            Số trận thắng: <li>{{$won}}</li>
                            Số trận thua: <li>{{$lost}}</li>
                            Số trận hòa: <li>{{$draw}}</li>
                        </ul>
                        <a href="{{URL::to('/all-tournament-by-team-'.$tournament->team2)}}" class="price-btn">Trận đấu của đội {{$tournament->team2}}<span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Pricing Section End -->
    @if(Session::get('id_customer'))
    <!-- Newslatter Section Begin -->
    <section class="newslatter-section about-newslatter">
        <div class="container">
            <div class="newslatter-inner set-bg" data-setbg="public/tournament/manup/img/newslatter-bg.jpg">
                <div class="ni-text">
                    <?php
                    $me = DB::table('users')
                    ->where('id_user', Session::get('id_customer'))
                    ->get()->first();
                    ?>
                    <h3>Theo {{$me->name_user}}, đội nào sẽ giành chiến thắng</h3>
                    <p>3 người trả lời đúng và nhanh nhất sẽ nhận được những phần quà giá trị hấp dẫn</p>
                </div>
                <form action="{{URL::to('/predict-tournament')}}" method="get" class="ni-form">
                    <input id="team_name" name="team_name" type="hidden" value="{{$tournament->team1}}">
                    <input id="id_customer" name="id_customer" type="hidden" value="{{Session::get('id_customer')}}">
                    <input id="id_tournament" name="id_tournament" type="hidden" value="{{$tournament->id_tournament}}">
                    <button style="color: blue">{{$tournament->team1}}</button>
                </form>
                <form action="{{URL::to('/predict-tournament')}}" method="get" class="ni-form">
                    <input id="team_name" name="team_name" type="hidden" value="{{$tournament->team2}}">
                    <input id="id_customer" name="id_customer" type="hidden" value="{{Session::get('id_customer')}}">
                    <input id="id_tournament" name="id_tournament" type="hidden" value="{{$tournament->id_tournament}}">
                    <button style="color: green">{{$tournament->team2}}</button>
                </form>
            </div>
        </div>
    </section>
    <br><br>
    <!-- Newslatter Section End -->
    @endif
    <!-- latest BLog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sự kiện mới nhất</h2>
                        <p>Đừng bỏ lỡ</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($newestTournament as $eachOfNewestTournament)
                <div class="col-lg-6">
                    <?php
                    $news = DB::table('news')
                        ->where('id_news',$eachOfNewestTournament->id_news)
                        ->get()
                        ->first();
                    ?>
                    <div class="latest-item set-bg"
                         data-setbg="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>">
                        <div class="li-tag">{{$news->title}}</div>
                        <div class="li-text">

                            <h5><a href="{{URL::to('/detail-tournament-'.$eachOfNewestTournament->id_tournament)}}">{{$eachOfNewestTournament->name_tournament}}</a></h5>
                            <span><i class="fa fa-clock-o"></i>{{$eachOfNewestTournament->start_time}}</span>
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- latest BLog Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Liên hệ</h2>
                        <?php
                        $news = DB::table('news')
                            ->where('id_news', $tournament->id_news)
                            ->get()->first();
                        $author = DB::table('users')
                            ->where('id_user', $news->id_journalist)
                            ->get()->first();
                        ?>
                        <p>Ban quản lý sự kiện: {{$author->name_user}}</p>
                    </div>
                    <div class="cs-text">
                        <div class="ct-address">
                            <span>Địa chỉ:</span>
                            <p>{{$tournament->location}}</p>
                        </div>
                        <ul>
                            <li>
                                <span>Ban tổ chức:</span>
                                {{$tournament->organizer}}
                            </li>
                            <li>
                                <span>Email:</span>
                                {{$tournament->organizer}}@gmail.com
                            </li>
                        </ul>
                        <div class="ct-links">
                            <span>Xem chi tiết:</span>
                            <?php
                            $news = DB::table('news')
                                ->where('id_news', $tournament->id_news)
                                ->get()
                                ->first();
                            ?>
                            <p><a href="{{URL::to('/news-detail-'.$tournament->id_news)}}">{{$news->title}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cs-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6963246222786!2d105.84315191476291!3d21.004806686011335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76ccab6dd7%3A0x55e92a5b07a97d03!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1597295618155!5m2!1svi!2s"
                            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
