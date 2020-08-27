@extends('journalist.home')
@section('jnl_all_news')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý tin tức</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm tin tức mới
                        </button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm tin tức mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/jnl-save-news')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="branch">Branch của tin tức</label>
                                                                        <?php
                                                                        $bra = DB::table('branch_category')->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_branch_category"
                                                                                id="id_branch_category">
                                                                            @foreach($bra as $indexbra)
                                                                                <option
                                                                                    value="{{$indexbra->id_branch_category}}">{{$indexbra->name_branch}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="news_title">Tiêu đề</label>
                                                                        <input type="text" name="news_title"
                                                                               class="form-control" id="news_title"
                                                                               placeholder="Tiêu đề">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="news_context">Nội dung</label>
                                                                        <textarea type="text" class="form-control"
                                                                               name="news_context" id="news_context" placeholder="nội dung"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ngày phát hành</label>
                                                                        <input type="datetime-local" name="publish_date" id="publish_date">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Thể loại</label>
                                                                        <?php
                                                                        $typeNews = DB::table('typeofnews')
                                                                            ->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_typeofnews"
                                                                                id="id_typeofnews">
                                                                            @foreach($typeNews as $eachOfTypeNews)
                                                                                <option
                                                                                    value="{{$eachOfTypeNews->id_typeofnews}}">{{$eachOfTypeNews->name_typeofnews}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="multimedia">Đa phương tiện</label>
                                                                        <input type="text" name="multimedia"
                                                                               class="form-control" id="multimedia"
                                                                               placeholder="Các đa phương tiện ngăn cách nhau bởi ký tự @">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="describ_multimedia">Mô tả đa phương tiện</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="describ_multimedia" id="describ_multimedia" placeholder="Các mô tả đa phương tiện ngăn cách nhau bởi ký tự @"></textarea>
                                                                    </div>

                                                                    <!-- /.card-body -->
                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_news"
                                                                                class="btn btn-primary">Thêm tin tức mới
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
                        <br></br>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID tin tức</th>
                                <th>Branch của tin tức</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Tác giả</th>
                                <th>Người phê duyệt</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật gần nhất</th>
                                <th>Thể loại</th>
                                <th>Lượt xem</th>
                                <th>Đa phương tiện</th>
                                <th>Mô tả đa phương tiện</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allNews as $eachNews)
                                <?php
                                $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachNews->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
                                $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachNews->id_news }}</td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/jnl-edit-branch-category/'.$branchCategoryOnly->id_branch_category) }}">
                                            {{$branchCategoryOnly->name_branch}}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: rebeccapurple"
                                           href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">{{ $eachNews->title }}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">
                                            {{strlen($eachNews->context) > 100 ? substr($eachNews->context,0,95).'...' : $eachNews->context}}
                                        </a>
                                    </td>
                                    <td style="color: green">
                                        <?php
                                        $author = DB::table('users')
                                            ->where('id_user',$eachNews->id_journalist)
                                            ->get()->first();
                                        ?>
                                        {{ $author->name_user }}
                                    </td>
                                    <td style="color: #0f401b">
                                        <?php
                                        $approver = DB::table('users')
                                            ->where('id_user',$eachNews->id_admin)
                                            ->get()->first();
                                        ?>
                                        {{ $approver != null ? $approver->name_user : '' }}
                                    </td>
                                    <td>
                                        <?php
                                        if($eachNews->status == 1){
                                        ?>
                                        <p style="color: green">Đang hiển thị</p>
                                        <a href="{{URL::to('/jnl-unactive-news/'.$eachNews->id_news)}}">Ẩn</a>
                                        <?php
                                        }else{ //if ($eachNews->_status==0)
                                        ?>
                                        <p style="color: red">Đang bị ẩn</p>
                                        <a href="{{URL::to('/jnl-active-news/'.$eachNews->id_news)}}">Hiển thị</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachNews->publish_date }}</td>
                                    <td>{{ $eachNews->latest_update }}</td>
                                    <td style="color: #0f401b">
                                        <?php
                                        $typeOfNews = DB::table('typeofnews')
                                            ->where('id_typeofnews',$eachNews->id_typeofnews)
                                            ->get()->first();
                                        ?>
                                        {{ $typeOfNews->name_typeofnews }}
                                    </td>
                                    <td>{{ $eachNews->views }}</td>
                                    <td><a href="{{URL::to('/news-detail-'.$eachNews->id_news)}}">
                                            <img height="100px" width="100px"
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachNews->multimedia)))[0] ?>"
                                                 alt="">
                                        </a></td>
                                    <td>{{strlen($eachNews->describ_multimedia) > 50 ? substr($eachNews->describ_multimedia,0,45).'...' : $eachNews->describ_multimedia}}</td>
                                    <td>
                                        <a href="{{URL::to('/jnl-edit-news/'.$eachNews->id_news)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allNews->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
