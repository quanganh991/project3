@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/alter-admin-information')}}" method="GET">
                            <input type="hidden" value="{{$adminInformation->id_user}}" name="id">
                            <label>Họ và tên:</label>
                            <div class="form-group"><input type="text" name="name" placeholder="Họ và tên"
                                                           value="{{$adminInformation->name_user}}"></div>
                            <label>Avatar:</label>
                            <div class="form-group"><input type="text" name="avatar" id="avatar"
                                                           value="{{$adminInformation->avatar}}"></div>
                            <label>Email</label>
                            <div class="form-group"><input type="text" name="email" placeholder="Email"
                                                           value="{{$adminInformation->email}}"></div>

                            <label>Địa chỉ</label>
                            <div class="form-group"><input type="text" name="address" placeholder="Địa chỉ"
                                                           value="{{$adminInformation->address}}"></div>

                            <label>Mật khẩu</label>
                            <div class="form-group"><input type="text" name="password" placeholder="Mật khẩu"
                                                           value="{{$adminInformation->password}}"></div>

                            <label>Điện thoại</label>
                            <div class="form-group"><input type="text" name="phone_number" placeholder="Điện thoại"
                                                           value="{{$adminInformation->phone_number}}"></div>

                            <label>Nghề nghiệp</label>
                            <div class="form-group"><input type="text" name="job" placeholder="Nghề nghiệp"
                                                           value="{{$adminInformation->job}}"></div>
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
        </div>
    </section>
@endsection
