@extends('admin.home')
@section('all_news')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý Góc nhìn người dùng</h3>
                    </div>
                    <div class="card-body">
                        <!-- end form -->
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID góc nhìn</th>
                                <th>Tác giả</th>
                                <th>Người phê duyệt</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật gần nhất</th>
                                <th>Lượt xem</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Đề tài hot</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allUserGocNhin as $eachUserGocNhin)
                                <tr>
                                    <td>{{ $eachUserGocNhin->id_gocnhin }}</td>
                                    <td  style="text-align: center">
                                        <?php
                                        $author = DB::table('users')
                                            ->where('id_user',$eachUserGocNhin->id_customer)
                                            ->get()->first();
                                        ?>
                                        <img height="80px" width="80px"
                                             src="<?php echo (explode("***<paragraph/>***", nl2br($author->avatar)))[0] ?>"
                                             alt="">
                                        <a style="color: darkorange"
                                           href="{{URL::to('/goc-nhin-tac-gia-'.$eachUserGocNhin->id_customer) }}">
                                            {{$author->name_user}}
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $approver = DB::table('users')
                                            ->where('id_user',$eachUserGocNhin->id_admin)
                                            ->get()->first();
                                        ?>
                                        {{$approver->name_user}}
                                    </td>
                                    <td>
                                        <?php
                                        if($eachUserGocNhin->status_gocnhin == 1){
                                        ?>
                                        <p style="color: green">Đang hiển thị</p>
                                        <a href="{{URL::to('/unactive-gocnhin/'.$eachUserGocNhin->id_gocnhin)}}">Ẩn</a>
                                        <?php
                                        }else{ //if ($eachUserGocNhin->_status_gocnhin==0)
                                        ?>
                                        <p style="color: red">Đang bị ẩn</p>
                                        <a href="{{URL::to('/active-gocnhin/'.$eachUserGocNhin->id_gocnhin)}}">Hiển thị</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachUserGocNhin->publish_date_gocnhin }}</td>
                                    <td>{{ $eachUserGocNhin->latest_update_gocnhin }}</td>
                                    <td>{{ $eachUserGocNhin->views_gocnhin}}</td>
                                    <td><a href="{{URL::to('/detail-goc-nhin-'.$eachUserGocNhin->id_gocnhin)}}">{{ $eachUserGocNhin->title_gocnhin}}</a></td>
                                    <td>
                                        <a href="{{URL::to('/detail-goc-nhin-'.$eachUserGocNhin->id_gocnhin)}}">
                                        {{strlen($eachUserGocNhin->context_gocnhin) > 100 ? substr($eachUserGocNhin->context_gocnhin,0,95).'...' : $eachUserGocNhin->context_gocnhin}}
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if($eachUserGocNhin->ishot_gocnhin == 1){
                                        ?>
                                        <p style="color: green">Hot</p>
                                        <a href="{{URL::to('/unmakeHot-gocnhin/'.$eachUserGocNhin->id_gocnhin)}}">Hủy hot</a>
                                        <?php
                                        }else{ //if ($eachUserGocNhin->_status_gocnhin==0)
                                        ?>
                                        <p style="color: red">Thông thường</p>
                                        <a href="{{URL::to('/makeHot-gocnhin/'.$eachUserGocNhin->id_gocnhin)}}">Đánh dấu là hot</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bài viết đang chờ</h3>
                    </div>
                    <div class="card-body">
                        <!-- end form -->
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID góc nhìn</th>
                                <th>Tác giả</th>
                                <th>Phê duyệt</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật gần nhất</th>
                                <th>Lượt xem</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Đề tài hot</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allGocNhinPending as $eachGocNhinPending)
                                <tr>
                                    <td>{{ $eachGocNhinPending->id_gocnhin }}</td>
                                    <td style="text-align: center">
                                        <?php
                                        $author = DB::table('users')
                                            ->where('id_user',$eachGocNhinPending->id_customer)
                                            ->get()->first();
                                        ?>
                                        <img height="80px" width="80px"
                                             src="<?php echo (explode("***<paragraph/>***", nl2br($author->avatar)))[0] ?>"
                                             alt="">
                                        <a style="color: darkorange"
                                           href="{{URL::to('/goc-nhin-tac-gia-'.$eachGocNhinPending->id_customer) }}">
                                            {{$author->name_user}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/approve-user-gocnhin-'.$eachGocNhinPending->id_gocnhin)}}">Phê duyệt</a>
                                    </td>
                                    <td>
                                        <?php
                                        if($eachGocNhinPending->status_gocnhin == 1){
                                        ?>
                                        <p style="color: green">Đang hiển thị</p>
                                        <a href="{{URL::to('/unactive-gocnhin/'.$eachGocNhinPending->id_gocnhin)}}">Ẩn</a>
                                        <?php
                                        }else{ //if ($eachGocNhinPending->_status_gocnhin==0)
                                        ?>
                                        <p style="color: red">Đang bị ẩn</p>
                                        <a href="{{URL::to('/active-gocnhin/'.$eachGocNhinPending->id_gocnhin)}}">Hiển thị</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachGocNhinPending->publish_date_gocnhin }}</td>
                                    <td>{{ $eachGocNhinPending->latest_update_gocnhin }}</td>
                                    <td>{{ $eachGocNhinPending->views_gocnhin}}</td>
                                    <td><a href="{{URL::to('/detail-goc-nhin-'.$eachGocNhinPending->id_gocnhin)}}">{{ $eachGocNhinPending->title_gocnhin}}</a></td>
                                    <td>
                                        <a href="{{URL::to('/detail-goc-nhin-'.$eachGocNhinPending->id_gocnhin)}}">
                                            {{strlen($eachGocNhinPending->context_gocnhin) > 100 ? substr($eachGocNhinPending->context_gocnhin,0,95).'...' : $eachGocNhinPending->context_gocnhin}}
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if($eachGocNhinPending->ishot_gocnhin == 1){
                                        ?>
                                        <p style="color: green">Hot</p>
                                        <a href="{{URL::to('/unmakeHot-gocnhin/'.$eachGocNhinPending->id_gocnhin)}}">Hủy hot</a>
                                        <?php
                                        }else{ //if ($eachGocNhinPending->_status_gocnhin==0)
                                        ?>
                                        <p style="color: red">Thông thường</p>
                                        <a href="{{URL::to('/makeHot-gocnhin/'.$eachGocNhinPending->id_gocnhin)}}">Đánh dấu là hot</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
