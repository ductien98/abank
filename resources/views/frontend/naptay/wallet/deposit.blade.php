@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('depositwallet'))
@section('content')
    @theme_include('errors.errors')
    <section class="main">
        <div class="blockContent">
            <h4><span class="text-uppercase">Tạo yêu cầu nạp tiền</span></h4>

            {!! Form::open(array('route' => 'frontend.wallet.deposit','method'=>'POST')) !!}
            <div class="card-body row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="FormControlSelect">Chọn ví muốn nạp</label>
                        <select name="wallet" class="form-control" style="padding: 0px">
                            @if(count($listwallets)>0)
                            @foreach($listwallets as $wallet)
                                <option value="{{$wallet->number}}">{{$wallet->number}} ( {{number_format($wallet->balance_decode)}} {{$wallet->currency_code}} )</option>
                            @endforeach
                                @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="net_amount">Số tiền muốn nạp:</label>
                        <input name="net_amount" type="text" class="form-control" id="net_amount" placeholder="Số tiền" value="{{ old('net_amount') }}" >
                    </div>

                    <div class="form-group">
                        <label for="payment">Hình thức thanh toán:</label>
                        <select name="paygate_code" class="form-control" style="padding: 0px">
                        <option></option>
                            @if(count($paygates)>0)
                            @foreach($paygates as $key => $paygate)
                            <option value="{{$paygate['payment']}}.{{$paygate['code']}}">{{$paygate['name']}}</option>
                            @endforeach
                                @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Nội dung nạp tiền:</label>
                    <textarea name="description" class="form-control">{{ Auth::user()->name }} nạp tiền vào ví điện tử</textarea>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Nạp tiền ngay</button>
            </div>
            {!! Form::close() !!}

<br><br><br>

            <h4><span class="text-uppercase">Lịch sử đơn hàng nạp tiền</span></h4>

            <table id="example1" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>

                    <th>Mã GD</th>
                    <th>Nạp vào ví</th>
                    <th>Số tiền</th>
                    <th>Ngân hàng nhận</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @if(count($deposits)>0)
                @foreach( $deposits as $deposit )
                    <tr>

                        <td>{{$deposit->order_code}}<br></td>
                        <td>{{$deposit->payee_wallet}}</td>
                        <td>+{{number_format($deposit->net_amount)}} {{$deposit->currency_code}}</td>
                        <td>
                            {!! $deposit->payment_acc !!}
                        </td>
                        <td>{{date('d-m-Y H:i', strtotime($deposit->created_at))}}</td>
                        <td>
                            @if($deposit->status == 'completed')
                                <span class="label label-success">HOÀN THÀNH</span>
                            @elseif($deposit->status == 'pending')
                                <span class="label label-warning">CHỜ XỬ LÝ</span>
                            @elseif($deposit->status == 'none')
                                <span class="label label-default">CHỜ THANH TOÁN</span>
                            @elseif($deposit->status == 'canceled')
                                <span class="label label-danger">ĐÃ HỦY</span>
                            @else
                                <span class="label label-default">CHƯA RÕ</span>
                            @endif
                        </td>
                        <td>
                            @if($deposit->link)
                            <a href="{{$deposit->link}}"><button class="btn btn-info btn-sm">Xem</button></a>
                                @endif
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>


            </table>

            {{$deposits->links()}}
        </div>
    </section>




@endsection
