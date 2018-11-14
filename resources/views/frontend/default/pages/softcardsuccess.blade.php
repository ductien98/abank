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
                    <td>Trạng thái thanh toán:</td>
                    <td align="right">
                        @if($order->payment == 'paid')
                            <span class="label label-success">ĐÃ THANH TOÁN</span>
                        @elseif($order->payment == 'pending')
                            <span class="label label-warning">CHƯA THANH TOÁN</span>
                        @elseif($order->payment == 'none')
                            <span class="label label-default">CHỜ THANH TOÁN</span>
                        @elseif($order->payment == 'canceled')
                            <span class="label label-danger">ĐÃ HỦY</span>
                        @else
                            <span class="label label-default">CHƯA RÕ</span>
                        @endif

                    </td>
                </tr>

                <tr>
                    <td>Trạng thái thẻ:</td>
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

                <div id="content" class="table-responsive">

                    @if($cardinfo)
                        {!! $cardinfo !!}
                    @else
                        <span class="text-danger"> Nếu bạn đã thanh toán mà chưa nhận được thẻ. Vui lòng liên hệ quản trị viên.</span>
                    @endif

                    @if($order->admin_note)

                            <br><h4>GHI CHÚ CỦA QUẢN TRỊ VIÊN</h4>

                   <textarea class="form-control" rows="5" readonly>{{ json_decode($order->admin_note) }}</textarea>
                    @endif
                </div>

            @endif
        </div>
    </div>
@endsection
