@extends('admin.home')
@section('commentController')
    <h1 style="color: red">Tất cả bình luận</h1>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID tin tức</th>
            <th>Branch của tin tức</th>
            <th>Tiêu đề bài viết</th>
            <th>Người bình luận</th>
            <th>Nội dung bình luận</th>
            <th>Lượt thích bình luận</th>
            <th>Ẩn/Hiển thị bình luận</th>
            <th>Khóa/Mở tài khoản</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allUserComment as $eachUserComment)
            <?php
            $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachUserComment->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
            $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
            ?>
            <tr>
                <td>{{ $eachUserComment->id_news }}</td>
                <td>
                    <a style="color: darkorange"
                       href="{{URL::to('/news-result-'.$branchCategoryOnly->id_branch_category) }}">
                        {{$branchCategoryOnly->name_branch}}
                    </a>
                </td>
                <td  style="text-align: center">
                    <?php
                    $eachNews = DB::table('news')
                    ->where('id_news',$eachUserComment->id_news)
                    ->get()->first();
                    ?>
                    <a style="color: rebeccapurple" href="{{URL::to('/news-detail-'.$eachUserComment->id_news) }}">
                        <img height="100px" width="100px"
                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachNews->multimedia)))[0] ?>"
                             alt=""><br>
                        {{ $eachNews->title }}
                    </a>
                </td>
                <td style="text-align: center">
                    <?php
                    $writer = DB::table('users')
                    ->where('id_user',$eachUserComment->id_customer)->get()->first();
                    ?>
                        <img height="80px" width="80px"
                             src="<?php echo (explode("***<paragraph/>***", nl2br($writer->avatar)))[0] ?>"
                             alt="">
                    {{$writer->name_user}}
                </td>
                <td>
                    <a href="{{URL::to('/news-detail-'.$eachUserComment->id_news) }}">
                        {{strlen($eachUserComment->context_coment) > 50 ? substr($eachUserComment->context_coment,0,45).'...' : $eachUserComment->context_coment}}
                    </a>
                </td>
                <td>{{ $eachUserComment->likes_coment }}</td>
                <td>
                    @if($eachUserComment->isvalid == 1)
                    <p style="color: green">Bình luận hiển thị</p>
                    <a style="color: #e63084" href="{{URL::to('/delete-comment/'.$eachUserComment->id_coment)}}">Ẩn bình luận</a>
                    @else   <!--($eachUserComment->isvalid == 0)-->
                    <p style="color: red">Bình luận đã bị xóa</p>
                    @endif
                </td>
                <td>
                    <?php
                    $writer = DB::table('users')
                        ->where('id_user',$eachUserComment->id_customer)
                        ->get()
                        ->first();
                    if($writer->status_user == 0){ //bị block
                    ?>
                    <p style="color: red">Bị Khóa</p>
                    <a href="{{URL::to('/unblock-user/'.$writer->id_user)}}">Mở Khóa tài khoản</a>
                    <?php
                    }else{ //if($writer->status_user == 1){ // active
                    ?>
                    <p style="color: green">Đang hoạt động</p>
                    <a href="{{URL::to('/block-user/'.$writer->id_user)}}">Khóa tài khoản</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <h1 style="color: red">Tất cả phản hồi</h1>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID tin tức</th>
            <th>Branch của tin tức</th>
            <th>Tiêu đề bài viết</th>
            <th>Người phản hồi</th>
            <th>Nội dung phản hồi</th>
            <th>Lượt thích phản hồi</th>
            <th>Ẩn/Hiển thị bình luận</th>
            <th>Khóa/Mở tài khoản</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allUserReply as $eachUserReply)
            <?php
            $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachUserReply->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
            $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
            $eachReply = DB::table('reply')
                ->where('id_reply',$eachUserReply->id_reply)
                ->get()->first();
            ?>
            <tr>
                <td>{{ $eachUserReply->id_news }}</td>
                <td>
                    <a style="color: darkorange"
                       href="{{URL::to('/news-result-'.$branchCategoryOnly->id_branch_category) }}">
                        {{$branchCategoryOnly->name_branch}}
                    </a>
                </td>
                <td  style="text-align: center">
                    <?php
                    $eachNews = DB::table('news')
                        ->where('id_news',$eachUserReply->id_news)
                        ->get()->first();
                    ?>
                    <a style="color: rebeccapurple" href="{{URL::to('/news-detail-'.$eachUserReply->id_news) }}">
                        <img height="100px" width="100px"
                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachNews->multimedia)))[0] ?>"
                             alt=""><br>
                        {{ $eachNews->title }}
                    </a>
                </td>
                <td style="text-align: center">
                    <?php
                    $writer = DB::table('users')
                        ->where('id_user',$eachReply->id_customer)->get()->first();
                    ?>
                    <img height="80px" width="80px"
                         src="<?php echo (explode("***<paragraph/>***", nl2br($writer->avatar)))[0] ?>"
                         alt="">
                    {{$writer->name_user}}
                </td>
                <td>
                    <a href="{{URL::to('/news-detail-'.$eachUserReply->id_news) }}">
                        {{strlen($eachUserReply->context_reply) > 50 ? substr($eachUserReply->context_reply,0,45).'...' : $eachUserReply->context_reply}}
                    </a>
                </td>
                <td>{{ $eachUserReply->likes_reply }}</td>
                <td>
                    @if($eachUserReply->isvalid_reply == 1)
                        <p style="color: green">Phản hồi hiển thị</p>
                        <a style="color: #e63084" href="{{URL::to('/delete-reply/'.$eachUserReply->id_reply)}}">Ẩn phản hồi</a>
                    @else   <!--($eachUserReply->isvalid == 0)-->
                    <p style="color: red">Phản hồi đã bị xóa</p>
                    @endif
                </td>
                <td>
                    <?php
                    $writer = DB::table('users')
                        ->where('id_user',$eachUserReply->id_customer)
                        ->get()
                        ->first();
                    if($writer->status_user == 0){ //bị block
                    ?>
                    <p style="color: red">Bị Khóa</p>
                    <a href="{{URL::to('/unblock-user/'.$writer->id_user)}}">Mở Khóa tài khoản</a>
                    <?php
                    }else{ //if($writer->status_user == 1){ // active
                    ?>
                    <p style="color: green">Đang hoạt động</p>
                    <a href="{{URL::to('/block-user/'.$writer->id_user)}}">Khóa tài khoản</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
