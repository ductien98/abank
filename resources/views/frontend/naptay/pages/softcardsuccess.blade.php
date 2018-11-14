@extends('frontend.'.$current_theme.'.common93')
@section('breadcrumbs', Breadcrumbs::render('default','Chi tiết đơn hàng mua mã thẻ'))
@section('content')
    {{--Dữ liệu ở đây lấy từ SofcardFrontController\getPageSuccess--}}

    <div class="fullColumn">
        <div class="col-md-12">
            @theme_include('errors.errors')
            <h4><strong>Thông tin đơn hàng</strong></h4>

            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>Mã đơn hàng:</td>
                    <td align="right"><strong>{{$order->order_code}}</strong></td>
                </tr>
                <tr>
                    <td>Thời gian:</td>
                    <td align="right"><strong>{{ $order->updated_at }}</strong></td>

                </tr>

                <tr>
                    <td>Số tiền:</td>
                    <td align="right"><strong>{{ number_format($order->pay_amount) }} {{$order->currency_code}}</strong>
                    </td>
                </tr>

                <tr>
                    <td>Cổng thanh toán:</td>
                    <td align="right"><strong>{{ $order->paygate_code }}</strong></td>

                </tr>

                <tr>
                    <td>Trạng thái:</td>
                    <td align="right">
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

                    </td>
                </tr>
                </tbody>
            </table>


            @if($order->status =='completed' && $order->module =='Softcard')
                <br>
                <h4><strong>Thông tin mã thẻ</strong></h4>
                <br>
                <div id="content" class="table-responsive">

                    @if($cardinfo)
                        {!! $cardinfo !!}
                    @else
                        <span class="text-danger"> Nếu bạn đã thanh toán mà chưa nhận được thẻ. Vui lòng liên hệ quản trị viên.</span>
                    @endif
                </div>

            @endif
        </div>
    </div>
@endsection
