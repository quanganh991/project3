@extends('user.tournament.header_footer')
@section('detail_tournament')
    <div class="container">
        <div>
            Đăng ký tham gia <h1 style="text-align: center; color: red">{{$tournament->name_tournament}}</h1>
        </div>
        <div class="content">
            <form action="{{URL::to('/submit-register')}}" method="GET">
                <div class="row">
                    <div id="checkout" class="col-lg-12">
                        <div class="box border-bottom-0">

                            <input class="form-control" type="hidden" value="{{$information->id_user}}" name="id_user">
                            <input class="form-control" type="hidden" value="{{$tournament->id_tournament}}" name="id_tournament">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Email</label>
                                        <input class="form-control"  type="text" name="email"
                                               placeholder="Email" value="{{$information->email}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Tên</label>
                                        <input class="form-control"  type="text" name="name_user"
                                               placeholder="Tên" value="{{$information->name_user}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Địa chỉ</label>
                                        <input class="form-control"  type="text" name="address"
                                               placeholder="Address" value="{{$information->address}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Số điện thoại</label>
                                        <input class="form-control"  type="text" name="phone_number"
                                               placeholder="Phone" value="{{$information->phone_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Lệ phí</label>
                                        <input class="form-control" readonly type="text" name="fee" placeholder="Lệ phí"
                                               value="250,000 VNĐ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Sự kiện/Giải đấu</label>
                                        <input class="form-control" readonly type="text" name="tournament" placeholder="Giải đấu/Sự kiện"
                                               value="{{$tournament->name_tournament}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="color: orangered" for="firstname">Chú thích</label>
                                        <textarea class="form-control" type="text" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label style="color: orangered" for="firstname">Thanh toán</label><br>
                                    <input type="radio" id="techcombank" name="bank" value="techcombank">
                                    <label for="techcombank">Techcombank</label><br>
                                    <input type="radio" id="vietinbanl" name="bank" value="vietinbanl">
                                    <label for="vietinbanl">Vietinbank</label><br>
                                    <input type="radio" id="Vietcombank" name="bank" value="Vietcombank">
                                    <label for="Vietcombank">Vietcombank</label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="send_order_place" class="btn btn-primary btn-sm">Đăng ký
                                </button><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
