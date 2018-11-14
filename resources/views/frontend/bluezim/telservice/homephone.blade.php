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

                    <a href="{{route('frontend.telservice.internet')}}"><button type="button" class="btn btn-default">Cước Internet</button></a>
                    <a href="{{route('frontend.telservice.homephone')}}"><button type="button" class="btn btn-primary">Điện thoại cố định</button></a>
                    <a href="{{route('frontend.telservice.television')}}"><button type="button" class="btn btn-default">Truyền Hình</button></a>


                            <h1 style="font-size: medium">Thanh toán cước điện thoại cố định</h1>

                            <br>
                            <form id="mtopup-form" action="{{ route('frontend.telservice.internet') }}" method="POST" name="formNapnhanh">
                                <div class="form-frontpage form-sm">

                                    @if($vendor && count($vendor) > 0)


                                            <select class="form-control" name="vendor" id="internetvendor" style="margin-bottom: 10px">
                                                <option value="">Chọn nhà cung cấp</option>
                                                @foreach($vendor as $item)
                                                <option value="{{$item->code}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>


                                        <div id="ajax-vendor"></div>


                                    @endif



                                    {!! $paygates !!}

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning btn-lg" style=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Thanh toán
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
               url:"{{url('ajax/telservice/getvendor')}}",
               method: "post",
               data: {
                   code: code,
                   _token: $('meta[name="csrf-token"]').attr('content')
               },
               
               success: function (data) {
                   var vendor = $.parseJSON(data);
                   var html = '';

                   $.each(vendor, function( index, value ) {
                        if($.isArray(value)){
                            html += '<select class="form-control" name="'+index+'" style="margin-bottom: 10px">';
                            html += '<option value="">Chọn ...</option>';
                            $.each(value, function(i,v) {

                                html += '<option value="'+i+'">'+v+'</option>';
                            });
                            html += '</select>';

                        }else{
                            html += '<input class="form-control" name="'+index+'" placeholder="Nhập '+index+'" style="margin-bottom: 10px" />';

                        }
                   });
                   $('#ajax-vendor').html(html);
               }

           })


        });
    });


</script>

@endsection
