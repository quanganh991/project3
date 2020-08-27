@extends('welcome')
@section('news_detail')
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_page">
                        <ol class="breadcrumb">
                            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                        </ol>
                        <h1>{{$detailGocNhin->title_gocnhin}}</h1>
                        <div class="post_commentbox"><a href="#"><i class="fa fa-user"></i>{{$author->name_user}}</a>
                            <span><i class="fa fa-calendar"></i>{{$detailGocNhin->latest_update_gocnhin}}</span>
                        </div>
                        <div class="single_page_content"><img alt="" style="border-radius: 50%"
                                                              src="{{$author->avatar}}">
                            <p style="color: red; font-style: oblique; font-size: 30px">{{$author->name_user}}</p>
                            <p style="color: #94eed3; font-style: oblique; font-size: 30px">{{$author->job}}</p>
                            <p><?php echo nl2br($detailGocNhin->context_gocnhin) ?></p>
                        </div>
                        <!--Bình luận-->
                        <h1 style="color: orangered">Bình luận:</h1>
                        <?php
                        $newsDetail = DB::table('news')
                            ->where('id_gocnhin', $detailGocNhin->id_gocnhin)
                            ->where('id_branch_category', 3)
                            ->get()
                            ->first();
                        ?>
                        @if (Session::get('id_user'))
                            <p>Bình luận về bài viết</p>
                            <form action="{{URL::to('/comment')}}" method="GET">
                                <textarea name="comment" placeholder="Bình luận" rows="6" cols="50"></textarea>
                                <input name="newsid_hidden" type="hidden" value="{{$newsDetail->id_news}}"/>
                                <input id="userid_hidden" name="userid_hidden" type="hidden"
                                       value="{{Session::get('id_user')}}"/>
                                <br>
                                <button type="submit" class="btn-template-main">Gửi bình luận</button>
                            </form>

                        @else
                            <p>Bạn phải đăng nhập để bình luận và đăng bài viết</p>
                        @endif
                        <?php
                        //hiển thị bình luận
                        $commentList = DB::table('coment')  //chứa coment của user
                        ->join('users', 'users.id_user', '=', 'coment.id_customer')
                            ->where('coment.id_news', $newsDetail->id_news)
                            ->get();
                        ?>
                        @foreach($commentList as $eachCommentList)
                            <row>
                            <?php
                            $user = DB::table('users') //chứa coment của độc giả
                            ->where('id_user', $eachCommentList->id_customer)
                                ->get()->first();
                            ?>
                            @if($user->status_user == 1)    <!--Nếu ko bị khóa tài khoản thì mới hiển thị bình luận-->
                                <hr>
                                @if($user->type_of_user != 'admin')
                                    <h4 style="color: #2b527e">{{$eachCommentList->name_user}}</h4>
                                @elseif($user->type_of_user == 'admin')
                                    <h4 style="color: red">Admin: {{$eachCommentList->name_user}}</h4>
                                @endif
                                <h5><i class="fa fa-comment"
                                       aria-hidden="true"></i> {{$eachCommentList->context_coment}}</h5>
                                @endif
                                @if(Session::get('id_admin'))
                                    <a href="{{URL::to('/delete-comment/'.$eachCommentList->id_coment)}}">Xóa
                                        comment</a>
                                    |
                                    <a href="{{URL::to('/block-user/'.$eachCommentList->id_customer)}}">Khóa tài
                                        khoản</a>
                                @endif
                            </row>
                            <li class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="color: green">
                                    Trả lời {{$eachCommentList->name_user}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <form class="dropdown-item" action="{{URL::to('/reply')}}" method="GET">
                                        <textarea name="reply" placeholder="Bình luận" rows="6" cols="50"></textarea>
                                        <input name="commentid_hidden" type="hidden"
                                               value="{{$eachCommentList->id_coment}}"/>
                                        <input id="userid_hidden" name="userid_hidden" type="hidden"
                                               value="{{Session::get('id_user')}}"/>
                                        <br>
                                        <button type="submit" class="btn-template-main">Gửi trả lời</button>
                                    </form>
                                </div>
                            </li>
                            <!--Reply-->
                            <li class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="color: green">
                                    Xem các phản hồi về bình luận
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    $reply = DB::table('reply')
                                        ->where('id_coment', $eachCommentList->id_coment)
                                        ->get();
                                    ?>
                                    @foreach($reply as $eachOfReply)
                                        <?php
                                        $userRep = DB::table('users') //chứa reply của độc giả
                                        ->where('id_user', $eachOfReply->id_customer)
                                            ->get()->first();
                                        ?>
                                        @if($userRep->status_user == 1)
                                            @if($userRep->type_of_user != 'admin')
                                                <h4 class="dropdown-item"
                                                    style="color: white">{{$userRep->name_user}}</h4>
                                            @elseif($userRep->type_of_user == 'admin')
                                                <h4 class="dropdown-item" style="color: yellow">
                                                    Admin: {{$userRep->name_user}}</h4>
                                            @endif
                                            <h5 style="color: lightsalmon" class="dropdown-item"><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i> {{$eachOfReply->context_reply}}
                                            </h5>
                                        @endif

                                        @if(Session::get('id_admin'))
                                            <a style="color: #e63084"
                                               href="{{URL::to('/delete-reply/'.$eachOfReply->id_reply)}}">Xóa
                                                comment</a>
                                            |
                                            <a style="color: #e63084"
                                               href="{{URL::to('/block-user/'.$eachCommentList->id_customer)}}">Khóa tài
                                                khoản</a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                            <!--Hết Reply-->
                            <hr>
                            <hr>
                    @endforeach
                    <!--Hết Bình luận-->
                        <div class="social_link">
                            <ul class="sociallink_nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                        <div class="related_post">
                            <h2>Bài viết liên quan<i class="fa fa-thumbs-o-up"></i></h2>
                            <ul class="spost_nav wow fadeInDown animated">
                                @foreach($relevantGocNhin as $eachOfRelevantGocNhin)
                                    <?php
                                    $authorRelevant = DB::table('users')
                                        ->where('id_user', $eachOfRelevantGocNhin->id_customer)
                                        ->get()
                                        ->first();
                                    ?>
                                    <li>
                                        <div class="media"><a class="media-left"
                                                              href="{{URL::to('/detail-goc-nhin-'.$eachOfRelevantGocNhin->id_gocnhin)}}">
                                                <img alt="" style="border-radius: 50%"
                                                     src="{{$authorRelevant->avatar}}"> </a>
                                            <div class="media-body"><a class="catg_title"
                                                                       href="{{URL::to('/detail-goc-nhin-'.$eachOfRelevantGocNhin->id_gocnhin)}}">{{$eachOfRelevantGocNhin->title_gocnhin}}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Cùng tác giả {{$author->name_user}}</span></h2>
                        <ul class="spost_nav">
                            <?php
                            $sameAuthor = DB::table('gocnhin') //chứa 5 tin tức mới nhất của cùng tác giả
                            ->where('id_customer', $author->id_user)
                                ->orderBy('latest_update_gocnhin', 'DESC')
                                ->take(5)
                                ->get();
                            ?>
                            @foreach($sameAuthor as $eachOfSameAuthor)
                                <?php
                                $authorRelevant = DB::table('users')
                                    ->where('id_user', $eachOfSameAuthor->id_customer)
                                    ->get()
                                    ->first();
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/detail-goc-nhin-'.$eachOfSameAuthor->id_gocnhin)}}"
                                            class="media-left">
                                            <img alt="" style="border-radius: 50%"
                                                 src="{{$authorRelevant->avatar}}"></a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/detail-goc-nhin-'.$eachOfSameAuthor->id_gocnhin)}}"
                                                class="catg_title">{{$eachOfSameAuthor->title_gocnhin}}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Đại dịch Covid-19</span></h2>
                        <div style="height: 350px; overflow: scroll">
                            <?php
                            $url = 'https://tygia.com/app/covid-19/api.json?type=2';
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15"));
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $info = json_decode($result, true);
                            ?>
                            <table style="border: 1px solid black">
                                <tr style="border: white">
                                    <th style="border: 1px solid black; color: #fd7605">Nghiêm trọng</th>
                                    <th style="border: 1px solid black; color: red">Tử vong</th>
                                    <th style="border: 1px solid black; color: green">Khỏi bệnh</th>
                                    <th style="border: 1px solid black;  color: blue">Nhiễm</th>
                                    <th style="border: 1px solid black">Quốc gia</th>
                                </tr>
                                @for ($i = 1; $i < count($info["items"]); $i++)
                                    <tr style="border: white">
                                        @foreach ($info["items"][$i] as $key => $value)
                                            @if ($key != "changed")
                                                <th style="border: 1px solid black">
                                                    <?php print_r($value . "\t" . " ") // print all data
                                                    ?>
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endfor
                            </table>
                        </div>
                        <h2><span>Danh mục khác</span></h2>
                        <select class="catgArchive">
                            <option>Danh mục khác</option>
                            <?php
                            $main = DB::table('main_category')->get();
                            ?>
                            @foreach($main as $eachOfMain)
                                <option>{{$eachOfMain->name_main}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Thời tiết - Giá Vàng - Tỷ giá</span></h2>
                        <iframe frameborder="0" marginwidth="0" marginheight="0"
                                src="http://thienduongweb.com/tool/weather/?r=1&w=1&g=1&d=0" width="100%" height="370"
                                scrolling="yes"></iframe>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
