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
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/59df494b4854b82732ff51b3/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->