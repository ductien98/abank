<table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Tên dịch vụ</th>
        <th style="width:15%">Muốn nạp</th>
        <th style="width:15%">Giá</th>
        <th style="width:20%" class="text-center">Thành tiền</th>
    </tr>

    </thead>
    <tbody>

    @foreach($items as $item)
        <tr>
            <td data-th="product">Nạp tiền thuê bao<strong> {{ $item->phone_number }}</strong></td>
            <td data-th="price">{{ number_format($item->declared_value, $currency->decimal) }}đ</td>
            <td data-th="price">{{$currency->symbol_left}}{{ number_format($item->amount,$currency->decimal) }}{{$currency->symbol_right}}</td>
            <td data-th="subtotal"
                class="text-center">{{$currency->symbol_left}}{{ number_format($item->amount, $currency->decimal) }}{{$currency->symbol_right}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pull-right">
    <h3>Tổng: {{$currency->symbol_left}}{{ number_format($total, $currency->decimal) }}{{$currency->symbol_right}}</h3>
</div>
<div class="clearfix"></div>







