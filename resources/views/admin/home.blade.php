<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NewsExpress | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('public/backend/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/backend/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ URL::to('/') }}" class="nav-link">Về Trang NewsExpress</a>
            </li>
        </ul>
        <div style=" margin-left:70%">
            <a href="{{URL::to('/logout')}}" class="nav-link" style="text-align: right">Đăng xuất</a>
        </div>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ URL::to('/welcome-admin') }}" class="brand-link">
            <span style="text-align: center">Trang Admin của NewsExpress</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php
                    $AD = DB::table('users')->where('id_user',Session::get('id_admin'))->get()->first();
                    ?>
                    <img src="{{$AD->avatar}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <?php
                    $nameAdmin = DB::table('users')
                        ->select('name_user')
                        ->where('id_user',Session::get('id_admin'))
                        ->get()->first();
                    ?>
                    <a href="{{ URL::to('/change-admin-information') }}" class="d-block">{{$nameAdmin->name_user}}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Quản lý
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">11</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{URL::to('/all-branch-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý Branch</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/all-main-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý Main</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/all-news')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý tin tức</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{URL::to('/add-admin')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Admin</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{URL::to('/display-user')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý người dùng</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin-view-all-user-comment')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý bình luận người dùng</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/all-multiple-choice')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý câu hỏi/khảo sát</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin-view-all-user-gocnhin')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý góc nhìn người dùng</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/view-all-session')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý phiên đăng nhập</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/all-tournament')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý sự kiện/ trận đấu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/view-all-prediction')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quản lý danh sách bình chọn</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">

        @yield('all_news')
        @yield('all_main_category')
        @yield('all_branch_category')
        @yield('commentController')
        @yield('all_multiple_choice')
        @yield('all_tournament')
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="{{URL::to('/home')}}">NewsExpress</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="{{asset('public/backend/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('public/backend/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/backend/chart.js/Chart.min.js')}}"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="{{asset('public/backend/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/backend/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('public/backend/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{asset('public/backend/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('public/backend/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('public/backend/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/adminlte.js')}}"></script>
<script src="{{asset('public/backend/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>

<script src="{{asset('public/backend/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
</body>
</html>

