@extends('frontend.'.$current_theme.'.app')

@section('breadcrumbs', Breadcrumbs::render('default','Tẩy thẻ chậm'))

@section('customstyle')
<style type="text/css">
.card-game-panel .tabpage{}
.card-game-panel ul.nav-tabs{}
.card-game-panel ul.nav-tabs li{
    width: auto;
}
.card-game-panel ul.nav-tabs li > a{
    min-height: 20px;
    padding: 10px 20px;
    margin: 0;
}
.card-game-panel ul.nav-tabs li > a .title{
    font-size: 14px;
    text-transform: uppercase;
}
.card-game-panel .tab-content {}
.card-game-panel .tab-content table{}
</style>
@endsection

@section('content')

<section class="main">

    <div class="blockContent">
        <div class=" right-seperate">
            <div class="card-game-panel">
                <h3 class="title">Tẩy thẻ chậm</h3>
                <p>{!! $servicedesc->description !!}</p>

                <div class="form-frontpage form-sm" style="margin-top: 30px;">
                    <h4 style="margin-bottom: 20px;">Form nhập mã thẻ</h4>
                    <div class="row-group">
                        @theme_include('errors.errors')
                            <form action="{{ route('frontend.charging.postCharging')  }}" method="POST" >
                            <div id="list-row">
                            <div  class="irow row row-group" style="margin-bottom: 10px;">
                                    <div class="col-sm-2 select">
                                        <select class="telco form-control" name="telco[]" data-row="1" required autofocus>
                                            @foreach( $lsTelco as $telco )
                                            <option value="{{ $telco->key }}">{{ $telco->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="code[]" data-row="1" class="form-control" type="text" placeholder="Mã thẻ" required autofocus>
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="serial[]" data-row="1" class="form-control" type="text" placeholder="Serial" required autofocus>
                                    </div>
                                    <div class="col-sm-2">
                                        @foreach( $lsTelco as $telco )
                                            <input type="hidden" class="defaultAmount" data-telco="{{ $telco->key }}" data-amount="{{$telco->value}}" >
                                        @endforeach
                                        <select id="lsAmount" name="amount[]" data-row="1" class="amount form-control" required autofocus>
                                            <option value="">-- Mệnh giá --</option>
                                            @foreach($lsAmount as $amount)
                                            <option value="{{$amount}}">{{ $amount }} đ</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div style="position: absolute;"><button type="button" id="addRow" class="btn btn-success " style="float:left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm</button></div>
                                <br>
                                <div class="clear-fix"></div>

                                    <div align="center" class="col-md-12">

                                        @if($spam == 1)
                                        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        @endif


                                        <br>
                                        <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Gửi thẻ cào
                                        </button>

                                    </div>


                                {{ csrf_field() }}
                            </form>
                    </div>
                    <div class="clearfix"></div>
                </div>


                @if($lsTelco->count())
                    <div class="tabpage" id="bang-phi" style="margin-top: 50px;">
                        <h4>Bảng phí tẩy thẻ</h4>
                        @php $firstClass="active"; @endphp
                        <ul class="nav nav-tabs">
                            @foreach( $lsTelco as $telco )
                                <li class="{{$firstClass}}">
                                    <a data-toggle="tab" href="#discount-{{$telco->id}}">
                                        <span class="title">{{ $telco->name }}</span>
                                    </a>
                                </li>
                                @php $firstClass=""; @endphp
                            @endforeach
                        </ul>
                        @php $firstClass="in active"; @endphp
                        <div class="tab-content" style="padding-top: 20px;">
                            @foreach( $lsTelco as $telco )
                                @if( strpos($telco->value,',') && count(explode(',',$telco->value)) )
                                    <div class="table-responsive tab-pane fadess {{$firstClass}}" id="discount-{{$telco->id}}">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Nhóm thành viên</th>
                                                @foreach( explode(',',trim($telco->value)) as $value)
                                                    @if($value)
                                                        <th class="text-center">{{ 'Thẻ '.number_format($value).'đ'}}</th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @if($groups->count())
                                                @foreach( $groups as $group )
                                                    @if($group->id!=1)
                                                        <tr>
                                                            <td><b>{{ $group->name }}</b></td>
                                                            @foreach( explode(',',trim($telco->value)) as $value)
                                                                @if($value)
                                                                    @php $phi = $fees->getValueByGroupandTelco($group->id, $telco->key, $value, 'fees'); @endphp
                                                                    <td>@if($phi){{ $phi.'%' }}@endif</td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @php $firstClass=""; @endphp
                            @endforeach
                        </div>
                    </div>
                @endif


                @if(Auth::check())
                <h3 class="panel-title">Lịch sử tẩy thẻ chậm</h3>
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TT</th>
                        <th>Mã Nạp</th>
                        <th>Seri</th>
                        <th>Mạng</th>
                        <th>Khai</th>
                        <th>Thực</th>
                        <th>Phí</th>
                        <th>Phạt</th>
                        <th>Nhận</th>
                        <th>Ngày</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($listHistory)
                    @foreach( $listHistory as $itemc )
                        <tr>

                            <td>{{$itemc->id}}</td>
                            <td>@if($itemc['status'] == 1)<span class="label label-success">Xong</span> @elseif($itemc['status'] == 2) <span class="label label-success">Sai m.giá</span> @elseif($itemc['status'] == 3) <span class="label label-danger">Thẻ lỗi</span> @elseif($itemc['status'] == 4) <span class="label label-danger">Đã s.dụng</span> @else <span class="label label-warning">Chờ</span> @endif</td>
                            <td>{{$itemc->code}}</td>
                            <td>{{$itemc->serial}}</td>
                            <td>{{$itemc->telco}}</td>
                            <td>{{number_format($itemc->declared_value)}}</td>
                            <td>{{number_format($itemc->real_value)}}</td>
                            <td>{{$itemc->fees}}%</td>
                            <td>{{$itemc->penalty}}%</td>
                            <td>{{number_format($itemc->amount)}} {{$itemc->currency_code}}</td>
                            <td>{{$itemc->created_at}}</td>

                        </tr>
                    @endforeach
                        @endif
                    </tbody>


                </table>
                </div>
                {{ $listHistory->links() }}

                @endif


            </div>
        </div>
    </div>
</section>
<div id="dataRow" class="hidden">
<div class="irow row row-group " data-row="{timestamp}" style="margin-bottom: 10px;">
    <div class="col-sm-2 select">
        <select class="telco form-control" name="telco[]"  data-row="{timestamp}" required autofocus>
            @foreach( $lsTelco as $telco )
                <option value="{{ $telco->key }}">{{ $telco->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-3">
        <input name="code[]"  data-row="{timestamp}" class="form-control" type="text" placeholder="Mã thẻ" required autofocus>
    </div>
    <div class="col-sm-3">
        <input name="serial[]"  data-row="{timestamp}" class="form-control" type="text" placeholder="Serial" required autofocus>
    </div>
    <div class="col-sm-2">
        <select name="amount[]"  data-row="{timestamp}" class="amount form-control" required autofocus>
            <option value="">-- Mệnh giá --</option>
            @foreach($lsAmount as $amount)
                <option value="{{$amount}}">{{ $amount }} đ</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-2">
        <button type="button" class="button-red act_del" data-row="{timestamp}">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>
    </div>
</div>
</div>


@endsection




@section('js-footer')

<script>
$(document).ready(function(){
    $(document).on('change','select.telco' , function(){
        var rowID = $(this).attr('data-row');
        var defaultAmount = $('.defaultAmount[data-telco='+$(this).val()+']').attr('data-amount');
        var lsAmount = defaultAmount.split(',');
        var option = '';
        $.each(lsAmount, function( index, value ) {
            option += '<option value="'+value+'">'+value+' đ</option>';
        });
        $(".amount[data-row="+rowID+"]").html(option);
    });


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
});
</script>

@endsection
