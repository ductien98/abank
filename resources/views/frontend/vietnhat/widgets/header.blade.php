<header class="header-top">
    <div class="navigation-wrapper fix-top">
        <div class="container"><span>
              <nav class="navbar">
                <div>
                  <!-- Brand and toggle get grouped for better mobile display-->
                  <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                  </div><a class="navbar-brand" href="{{url('/')}}"><img src="{{ url($settings['logo']) }}" alt=""/></a>
                    <!-- Collect the nav links, forms, and other content for toggling-->

                    @theme_include('widgets.header-menu')

                </div>
              </nav></span></div>
    </div>
    <div class="breaking-new-wrapper" style="margin-top:20px">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="breaking-new-wrapper">
                        <div class="title-head"><i class="fa fa-bullhorn" aria-hidden="true"></i> Thông báo: </div>
                        <ul class="breaking-new owl-carousel">

                            @foreach($news as $newsi)
                            <li><a href="{{url('tin-tuc/'.$newsi['url_key'])}}">{{$newsi['title']}}</a></li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>