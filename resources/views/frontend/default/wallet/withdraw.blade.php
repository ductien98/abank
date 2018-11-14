@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('withdrawwallet'))
@section('content')
    @theme_include('errors.errors')
    <section class="main">
        <div class="blockContent">
            <h4><span class="text-uppercase">Tạo yêu cầu rút tiền</span></h4>

            {!! Form::open(array('route' => 'frontend.wallet.withdraw','method'=>'POST')) !!}
            <div class="card-body row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="FormControlSelect">Chọn ví muốn rút</label>
                        <select name="wallet" class="form-control" style="padding: 0px">
                            @foreach($listwallets as $wallet)
                                <option value="{{$wallet->number}}">{{$wallet->number}}
                                    ( {{number_format($wallet->balance_decode)}} {{$wallet->currency_code}} )
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="net_amount">Số tiền muốn rút:</label>
                        <input name="net_amount" type="text" class="form-control" id="net_amount" placeholder="Số tiền"
                               value="{{ old('net_amount') }}">
                    </div>

                    <div class="form-group">
                        <label for="paygate_code">Hình thức nhận tiền:</label>
                        <select name="paygate_code" class="form-control" style="padding: 0px" id="mySelect"
                                onchange="bankcode(this)">
                            <option value=""></option>
                            @foreach($list_pagates as $paygate)
                                <option value="{{$paygate->code}}">{{$paygate->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="userbank">
                    </div>

                    <div class="form-group">
                        <label for="description">Nội dung rút tiền:</label>
                        <textarea name="description" class="form-control">{{ Auth::user()->name }} rút tiền từ ví điện tử</textarea>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Rút tiền ngay</button>
            </div>
            {!! Form::close() !!}

            <br><br><br>

            <h4><span class="text-uppercase">Lịch sử đơn hàng rút tiền</span></h4>

            <table class="table table-bordered table-striped dataTable">
                <thead>
                <tr>

                    <th>Mã GD</th>
                    <th>Rút từ ví</th>
                    <th>Số tiền</th>
                    <th>Tài khoản nhận</th>
                    <th>Ngày tạo</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $withdraws as $withdraw )
                    <tr>

                        <td>{{$withdraw->order_code}}</td>
                        <td>{{$withdraw->payer_wallet}}</td>
                        <td>-{{number_format($withdraw->net_amount)}} {{$withdraw->currency_code}}</td>

                        <td>
                            {!! $withdraw->payer_info !!}
                        </td>

                        <td>{{date('d-m-Y H:i', strtotime($withdraw->created_at))}}</td>
                        <td>{{$withdraw->description}}</td>
                        <td>

                            @if($withdraw->status == 'completed')
                                <span class="label label-success">HOÀN THÀNH</span>
                            @elseif($withdraw->status == 'pending')
                                <span class="label label-warning">ĐỢI CHUYỂN</span>
                            @elseif($withdraw->status == 'none')
                                <span class="label label-default">NHÁP</span>
                            @elseif($withdraw->status == 'canceled')
                                <span class="label label-danger">ĐÃ HỦY</span>
                            @else
                                <span class="label label-default">CHƯA RÕ</span>
                            @endif

                        </td>
                    </tr>
                @endforeach

                </tbody>


            </table>
    {{$withdraws->links()}}
</div></section>

    <div class="hidden" id="payment-render-Localbank">
        <label>Chọn ngân hàng</label>
        <select id="paymentlist" name="bankinfo_id" class="form-control" style="padding: 0px">
            @foreach($listuserbank as $userbank)
                <option value="{{$userbank->id}}">{!! $userbank->name. ' ' .$userbank->branch.' / STK: '.$userbank->acc_num.', CTK: '.$userbank->acc_name !!}</option>
            @endforeach
        </select>
    </div>


@endsection



@section('js-footer')
<script type="text/javascript">
    function bankcode(element) {
        document.getElementById("userbank").innerHTML = '';
        payment = element.value;
        html = document.getElementById('payment-render-'+payment).innerHTML;
        document.getElementById("userbank").innerHTML = html;
    }
</script>
@endsection

