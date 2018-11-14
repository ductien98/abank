@extends('frontend.'.$current_theme.'.common93')
@section('breadcrumbs', Breadcrumbs::render('default','Chi tiết đơn hàng mua mã thẻ'))
@section('content')
    {{--Dữ liệu ở đây lấy từ SofcardFrontController\getPageSuccess--}}

    @theme_include('errors.errors')
    <div class="fullColumn">
        <h4><strong>Thông tin đơn hàng</strong></h4>

        <div class="row pb-5 p-5">
            <div class="col-md-6">

                <p class="mb-1">Mã đơn hàng:</p>
                <p>Thời gian:</p>
                <p>Số tiền:</p>
                <p>Cổng thanh toán:</p>
                <p>Trạng thái:</p>
            </div>

            <div class="col-md-6 text-right">
                <p class="mb-1"><strong>{{$order->order_code}}</strong></p>
                <p class="mb-1"><strong>{{ $order->updated_at }}</strong></p>
                <p class="mb-1"><strong>{{ number_format($order->pay_amount) }} {{$order->currency_code}}</strong></p>
                <p class="mb-1"><strong>{{ $order->paygate_code }}</strong></p>
                <p class="mb-1">

                  @if($order->status == 'completed')
                            <span class="label label-success">HOÀN THÀNH</span>
                        @elseif($order->status == 'pending')
                            <span class="label label-warning">CHỜ XỬ LÝ</span>
                        @elseif($order->status == 'none')
                            <span class="label label-default">NHÁP</span>
                        @elseif($order->status == 'canceled')
                            <span class="label label-danger">ĐÃ HỦY</span>
                        @else
                            <span class="label label-default">CHƯA RÕ</span>
                        @endif

                    </p>
            </div>
        </div>
    </div>

    @if($order->status =='completed' && $order->module =='Softcard')
    <br>
    <h4><strong>Thông tin mã thẻ</strong></h4>
    <br>
    <div id="content">

        @if($cardinfo)
        {!! $cardinfo !!}
        @else
        <span class="text-danger"> Nếu bạn đã thanh toán mà chưa nhận được thẻ. Vui lòng liên hệ quản trị viên.</span>
        @endif
    </div>

    @endif

@endsection
