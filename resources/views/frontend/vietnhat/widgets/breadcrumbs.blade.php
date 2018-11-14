<div class="container">
    @if (isset($breadcrumbs) && count($breadcrumbs))
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            @foreach ($breadcrumbs as $key => $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                        <meta itemprop="position" content="{{$key+1}}">
                    </li>
                @else
                    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">{{ $breadcrumb->title }}
                        <meta itemprop="position" content="{{$key+1}}">
                    </li>
                @endif
            @endforeach
        </ol>
    @endif
</div>