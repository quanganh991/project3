@extends('user.tournament.header_footer')
@section('detail_tournament')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 style="color: red" class="h2">Lỗi: {{$reason}}</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Về trang chủ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection
