@extends('frontend.'.$current_theme.'.app')

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
                                        <div class="row" style="padding-right: 15px">
                                            <label>Số điện thoại:</label><span
                                                    class="telco-icon telco-icon-right full-width">
                    <input id="p-number-1" name="phone_number[]" data-row="1" class="inputRow number_phone form-control normal-control"
                           placeholder="Nhập số đt..." required></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Số tiền nạp:</label>
                                        <div class="row" style="padding-right: 15px">
                                            <select name="amount[]" data-row="1"
                                                    id="amount-1" class="inputRow amount form-control normal-control" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <div class="row" style="padding-right: 15px">
                                            <label>Loại:</label>
                                            <select name="telco_type[]" data-row="1"
                                                    class="inputRow telco_type form-control">
                                                <option value="tratruoc">Trả trước</option>
                                                <option value="trasau">Trả sau</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <div class="row" style="padding-right: 15px">
                                            <div>Thành tiền:</div>
                                            <div class="fees normal-control" data-row="1">VNĐ</div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-1">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" id="addRow" class="btn btn-success " style="float:left"><i
                                            class="fa fa-plus-circle" aria-hidden="true"></i> Thêm
                                </button>
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
                        <td>{{ date('d-m-Y',strtotime($listtopup->created_at)) }}</td>
                    </tr>
                @endforeach

                </tbody>


            </table>

            @endif

            </div>
            </div>
    </section>

    <div id="dataRow" class="hidden">
        <div class="irow row-group " data-row="{timestamp}">
            <div class="row-group">
                <div class="form-group col-sm-3">
                    <div class="row" style="padding-right: 15px">
            <span class="telco-icon  telco-icon-right full-width">
            <input id="p-number-{timestamp}" name="phone_number[]" data-row="{timestamp}"
                   class="inputRow number_phone form-control normal-control" placeholder="Nhập số đt..."
                   required></span>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <div class="row" style="padding-right: 15px">
                        <select name="amount[]" data-row="{timestamp}"
                                id="amount-{timestamp}" class="inputRow amount form-control normal-control" required>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <div class="row" style="padding-right: 15px">
                        <select name="telco_type[]" data-row="{timestamp}" class="inputRow telco_type form-control">
                            <option value="tratruoc">Trả trước</option>
                            <option value="trasau">Trả sau</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <div class="row" style="padding-right: 15px">
                        <div class="fees normal-control" data-row="{timestamp}">N/A</div>
                    </div>
                </div>
                <div class="form-group col-sm-1">
                    <div class="row" style="padding-right: 15px">
                        <button type="button" class="button-red act_del" data-row="{timestamp}">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js-footer')

    <script>
        $(document).ready(function () {
            $(document).on('change', '.inputRow.number_phone', function () {
                var rowID = $(this).attr('data-row');
                var number_phone = $(this).val();
                var telco_type = $('.telco_type[data-row=' + rowID + ']').val();
                var obj = $(this);
                obj.parent('span').attr('class', 'telco-icon telco-icon-right full-width');

                $(".amount[data-row=" + rowID + "]").html('');
                $(".fees[data-row=" + rowID + "]").html('N/A đ');

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
                                var telco = data.telco;
                                var lsValue = data.lsValue;

                                obj.parent('span').attr('class', 'telco-icon telco-icon-right full-width');
                                obj.parent('span').addClass('icon-' + telco);

                                var lsAmount = lsValue.split(',');
                                var option = '';
                                if(telco_type=='tratruoc'){
                                    $.each(lsAmount, function (index, value) {
                                        option += '<option value="' + value + '">' + value + ' đ</option>';
                                    });
                                    $(".amount[data-row=" + rowID + "]").html(option);
                                }
                                $.each(data.discount, function (index, value) {
                                    $(".telco_type[data-row=" + rowID + "] > option[value=" + index + "]").data('discount', value);
                                });
                                selectAmount($(".amount[data-row=" + rowID + "]"));
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
                var rownum = $(this).data('row');
                var amountWrapper = $('#amount-'+rownum).parent();
                if(telcotype=='trasau'){
                    newInput = '<input id="amount-'+rownum+'" type="text" name="amount[]" data-row="'+rownum+'" class="inputRow amount form-control normal-control" required/>';
                }else{
                    $('#p-number-'+rownum).val('');
                    newInput = '<select id="amount-'+rownum+'" name="amount[]"  data-row="'+rownum+'" class="clone-amount inputRow amount form-control normal-control" required></select>';
                }
                amountWrapper.html(newInput);
            });

            function selectAmount(ele) {
                amount = ele.val();
                if (amount != '' && amount > 0) {
                    rowID = ele.attr('data-row');
                    discount = $(".telco_type[data-row=" + rowID + "] > option:selected").data('discount');
                    amount -= (amount * discount) / 100;
                    $(".fees[data-row=" + rowID + "]").html(amount + ' đ');
                }
            }

            function selectTeltype(ele) {
                rowID = ele.attr('data-row');
                amount = $(".amount[data-row=" + rowID + "]").val();
                if (amount != '' && amount > 0) {
                    discount = $(".telco_type[data-row=" + rowID + "] > option:selected").data('discount');
                    amount -= (amount * discount) / 100;
                    $(".fees[data-row=" + rowID + "]").html(amount + ' đ');
                }
            }

        $(document).on('click', '.act_del', function () {
            var id = $(this).attr('data-row');
            $(".irow[data-row=" + id + "]").remove();
        });
        $("#addRow").click(function () {
            if ($('#list-row > .irow').size() >= 10) {
                alert("Không được vượt quá 10 dòng!");
            } else {
                var dataRow = $("#dataRow").clone().html();
                dataRow = dataRow.replace(/{timestamp}/g, Date.now());
                $("#list-row").append(dataRow);
            }
        });
    });

    $(document).on('click',"a.select-payment-btn",function() {
        paymentCode = $(this).data('payment-code');
        $('input#payment-'+paymentCode).prop("checked", "checked");
        $('#payment-select-wrapper li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
</script>
@endsection
