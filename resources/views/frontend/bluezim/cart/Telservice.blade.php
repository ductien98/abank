<table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Tên dịch vụ</th>
        <th style="width:15%">Muốn thanh toán</th>
        <th style="width:10%">Chiết khấu</th>
        <th style="width:10%">Phí xử lý</th>
        <th style="width:15%" class="text-center">Thành tiền</th>
    </tr>

    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td data-th="product"><strong> {{ json_decode($item->cart_content)->name }}</strong></td>
            <td data-th="price">{{ number_format($item->amount, $currency->decimal) }}đ</td>
            <td data-th="price">-{{$item->discount}}%</td>
            <td data-th="feee">+{{$item->handling_fees}}%</td>
            <td data-th="subtotal"
                class="text-center">{{$currency->symbol_left}}{{ number_format($item->pay_amount, $currency->decimal) }}{{$currency->symbol_right}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pull-right">
    <h3>Tổng: {{$currency->symbol_left}}{{ number_format($total, $currency->decimal) }}{{$currency->symbol_right}}</h3>
</div>
<div class="clearfix"></div>







