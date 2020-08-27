@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/save-admin')}}" method="GET">

                            <div class="form-group">
                                <label>Tên Admin</label>
                                <input type="text" name="admin_name" class="form-control" id="admin_name"
                                       placeholder="Tên admin">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="admin_email" class="form-control" id="admin_email"
                                       placeholder="Email của admin">
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="admin_password" class="form-control" id="admin_password"
                                       placeholder="Password của admin">
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="admin_address" class="form-control" id="admin_address"
                                       placeholder="Địa chỉ admin">
                            </div>

                            <div class="form-group">
                                <label>Điện thoại</label>
                                <input type="text" name="admin_phone_number" class="form-control"
                                       id="admin_phone_number"
                                       placeholder="Số điện thoại Admin">
                            </div>

                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="text" name="admin_avatar" class="form-control" id="admin_avatar">
                            </div>

                            <div class="form-group">
                                <label>Nghề nghiệp</label>
                                <input type="text" name="admin_job" class="form-control" id="admin_job">
                            </div>

                            <label>Nhà báo/Admin</label>
                            <select name="type_of_user" class="form-control input-sm m-bot15">
                                <option value="journalist">Nhà báo</option>
                                <option selected value="admin">Admin</option>
                            </select>

                            <button type="submit" name="add_admin" class="btn btn-info">Thêm Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
