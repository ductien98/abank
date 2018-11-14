@extends('frontend.'.$current_theme.'.app')

@section('meta-tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customstyle')
    <link rel="stylesheet" href="{{ theme_asset('css/softcard.css') }}" type="text/css">
@endsection

@section('breadcrumbs', Breadcrumbs::render('default','Mua mã thẻ'))

@section('content')
@theme_include('errors.errors')

    <section class="main softcard-page">
        <div class="blockContent row">
            <div class="col-sm-12">
                <h3 class="panel-title">Mua mã thẻ</h3>
                <p>{{$servicedesc->description}}</p>
            </div>
            <div class="col-sm-7 right-seperate">
                <div class="card-game-panel">
                    <div class="form-frontpage">
                        @if(count($categories))
                            <ul class="nav nav-tabs">
                                <?php $first = true; ?>
                                @foreach ($categories as $cate)
                                    <li @if($first) class="active" @endif><a data-toggle="tab"
                                                                             href="#panel-sc-{{ $cate->id }}">{{ $cate->name }}</a>
                                    </li>
                                    <?php $first = false; ?>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @if(isset($products) && count($products))
                                    <?php $first = true; $flag = true; ?>
                                    @foreach($products as $cate_id => $product)
                                        <div class="text-center tab-pane fade in @if($first) active @endif"
                                             id="panel-sc-{{ $cate_id }}">
                                            <div class="tnap-group border-active">
                                                @if(count($product))
                                                    @foreach($product as $pro)
                                                        <div class="btn btn-xmd btn-default softcard-btn @if($flag) btn-primary @endif"
                                                             data-toggle="tab" href="#panel-sc-option-{{ $pro->id }}"
                                                             data-sc-id="{{ $pro->id }}">
                                                            @if(isset($thumb[$pro->id]['url']))
                                                                <img src="{{ asset('storage').'/'.$thumb[$pro->id]['url'] }}"
                                                                     alt="{{ $thumb[$pro->id]['alt'] }}" width="100"
                                                                     height="50"/>
                                                            @else
                                                                <img src="{{ asset('storage').'/default.jpg' }}"
                                                                     alt="{{ $pro->name }}" width="100" height="50"/>
                                                            @endif
                                                        </div>
                                                        <?php $flag = false; ?>
                                                    @endforeach
                                                @else
                                                    <p class="text-danger bg-info text-center">Danh mục hiện tại không
                                                        có sản phẩm!!</p>
                                                @endif
                                            </div>
                                        </div>
                                        <?php $first = false; ?>
                                    @endforeach
                                @endif
                            </div>
                            <div class="text-left tab-content">
                                <label><strong>Chọn số tiền:</strong></label>
                                @if(isset($options) && count($options))
                                    <?php $first = true; ?>
                                    @foreach($options as $product_id => $items)
                                        <div class="tnap-group tab-pane fade in @if($first) active @endif"
                                             id="panel-sc-option-{{ $product_id }}">
                                            @if(count($items))
                                                @foreach($items as $item)
                                                    <div id="item-{{ $item['sku'] }}"
                                                         class="btn btn-xmd btn-default sc-item-btn @if(array_key_exists($item['sku'], $added_items)) btn-primary @endif"
                                                         title="{{ $item['name'] }}" data-id="{{ $item['id'] }}"
                                                         data-sku="{{ $item['sku'] }}"
                                                         @if(array_key_exists($item['sku'], $added_items)) data-row="{{ $added_items[$item['sku']] }}"
                                                         @else data-row="" @endif>
                                                        <span>{{ number_format($item['value'],0,',','.').'đ' }}</span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-danger bg-info text-center">Hiện tại không có mệnh giá
                                                    nào cho loại thẻ này!!</p>
                                            @endif
                                        </div>
                                        <?php $first = false; ?>
                                    @endforeach
                                @else
                                    <p class="text-danger bg-info text-center">Hiện tại không có mệnh giá nào cho loại
                                        thẻ này!!</p>
                                @endif
                            </div>
                        @else
                            <p class="text-danger bg-info text-center">Danh mục hiện tại không có sản phẩm!!</p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="row">
                    <div class="right-pay" id="shopping-cart-wrapper">
                        {!! $shopping_cart !!}
                    </div>
                </div>
            </div>

            <div class="overlay" style="display: none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>

    </section>
