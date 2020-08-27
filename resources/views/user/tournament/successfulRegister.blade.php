@extends('user.tournament.header_footer')
@section('detail_tournament')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 style="color: yellowgreen" class="h2">Đăng ký thành công</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Về trang chủ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="review-payment">
            <h2 style="color: red">
                <?php
                $information = DB::table('users')
                    ->where('id_user',$id_user)
                    ->get()->first();
                ?>
                Cảm ơn bạn {{$information->name_user}} đã đăng ký tham gia {{$tournament}}. Trong vòng 10 phút, nhân viên sẽ gọi điện hoặc gửi tin nhắn để xác nhận đăng ký tham gia
            </h2>
        </div>

        <h3 style="color: orange">Vui lòng kiểm tra hộp thư để nhận thông báo khi được admin phê duyệt</h3>
        <ul>
            <li style="color: #fd7605">Tên: <span style="color: #ba8b00">{{$name_user}}</span></li>
            <li style="color: #00c054">Địa chỉ: <span style="color: #ba8b00">{{$address}}</span></li>
            <li style="color: #00c054">Email:<span style="color: #ba8b00">{{$email}}</span></li>
            <li style="color: #00c054">Số điện thoại: <span style="color: #ba8b00">{{$phone_number}}</span></li>
            <li style="color: #00c054">Chú thích: <span style="color: #ba8b00">{{$note}}</span></li>
            <li style="color: #00c054">Phương thức thanh toán: <span style="color: #ba8b00">{{$fee}} bằng {{$bank}}</span></li>
        </ul>
    </div>
    <br><br>
    @endsection
