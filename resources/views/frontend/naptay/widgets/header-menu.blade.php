<nav class="navi-wrapper fix-top">
    <div class="container">
        <div class="navigation">
            <ul class="pull-left">
                @if(isset($menu) && count($menu))
                    @foreach($menu as $item)
                        <li>
                            <a @if(strpos($item['data']['url'],'http')) href="{{ $item['data']['url'] }}" @else href="{{ url($item['data']['url']) }}" @endif>{{ $item['data']['name'] }}</a>@if($item['data']['children_count'] > 0)
                                <ul>
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

        </div>
        @if( ! Auth::check() )
            <span class="pull-right">
                <span class="navi-wrapper">
                    <div class="navigation">
                <ul class="loginGroup">
                    <li>
                        <a href="{{ url('register') }}" class="btnLogin">
                            <span class="btn-text">Đăng ký</span>
                        </a></li>
                    <li>
                        <a href="{{ url('login') }}" class="btnLogin">
                            <span class="btn-text">Đăng nhập</span>
                        </a></li>
                    </span>
                </ul>
                </div>
                </span>
            </span>
        @else
            <span class="pull-right loginBox">
                <span class="navi-wrapper">
                    <div class="navigation">
                        <ul>
                            <li>
                                <a href="/profile"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                                <ul>
                                    <li>
                                        <a href="{{ url('profile') }}">@lang('profiles.account')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('change-password') }}">@lang('profiles.changepassword')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('profiles.logout')</a>
                                        {!! Form::open(array('route' => 'logout','method'=>'POST', 'id'=>'logout-form', 'style'=>"display: none;")) !!}{!! Form::close() !!}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </span>
        @endif
    </div>
</nav>
