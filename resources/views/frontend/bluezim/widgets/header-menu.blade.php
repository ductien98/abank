<span class="navi-wrapper">
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
</span>
