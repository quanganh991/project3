<!DOCTYPE html>
<html lang="vi">
<head>
    <title>NewsExpress</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="public/assets/js/html5shiv.min.js"></script>
    <script src="public/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <header id="header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="header_top">
                    <div class="header_top_left">
                        <ul class="top_nav">
                            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            @if(Session::get('id_user'))
                                <li>
                                    <a
                                        <?php
                                        $allUserNotification = DB::table('notification')    //lấy hết noti ra
                                        ->join('users','notification.id_customer','=','users.id_user')
                                            ->where('users.id_user', Session::get('id_user'))
                                            ->where('notification.isread_noti','not seen')
                                            ->orderBy('notification.date_noti','DESC')
                                            ->get();
                                        $cnt = count($allUserNotification); //số lượng thông báo mới
                                        if($cnt) {
                                            echo 'style="color: red"';
                                        }
                                        ?>
                                        href="{{URL::to('/user-view-notification')}}">
                                        Thông báo ({{$cnt}})
                                    </a>
                                </li>
                            @endif
                            @if(!Session::get('id_user'))
                                <li><a href="{{URL::to('/login')}}">Đăng nhập</a></li>
                                <li><a href="{{URL::to('/signup')}}">Đăng ký</a></li>
                            @elseif(Session::get('id_customer'))
                                <?php
                                $nameCustomer = DB::table('users')
                                    ->where('type_of_user', 'customer')
                                    ->where('id_user', Session::get('id_customer'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: green">
                                        Xin chào: {{$nameCustomer->name_user}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-user-information')}}">Thông
                                            tin cá nhân</a>
                                        <a class="dropdown-item" href="{{URL::to('/view-all-user-bookmark')}}">Bài viết
                                            đã lưu</a>
                                        <a class="dropdown-item" href="{{URL::to('/view-all-user-comment')}}">Danh mục
                                            bình luận</a>
                                        <a class="dropdown-item" href="{{URL::to('/user-control-goc-nhin')}}">Góc nhìn
                                            của bạn</a>
                                        <a class="dropdown-item" href="{{URL::to('/user-control-tournament')}}">Giải đấu
                                            bạn đã tham gia</a>
                                        <a class="dropdown-item" href="{{URL::to('/user-control-event')}}">Sự kiện bạn
                                            đã tham gia</a>
                                    </div>
                                </li>
                            @elseif(Session::get('id_admin'))
                                <?php
                                $nameAdmin = DB::table('users')
                                    ->where('type_of_user', 'admin')
                                    ->where('id_user', Session::get('id_admin'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: red">
                                        {{$nameAdmin->name_user}} - Admin
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-admin-information')}}">Thông
                                            tin cá nhân</a>
                                        <a class="dropdown-item" href="{{URL::to('/home-admin')}}">Về trang admin</a>
                                    </div>
                                </li>
                            @elseif(Session::get('id_journalist'))
                                <?php
                                $nameJourlalist = DB::table('users')
                                    ->where('type_of_user', 'journalist')
                                    ->where('id_user', Session::get('id_journalist'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: red">
                                        {{$nameJourlalist->name_user}} - Nhà báo
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-journalist-information')}}">Thông
                                            tin cá
                                            nhân</a>
                                        <a class="dropdown-item" href="{{URL::to('/home-journalist')}}">Về trang nhà báo</a>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <form method="GET" action="{{URL::to('/search-news')}}">
                                    <input required size="10" type="text" name="keyword" id="keyword"
                                           placeholder="Tìm kiếm tin tức"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="header_top_right">
                        <p>{{date('D, d-m-Y')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="header_bottom">
                    <div class="logo_area">
                        <a href="{{URL::to('/')}}" class="logo">
                            <img src="public/images/newsexpress.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="navArea">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav main_nav">
                    <li class="active"><a href="{{URL::to('/')}}"><span class="fa fa-home desktop-home"></span><span
                                class="mobile-show">Trang chủ</span></a></li>
                    <?php
                    $main = DB::table('main_category')->get();
                    ?>
                    @foreach($main as $key => $eachOfMain)
                        @if($eachOfMain->name_main != 'Góc nhìn')
                            <li class="dropdown"><a href="{{URL::to('/branch-result-'.$eachOfMain->id_main_category)}}"
                                                    class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">{{$eachOfMain->name_main}}</a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    $branch = DB::table('branch_category')->where('id_main_category', $eachOfMain->id_main_category)->get();
                                    ?>
                                    @foreach($branch as $eachOfBranch)
                                        <li>
                                            <a href="{{URL::to('/news-result-'.$eachOfBranch->id_branch_category)}}">{{$eachOfBranch->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="dropdown"><a href="{{URL::to('/all-goc-nhin')}}"
                                                    class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                    aria-expanded="false">Góc nhìn</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{URL::to('/all-goc-nhin')}}">Góc nhìn</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </nav>
    </section>
    <section id="newsSection">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="latest_newsarea"><span>Tin mới nhất</span>
                    <ul id="ticker01" class="news_sticker">
                        <?php
                        $latest_news = DB::table('news')->orderBy('latest_update', 'DESC')->take(10)->get();
                        ?>
                        @foreach($latest_news as $each_latest_news)
                            <li><a href="{{URL::to('/news-detail-'.$each_latest_news->id_news)}}">
                                    <img
                                        src="<?php echo (explode("***<paragraph/>***", nl2br($each_latest_news->multimedia)))[0] ?>"
                                        alt="">
                                    {{$each_latest_news->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="social_area">
                        <ul class="social_nav">
                            <li class="facebook"><a href="https://www.facebook.com/"></a></li>
                            <li class="twitter"><a href="https://twitter.com/?lang=vi"></a></li>
                            <li class="flickr"><a href="https://www.flickr.com/"></a></li>
                            <li class="pinterest"><a href="https://www.pinterest.com/"></a></li>
                            <li class="googleplus"><a href="https://plus.google.com/"></a></li>
                            <li class="vimeo"><a href="https://vimeo.com/"></a></li>
                            <li class="youtube"><a href="https://www.youtube.com/"></a></li>
                            <li class="mail"><a href="https://mail.google.com/mail/u/0/#inbox"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('home')
    @yield('news_detail')
    @yield('branch_list')
    @yield('news_list')
    @yield('login')
    @yield('signup')
    @yield('userInformation')
    @yield('viewAllBookmark')
    @yield('viewAllComment')
    @yield('check_multiple_choice')
    <footer id="footer">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_widget wow fadeInDown">
                        <h2>Tìm kiếm</h2>
                        <ul class="tag_nav">
                            <li>
                                <form method="GET" action="{{URL::to('/search-news')}}">
                                    <input required size="40" type="text" name="keyword" id="keyword"
                                           placeholder="Tìm kiếm tin tức"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_widget wow fadeInRightBig">
                        <h2>Liên hệ</h2>
                        <p>NewsExpress</p>
                        <address>
                            Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội ,Điện thoại: 123-326-789 Đường dây nóng: 123-546-567
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <p class="copyright">Copyright &copy; 2020 <a href="index.html">NewsExpress</a></p>
            <p class="developer">Developed By Wpfreeware</p>
        </div>
    </footer>
</div>
<script src="public/assets/js/jquery.min.js"></script>
<script src="public/assets/js/wow.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/slick.min.js"></script>
<script src="public/assets/js/jquery.li-scroller.1.0.js"></script>
<script src="public/assets/js/jquery.newsTicker.min.js"></script>
<script src="public/assets/js/jquery.fancybox.pack.js"></script>
<script src="public/assets/js/custom.js"></script>
</body>
</html>
