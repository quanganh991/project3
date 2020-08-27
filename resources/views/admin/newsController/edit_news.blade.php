@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa tin tức</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-news')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_news" value="{{$edit_news->id_news}}">
                            <div class="form-group">
                                <label>Tên Branch</label>
                                <?php
                                $bra = DB::table('branch_category')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_branch_category" id="id_branch_category" >
                                    @foreach($bra as $indexbra)
                                        <option
                                            <?php if($indexbra->id_branch_category ==  $edit_news->id_branch_category) echo "selected" ?>
                                            value="{{$indexbra->id_branch_category}}">{{$indexbra->name_branch}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="news_title" class="form-control" id="news_title"
                                       value="{{$edit_news->title}}">
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="news_context"
                                          id="news_context">{{$edit_news->context}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Tác giả</label>
                                <?php
                                $author = DB::table('users')
                                    ->where('id_user',$edit_news->id_journalist)
                                    ->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_author" id="id_author" >
                                    @foreach($author as $indexAuthor)
                                        <option
                                            <?php if($indexAuthor->id_user ==  $edit_news->id_journalist) echo "selected" ?>
                                            value="{{$indexAuthor->id_user}}">{{$indexAuthor->name_user}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="news_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option selected value="1">Hiển thị</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ngày đăng</label>
                                <input type="datetime-local" name="publish_date" class="form-control" id="publish_date"
                                       value="{{$edit_news->publish_date}}">
                            </div>

                            <div class="form-group">
                                <label>Thể loại</label>
                                <?php
                                $typeOfNews = DB::table('typeofnews')
                                    ->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_typeofnews" id="id_typeofnews" >
                                    @foreach($typeOfNews as $eachOfTypeOfNews)
                                        <option
                                            <?php if($eachOfTypeOfNews->id_typeofnews ==  $edit_news->id_typeofnews) echo "selected" ?>
                                            value="{{$eachOfTypeOfNews->id_typeofnews}}">{{$eachOfTypeOfNews->name_typeofnews}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lượt xem</label>
                                <input readonly type="text" name="views" class="form-control" id="views" value="{{$edit_news->views}}">
                            </div>

                            <div class="form-group">
                                <label>Đa phương tiện</label>
                                <textarea type="text" name="multimedia" class="form-control" id="multimedia">{{$edit_news->multimedia}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Mô tả đa phương tiện</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="describ_multimedia"
                                          id="describ_multimedia">{{$edit_news->describ_multimedia}}</textarea>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa news</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
