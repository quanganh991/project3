@extends('welcome')
@section('news_detail')
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_page">
                        <ol class="breadcrumb">
                            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            <li>
                                <a href="{{URL::to('/branch-result-'.$newsDetailMain->id_main_category)}}">{{$newsDetailMain->name_main}}</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/news-result-'.$newsDetailBranch->id_branch_category)}}">{{$newsDetailBranch->name_branch}}</a>
                            </li>
                        </ol>
                        <p style="color: saddlebrown; font-size: 35px; font-weight: bold">{{$newsDetail->title}}</p>
                        <?php
                        $journal = DB::table('users')
                            ->where('id_user', $newsDetail->id_journalist)
                            ->get()->first();   //lấy tác giả của bài viết
                        ?>
                        <div class="post_commentbox"><a href="#"><i class="fa fa-user"></i>{{$journal->name_user}}</a>
                            <span><i
                                    class="fa fa-calendar"></i>{{$newsDetail->latest_update}}
                            </span>
                            <a href="{{URL::to('/news-result-'.$newsDetailBranch->id_branch_category)}}"><i
                                    class="fa fa-tags"></i>{{$newsDetailBranch->name_branch}}
                            </a>
                        </div>
                        <div class="single_page_content">
                            <?php
                            //cả 3 biến dưới đây là kiểu mảng
                            $allParagraph = explode("***<paragraph/>***", nl2br($newsDetail->context)); //tách đoạn
                            $allMultimedia = explode("***<paragraph/>***", nl2br($newsDetail->multimedia)); //tách đa phương tiện
                            $allDescribMultimedia = explode("***<paragraph/>***", nl2br($newsDetail->describ_multimedia)); //tách mô tả đa phương tiện
                            ?>

                            @for($i=0;$i<max(count($allMultimedia),count($allParagraph),count($allDescribMultimedia));$i++)
                                @if($i < count($allParagraph))
                                    <p><?php echo $allParagraph[$i] ?></p>
                                @endif
                                @if($i < count($allMultimedia) )
                                    @if($newsDetail->id_typeofnews != 3)
                                        <img class="img-center" src="<?php echo $allMultimedia[$i] ?>" alt="">
                                    @elseif($newsDetail->id_typeofnews == 3)
                                        <iframe width="560" height="315"
                                                src="{{$allMultimedia[$i]}}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            {{$allDescribMultimedia[$i]}}
                                        </iframe>
                                    @endif
                                @endif
                                @if($i < count($allDescribMultimedia))
                                    <p style="background: #D6E1D1"><?php echo $allDescribMultimedia[$i] ?></p>
                                @endif
                            @endfor
                            {{--chứa nội dung--}}
                        <!--Nếu tin tức là trắc nghiệm thì sẽ có mục này-->
                            @if($newsDetail->id_typeofnews == 4)
                                <?php
                                $multiple_choice = DB::table('multiple_choice')
                                    ->where('id_news', $newsDetail->id_news)
                                    ->get();
                                ?>
                                <form action="{{URL::to('/check-multiple-choice')}}">
                                    @foreach($multiple_choice as $key => $eachOfMultipleChoice)
                                        <p  style="color: purple; font-size: 25px; font-weight: bold;">Câu hỏi {{$eachOfMultipleChoice->stt}}: </p>
                                        <p>{{$eachOfMultipleChoice->question}}</p>

                                        <input type="radio" id="A" name="choice[{{$key}}]" value="A">
                                        <label for="A">A. {{$eachOfMultipleChoice->a_answer}}</label><br>

                                        <input type="radio" id="B" name="choice[{{$key}}]" value="B">
                                        <label for="B">B. {{$eachOfMultipleChoice->b_answer}}</label><br>

                                        <input type="radio" id="C" name="choice[{{$key}}]" value="C">
                                        <label for="C">C. {{$eachOfMultipleChoice->c_answer}}</label><br>

                                        <input type="radio" id="D" name="choice[{{$key}}]" value="D">
                                        <label for="D">D. {{$eachOfMultipleChoice->d_answer}}</label><br>
                                        <br><br>
                                    @endforeach
                                    <input type="hidden" name="id_news" value="{{$newsDetail->id_news}}">
                                    <button>Gửi đáp án</button>
                                </form>
                            @endif
                        <!--Nếu tin tức là trắc nghiệm thì sẽ có mục này-->
                            <!--Nếu tin tức là dạng sự kiện/ trận đấu thì sẽ có mục này-->
                            @if($newsDetail->id_typeofnews == 7)
                                <?php
                                $tournament = DB::table('tournament')
                                    ->where('id_news', $newsDetail->id_news)
                                    ->get()->first();
                                ?>
                                <a style="color: blue"
                                   href="{{URL::to('/detail-tournament-'.$tournament->id_tournament)}}">Xem chi
                                    tiết: {{$tournament->name_tournament}}</a>
                            @endif
                        <!--Nếu tin tức là dạng sự kiện/ trận đấu thì sẽ có mục này-->
                            @if(Session::get('id_customer'))
                                <?php
                                $allMultimedia = explode("***<paragraph/>***", nl2br($newsDetail->multimedia)); //tách đa phương tiện
                                $allDescribMultimedia = explode("***<paragraph/>***", nl2br($newsDetail->describ_multimedia)); //tách mô tả đa phương tiện
                                $isSaved = DB::table('bookmarked')
                                    ->where('id_customer', Session::get('id_customer'))
                                    ->where('id_news', $newsDetail->id_news)
                                    ->get();
                                ?>
                                @if(count($isSaved)==0)
                                    <form action="{{URL::to('/bookmark')}}" method="get">
                                        <input name="id_news" value="{{$newsDetail->id_news}}" type="hidden"/>
                                        <button class="btn default-btn">Lưu bài viết</button>
                                    </form>
                                @else
                                    <form action="{{URL::to('/unbookmark')}}" method="get">
                                        <input name="id_news" value="{{$newsDetail->id_news}}" type="hidden"/>
                                        <button class="btn default-btn">Bỏ lưu bài viết</button>
                                    </form>
                                @endif
                            @endif
                            {{--                            <button class="btn btn-red">Red Button</button>--}}
                        </div>
                        <!--Bình luận-->
                        <p style="color: orangered; font-size: 35px; font-weight: bold" >Bình luận:</p>
                        <?php
                        if (Session::get('id_user')) {
                        ?>
                        <form action="{{URL::to('/comment')}}" method="GET">
                            <textarea name="comment" placeholder="Bình luận" rows="6" cols="50"></textarea>
                            <input name="newsid_hidden" type="hidden" value="{{$newsDetail->id_news}}"/>
                            <input id="userid_hidden" name="userid_hidden" type="hidden"
                                   value="{{Session::get('id_user')}}"/>
                            <br>
                            <button type="submit" class="btn-template-main">Gửi bình luận</button>
                        </form>
                        <?php
                        } else {
                            echo "Bạn phải đăng nhập để bình luận";
                        }
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
                                    <p style="color: #2b527e; font-size: 20px; font-weight: bold">{{$eachCommentList->name_user}}</p>
                                @elseif($user->type_of_user == 'admin')
                                    <p style="color: red; font-size: 20px; font-weight: bold">Admin: {{$eachCommentList->name_user}}</p>
                                @endif
                                <p style="color: red; font-size: 15px; font-weight: bold"><i class="fa fa-comment"
                                       aria-hidden="true"></i> {{$eachCommentList->context_coment}}</p>
                                @endif
                                @if(Session::get('id_admin'))
                                    <a href="{{URL::to('/delete-comment/'.$eachCommentList->id_coment)}}">Xóa
                                        comment</a>
                                    |
                                    <a href="{{URL::to('/block-user/'.$eachCommentList->id_customer)}}">Khóa tài
                                        khoản</a>
                                @endif
                            </row>
                            {{-- 2 sự lựa chọn: Trả lời bình luận và xem các câu trả lời--}}
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
                                                <p style="color: white; font-size: 20px; font-weight: bold" class="dropdown-item">{{$userRep->name_user}}</p>
                                            @elseif($userRep->type_of_user == 'admin')
                                                <p style="color: yellow; font-size: 20px; font-weight: bold" class="dropdown-item">Admin: {{$userRep->name_user}}</p>
                                            @endif
                                            <p style="color: lightsalmon; font-size: 20px; font-weight: bold" class="dropdown-item"><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i> {{$eachOfReply->context_reply}}
                                            </p>
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
                            <p style=" font-size: 30px; font-weight: bold">Bài viết liên quan<i class="fa fa-thumbs-o-up"></i></p>
                            <ul class="spost_nav wow fadeInDown animated">
                                @foreach($relevantNewsDetail as $eachOfRelevantNewsDetail)
                                    <li>
                                        <div class="media">
                                            <a class="media-left"
                                               href="{{URL::to('/news-detail-'.$eachOfRelevantNewsDetail->id_news)}}">
                                                <img
                                                    src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfRelevantNewsDetail->multimedia)))[0] ?>"
                                                    alt="">
                                            </a>
                                            <div class="media-body"><a class="catg_title"
                                                                       href="{{URL::to('/news-detail-'.$eachOfRelevantNewsDetail->id_news)}}">{{$eachOfRelevantNewsDetail->title}}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $relevantNews = DB::table('news')->where('id_branch_category', $newsDetailBranch->id_branch_category)->get();
            $pre = 0;
            $next = 0;
            foreach ($relevantNews as $key => $eachOfRelevantNews) {
                if ($eachOfRelevantNews->id_news == $newsDetail->id_news) {
                    if ($key == 0) {
                        $pre = count($relevantNews) - 1;
                        $next = ($key + 1) % count($relevantNews);
                    } else if ($key == count($relevantNews) - 1) {
                        $pre = ($key - 1) % count($relevantNews);
                        $next = 0;
                    } else {
                        $pre = ($key - 1) % count($relevantNews);
                        $next = ($key + 1) % count($relevantNews);
                    }
                    $pre = $relevantNews[$pre];
                    $next = $relevantNews[$next];
                    break;
                }
            }
            ?>
            <nav class="nav-slit">
                <a class="prev" href="{{URL::to('/news-detail-'.$pre->id_news)}}">
                    <span class="icon-wrap">
                        <i class="fa fa-angle-left"></i>
                    </span>
                    <div>
                        <p style=" font-size: 30px; font-weight: bold">{{$pre->title}}</p>
                        <img src="<?php echo (explode("***<paragraph/>***", nl2br($pre->multimedia)))[0] ?>" alt=""/>
                    </div>
                </a>
                <a class="next" href="{{URL::to('/news-detail-'.$next->id_news)}}">
                    <span class="icon-wrap">
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <div>
                        <p style="font-size: 30px; font-weight: bold">{{$next->title}}</p>
                        <img src="<?php echo (explode("***<paragraph/>***", nl2br($next->multimedia)))[0] ?>" alt=""/>
                    </div>
                </a>
            </nav>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Bài viết mới nhất về {{$newsDetailBranch->name_branch}}</span></h2>
                        <ul class="spost_nav">
                            <?php
                            $newsEst = DB::table('news') //chứa 5 tin tức mới nhất có $id_branch_category
                            ->where('id_branch_category', $newsDetailBranch->id_branch_category)
                                ->orderBy('latest_update', 'DESC')
                                ->take(5)
                                ->get();
                            ?>
                            @foreach($newsEst as $eachOfNewsEst)
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/news-detail-'.$eachOfNewsEst->id_news)}}"
                                            class="media-left">
                                            <img alt=""
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsEst->multimedia)))[0] ?>">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsEst->id_news)}}"
                                                class="catg_title">{{$eachOfNewsEst->title}}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">{{$newsDetailMain->name_main}}
                                    /{{$newsDetailBranch->name_branch}}</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video
                                    trong {{$newsDetailBranch->name_branch}}</a></li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận
                                    trong {{$newsDetailBranch->name_branch}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category">
                                <!--Các branch khác trong cùng main-->
                                <ul>
                                    @foreach($branchInSameMain as $eachOfBranchInSameMain)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/branch-result-'.$eachOfBranchInSameMain->id_branch_category)}}">{{$eachOfBranchInSameMain->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video trong cùng branch-->
                                <div class="vide_area">
                                    @foreach($videoInSameBranch as $eachOfVideoInSameBranch)
                                        <?php
                                        $allMultimedia = explode("***<paragraph/>***", nl2br($eachOfVideoInSameBranch->multimedia)); //tách tất cả video trong mỗi bản tin
                                        $allDescribMultimedia = explode("***<paragraph/>***", nl2br($eachOfVideoInSameBranch->describ_multimedia)); //tách tất cả mô tả video trong mỗi bản tin
                                        ?>
                                        @for($index = 0; $index < count($allMultimedia) ; $index++)
                                            <iframe width="320" height="180"
                                                    src="{{$allMultimedia[$index]}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                {{$allDescribMultimedia[$index]}}
                                            </iframe>
                                        @endfor
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comments">   <!--Comment hàng đầu trong cùng branch-->
                                <ul class="spost_nav">
                                    @foreach($relevantNewsDetail as $eachOfRelevantNewsDetail)
                                        <?php
                                        $comment = DB::table('coment')
                                            ->where('id_news', $eachOfRelevantNewsDetail->id_news)
                                            ->orderBy('likes_coment', 'DESC')
                                            ->get();
                                        ?>
                                        @foreach($comment as $eachOfComment)
                                            <li>
                                                <div class="media wow fadeInDown">
                                                    <a href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                       class="media-left">
                                                        <img alt=""
                                                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfRelevantNewsDetail->multimedia)))[0] ?>">
                                                    </a>
                                                    <?php
                                                    $commentPeople = DB::table('users')
                                                        ->where('id_user', $eachOfComment->id_customer)
                                                        ->get()->first();
                                                    ?>
                                                    <p>{{$commentPeople->name_user}}</p>
                                                    <div class="media-body">
                                                        <a href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                           class="catg_title">
                                                            {{$eachOfComment->context_coment}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
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
