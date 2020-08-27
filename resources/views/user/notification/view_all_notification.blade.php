@extends('welcome')
@section('viewAllComment')
    <h1 style="color: red">Thông báo</h1>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID Thông báo</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Đánh dấu đã đọc</th>
            <th>Xem chi tiết</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allNotification as $eachNotification)
            <tr>
                <td>{{ $eachNotification->id_notification }}</td>
                <td>
                    <a
                        @if($eachNotification->isread_noti == 'seen')
                        style="color: black"
                        @elseif($eachNotification->isread_noti == 'not seen')
                        style="color: red; font: italic bold 15px/15px Arial, serif;"
                        @endif
                        href="{{URL::to($eachNotification->link_noti)}}">
                        {{$eachNotification->context_noti}}
                    </a>
                </td>
                <td>{{ $eachNotification->date_noti }}</td>
                <td>
                    @if($eachNotification->isread_noti == 'seen')
                        <p>Đã xem</p>
                    @elseif($eachNotification->isread_noti == 'not seen')
                        <a style="color: rebeccapurple" href="{{URL::to('/mark-as-read-notification-'.$eachNotification->id_notification) }}">Đánh dấu đã xem</a>
                    @endif
                </td>
                <td>
                    <a style="color: darkorange"
                       href="{{URL::to($eachNotification->link_noti)}}">
                        <p>Xem chi tiết</p>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
