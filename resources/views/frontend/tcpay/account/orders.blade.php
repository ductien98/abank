@extends('frontend.'.$current_theme.'.app')
@section('breadcrumbs', Breadcrumbs::render('orderuser'))
@section('content')
    <h4><span class="text-uppercase">Đơn hàng mua mã thẻ</span></h4>
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
                        @foreach( $orders_softcard as $softcard )
                            <tr>
                                <td>{{$softcard->order_code}}</td>
                                <td>
                                    {!! App\Modules\Order\Models\Order::getlistproduct($softcard) !!}
                                </td>
                                <td>

                                    @if($softcard->payment == 'paid')
                                        <span class="label label-success">ĐÃ THANH TOÁN</span>
                                    @elseif($softcard->payment == 'unpaid')
                                        <span class="label label-warning">CHƯA THANH TOÁN</span>
                                    @elseif($softcard->payment == 'refunded')
                                        <span class="label label-primary">ĐÃ HOÀN TIỀN</span>
                                    @elseif($softcard->payment == 'none')
                                        <span class="label label-default">NHÁP</span>
                                    @elseif($softcard->payment == 'canceled')
                                        <span class="label label-danger">ĐÃ HỦY</span>
                                    @else
                                        <span class="label label-default">CHƯA RÕ</span>
                                    @endif

                                </td>
                                <td>

                                    @if($softcard->status == 'completed')
                                        <span class="label label-success">HOÀN THÀNH</span>
                                    @elseif($softcard->status == 'pending')
                                        <span class="label label-warning">CHỜ XỬ LÝ</span>
                                    @elseif($softcard->status == 'none')
                                        <span class="label label-default">NHÁP</span>
                                    @elseif($softcard->status == 'canceled')
                                        <span class="label label-danger">ĐÃ HỦY</span>
                                    @else
                                        <span class="label label-default">CHƯA RÕ</span>
                                    @endif

                                </td>
                                <td>{{number_format($softcard->pay_amount)}} {{$softcard->currency_code}}</td>

                                <td>{{date('d-m-Y H:i', strtotime($softcard->created_at))}}</td>

                                <td>

                                    <a href="{{url('/order/detail/'.$softcard->id)}}"><button type="submit" class="btn btn-info btn-xs" value="delete">Xem đơn</button></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    {{$orders_softcard->links()}}
                </div>
            </div>

</div>

</div>
</div>


@endsection