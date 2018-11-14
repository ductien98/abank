@extends('frontend.'.$current_theme.'.master')

@section('title', $settings['title'])
@section('description', $settings['description'])

@section('customstyle')
<link rel="stylesheet" href="{{ theme_asset('css/softcard.css') }}" type="text/css">
@endsection

@section('content')


<div class="row">
    <div class="cardPayment">
        <ul class="nav nav-tabs section-title-wrapper heading-normal">
            <li class="active"><a data-toggle="tab" href="#card-pay">@lang('home.card-pay')</a></li>
            <li><a data-toggle="tab" href="#card-game">MUA MÃ THẺ</a></li>
            <li><a data-toggle="tab" href="#phone-pay">NẠP ĐIỆN THOẠI</a></li>
            <li><a data-toggle="tab" href="#game-pay">NẠP TIỀN GAME</a></li>
            <li><a data-toggle="tab" href="#internet-pay">NẠP CƯỚC</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade" id="card-game">
                {!! $muamathe_html !!}
            </div>
            <div class="tab-pane fade" id="phone-pay">
                {!! $napcham_html !!}
            </div>
            <div class="tab-pane fade in active" id="card-pay">
                {!! $taythecham_html !!}
            </div>
            <div class="tab-pane fade" id="game-pay">
                <div class="blockContent row">
                    <div class="col-sm-12 text-danger text-center">
                        <h3 class="panel-title">Đang thực hiện.</h3>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="internet-pay">
                <div class="blockContent row">
                    <div class="col-sm-12 text-danger text-center">
                        <h3 class="panel-title">Đang thực hiện.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js-footer')
<!-- Sofdcard js -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('body').on('click','.softcard-btn',function(e){
    if(!$(this).hasClass('btn-primary')){
      $('.softcard-btn').removeClass('btn-primary');
      $(this).addClass('btn-primary');
    }else{

    }
  });
  
  $('body').on('click','.sc-item-btn',function(e){
    ele = $(this);
    itemSku = ele.data('sku');
    itemId = ele.data('id');
    row = '';
    if(ele.hasClass('btn-primary')){
      ele.removeClass('btn-primary');
      type = 'remove';
      row = ele.data('row');
    }else{
      ele.addClass('btn-primary');
      type = 'add';
    }
    $.ajax({
      url: '{{ route("softcard.ajaxpost") }}',
      method: 'POST',
      data: {type:type,id:itemId,row:row},
      beforeSend:function(){
        // $('.overlay').show();
      },
      success:function(data){
        data = $.parseJSON(data);
        if(type=='add'){
          ele.data('row',data.row);
        }
        $('#shopping-cart-wrapper').html(data.shopping_cart);
        // $('.overlay').fadeOut();
      }
    });
  });

  $('body').on('change','.shopping-cart-qty',function(e){
    if(checkInputQty($(this))){
      rowId = $(this).data('row');
      qty = $(this).val();
      itemId = $(this).data('id');
      $.ajax({
        url: '{{ route("softcard.ajaxpost") }}',
        method: 'POST',
        data: {type:'update',row:rowId,qty:qty},
        beforeSend:function(){
          // $('.overlay').show();
        },
        success:function(data){
          data = $.parseJSON(data);
          $('#shopping-cart-wrapper').html(data.shopping_cart);
          // $('.overlay').fadeOut();
        }
      });
    }
  });

  $('body').on('click','.delete-cart',function(e){
    $.ajax({
      url: '{{ route("softcard.ajaxpost") }}',
      method: 'POST',
      data: {type:'delete'},
      beforeSend:function(){
        // $('.overlay').show();
      },
      success:function(data){
        data = $.parseJSON(data);
        $('.sc-item-btn').removeClass('btn-primary');
        $('#shopping-cart-wrapper').html(data.shopping_cart);
        // $('.overlay').fadeOut();
      }
    });
  });

  $('body').on('click','.cell-delete-item',function(e){
    sku = $(this).data('sku');
    row = $(this).data('row');
    $.ajax({
      url: '{{ route("softcard.ajaxpost") }}',
      method: 'POST',
      data: {type:'remove',row:row},
      beforeSend:function(){
        // $('.overlay').show();
      },
      success:function(data){
        data = $.parseJSON(data);
        $('#item-'+sku).removeClass('btn-primary');
        $('#shopping-cart-wrapper').html(data.shopping_cart);
        // $('.overlay').fadeOut();
      }
    });
  });

  $('body').on('click','.btn-number',function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if(type == 'minus') {
        if(currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }   
        if(parseInt(input.val()) == input.attr('min')) {
          $(this).addClass('disabled');
        }
      } else if(type == 'plus') {
        if(currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        if(parseInt(input.val()) == input.attr('max')) {
          $(this).addClass('disabled');
        }
      }
    } else {
      input.val(0);
    }
  });
  $('body').on('focusin','.input-number',function(){
    $(this).data('oldValue', $(this).val());
  });
  $('body').on('keydown','.input-number',function (e) {
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
  function checkInputQty(ele){
  // $('body').on('change','.input-number',function() {
    // ele = $(this);
    minValue =  parseInt(ele.attr('min'));
    maxValue =  parseInt(ele.attr('max'));
    valueCurrent = parseInt(ele.val());
    
    namea = ele.attr('name');
    if(valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='"+namea+"']").removeClass('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      ele.val(ele.data('oldValue'));
      return false;
    }
    if(valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='"+namea+"']").removeClass('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      ele.val(ele.data('oldValue'));
      return false;
    } 
    return true;
  // });
  }
