@extends('welcome')
@section('news_detail')
    <form role="form" action="{{URL::to('/search-news')}}"
          method="get">
        <div class="card-body">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="keyword"
                       class="form-control" id="keyword"
                       placeholder="Tiêu đề">
            </div>
            <div class="form-group">
                <label>Từ ngày</label>
                <input type="datetime-local" name="dateFrom" id="dateFrom">

            </div>

            <div class="form-group">
                <label>Đến ngày</label>
                <input type="datetime-local" name="dateTo" id="dateTo">
            </div>
        </div>
        <button>Tìm kiếm</button>
    </form>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Branch của tin tức</th>
                    <th>Main của tin tức</th>
                    <th>Nội dung</th>
                    <th>Ngày đăng</th>
                    <th>Ảnh</th>
                </tr>
                </thead>
                <tbody>
                @foreach($search_news as $key=> $eachOfSearchNews) {{--$news chứa tất cả các bản ghi đã truy vấn, $key chứa chỉ số bản ghi, $eachOfSearchNews chứa từng bản ghi một--}}

                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="{{URL::to('/news-detail-'.$eachOfSearchNews->id_news)}}">
                            {{$eachOfSearchNews->title}}
                        </a>
                    </td>
                    <td>
                        <?php
                        $bra = DB::table('branch_category')->where('id_branch_category', $eachOfSearchNews->id_branch_category)->get()->first();
                        ?>
                        <a href="{{URL::to('/news-result-'.$bra->id_branch_category) }}">{{$bra->name_branch}}</a>
                    </td>
                    <td>
                        <?php
                        $cat = DB::table('main_category')->where('id_main_category', $bra->id_main_category)->get()->first();
                        ?>
                        <a href="{{URL::to('/branch-result-'.$cat->id_main_category) }}">{{$cat->name_main}}</a>
                    </td>
                    <td>
                        {{strlen($eachOfSearchNews->context) > 100 ? substr($eachOfSearchNews->context,0,95).'...' : $eachOfSearchNews->context}}
                    </td>
                    <td>
                        {{$eachOfSearchNews->publish_date}}
                    </td>
                    <td>
                        <a href="{{URL::to('/news-detail-'.$eachOfSearchNews->id_news) }}">
                            <img height="100" width="100" src="{{$eachOfSearchNews->multimedia}}" class="img-fluid">
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{--    <iframe width="560" height="315"--}}
{{--            src="https://www.youtube.com/embed/v0wLWbN5sAo"--}}
{{--            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>--}}
{{--    </iframe>--}}

{{--    <iframe width="560" height="315" src="https://www.youtube.com/embed/ZicURsm2Q8c"--}}
{{--            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>--}}
{{--    </iframe>--}}
@endsection
