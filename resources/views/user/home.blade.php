@extends('welcome')
@section('home')
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">
                    <?php
                    $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất
                    ->orderBy('latest_update', 'DESC')
                        ->take(5)
                        ->get();
                    ?>
                    @foreach($newsSearch as $eachOfNewsSearch)
                        <div class="single_iteam">
                            <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}">
                            @if($eachOfNewsSearch->id_typeofnews != 3) <!--Ko phải Video-->
                                <img
                                    src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>"
                                    alt="">
                            @elseif($eachOfNewsSearch->id_typeofnews == 3)  <!--Video-->
                                <?php
                                $allMultimedia = explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)); //tách tất cả video trong mỗi bản tin
                                ?>
                                <iframe width="705" height="450"
                                        src="{{$allMultimedia[0]}}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                                @endif
                            </a>
                            <div class="slider_article">
                                <h2><a class="slider_tittle"
                                       href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}">{{$eachOfNewsSearch->title}}</a>
                                </h2>
                                <p>{{strlen($eachOfNewsSearch->context) > 200 ? substr($eachOfNewsSearch->context,0,195).'...' : $eachOfNewsSearch->context}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>{{$allMain[0]->name_main}}</span></h2>
                    <?php
                    $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main thời sự
                    ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                        ->where('branch_category.id_main_category', $allMain[0]->id_main_category)
                        ->orderBy('latest_update', 'DESC')
                        ->take(5)
                        ->get();
                    ?>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @foreach($newsSearch as $eachOfNewsSearch)
                                <li>
                                    <div class="media">
                                        <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                           class="media-left">

                                            <img alt=""
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">

                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                class="catg_title">
                                                {{$eachOfNewsSearch->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_post_content">
                        <h2><span>{{$allMain[2]->name_main}}</span></h2>
                        <?php
                        $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main thế giới
                        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                            ->where('branch_category.id_main_category', $allMain[2]->id_main_category)
                            ->orderBy('latest_update', 'DESC')
                            ->take(5)
                            ->get();
                        ?>
                        <div class="single_post_content_left">
                            <ul class="business_catgnav  wow fadeInDown">
                                <li>
                                    <figure class="bsbig_fig"><a
                                            href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}"
                                            class="featured_img">
                                        @if($newsSearch[0]->id_typeofnews != 3) <!--Ko phải Video-->
                                            <img alt=""
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)))[0] ?>">
                                        @elseif($newsSearch[0]->id_typeofnews == 3)  <!--Video-->
                                            <?php
                                            $allMultimedia = explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)); //tách tất cả video trong mỗi bản tin
                                            ?>
                                            <iframe width="340" height="230"
                                                    src="{{$allMultimedia[0]}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                            @endif
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch[0]->context) > 200 ? substr($newsSearch[0]->context,0,195).'...' : $newsSearch[0]->context}}</p>
                                    </figure>
                                </li>
                            </ul>
                        </div>
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @foreach($newsSearch as $key => $eachOfNewsSearch)
                                    @if($key>0)
                                        <li>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                                </a>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                        class="catg_title">{{$eachOfNewsSearch->title}}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="fashion_technology_area">
                        <div class="fashion">
                            <div class="single_post_content">
                                <h2><span>{{$allMain[4]->name_main}}</span></h2>
                                <?php
                                $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main thế giới
                                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                                    ->where('branch_category.id_main_category', $allMain[4]->id_main_category)
                                    ->orderBy('latest_update', 'DESC')
                                    ->take(5)
                                    ->get();
                                ?>
                                <ul class="business_catgnav wow fadeInDown">
                                    <li>
                                        <figure class="bsbig_fig"><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}"
                                                class="featured_img">
                                            @if($newsSearch[0]->id_typeofnews != 3) <!--Ko phải Video-->
                                                <img alt=""
                                                     src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)))[0] ?>">
                                            @elseif($newsSearch[0]->id_typeofnews == 3)  <!--Video-->
                                                <?php
                                                $allMultimedia = explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)); //tách tất cả video trong mỗi bản tin
                                                ?>
                                                <iframe width="340" height="230"
                                                        src="{{$allMultimedia[0]}}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                </iframe>
                                                @endif
                                                <span class="overlay"></span> </a>
                                            <figcaption><a
                                                    href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                            </figcaption>
                                            <p>{{strlen($newsSearch[0]->context) > 200 ? substr($newsSearch[0]->context,0,195).'...' : $newsSearch[0]->context}}</p>
                                        </figure>
                                    </li>
                                </ul>
                                <ul class="spost_nav">
                                    @foreach($newsSearch as $key => $eachOfNewsSearch)
                                        @if($key>0)
                                            <li>
                                                <div class="media wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                        class="media-left"> <img alt=""
                                                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                                    </a>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                            class="catg_title">{{$eachOfNewsSearch->title}}</a></div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="technology">
                            <div class="single_post_content">
                                <h2><span>{{$allMain[5]->name_main}}</span></h2>
                                <?php
                                $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main thế giới
                                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                                    ->where('branch_category.id_main_category', $allMain[5]->id_main_category)
                                    ->orderBy('latest_update', 'DESC')
                                    ->take(5)
                                    ->get();
                                ?>
                                <ul class="business_catgnav">
                                    <li>
                                        <figure class="bsbig_fig"><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}"
                                                class="featured_img">
                                            @if($newsSearch[0]->id_typeofnews != 3) <!--Ko phải Video-->
                                                <img alt=""
                                                     src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)))[0] ?>">
                                            @elseif($newsSearch[0]->id_typeofnews == 3)  <!--Video-->
                                                <?php
                                                $allMultimedia = explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)); //tách tất cả video trong mỗi bản tin
                                                ?>
                                                <iframe width="340" height="230"
                                                        src="{{$allMultimedia[0]}}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                </iframe>
                                                @endif
                                                <span class="overlay"></span> </a>
                                            <figcaption><a
                                                    href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                            </figcaption>
                                            <p>{{strlen($newsSearch[0]->context) > 200 ? substr($newsSearch[0]->context,0,195).'...' : $newsSearch[0]->context}}</p>
                                        </figure>
                                    </li>
                                </ul>
                                <ul class="spost_nav">
                                    @foreach($newsSearch as $key => $eachOfNewsSearch)
                                        @if($key>0)
                                            <li>
                                                <div class="media wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                        class="media-left"> <img alt=""
                                                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                                    </a>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                            class="catg_title">{{$eachOfNewsSearch->title}}</a></div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_post_content">
                        <h2><span>Ảnh</span></h2>
                        <ul class="photograph_nav  wow fadeInDown">
                            <?php
                            $allPhotograph = DB::table('news')  //lấy tất cả tin tức kiểu ảnh từ mới nhất đến cũ nhất, mỗi tin tức sẽ lấy cái ảnh đầu tiên thôi
                            ->where('id_typeofnews', 5)
                                ->orderBy('publish_date')
                                ->take(6)
                                ->get();
                            ?>
                            @foreach($allPhotograph as $eachPhotograph)
                                <li>
                                    <div class="photo_grid">
                                        <figure class="effect-layla">
                                            <a class="fancybox-buttons" data-fancybox-group="button"
                                               href="{{URL::to('/news-detail-'.$eachPhotograph->id_news)}}"
                                               title="<?php echo (explode("***<paragraph/>***", nl2br($eachPhotograph->describ_multimedia)))[0] ?>">
                                                <img
                                                    src="<?php echo (explode("***<paragraph/>***", nl2br($eachPhotograph->multimedia)))[0] ?>"
                                                    alt=""/>
                                            </a>
                                        </figure>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_post_content">
                        <h2><span>{{$allMain[6]->name_main}}</span></h2>
                        <?php
                        $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main thể thao
                        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                            ->where('branch_category.id_main_category', $allMain[6]->id_main_category)
                            ->orderBy('latest_update', 'DESC')
                            ->take(5)
                            ->get();
                        ?>
                        <div class="single_post_content_left">
                            <ul class="business_catgnav">
                                <li>
                                    <figure class="bsbig_fig"><a
                                            href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}"
                                            class="featured_img"> <img alt=""
                                                                       src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)))[0] ?>">
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch[0]->context) > 200 ? substr($newsSearch[0]->context,0,195).'...' : $newsSearch[0]->context}}</p>
                                    </figure>
                                </li>
                            </ul>
                        </div>
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @foreach($newsSearch as $key => $eachOfNewsSearch)
                                    @if($key>0)
                                        <li>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                                </a>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                        class="catg_title">{{$eachOfNewsSearch->title}}</a></div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>{{$allMain[7]->name_main}}</span></h2>
                        <?php
                        $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất về main pháp luật
                        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                            ->where('branch_category.id_main_category', $allMain[7]->id_main_category)
                            ->orderBy('latest_update', 'DESC')
                            ->take(5)
                            ->get();
                        ?>
                        <ul class="spost_nav">
                            @foreach($newsSearch as $eachOfNewsSearch)
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                            class="media-left"> <img alt=""
                                                                     src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                class="catg_title">
                                                {{$eachOfNewsSearch->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">Tất cả chuyên mục</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video mới nhất</a></li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận được ưa thích nhất</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category"> <!--Tất cả chuyên mục-->
                                <ul>
                                    @foreach($allMain as $eachOfAllMain)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}">{{$eachOfAllMain->name_main}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video mới nhất-->
                                <?php
                                $allNewestVideo = DB::table('news')
                                    ->where('id_typeofnews', 3)
                                    ->get();
                                ?>
                                <div class="vide_area">
                                    @foreach($allNewestVideo as $eachNewestVideo)
                                        <?php
                                        $allMultimedia = explode("***<paragraph/>***", nl2br($eachNewestVideo->multimedia)); //tách tất cả video trong mỗi bản tin
                                        $allDescribMultimedia = explode("***<paragraph/>***", nl2br($eachNewestVideo->describ_multimedia)); //tách tất cả mô tả video trong mỗi bản tin
                                        ?>
                                        @for($index = 0; $index < count($allMultimedia) ; $index++)
                                            <iframe width="560" height="315"
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
                            <div role="tabpanel" class="tab-pane" id="comments">    <!--Bình luận được ưa thích nhất-->
                                <ul class="spost_nav">
                                    <?php
                                    $coment = DB::table('coment')
                                        ->orderBy('likes_coment')
                                        ->get();
                                    ?>
                                    @foreach($coment as $eachOfComent)
                                        <li>
                                            <?php
                                            $news = DB::table('news')
                                                ->where('id_news', $eachOfComent->id_news)
                                                ->get()->first();
                                            ?>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$eachOfComent->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="<?php echo (explode("***<paragraph/>***", nl2br($news->multimedia)))[0] ?>">
                                                </a>
                                                <?php
                                                $commentPeople = DB::table('users')
                                                    ->where('id_user', $eachOfComent->id_customer)
                                                    ->get()->first();
                                                ?>
                                                <p>{{$commentPeople->name_user}}</p>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfComent->id_news)}}"
                                                        class="catg_title"></a></div>
                                            </div>
                                        </li>
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
