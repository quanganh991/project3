<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Manup Template">
    <meta name="keywords" content="Manup, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giải đấu | Sự kiện</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">


    <!-- Css Styles -->
    <link rel="stylesheet" href="public/tournament/manup/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="public/tournament/manup/css/style.css" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header-section">
    <div class="container">
        <div class="logo">
            <a href="{{URL::to('/home')}}">
                <img width="350px" height="50px" src="public/images/newsexpress.png" alt="">
            </a>
        </div>
        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li><a href="{{URL::to('/champion-list')}}">Nhà vô địch</a></li>
                    <li><a href="{{URL::to('/comming-soon-tournament')}}">Sắp diễn ra</a></li>
                    <li><a href="{{URL::to('/search-tournament-by-team')}}">Tìm kiếm trận đấu</a></li>
                </ul>
            </nav>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->
@yield('detail_tournament')
<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="partner-logo owl-carousel">
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-1.png" alt="">
                </div>
            </a>
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-2.png" alt="">
                </div>
            </a>
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-3.png" alt="">
                </div>
            </a>
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-4.png" alt="">
                </div>
            </a>
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-5.png" alt="">
                </div>
            </a>
            <a href="#" class="pl-table">
                <div class="pl-tablecell">
                    <img src="public/tournament/manup/img/partner-logo/logo-6.png" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-text">
                    <div class="ft-logo">
                        <a href="{{URL::to('/')}}" class="footer-logo"><img style="mix-blend-mode: multiply" width="350px" height="50px"  src="public/images/newsexpress.png" alt=""></a>
                    </div>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Speakers</a></li>
                        <li><a href="#">Schedule</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <div class="copyright-text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Bản quyền &copy;<script>document.write(new Date().getFullYear());</script> Trang sự kiện của <i class="fa fa-heart" aria-hidden="true"></i> <a href="{{URL::to('/')}}" target="_blank">NewsExpress</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    <div class="ft-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="public/tournament/manup/js/jquery-3.3.1.min.js"></script>
<script src="public/tournament/manup/js/bootstrap.min.js"></script>
<script src="public/tournament/manup/js/jquery.magnific-popup.min.js"></script>
<script src="public/tournament/manup/js/jquery.countdown.min.js"></script>
<script src="public/tournament/manup/js/jquery.slicknav.js"></script>
<script src="public/tournament/manup/js/owl.carousel.min.js"></script>
<script src="public/tournament/manup/js/main.js"></script>
</body>

</html>
