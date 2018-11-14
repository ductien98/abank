@extends('frontend.'.$current_theme.'.common')

@section('breadcrumbs', Breadcrumbs::render('telservice','Thanh toán hóa đơn'))

@section('customstyle')
@endsection

@section('content')
    <section class="main">
        <div class="row blockContent">
            <div class="col-sm-12 right-seperate">
                <div class="card-game-panel">
                    @theme_include('errors.errors')
                    <h3 class="panel-title">THANH TOÁN HÓA ĐƠN</h3>

                    <a href="{{route('frontend.telservice.internet')}}">
                        <button type="button" class="btn btn-primary">Cước Internet</button>
                    </a>
                    <a href="{{route('frontend.telservice.homephone')}}">
                        <button type="button" class="btn btn-default">Điện thoại cố định</button>
                    </a>
                    <a href="{{route('frontend.telservice.television')}}">
                        <button type="button" class="btn btn-default">Truyền Hình</button>
                    </a>


                    <h1 style="font-size: medium">Thanh toán cước Internet</h1>

                    <br>


                    <form id="mtopup-form" action="{{ route('frontend.telservice.internet') }}" method="POST">

                        @if($vendor && count($vendor) > 0)

                            <select class="form-control" name="vendor" id="internetvendor"
                                    style="padding:0px; margin-bottom: 10px" required>
                                <option value="">Chọn nhà cung cấp</option>
                                @foreach($vendor as $item)
                                    <option value="{{$item->code}}">{{$item->name}}</option>
                                @endforeach
                            </select>

                            <div id="ajax-vendor"></div>
                            <input class="form-control" name="amount" placeholder="Số tiền muốn thanh toán.. VND"
                                   style="margin-bottom: 10px" required>

                            <textarea class="form-control" name="other_info"
                                      placeholder="Các yêu cầu thêm nếu có"></textarea>

                        @endif


                        {!! $paygates !!}


                        <div class="text-center">
                            <button type="submit" class="btn btn-warning btn-lg" style=""><i class="fa fa-cart-plus"
                                                                                             aria-hidden="true"></i>
                                Thanh toán
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>

                </div>

            </div>

        </div>

    </section>




@endsection

@section('js-footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#internetvendor").change(function () {
                var code = $(this).val();
                $('#ajax-vendor').html('');
                $.ajax({
                    url: "{{url('ajax/telservice/getvendor')}}",
                    method: "post",
                    data: {
                        code: code,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (data) {
                        var vendor = $.parseJSON(data);
                        var html = '';

                        $.each(vendor, function (index, value) {
                            if ($.isArray(value)) {
                                html += '<select class="form-control" name="' + index + '" style="padding:0px; margin-bottom: 10px" required>';
                                html += '<option value="">Chọn ...</option>';
                                $.each(value, function (i, v) {

                                    html += '<option value="' + v + '">' + v + '</option>';
                                });
                                html += '</select>';

                            } else {
                                var mapLabel = {
                                    ma_khach_hang: 'Nhập mã khách hàng',
                                    location: 'Chọn khu vực'
                                }
                                var label = mapLabel[index]
                                html += '<input class="form-control" name="' + index + '" placeholder="' + label + '" style="margin-bottom: 10px" required/>';
                            }
                        });
                        $('#ajax-vendor').html(html);
                    }

                })


            });
        });


    </script>

@endsection