</script>

<!-- Tẩy thẻ chậm js -->
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select.telco' , function(){
        var rowID = $(this).attr('data-row-tt');
        var defaultAmount = $('.defaultAmount[data-telco='+$(this).val()+']').attr('data-amount');
        var lsAmount = defaultAmount.split(',');
        var option = '';
        $.each(lsAmount, function( index, value ) {
            option += '<option value="'+value+'">'+value+' đ</option>';
        });
        $(".amount[data-row-tt="+rowID+"]").html(option);
    });


    $(document).on('click','.taythe-act_del',function(){
        var id = $(this).attr('data-row-tt');
        $(".irow[data-row-tt="+id+"]").remove();
    });
    $("#taythe-addRow").click(function(){
        if( $('#tt-list-row > .irow').size() >= 10 )
        {
            alert("Không được vượt quá 10 dòng!");
        }else{
            var dataRow = $("#taythe-dataRow").clone().html();
            dataRow = dataRow.replace(/{timestamp}/g, Date.now());
            $("#tt-list-row").append(dataRow);
        }
    });
  });
</script>

<!-- Nạp chậm js -->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change', '.inputRow.number_phone', function(){
        var rowID = $(this).attr('data-row');
        var number_phone = $(this).val();
        var telco_type = $('.telco_type[data-row='+rowID+']').val();
        var obj = $(this);
        obj.parent('span').attr('class','telco-icon telco-icon-right full-width');

        $(".amount[data-row="+rowID+"]").html('');
        $(".fees[data-row="+rowID+"]").html('N/A đ');

        if( number_phone.length > 2 )
        {
            $.ajax({
                url: "{{ url('/mtopup/ajax/getDiscount') }}",
                type : "get",
                dataType:"text",
                data : {
                    'number_phone':number_phone,
                    'telco_type':telco_type,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    data = $.parseJSON(data);
                    if(!data.errors)
                    {
                        var telco = data.telco;
                        var lsValue = data.lsValue;

                        obj.parent('span').attr('class','telco-icon telco-icon-right full-width');
                        obj.parent('span').addClass('icon-'+telco);

                        var lsAmount = lsValue.split(',');
                        var option = '';
                        $.each(lsAmount, function( index, value ) {
                            option += '<option value="'+value+'">'+value+' đ</option>';
                        });
                        $(".amount[data-row="+rowID+"]").html(option);

                        $.each(data.discount, function(index, value){
                            $(".telco_type[data-row="+rowID+"] > option[value="+index+"]").data('discount',value);
                        });
                        selectAmount($(".amount[data-row="+rowID+"]"));
                    }else{
                        $('#list-row').append('<div class="ajax-message alert alert-danger error-messages">'+data.errors+'</div>');
                        setTimeout(function(){  $('.ajax-message').remove(); },2000);
                    }
                }
            }).done(function() {

            });
        }
    });

    $(document).on('change', '.inputRow.amount', function(){
        selectAmount($(this));
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

    $(document).on('change', '.inputRow.telco_type', function(){
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

    function selectAmount(ele){
        amount = ele.val();
        if(amount!='' && amount>0){
            rowID = ele.attr('data-row');
            discount = $(".telco_type[data-row="+rowID+"] > option:selected").data('discount');
            amount  -= (amount*discount)/100;
            $(".fees[data-row="+rowID+"]").html(amount+' đ');
        }
    }

    function selectTeltype(ele){
        rowID = ele.attr('data-row');
        amount = $(".amount[data-row="+rowID+"]").val();
        if(amount!='' && amount>0){
            discount = $(".telco_type[data-row="+rowID+"] > option:selected").data('discount');
            amount  -= (amount*discount)/100;
            $(".fees[data-row="+rowID+"]").html(amount+' đ');
        }
    }

    $(document).on('click','.act_del',function(){
        var id = $(this).attr('data-row');
        $(".irow[data-row="+id+"]").remove();
    });
    $("#addRow").click(function(){
        if( $('#list-row > .irow').size() >= 10 )
        {
            alert("Không được vượt quá 10 dòng!");
        }else{
            var dataRow = $("#dataRow").clone().html();
            dataRow = dataRow.replace(/{timestamp}/g, Date.now());
            $("#list-row").append(dataRow);
        }
    });

    $(document).on('click',"a.select-payment-btn",function() {
      paymentCode = $(this).data('payment-code');
      $('input#payment-'+paymentCode).prop("checked", "checked");
      $('#payment-select-wrapper li').removeClass('active');
      $(this).parent('li').addClass('active');
    });
});
</script>

@if($settings['globalpopup'] == 1)
    <script>
        $(document).ready(function() {
            $('#global-modal').modal('show');
        });
    </script>


    <div id="global-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body">
                    <p>{!! $settings['globalpopup_mes'] !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
@endif


@endsection
