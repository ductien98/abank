@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('localbank'))
@section('content')
    @theme_include('errors.errors')
    <h4><span class="text-uppercase">Thông tin chuyển khoản</span></h4>
    <section class="">

            <table class="table">
                <tbody>
                <tr>
                    <td width="30%">Thanh toán:</td>
                    <td><b>Ngân hàng trong nước</b>
                    </td>
                </tr>
                <tr>
                    <td>Số tiền:</td>
                    <td><b>{{ number_format($order->pay_amount) }} {{ $order->currency_code }}</b></td>
                </tr>
                <tr>
                    <td>Nội dung chuyển khoản:</td>
                    <td><b>Thanh toan don hang {{ $order->order_code }} </b>

                    </td>
                </tr>

                <tr>
                    <td>Trạng thái:</td>
                    <td>
                        @if($order->status == 'completed')
                            <span class="label label-success">HOÀN THÀNH</span>
                        @elseif($order->status == 'pending')
                            <span class="label label-warning">CHỜ XỬ LÝ</span>
                        @elseif($order->status == 'none')
                            <span class="label label-default">CHỜ THANH TOÁN</span>
                        @elseif($order->status == 'canceled')
                            <span class="label label-danger">ĐÃ HỦY</span>
                        @else
                            <span class="label label-default">CHƯA RÕ</span>
                        @endif

                    </td>
                </tr>

                <tr>
                    <td>Lưu ý:</td>
                    <td><i>Bạn hãy chọn một trong những ngân hàng bên dưới để chuyển tiền. Nhớ ghi đúng nội dung chuyển khoản và chuyển đúng số tiền. Sau khi gửi xong vui lòng liên hệ với chúng tôi để được kích hoạt đơn hàng. Xin cảm ơn!</i>
                    </td>
                </tr>
                </tbody>
            </table>




        <h4><span class="text-uppercase">VUI LÒNG GỬI TIỀN VÀO NGÂN HÀNG DƯỚI ĐÂY</span></h4>

        <div class="card-body row">
            <div class="col-md-12">

                <table class="table">
                    <tbody>


                    <tr>
                        <td><img width="111" height="59" src="{{theme_asset('images/bank')}}/{{$adminbank->code}}.jpg"></td>
                        <td><b>{{$adminbank->name}} chi nhánh {{$adminbank->branch}}</b><br>
                            Số tài khoản: {{$adminbank->acc_num}} <br>
                            Chủ tài khoản: {{$adminbank->acc_name}}
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>


        <div class="card-footer">
            <i>Nếu như bạn đã chuyển tiền, vui lòng thông báo cho chúng tôi để nạp tiền vào ví.</i><br>
            {{--<button type="submit" class="btn btn-primary">Xác nhận đã chuyển tiền!</button>--}}
        </div>


    </section>
@endsection
