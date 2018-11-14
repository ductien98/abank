<div class="sidebar">

    @if(Auth::check())
        @theme_include('account.userpanel')
    @endif




    @if(isset($list_news) && count($list_news))

        <h4><span><i class="fa fa-newspaper-o"></i> Tin mới</span></h4>

        @foreach($list_news as $post)
            <div class="heading">
                <div><a href="{{ url('tin-tuc').'/'.$post->url_key }}">{{ $post->title }}</a></div>
                <div><a href="{{ url('tin-tuc').'/'.$post->url_key }}" class="readmore">Xem thêm...</a></div>
            </div>

        @endforeach



    @endif



</div>

