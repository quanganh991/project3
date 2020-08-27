@extends('welcome')
@section('news_list')
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">
                    @foreach($cacTacGia as $eachOfCacTacGia)
                        <div class="single_iteam"><a href="{{URL::to('/goc-nhin-tac-gia-'.$eachOfCacTacGia->id_customer)}}">
                                <img style="border-radius: 50%; height: 200px; width: 200px" src="{{$eachOfCacTacGia->avatar}}" alt=""></a>
                            <div class="slider_article">
                                <h2><a class="slider_tittle"
                                       href="{{URL::to('/goc-nhin-tac-gia-'.$eachOfCacTacGia->id_customer)}}">{{$eachOfCacTacGia->name_user}}</a>
                                </h2>
                                <p>{{$eachOfCacTacGia->job}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>Theo dòng sự kiện</span></h2>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @foreach($theoDongSuKien as $key => $eachOfTheoDongSuKien)
                                <li>
                                    <?php
                                    $author = DB::table('users')
                                    ->where('id_user',$eachOfTheoDongSuKien->id_customer)
                                    ->get()
                                    ->first();
                                    ?>
                                    <div class="media"><a href="{{URL::to('/detail-goc-nhin-'.$eachOfTheoDongSuKien->id_gocnhin)}}"
                                                          class="media-left"> <img style="border-radius: 50%;"
                                                alt="" src="{{$author->avatar}}"> </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/detail-goc-nhin-'.$eachOfTheoDongSuKien->id_gocnhin)}}"
                                                class="catg_title">
                                                {{$eachOfTheoDongSuKien->title_gocnhin}}</a></div>
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
                        <h2><span>Bài viết mới nhất</span></h2>
                        <ul class="business_catgnav  wow fadeInDown">
                            <li>
                                <?php
                                $author = DB::table('users')
                                    ->where('id_user',$allGocNhin[0]->id_customer)
                                    ->get()
                                    ->first();
                                ?>
                                <figure class="bsbig_fig"><a href="{{URL::to('/detail-goc-nhin-'.$allGocNhin[0]->id_gocnhin)}}"
                                                             class="featured_img"> <img alt=""
                                                                                        style="border-radius: 50%; height: 200px; width: 200px"
                                                                                        src="{{$author->avatar}}">
                                        <span class="overlay"></span> </a>
                                    <figcaption><a
                                            href="{{URL::to('/detail-goc-nhin-'.$allGocNhin[0]->id_gocnhin)}}">{{$allGocNhin[0]->title_gocnhin}}</a>
                                    </figcaption>
                                    <p>{{strlen($allGocNhin[0]->context_gocnhin) > 200 ? substr($allGocNhin[0]->context_gocnhin,0,195).'...' : $allGocNhin[0]->context_gocnhin}}</p>
                                    <br>
                                </figure>
                            </li>
                        </ul>
                        <ul class="spost_nav">
                            @foreach($allGocNhin as $key => $eachOfAllGocNhin)
                                @if($key>=1)
                                    <?php
                                    $author = DB::table('users')
                                        ->where('id_user',$eachOfAllGocNhin->id_customer)
                                        ->get()
                                        ->first();
                                    ?>
                                    <li>
                                        <div class="media wow fadeInDown"><a
                                                href="{{URL::to('/detail-goc-nhin-'.$eachOfAllGocNhin->id_gocnhin)}}"
                                                class="media-left"> <img alt="" style="border-radius: 50%" src="{{$author->avatar}}">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{URL::to('/detail-goc-nhin-'.$eachOfAllGocNhin->id_gocnhin)}}"
                                                   class="catg_title">{{$eachOfAllGocNhin->title_gocnhin}}</a>
                                                <br>
                                                <p>{{strlen($eachOfAllGocNhin->context_gocnhin) > 200 ? substr($eachOfAllGocNhin->context_gocnhin,0,195).'...' : $eachOfAllGocNhin->context_gocnhin}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        @if(Session::get('id_customer'))
                            <p style="color: red; font-size: 30px; font-weight: bold">Chia sẻ góc nhìn</p>
                            <p style="color: blue">Bài gửi trang Góc nhìn không nhất thiết phải trùng quan điểm của toàn soạn và không có nhuận bút</p>

                            <form action="{{URL::to('/up-gocnhin')}}" method="POST">
                                @csrf
                                {{ csrf_field() }}
                                <input name="title_gocnhin" type="text" placeholder="Tiêu đề góc nhìn"/>
                                <br><br><br>
                                <textarea name="context_gocnhin"
                                          placeholder="Quan điểm của bạn sẽ được đăng sau khi Admin phê duyệt"
                                          rows="9" cols="90"></textarea>
                                <input id="id_user" name="id_user" type="hidden"
                                       value="{{Session::get('id_user')}}"/>
                                <br><br>
                                <button type="submit" class="btn-template-main">Đăng bài viết</button>
                            </form>

                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Quan tâm nhiều</span></h2>   <!--Nhiều lượt xem nhất đến ít lượt xem nhất-->
                        <ul class="spost_nav">
                            @foreach($quanTamNhieu as $eachOfQuanTamNhieu)
                                <?php
                                $author = DB::table('users')
                                    ->where('id_user',$eachOfQuanTamNhieu->id_customer)
                                    ->get()
                                    ->first();
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/detail-goc-nhin-'.$eachOfQuanTamNhieu->id_gocnhin)}}"
                                            class="media-left"> <img alt="" style="border-radius: 50%" src="{{$author->avatar}}">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/detail-goc-nhin-'.$eachOfQuanTamNhieu->id_gocnhin)}}"
                                                class="catg_title">
                                                {{$eachOfQuanTamNhieu->title_gocnhin}}</a></div>
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
                    </div>
                    <div class="single_sidebar wow fadeInDown">
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
