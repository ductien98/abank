@if(isset($sliders) && count($sliders))
    <div class="slider-wrapper">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="slider" autoplay="true">
                        <div class="owl-carousel owl-theme">
                            @foreach($sliders as $slider)
                                <div class="item">
                                    <div class="col-sm-12">
                                        <div class="row"><img src="{{asset($slider->slider_image)}}" alt="{{ $slider->slider_name }}"/></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="clearfix"></div>