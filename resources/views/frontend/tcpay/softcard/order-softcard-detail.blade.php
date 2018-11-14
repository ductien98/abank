@extends('frontend.'.$current_theme.'.common93')
@section('breadcrumbs', Breadcrumbs::render('default','Chi tiết đơn hàng mua mã thẻ'))
@section('content')
    {{--Dữ liệu ở đây lấy từ SofcardFrontController\getPageSuccess--}}

                <div class="fullColumn">
                    <h4><strong>Thông tin đơn hàng</strong></h4>

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">

                            <p class="mb-1">Mã đơn hàng</p>
                            <p>Thời gian</p>
                            <p class="mb-1">Berlin, Germany</p>
                            <p class="mb-1">6781 45P</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="mb-1"><span class="text-muted">{{$order->order_code}}</span></p>
                            <p class="mb-1"><span class="text-muted">{{ $order->updated_at }}</span></p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span></p>
                            <p class="mb-1"><span class="text-muted">Name: </span></p>
                        </div>
                    </div>







                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="http://www.mirchu.net/mobiles/apple-iphone-6/" target="_blank">Apple iphone 6</a></td>
                            <td>Waqas Hussain</td>
                            <td>example@mirchu.net</td>
                            <td>11/6/2014</td>
                            <td>$899.00</td>
                            <td><span class="label label-info">Processing</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="http://www.mirchu.net/mobiles/lg-g3/" target="_blank">LG G3</a></td>
                            <td>Basit Raza</td>
                            <td>example@bugpluss.com</td>
                            <td>10/6/2014</td>
                            <td>$621.00</td>
                            <td><span class="label label-success">Shipped</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="http://www.mirchu.net/mobiles/samsung-galaxy-s5/" target="_blank">Samsung Galaxy S5</a></td>
                            <td>Raza Ahmed</td>
                            <td>example@therazz.net</td>
                            <td>11/9/2013</td>
                            <td>$640.00</td>
                            <td><span class="label label-info">Processing</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="http://www.mirchu.net/rook-bootstrap-app-landing-page/" target="_blank">Rook Landing Page</a></td>
                            <td>Mirchu net</td>
                            <td>example@mirchu.net</td>
                            <td>11/6/2014</td>
                            <td>$12.00</td>
                            <td><span class="label label-primary">Completed</span></td>
                        </tr>
                        </tbody>
                    </table>






                    <div>Thời gian:<b> {{ $order->updated_at }}</b></div>
                </div>
                <br>
                <div id="content">
                    @theme_include('errors.errors')
                    {!! $response !!}
                </div>

@endsection
