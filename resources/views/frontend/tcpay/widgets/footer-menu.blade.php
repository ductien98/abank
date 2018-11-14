
@if(isset($footer_menu) && count($footer_menu))
    @foreach($footer_menu as $fmenu)
<div class="col-sm-4 col-sm-12">
    <div class="listFooter wow animated slideInUp"><a class="title">{{ $fmenu['data']['name'] }}</a>
        @if($fmenu['data']['children_count'])
            <div class="info-pg">
            @foreach($fmenu['childs'] as $child)
        <a class="contact-line" href="{{ $child['data']['url'] }}"><span>{{ $child['data']['name'] }}</span></a>
            @endforeach
            </div>
        @endif
    </div>
</div>
    @endforeach
@endif
