@extends('welcome')
@section('login')
<div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Đăng nhập</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng Nhập</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            @if(isset($check))
                <br/>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        @if($check == false)
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong style="text-align: center">{{$alert}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="box">
                        <h2 class="text-uppercase text-center">Đăng nhập</h2>
                        <form action="{{URL::to('/login-check')}}" method="get">
                            <div class="form-group">
                                <label for="email">Tài Khoản</label>
                                <input type="text" id="email" name="email_account" class="form-control" placeholder="Tài khoản"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" id="password" name="password_account" placeholder="Password"" class="form-control"/>
                            </div>
                            <label>
								<input name="save_login" id="save_login" type="checkbox" class="checkbox">
								Lưu thông tin
							</label>
                            <div class="text-center">
                                <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i>Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
