@extends('welcome')
@section('check_multiple_choice')
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <p style="color: red; font-size: 35px; font-weight: bold">Kết Quả</p>
                <?php
                $newsDetail = DB::table('news')
                    ->where('id_news', $id_news)
                    ->get()
                    ->first();
                ?>
                @if($newsDetail->id_typeofnews == 4)
                    <?php
                    $multiple_choice = DB::table('multiple_choice')
                        ->where('id_news', $newsDetail->id_news)
                        ->get();
                    ?>
                    @foreach($multiple_choice as $key => $eachOfMultipleChoice)
                        <?php
                        $a_percent = round($qty_a[$key] / $sum[$key] * 100, 2);
                        $b_percent = round($qty_b[$key] / $sum[$key] * 100, 2);
                        $c_percent = round($qty_c[$key] / $sum[$key] * 100, 2);
                        $d_percent = round($qty_d[$key] / $sum[$key] * 100, 2);
                        ?>
                        <p  style="color: purple; font-size: 25px; font-weight: bold;">Câu hỏi {{$eachOfMultipleChoice->stt}}: </p>
                        <p>{{$eachOfMultipleChoice->question}}</p>

                        <p>A. {{$eachOfMultipleChoice->a_answer}}</p>
                        <p style="color: brown">Có {{$a_percent}}% người dùng lựa chọn A</p>

                        <p>B. {{$eachOfMultipleChoice->b_answer}}</p>
                        <p style="color: brown">Có {{$b_percent}}% người dùng lựa chọn B</p>

                        <p>C. {{$eachOfMultipleChoice->c_answer}}</p>
                        <p style="color: brown">Có {{$c_percent}}% người dùng lựa chọn C</p>

                        <p>D. {{$eachOfMultipleChoice->d_answer}}</p>
                        <p style="color: brown">Có {{$d_percent}}% người dùng lựa chọn D</p>
                        @if($eachOfMultipleChoice->key_answer != null)
                            @if($result[$key] == 1)
                                <p style="color: green">Bạn chọn {{$choice[$key]}}. Đúng, đáp án là {{$KEY[$key]}}</p>
                            @elseif($result[$key] == 0)
                                <p style="color: red">Bạn chọn {{$choice[$key]}}. Sai, đáp án là {{$KEY[$key]}}</p>
                            @endif
                            {{--Giải thích đáp án--}}
                            <img alt="" src="{{$eachOfMultipleChoice->img_explanation}}">
                            <p><?php echo nl2br($eachOfMultipleChoice->explanation)?></p>
                            {{--Giải thích đáp án--}}
                        @endif
                        <br><br>
                    @endforeach
                    <button><a type href="{{URL::to('/news-detail-'.$id_news)}}">Quay lại</a></button><br><br>
                @endif
            </div>
        </div>
    </section>
@endsection
