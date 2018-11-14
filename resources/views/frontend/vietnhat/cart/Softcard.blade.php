<table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Tên dịch vụ</th>
        <th style="width:15%">Đơn giá</th>
        <th style="width:15%">SL</th>
        <th style="width:20%" class="text-center">Thành tiền</th>
    </tr>

    </thead>
    <tbody>

    @foreach($items as $item)
        <tr>
            <td data-th="product"><strong>{{ $item->product }} (-{{$item->discount}}%)</strong></td>
            <td data-th="price">{{$currency->symbol_left}}{{ number_format($item->price,$currency->decimal) }}{{$currency->symbol_right}}</td>
            <td data-th="qty">{{ $item->qty }}</td>
            <td data-th="subtotal" class="text-center">{{$currency->symbol_left}}{{ number_format($item->subtotal,$currency->decimal) }}{{$currency->symbol_right}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pull-right">
    <h3>Tổng: {{$currency->symbol_left}}{{ number_format($total, $currency->decimal) }}{{$currency->symbol_right}}</h3>
</div>

<div class="clearfix"></div>
