@extends('journalist.home')
@section('jnl_information')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/alter-journalist-information')}}" method="GET">
                            <input type="hidden" value="{{$journalistInformation->id_user}}" name="id">
                            <label>Họ và tên:</label>
                            <div class="form-group"><input type="text" name="name" placeholder="Họ và tên"
                                                           value="{{$journalistInformation->name_user}}"></div>
                            <label>Avatar:</label>
                            <div class="form-group"><input type="text" name="avatar" id="avatar"
                                                           value="{{$journalistInformation->avatar}}"></div>
                            <label>Email</label>
                            <div class="form-group"><input type="text" name="email" placeholder="Email"
                                                           value="{{$journalistInformation->email}}"></div>

                            <label>Địa chỉ</label>
                            <div class="form-group"><input type="text" name="address" placeholder="Địa chỉ"
                                                           value="{{$journalistInformation->address}}"></div>

                            <label>Mật khẩu</label>
                            <div class="form-group"><input type="text" name="password" placeholder="Mật khẩu"
                                                           value="{{$journalistInformation->password}}"></div>

                            <label>Điện thoại</label>
                            <div class="form-group"><input type="text" name="phone_number" placeholder="Điện thoại"
                                                           value="{{$journalistInformation->phone_number}}"></div>

                            <label>Nghề nghiệp</label>
                            <div class="form-group"><input type="text" name="job" placeholder="Nghề nghiệp"
                                                           value="{{$journalistInformation->job}}"></div>
                            <label>Trạng thái</label>
                            <select name="status_user" class="form-control input-sm m-bot15">
                                <option value="0">Nghỉ việc</option>
                                <option selected value="1">Đang làm việc</option>
                            </select>

                            <input type="submit" value="Xác nhận" name="send_order_place"
                                   class="btn btn-primary btn-sm">
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection
