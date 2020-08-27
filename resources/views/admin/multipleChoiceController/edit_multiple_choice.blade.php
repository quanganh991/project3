@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa câu hỏi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-multiple-choice')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_multiple_choice" value="{{$edit_multiple_choice->id_multiple_choice}}">
                            <div class="form-group">
                                <label>Tin tức của khảo sát/ câu hỏi</label>
                                <?php
                                $news = DB::table('news')
                                    ->where('id_typeofnews',4)
                                    ->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_news" id="id_news" >
                                    @foreach($news as $indexnews)
                                        <option
                                            <?php if($indexnews->id_news ==  $edit_multiple_choice->id_news) echo "selected" ?>
                                            value="{{$indexnews->id_news}}">{{$indexnews->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Câu số</label>
                                <input type="number" name="stt" class="form-control" id="stt"
                                       value="{{$edit_multiple_choice->stt}}">
                            </div>

                            <div class="form-group">
                                <label>Câu hỏi</label>
                                <input type="text" name="question" class="form-control" id="question"
                                       value="{{$edit_multiple_choice->question}}">
                            </div>

                            <div class="form-group">
                                <label>Phương án A</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="a_answer"
                                          id="a_answer">{{$edit_multiple_choice->a_answer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Phương án B</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="b_answer"
                                          id="b_answer">{{$edit_multiple_choice->b_answer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Phương án C</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="c_answer"
                                          id="c_answer">{{$edit_multiple_choice->c_answer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Phương án D</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="d_answer"
                                          id="d_answer">{{$edit_multiple_choice->d_answer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Đáp án</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="key_answer"
                                          id="key_answer">{{$edit_multiple_choice->key_answer}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Giải thích</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="explanation"
                                          id="explanation">{{$edit_multiple_choice->explanation}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Minh họa cho lời GT</label>
                                <input  type="text" name="img_explanation" class="form-control" id="img_explanation" value="{{$edit_multiple_choice->img_explanation}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa câu hỏi</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
