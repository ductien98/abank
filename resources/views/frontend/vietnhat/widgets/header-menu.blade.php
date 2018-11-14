<div class="collapse navbar-collapse" id="bs-navbar-collapse">
    <ul class="nav navbar-nav">
        @if(isset($menu) && count($menu))

            @foreach($menu as $item)

                <li @if($item['data']['children_count'] > 0)  class=" dropdown" @endif >
                    <a  @if($item['data']['children_count'] > 0) class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" @endif   @if(strpos($item['data']['url'],'http')) href="{{ $item['data']['url'] }}" @else href="{{ url($item['data']['url']) }}" @endif><span>{{ $item['data']['name'] }}</span>@if($item['data']['children_count'] > 0)<span class="caret"></span>@endif</a>
                    @if($item['data']['children_count'] > 0)
                        <ul class="dropdown-menu">
                            @foreach($item['childs'] as $child)
                                <li>
                                    <a @if(strpos($child['data']['url'],'http')) href="{{ $child['data']['url'] }}" @else href="{{ url($child['data']['url']) }}" @endif>{{$child['data']['name']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
    <ul class="nav navbar-nav user-right-menu">

        @if(!Auth::check())
            <li class="text-center "><a class="btn btn-second" href="{{ url('register') }}"><i class="fa fa-sign-in"></i> Đăng ký</a>&nbsp;<a class="btn btn-third" href="{{ url('login') }}"><i class="fa fa-lock"></i> Đăng nhập</a>
            </li>
        @endif
        @if(Auth::check())

            <li class="text-center">
                <a class="dropdown-toggle"><i class="fa fa-money" aria-hidden="true"></i> {{ session()->get('currency')->symbol_left}}{{ number_format(App\Modules\Wallet\Models\Wallet::where(['user'=>Auth::user()->id, 'currency_id' => session()->get('currency')->id])->select('balance_decode')->first()->balance_decode, session()->get('currency')->decimal) }} {{ session()->get('currency')->symbol_right}}</a>
            </li>

            <li class=" dropdown"><a class="dropdown-toggle" href="/acount.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>TÀI KHOẢN</span><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('profile') }}"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                    </li>
                    <li><a href="{{ url('profile') }}">@lang('profiles.account')</a>
                    </li>
                    <li><a href="{{ url('change-password') }}">@lang('profiles.changepassword')</a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('profiles.logout')</a>
                        {!! Form::open(array('route' => 'logout','method'=>'POST', 'id'=>'logout-form', 'style'=>"display: none;")) !!}{!! Form::close() !!}

                    </li>
                </ul>
            </li>
        @endif
    </ul>
</div>
