
@if(isset($footer_menu) && count($footer_menu))
    @foreach($footer_menu as $fmenu)
        <div class="col-sm-4">

            <span class="listFooter wow animated slideInUp"><a class="title">{{ $fmenu['data']['name'] }}</a></span>
            <div class="info-pg">
                @if($fmenu['data']['children_count'])
                    @foreach($fmenu['childs'] as $child)
                        <a class="contact-line" href="{{ $child['data']['url'] }}">
                            <span>{{ $child['data']['name'] }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
@endif
