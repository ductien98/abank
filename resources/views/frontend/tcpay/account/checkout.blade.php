@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('checkout'))

@section('content')
    @theme_include('errors.errors')
    <div class="fullColumn">

            <h3>Thanh toán đơn hàng</h3>

        {!! $cart !!}

            <p>Hình thức thanh toán: <b>{{$order->paygate_code}}</b></p>

            <form action="{{ $actionUrl }}" method="POST">
                {{ csrf_field() }}

                @if($twofactor !== null)
                    {!! $twofactor !!}
                    <br>
                @endif

                <input type="hidden" name="action" value="doPayment">
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-warning btn-block">Thanh toán ngay <i class="fa fa-angle-right"></i></button>
            </form>

    </div>


@endsection
