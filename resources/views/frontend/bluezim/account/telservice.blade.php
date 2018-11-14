@extends('frontend.'.$current_theme.'.app')
@section('breadcrumbs', Breadcrumbs::render('orderuser'))
@section('content')
    <h4><span class="text-uppercase">Đơn hàng thanh toán hóa đơn</span></h4>
    <div class="blockContent">
<div class="card">
        <div class="card-body" style="padding-top: 0;">
            <div class="row"><div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th>Mã giao dịch</th>
                            <th>Sản phẩm</th>
                            <th>TT thanh toán</th>
                            <th>TT đơn hàng</th>
                            <th>Số tiền</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $order_telservice as $telservice )
                            <tr>
                                <td>{{$telservice->order_code}}</td>
                                <td>
                                    Thanh toán {{$telservice->type}} với MKH: <b>{{$telservice->ma_khach_hang}}</b>
                                </td>
                                <td>

                                    @if($telservice->payment == 'paid')
                                        <span class="label label-success">ĐÃ THANH TOÁN</span>
                                    @elseif($telservice->payment == 'unpaid')
                                        <span class="label label-warning">CHƯA THANH TOÁN</span>
                                    @elseif($telservice->payment == 'refunded')
                                        <span class="label label-primary">ĐÃ HOÀN TIỀN</span>
                                    @elseif($telservice->payment == 'none')
                                        <span class="label label-default">NHÁP</span>
                                    @elseif($telservice->payment == 'canceled')
                                        <span class="label label-danger">ĐÃ HỦY</span>
                                    @else
                                        <span class="label label-default">CHƯA RÕ</span>
                                    @endif

                                </td>
                                <td>

                                    @if($telservice->status == 'completed')
                                        <span class="label label-success">HOÀN THÀNH</span>
                                    @elseif($telservice->status == 'pending')
                                        <span class="label label-warning">CHỜ XỬ LÝ</span>
                                    @elseif($telservice->status == 'none')
                                        <span class="label label-default">NHÁP</span>
                                    @elseif($telservice->status == 'canceled')
                                        <span class="label label-danger">ĐÃ HỦY</span>
                                    @else
                                        <span class="label label-default">CHƯA RÕ</span>
                                    @endif

                                </td>
                                <td>{{number_format($telservice->pay_amount)}} {{$telservice->currency_code}}</td>

                                <td>{{date('d-m-Y H:i', strtotime($telservice->created_at))}}</td>

                                <td>

                                    <a href="{{url('/order/detail/'.$telservice->order_code)}}"><button type="submit" class="btn btn-info btn-xs" value="delete">Xem đơn</button></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    {{$order_telservice->links()}}
                </div>
            </div>

</div>

</div>
</div>


@endsection