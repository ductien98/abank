<div class="sidebar">

    @if(Auth::check())
        @theme_include('account.userpanel')
        @endif
</div>


<div class="sidebar border-left">
    <h3 class="title">VIDEO</h3>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                @php $youtube = explode('watch?v=', $settings['youtube']) @endphp
                <iframe width="100%"  src="https://www.youtube.com/embed/@if(count($youtube) > 1){{$youtube[1]}}@endif" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</div>

@if(isset($list_news) && count($list_news))
<div class="sidebar border-left">
    <div class="blockTitle row lineHorizontal">
        <h3><span><i class="fa fa-newspaper-o"></i> Tin mới</span></h3>
    </div>
    <div class="blockContent row">
        <div class="content-side">
            @foreach($list_news as $post)
            <div class="fullImage small-blockitem">
                <div class="blockCase">
                    <div class="cover">
                        <a href="{{ url('tin-tuc').'/'.$post->url_key }}"><img src="{{ asset($post->image) }}" alt=""/></a>
                    </div>
                    <div class="heading">
                        <h3><a href="{{ url('tin-tuc').'/'.$post->url_key }}">{{ $post->title }}</a></h3>
                    </div><a href="{{ url('tin-tuc').'/'.$post->url_key }}" class="readmore">Xem thêm...</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

