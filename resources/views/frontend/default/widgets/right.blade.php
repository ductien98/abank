<div class="row">
    <div class="sidebar">

        @if(Auth::check())
            <div class="block box-shadow">
                <h3 class="block-header"><a href="#somewhere">Thông tin tài khoản</a></h3>
                <div class="block-content">
                    <div class="row">
                        <div class="col-sm-12">

                            @theme_include('account.userpanel')

                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="block box-shadow">
            <h3 class="block-header text-second"><a href="#somewhere">VIDEO</a></h3>
            <div class="block-content">
                <div class="row">
                    <div class="col-sm-12">
                            @php $youtube = explode('watch?v=', $settings['youtube']) @endphp
                        <iframe width="255" height="180" src="https://www.youtube.com/embed/@if(count($youtube) > 1){{$youtube[1]}}@endif" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                    </div>
                </div>
            </div>
        </div>

        @if(isset($list_news) && count($list_news))
            <div class="block box-shadow">
                <h3 class="block-header"><a href="#somewhere">Tin tức</a></h3>
                <div class="block-content">
                    <div class="row">
                        <div class="col-sm-12">

                            @foreach($list_news as $post)
                                <div class="blogItem normalCat"><a class="cover" href="{{ url('tin-tuc').'/'.$post->url_key }}"><img src="{{ asset($post->image) }}" width="80" alt="news"/></a>
                                    <div class="detail"><a class="title" href="{{ url('tin-tuc').'/'.$post->url_key }}">{{ $post->title }}</a>
                                        <div class="info-meta"><span class="info-inline"><i class="fa fa-calendar-o"></i>{{ $post->created_at }}</span></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif



    </div>
</div>
