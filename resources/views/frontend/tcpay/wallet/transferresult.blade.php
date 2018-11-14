@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('transfer'))
@section('content')
    @theme_include('errors.errors')
    <section class="main">
        <div class="blockContent">
            <h4><span class="text-uppercase">Kết quả chuyển tiền</span></h4>


            <div class="row">
                <div class=" col-md-12">
                    <table class="table">
                        <tbody>

                        <tr>
                            <td>Mã giao dịch:</td>
                            <td>{{ $order->order_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tài khoản người nhận:</td>
                            <td>{{ $order->payee_info }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tên người nhận:</td>
                            <td>{{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Ví người nhận:</td>
                            <td>{{ $order->payee_wallet }}
                            </td>
                        </tr>
                        <tr>
                            <td>Số tiền:</td>
                            <td><strong>{{ number_format($order->net_amount) }} {{ $order->currency_code }}</strong></td>
                        </tr>
                        <tr>
                            <td>Mô tả:</td>
                            <td>{{ $order->description }}

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

                </div>
            </div>



        </div>
    </section>

@endsection
