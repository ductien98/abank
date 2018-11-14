@extends('frontend.'.$current_theme.'.common')

@section('breadcrumbs', Breadcrumbs::render('default','Nạp tiền điện thoại'))

@section('customstyle')
    <style>
        .row-group {
            margin-bottom: 0px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        #mtopup-form ul {
            padding: 0;
        }
        #mtopup-form li {
            padding:5px;
            list-style:none;
            display:inline-block;
        }
        #mtopup-form img{
            width:100%;
        }

        #mtopup-form  li.active{
            border:3px solid #42b873;
            padding:0px;
        }
        #mtopup-form input[type=radio]{
            display:none;
        }


        .combo { position: relative; }
        .combo .trigger { position: absolute; right: 0; top: 1px }


    </style>
@endsection

@section('content')
    <section class="main">
        <div class="row blockContent">
            <div class="col-sm-12 right-seperate">
                <div class="card-game-panel">
                    <h3 class="panel-title">Nạp tiền điện thoại nhanh</h3>
                    <p>{{$servicedesc->description}}</p>

                    @theme_include('errors.errors')
                    <form id="mtopup-form" action="{{ route('frontend.Topup.postTopup') }}" method="POST" name="formNapnhanh">
                        <div class="form-frontpage form-sm">
                            <div id="list-row">
                                <div class="irow row-group">
                                    <div class="form-group col-sm-3">
                                        <div class="row combo" style="padding-right: 15px">
                                            <label>Số điện thoại:</label><span
                                                    class="telco-icon telco-icon-right full-width">
                    <input id="p-number" name="phone_number" class="inputRow number_phone form-control normal-control"
                           placeholder="Nhập số đt..." required>
                                            <img src="{{url('/images/icon/none.png')}}" style="width: 32px; height: 32px;" class="trigger">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>Số tiền nạp:</label>
                                        <div class="row" style="padding-right: 15px">
                                            <select name="amount"
                                                    id="amount" class="inputRow amount form-control normal-control" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <div class="row" style="padding-right: 15px">
                                            <label>Loại:</label>
                                            <select name="telco_type"
                                                    class="inputRow telco_type form-control">
                                                <option value="tratruoc">Trả trước</option>
                                                <option value="trasau">Trả sau</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <div class="row" style="padding-right: 15px">
                                            <div>Thành tiền:</div>
                                            <div class="fees normal-control">VND</div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-1">
                                    </div>
                                </div>
                            </div>

                            {!! $paygates !!}

            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" style=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Thanh toán
                </button>
            </div>
            {{ csrf_field() }}
            </form>
        </div>

        @if(Auth::check())
            <h3 class="panel-title">Lịch sử nạp tiền điện thoại</h3>


            <table id="tablez" class="table">
                <thead>
                <tr>
                    <th>Trạng thái</th>
                    <th>Mạng</th>
                    <th>Thuê bao</th>
                    <th>Số ĐT</th>
                    <th>Muốn nạp</th>
                    <th>Chiết khấu</th>
                    <th>Phải trả</th>
                    <th>T.toán</th>
                    <th>Ngày tạo</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $listTopups as $listtopup )
                    <tr class="irow" data-id="">

                        <td>
                            @if($listtopup->status == 'completed')
                                <span class="label label-success">Hoàn thành</span>
                            @elseif($listtopup->status == 'pending')
                                <span class="label label-warning">Chờ nạp</span>
                            @elseif($listtopup->status == 'none')
                                <span class="label label-default">Nháp</span>
                            @elseif($listtopup->status == 'error')
                                <span class="label label-danger">Nạp lỗi</span>
                            @elseif($listtopup->status == 'canceled')
                                <span class="label label-danger">Đã hủy</span>
                            @else
                                <span class="label label-dark">Không rõ</span>
                            @endif
                        </td>
                        <td>{{ $listtopup->telco }}</td>
                        <td>{{ $listtopup->telco_type }}</td>
                        <td>{{ $listtopup->phone_number }}</td>
                        <td>{{ number_format($listtopup->value)}}</td>
                        <td>{{ $listtopup->discount }}%</td>
                        <td>{{ number_format($listtopup->amount).' '.$listtopup->currency_code }}</td>
                        <td>
                            @if($listtopup->payment == 'paid')
                                <span class="label label-success">ĐÃ THANH TOÁN</span>
                            @elseif($listtopup->payment == 'unpaid')
                                <span class="label label-warning">CHƯA THANH TOÁN</span>
                            @elseif($listtopup->payment == 'refunded')
                                <span class="label label-primary">ĐÃ HOÀN TIỀN</span>
                            @elseif($listtopup->payment == 'none')
                                <span class="label label-default">NHÁP</span>
                            @elseif($listtopup->payment == 'canceled')
                                <span class="label label-danger">ĐÃ HỦY</span>
                            @else
                                <span class="label label-default">CHƯA RÕ</span>
                            @endif
                        </td>
                        <td>{{ $listtopup->created_at }}</td>
                    </tr>
                @endforeach

                </tbody>


            </table>

            @endif

            </div>
            </div>
    </section>


@endsection

@section('js-footer')

    <script>
        $(document).ready(function () {
            $(document).on('change', '.inputRow.number_phone', function () {
                var number_phone = $(this).val();
                var telco_type = $('.telco_type').val();
                var obj = $(this);
                obj.parent('span').attr('class', 'telco-icon telco-icon-right full-width');

                $(".amount").html('');
                $(".fees").html('N/A đ');

                if (number_phone.length > 2) {
                    $.ajax({
                        url: "{{ url('/topup/ajax/getDiscount') }}",
                        type: "get",
                        dataType: "text",
                        data: {
                            'number_phone': number_phone,
                            'telco_type': telco_type,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            data = $.parseJSON(data);
                            if (!data.errors) {
                                var telco = data.telco.toLowerCase();
                                var lsValue = data.lsValue;

                                $('img.trigger').attr("src","{{url('/').'/images/icon/'}}" + telco + ".png");

                                var lsAmount = lsValue.split(',');
                                var option = '';
                                if(telco_type=='tratruoc'){
                                    $.each(lsAmount, function (index, value) {
                                        option += '<option value="' + value + '">' + value + ' đ</option>';
                                    });
                                    $(".amount").html(option);
                                }
                                $.each(data.discount, function (index, value) {
                                    $(".telco_type > option[value=" + index + "]").data('discount', value);
                                });
                                selectAmount($(".amount"));
                            } else {
                                $('#list-row').append('<div class="ajax-message alert alert-danger error-messages">' + data.errors + '</div>');
                                setTimeout(function () {
                                    $('.ajax-message').remove();
                                }, 2000);
                            }
                        }
                    }).done(function () {

                    });
                }
            });

            $(document).on('change', '.inputRow.amount', function () {
                var amount = $(this).val();
                if(amount%10000!=0){
                    alert('mệnh giá phải là bội số của 10.000');
                    if($(this).data('oldVal')!=undefined)
                        $(this).val($(this).data('oldVal'));
                    else
                        $(this).val(0);
                }else{
                    selectAmount($(this));
                    $(this).data('oldVal',amount);
                }
            });

            $(document).on('change', '.inputRow.telco_type', function () {
                selectTeltype($(this));
                var telcotype = $(this).val();
                var amountWrapper = $('#amount').parent();
                if(telcotype=='trasau'){
                    newInput = '<input id="amount" type="text" name="amount" class="inputRow amount form-control normal-control" required/>';
                }else{
                    $('#p-number').val('');
                    newInput = '<select id="amount" name="amount"  class="clone-amount inputRow amount form-control normal-control" required></select>';
                }
                amountWrapper.html(newInput);
            });

            function selectAmount(ele) {
                amount = ele.val();
                if (amount != '' && amount > 0) {
                    discount = $(".telco_type > option:selected").data('discount');
                    amount -= (amount * discount) / 100;
                    $(".fees").html(amount + ' đ');
                }
            }

            function selectTeltype(ele) {
                amount = $(".amount").val();
                if (amount != '' && amount > 0) {
                    discount = $(".telco_type > option:selected").data('discount');
                    amount -= (amount * discount) / 100;
                    $(".fees").html(amount + ' đ');
                }
            }

    });

    $(document).on('click',"a.select-payment-btn",function() {
        paymentCode = $(this).data('payment-code');
        $('input#payment-'+paymentCode).prop("checked", "checked");
        $('#payment-select-wrapper li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
</script>
@endsection
