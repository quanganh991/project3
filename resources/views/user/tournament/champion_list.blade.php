@extends('user.tournament.header_footer')
@section('detail_tournament')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Quán quân và á quân</h2>
                        <div class="bt-option">
                            <a href="#">Về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Speaker Section Begin -->
    <section class="speaker-section spad">
        <div class="container">
        @foreach($allEvent as $key => $eachEvent)    <!--Duyệt từng event, ở mỗi event hiểu thị quán quân và á quân-->
        <?php
            $champion = DB::table('users')
                ->where('id_user',$eachEvent->id_champion)
                ->get()->first();
            $news = DB::table('news')
                ->where('id_news',$eachEvent->id_news)
                ->get()->first();
            $runnerUp = DB::table('users')
                ->where('id_user',$eachEvent->id_runner_up)
                ->get()->first();
        ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="speaker-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="si-pic">
                                    <img src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="si-text">
                                    <div class="si-title">
                                        <h4>Quán quân: {{$champion->name_user}}</h4>
                                        <span>Sự kiện: <a href="{{URL::to('/detail-tournament-'.$eachEvent->id_tournament)}}">{{$eachEvent->name_tournament}}</a></span>
                                    </div>
                                    <div class="si-social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <p>Xem chi tiết: <a href="{{URL::to('/news-detail-'.$news->id_news)}}">{{$news->title}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="speaker-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="si-pic">
                                    <img src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="si-text">
                                    <div class="si-title">
                                        <h4>Á quân: {{$runnerUp->name_user}}</h4>
                                            <span>Sự kiện: <a href="{{URL::to('/detail-tournament-'.$eachEvent->id_tournament)}}">{{$eachEvent->name_tournament}}</a></span>
                                    </div>
                                    <div class="si-social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <p>Xem chi tiết: <a href="{{URL::to('/news-detail-'.$news->id_news)}}">{{$news->title}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Speaker Section End -->
@endsection
