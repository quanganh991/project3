@extends('welcome')
@section('login')
    <div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Đăng Ký</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đăng Ký</li>
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
            <div class="col-lg-6">
                <div class="box">
                    <p style="color: red; font-style: oblique; font-size: 30px" class="text-uppercase">Đăng ký</p>
                    <p class="lead">Chưa có tài khoản? Đăng ký ngay</p>
                    <hr>
                    <form action="{{URL::to('/signup-check')}}" method="get">
                        <div class="form-group">
                            <label for="name-login">Tên</label>
                            <input id="name-login" name="customer_name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email-login">Email</label>
                            <input id="email-login" name="customer_email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password-login">Mật khẩu</label>
                            <input id="password-login" name="customer_password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone-login">Số điện thoại</label>
                            <input id="phone-login" name="customer_phone" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address-login">Địa chỉ</label>
                            <input id="address-login" name="customer_address" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="avatar-login">Ảnh đại diện</label>
                            <input id="avatar-login" name="customer_avatar" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="job-login">Nghề nghiệp</label>
                            <input id="job-login" name="customer_job" type="text" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <p style="color: red; font-style: oblique; font-size: 30px" class="text-uppercase">Đăng nhập</p>
                    <p class="lead">Đã có tài khoản ? Đăng nhập tại đây</p>
                    <!-- <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p> -->
                    <hr>
                    <form action="{{URL::to('/login-check')}}" method="get">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email_account" class="form-control" placeholder="Tài khoản"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" id="password" name="password_account" placeholder="Password" class="form-control"/>
                        </div>
                        <label>
								<input type="checkbox" class="checkbox">
								Nhớ thông tin
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
