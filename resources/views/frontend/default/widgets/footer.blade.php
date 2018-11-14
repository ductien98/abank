<footer class="bg-dark">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-md-4">

                    <div class="listFooter wow animated slideInUp"><a class="title">{{$settings['name']}}</a>
                        <div class="addressBlock">
                            <div class="info-pg">
                                <div class="content">
                                    <div><i class="fa fa-map-marker"></i><span>&nbsp;{{$settings['address']}}</span></div>
                                    <div><i class="fa fa-envelope">  </i><span>&nbsp;{{$settings['email']}}</span></div>
                                    <div><i class="fa fa-facebook"></i><span>{{$settings['facebook']}}</span></div>
                                    <div><i class="fa fa-phone"></i><span>{{$settings['phone']}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @theme_include('widgets.footer-menu')

                </div>
            </div>


            <div class="col-sm-12 copyright text-center wow animated slideInUp"><span>@if(isset($settings['copyright'])) {{ $settings['copyright'] }} @endif</span></div>
        </div>
    </div>
</footer>
