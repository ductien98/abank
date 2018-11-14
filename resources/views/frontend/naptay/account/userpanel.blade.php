
<div>
    <h4>Số dư: {{ session()->get('currency')->symbol_left}}{{ number_format(App\Modules\Wallet\Models\Wallet::where(['user'=>Auth::user()->id, 'currency_id' => session()->get('currency')->id])->select('balance_decode')->first()->balance_decode, session()->get('currency')->decimal) }} {{ session()->get('currency')->symbol_right}}</h4>
</div>
<div style="padding: 5px"><a href="{{ url('profile') }}"><i class="fa fa-angle-right"></i> <strong>Thông tin tài khoản</strong></a></div>
<div style="padding: 5px"><a href="{{ url('/user/orders') }}"><i class="fa fa-angle-right"></i> <strong>Đơn hàng</strong></a></div>
<div style="padding: 5px"><a href="{{ url('wallet') }}"><i class="fa fa-angle-right"></i> <strong>Ví điện tử</strong></a></div>
<div style="padding: 5px"><a href="{{ url('transfer') }}"><i class="fa fa-angle-right"></i> <strong>Chuyển tiền</strong></a></div>
<div style="padding: 5px"><a href="{{ url('wallet/deposit') }}"><i class="fa fa-angle-right"></i> <strong>Nạp tiền</strong></a></div>
<div style="padding: 5px"><a href="{{ url('wallet/withdraw') }}"><i class="fa fa-angle-right"></i> <strong>Rút tiền</strong></a></div>
<div style="padding: 5px"><a href="{{ url('wallet/transactions') }}"><i class="fa fa-angle-right"></i> <strong>Lịch sử ví</strong></a></div>
<div style="padding: 5px"><a href="{{ url('user/localbank') }}"><i class="fa fa-angle-right"></i> <strong>Tài khoản ngân hàng</strong></a></div>
<div style="padding: 5px"><a href="{{ url('change-password') }}"><i class="fa fa-angle-right"></i> <strong>Đổi mật khẩu</strong></a></div>
<div style="padding: 5px"><a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-angle-right"></i> <strong>@lang('profiles.logout')</strong></a></div>
{!! Form::open(array('route' => 'logout','method'=>'POST', 'id'=>'logout-form', 'style'=>"display: none;")) !!}{!! Form::close() !!}
