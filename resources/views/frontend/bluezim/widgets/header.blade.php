@if( ! Auth::check() )
    <a href="{{ url('login') }}" class="animated-arrow right-menu-toggle off-menu mobile-user-icon"><span></span></a>
@else
    <a class="animated-arrow right-menu-toggle off-menu mobile-user-icon"><span></span></a>
    <div class="rightVerticleMenu off-menu">
        <div class="brand-block"><a class="navbar-brand" href="{{url('/')}}"><img src="{{ url($settings['logo']) }}" alt=""/></a></div>
        <div class="content-menu">
            <ul class="list-menu listMenuUserPanel">
                @theme_include('account.userpanel')
            </ul>
        </div>
    </div>
@endif

<header class="header-top">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ url($settings['logo']) }}" alt=""/>
            </a>
        </div>

        @theme_include('widgets.header-menu')

        @if( ! Auth::check() )
            <span class="pull-right user-header">
                    <span class="separate">&nbsp;</span>
                    <a href="{{ url('register') }}" class="btn btn-third">
                        <i class="icon ion-android-person"></i> Đăng ký
                    </a>
                    <a href="{{ url('login') }}" class="btn btn-second">
                        <i class="fa ion ion-android-unlock"></i> Đăng nhập

                    </a>
                </span>
        @else
            <span class="pull-right loginBox">
                <span class="navi-wrapper">
                        <div class="navigation">
                            <ul>

                        <li>


                          <i class="fa fa-money"
                             aria-hidden="true"></i> {{ session()->get('currency')->symbol_left}}{{ number_format(App\Modules\Wallet\Models\Wallet::where(['user'=>Auth::user()->id, 'currency_id' => session()->get('currency')->id])->select('balance_decode')->first()->balance_decode, session()->get('currency')->decimal) }} {{ session()->get('currency')->symbol_right}}

                            </li>
                                <li>
                                    <a href="{{ url('profile') }}"><i class="fa fa-user"
                                                                      aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                                    <ul>
                                        <li>
                                            <a href="{{ url('profile') }}">@lang('profiles.account')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('change-password') }}">@lang('profiles.changepassword')</a>
                                        </li>

                                        <li>
                                            <a href="{{ url('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('profiles.logout')</a>
                                            {!! Form::open(array('route' => 'logout','method'=>'POST', 'id'=>'logout-form', 'style'=>"display: none;")) !!}{!! Form::close() !!}
                                        </li>
                                    </ul>
                                </li>



                            </ul>


                        </div>
                </span>
            </span>
        @endif
        {{--@if(isset($currencies))--}}
        {{--<span class="pull-right">--}}
        {{--<span class="navi-wrapper">--}}
        {{--<div class="navigation">--}}
        {{--<form action="{{ url('/set-site-currency') }}" id="change-currency-form" method="POST">--}}
        {{--@csrf--}}
        {{--<select id="site-currency" name="currency_id" onchange="changeCur()">--}}
        {{--@foreach($currencies as $currency)--}}
        {{--<option value="{{ $currency->id }}" @if(session()->has('currency') && session()->get('currency')->id==$currency->id) selected="selected" @endif>{{ $currency->code }}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--<script>--}}
        {{--function changeCur() {--}}
        {{--document.getElementById("change-currency-form").submit();--}}
        {{--}--}}
        {{--</script>--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--</span>--}}
        {{--</span>--}}
        {{--@endif--}}
    </div>
</header>