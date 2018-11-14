<style>
    #mtopup-form ul {
        padding: 0;
    }
    #mtopup-form li {
        padding:5px;
        list-style:none;
        display:inline-block;
    }
    #mtopup-form img{
        width:100%;
    }

    #mtopup-form  li.active{
        border:3px solid #42b873;
        padding:0px;
    }
    #mtopup-form input[type=radio]{
        display:none;
    }


</style>
<div class="clearfix" style="margin-bottom: 15px"></div>
<div class="text-left">
    <div class="title"><strong>Phương thức thanh toán:</strong></div>

    <div class="list-banks-detail"></div>

    <ul id="payment-select-wrapper">
        <li class="active">
            <a data-payment-code="Wallet" class="select-payment-btn" onClick="return false;" href="#"> <img width="120px" height="66px" src="{{theme_asset('images/paygate/ewallet.png')}}"> </a>
            <input id="payment-Wallet" class="radio" type="radio" value="Wallet.Wallet" name="paygate_code" checked="checked">
        </li>
        @if(count($paygates)>0)
        @foreach($paygates as $paygate)
            <li>
                <a data-payment-code="{{$paygate['code']}}" class="select-payment-btn" onClick="return false;" href="#"> <img  width="120px" height="66px" src="{{url($paygate['image'])}}"> </a>
                <input id="payment-{{$paygate['code']}}" class="radio" type="radio" value="{{$paygate['payment']}}.{{$paygate['code']}}" name="paygate_code">
            </li>
        @endforeach
            @endif
    </ul>

</div>