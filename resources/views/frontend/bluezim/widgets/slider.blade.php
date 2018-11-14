
@if(isset($sliders) && count($sliders))
    <div class="container section-slider">
        <div class="col-sm-12">
            <div class="row">
                <div class="slider">
                    <div class="owl-carousel owl-theme">
                        @foreach($sliders as $slider)
                            <div class="item">
                                <div class="col-sm-5 pull-right"><img src="{{asset($slider->slider_image)}}" alt="{{ $slider->slider_name }}"/></div>
                                <div class="container">
                                    <div class="caption col-sm-7">
                                        <h3>{{ $slider->slider_name }}</h3>
                                        <p>{{ $slider->slider_text }}</p>
                                        <?php if($slider->slider_btn_text!='') $btnTxt = $slider->slider_btn_text; else $btnTxt = 'Xem chi tiết'; ?>
                                        <a href="{{ $slider->slider_btn_url }}" class="btn btn-second text-uppercase">{{ $btnTxt }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif