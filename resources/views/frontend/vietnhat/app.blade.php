<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    @yield('meta-tags')
    <title>@if(isset($title)) {{ $title }} @elseif(isset($settings['title'])) {{ $settings['title'] }} @endif</title>
    @theme_include('widgets.headcss')
    @yield('customstyle')
</head>
<body>
<div class="page category">
    @theme_include('widgets.topmenu')
    @theme_include('widgets.header')
    @yield('breadcrumbs')
    <section class="main">
        <div class="mainFrontPage">
            <div class="container">
                <div class="col-sm-12">

                    @yield('content')

                </div>

            </div>
        </div>

        @theme_include('widgets.weblinks')
    </section>

    @theme_include('widgets.footer')
</div>
@theme_include('widgets.systemjs')
@yield('js-footer')
</body>

</html>