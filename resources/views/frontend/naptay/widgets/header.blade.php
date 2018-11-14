@if( ! Auth::check() )
    <a href="{{ url('login') }}" class="animated-arrow right-menu-toggle off-menu mobile-user-icon"><span></span></a>
@else
    <a class="animated-arrow right-menu-toggle off-menu mobile-user-icon"><span></span></a>
    <div class="rightVerticleMenu off-menu">
        <div class="brand-block"><img src="{{theme_asset('images/logo.png')}}" alt=""/></div>
        <div class="content-menu">
            <ul class="list-menu listMenuUserPanel">
                @theme_include('account.userpanel')
            </ul>
        </div>
    </div>
@endif

<header class="header-top padding-top-15 padding-bottom-15">
    <div class="container">
        <a href="{{ url('/') }}"><h1 class="logo col-md-2"><img src="{{theme_asset('images/logo.png')}}" alt=""/></h1></a>
        <div class="right-head" >
            <div class="specialHotline "><span class="iconPhoneLarg"></span><a class="phoneNumber">{{$settings['phone']}}</a><span class="lastText">tư vấn 24/7</span><br/><a class="subline">Email: {{$settings['email']}}</a></div>
        </div>
    </div>
</header>

<div class="breaking-new-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                    <ul class="breaking-new owl-carousel">
                        @foreach($news as $newsi)
                            <li><a href="{{url('tin-tuc/'.$newsi['url_key'])}}">{{$newsi['title']}}</a></li>
                        @endforeach
                    </ul>

            </div>
        </div>
    </div>
</div>
@theme_include('widgets.header-menu')

