<footer class="bg-dark">
    <div class="container">
        <div class="row">
            @theme_include('widgets.footer-menu')
            <div class="col-sm-12 copyright colorW text-center">
                <span>@if(isset($settings['copyright'])) {{ $settings['copyright'] }} @endif</span>
            </div>
        </div>
    </div>
</footer>
