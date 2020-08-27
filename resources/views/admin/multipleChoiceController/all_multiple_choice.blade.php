@extends('admin.home')
@section('all_multiple_choice')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý khảo sát/câu hỏi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm khảo sát/câu hỏi mới
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
                                                                <h3 class="card-title">Thêm khảo sát/câu hỏi mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/save-multiple-choice')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Tin tức của khảo sát/câu hỏi</label>
                                                                        <?php
                                                                        $news = DB::table('news')
                                                                            ->where('id_typeofnews',4)
                                                                            ->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_news"
                                                                                id="id_news">
                                                                            @foreach($news as $indexnews)
                                                                                <option
                                                                                    value="{{$indexnews->id_news}}">{{$indexnews->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="question">Câu số</label>
                                                                        <input type="number" name="stt"
                                                                               class="form-control" id="stt"
                                                                               placeholder="Câu số">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="question">Nội dung câu hỏi</label>
                                                                        <input type="text" name="question"
                                                                               class="form-control" id="question"
                                                                               placeholder="Nội dung câu hỏi">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="a_answer">Phương án A</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="a_answer" id="a_answer" placeholder="Phương án A"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="b_answer">Phương án B</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="b_answer" id="b_answer" placeholder="Phương án B"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="c_answer">Phương án C</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="c_answer" id="c_answer" placeholder="Phương án C"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="d_answer">Phương án D</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="d_answer" id="d_answer" placeholder="Phương án D"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Đáp án</label>
                                                                        <input type="text" name="key_answer" id="key_answer">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="explanation">Giải thích đáp án</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="explanation" id="explanation" placeholder="Giải thích đáp án"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Minh họa cho lời giải thích</label>
                                                                        <input type="file" name="img_explanation" id="img_explanation">
                                                                    </div>

                                                                    <!-- /.card-body -->
                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_multiple_choice"
                                                                                class="btn btn-primary">Thêm khảo sát/câu hỏi mới
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
                                <th>ID khảo sát/câu hỏi</th>
                                <th>Tin tức của khảo sát/câu hỏi</th>
                                <th>Câu số</th>
                                <th>Nội dung của khảo sát/câu hỏi</th>
                                <th>Phương án A</th>
                                <th>Phương án B</th>
                                <th>Phương án C</th>
                                <th>Phương án D</th>
                                <th>Đáp án</th>
                                <th>Số người chọn phương án A</th>
                                <th>Số người chọn phương án B</th>
                                <th>Số người chọn phương án C</th>
                                <th>Số người chọn phương án D</th>
                                <th>Giải thích</th>
                                <th>Minh họa cho giải thích</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allMultipleChoice as $eachMultipleChoice)
                                <?php
                                $news = DB::table('news')
                                    ->where('id_news',$eachMultipleChoice->id_news)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachMultipleChoice->id_multiple_choice }}</td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/edit-news/'.$news->id_news) }}">
                                            {{$news->title}}
                                        </a>
                                    </td>
                                    <td>{{ $eachMultipleChoice->stt }}</td>
                                    <td>
                                        <a href="{{URL::to('/edit-multiple-choice/'.$eachMultipleChoice->id_multiple_choice) }}">
                                            {{$eachMultipleChoice->question}}
                                        </a>
                                    </td>
                                    <td>{{ $eachMultipleChoice->a_answer }}</td>
                                    <td>{{ $eachMultipleChoice->b_answer }}</td>
                                    <td>{{ $eachMultipleChoice->c_answer }}</td>
                                    <td>{{ $eachMultipleChoice->d_answer }}</td>
                                    <td>{{ $eachMultipleChoice->key_answer }}</td>
                                    <td>{{ $eachMultipleChoice->a_quantity }}</td>
                                    <td>{{ $eachMultipleChoice->b_quantity }}</td>
                                    <td>{{ $eachMultipleChoice->c_quantity }}</td>
                                    <td>{{ $eachMultipleChoice->d_quantity }}</td>
                                    <td>{{strlen($eachMultipleChoice->explanation) > 50 ? substr($eachMultipleChoice->explanation,0,45).'...' : $eachMultipleChoice->explanation}}</td>
                                    <td>
                                        <a href="{{URL::to('/news-detail-'.$eachMultipleChoice->id_news)}}">
                                            <img height="80px" width="80px"
                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachMultipleChoice->img_explanation)))[0] ?>"
                                                 alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-multiple-choice/'.$eachMultipleChoice->id_multiple_choice)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allMultipleChoice->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