@endsection

@section('js-footer')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.softcard-btn', function (e) {
            if (!$(this).hasClass('btn-primary')) {
                $('.softcard-btn').removeClass('btn-primary');
                $(this).addClass('btn-primary');
            } else {

            }
        });

        $('body').on('click', '.sc-item-btn', function (e) {
            ele = $(this);
            itemSku = ele.data('sku');
            itemId = ele.data('id');
            row = '';
            if (ele.hasClass('btn-primary')) {
                ele.removeClass('btn-primary');
                type = 'remove';
                row = ele.data('row');
            } else {
                ele.addClass('btn-primary');
                type = 'add';
            }
            $.ajax({
                url: '{{ route("softcard.ajaxpost") }}',
                method: 'POST',
                data: {type: type, id: itemId, row: row},
                beforeSend: function () {
                    // $('.overlay').show();
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (type == 'add') {
                        ele.data('row', data.row);
                    }
                    $('#shopping-cart-wrapper').html(data.shopping_cart);
                    // $('.overlay').fadeOut();
                }
            });
        });

        $('body').on('change', '.shopping-cart-qty', function (e) {
            if (checkInputQty($(this))) {
                rowId = $(this).data('row');
                qty = $(this).val();
                itemId = $(this).data('id');
                $.ajax({
                    url: '{{ route("softcard.ajaxpost") }}',
                    method: 'POST',
                    data: {type: 'update', row: rowId, qty: qty},
                    beforeSend: function () {
                        // $('.overlay').show();
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        $('#shopping-cart-wrapper').html(data.shopping_cart);
                        // $('.overlay').fadeOut();
                    }
                });
            }
        });

        $('body').on('click', '.delete-cart', function (e) {
            $.ajax({
                url: '{{ route("softcard.ajaxpost") }}',
                method: 'POST',
                data: {type: 'delete'},
                beforeSend: function () {
                    // $('.overlay').show();
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    $('.sc-item-btn').removeClass('btn-primary');
                    $('#shopping-cart-wrapper').html(data.shopping_cart);
                    // $('.overlay').fadeOut();
                }
            });
        });

        $('body').on('click', '.cell-delete-item', function (e) {
            sku = $(this).data('sku');
            row = $(this).data('row');
            $.ajax({
                url: '{{ route("softcard.ajaxpost") }}',
                method: 'POST',
                data: {type: 'remove', row: row},
                beforeSend: function () {
                    // $('.overlay').show();
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    $('#item-' + sku).removeClass('btn-primary');
                    $('#shopping-cart-wrapper').html(data.shopping_cart);
                    // $('.overlay').fadeOut();
                }
            });
        });

        $('body').on('click', '.btn-number', function (e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).addClass('disabled');
                    }
                } else if (type == 'plus') {
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).addClass('disabled');
                    }
                }
            } else {
                input.val(0);
            }
        });
        $('body').on('focusin', '.input-number', function () {
            $(this).data('oldValue', $(this).val());
        });
        $('body').on('keydown', '.input-number', function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        function checkInputQty(ele) {
            // $('body').on('change','.input-number',function() {
            // ele = $(this);
            minValue = parseInt(ele.attr('min'));
            maxValue = parseInt(ele.attr('max'));
            valueCurrent = parseInt(ele.val());

            namea = ele.attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + namea + "']").removeClass('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                ele.val(ele.data('oldValue'));
                return false;
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + namea + "']").removeClass('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                ele.val(ele.data('oldValue'));
                return false;
            }
            return true;
            // });
        }
    </script>
@endsection
