<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta-tags')
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="robots" content="index, follow" />

    @theme_include('widgets.headcss')
    @yield('customstyle')
</head>
<body>
<div class="page homepage">
    @theme_include('widgets.topmenu')
    @theme_include('widgets.header')
    @theme_include('widgets.slider')

    <section class="main">
        <div class="mainFrontPage">
            <div class="container">
                <div class="col-sm-9">
                    @theme_include('errors.errors')
                    @yield('content')

                </div>
                <div class="col-sm-3">
                    @theme_include('widgets.right')
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