@extends('frontend.'.$current_theme.'.common')

@section('breadcrumbs', Breadcrumbs::render('default','Tẩy thẻ nhanh'))

@section('customstyle')
    <style type="text/css">
        .card-game-panel .tabpage {
        }

        .card-game-panel ul.nav-tabs {
        }

        .card-game-panel ul.nav-tabs li {
            width: auto;
        }

        .card-game-panel ul.nav-tabs li > a {
            min-height: 20px;
            padding: 10px 20px;
            margin: 0;
        }

        .card-game-panel ul.nav-tabs li > a .title {
            font-size: 14px;
            text-transform: uppercase;
        }

        .card-game-panel .tab-content {
        }

        .card-game-panel .tab-content table {
        }
    </style>
@endsection

@section('content')

    <section class="main">

        <div class="blockContent">
            <div class=" right-seperate">
                <div class="card-game-panel">
                    <h3 class="title">Tẩy thẻ nhanh</h3>
                    <p>{!! $servicedesc->description !!}</p>

                    <div class="form-frontpage form-sm" style="margin-top: 30px;">
                        <h4 style="margin-bottom: 20px;">Form nhập mã thẻ</h4>
                        <div class="col-md-12">
                            @theme_include('errors.errors')
                            <form class="form-inline" action="{{ route('frontend.chargingauto.postCharging')  }}"
                                  method="POST">
                                <div id="list-row">
                                    <div class="irow row row-group" style="margin-bottom: 10px;">
                                        <div class="form-group select">
                                            <select class="telco form-control" name="telco" data-row="1" required
                                                    autofocus>
                                                @foreach( $lsTelco as $telco )
                                                    <option value="{{ $telco->key }}">{{ $telco->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input name="code" data-row="1" class="form-control" type="text"
                                                   placeholder="Mã thẻ" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input name="serial" data-row="1" class="form-control" type="text"
                                                   placeholder="Serial" required autofocus>
                                        </div>

                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{--<button type="button" id="addRow" class="btn btn-success " style="float:left"><i--}}
                                {{--class="fa fa-plus-circle" aria-hidden="true"></i> Thêm--}}
                                {{--</button>--}}

                                {{--</div>--}}
                                <br>
                                <div class="clear-fix"></div>

                                <div align="center" class="col-md-12">

                                    @if($spam == 1)
                                        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <br>
                                    @endif


                                    <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-check-circle-o"
                                                                                            aria-hidden="true"></i> Gửi
                                        thẻ cào
                                    </button>

                                </div>


                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    @if($lsTelco->count())
                        <div class="tabpage" id="bang-phi" style="margin-top: 50px;">
                            <h4>Bảng phí tẩy thẻ nhanh</h4>

                            <div class="tab-content" style="padding-top: 20px;">


                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Mạng/Nhóm</th>
                                            @foreach( $groups as $group )
                                                @if($group->id!=1)
                                                    <th class="text-center">{{ $group->name}}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @foreach($lsTelco as $telco)
                                            <tr>
                                                <td><b>{{ $telco->key }}</b></td>

                                                @foreach( $groups as $group )
                                                    @if($group->id!=1)
                                                        @php $phi = $fees->getFeeByGroupandTelco($group->id, $telco->key, 'fees'); @endphp
                                                        <td>@if($phi){{ $phi.'%' }}@endif</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if(Auth::check())
                        <h3 class="panel-title">Lịch sử tẩy thẻ nhanh</h3>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TT</th>
                                    <th>Mã Nạp</th>
                                    <th>Seri</th>
                                    <th>Mạng</th>
                                    <th>Mệnh giá</th>
                                    <th>Phí</th>
                                    <th>Nhận</th>
                                    <th>Ngày</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($listHistory)
                                    @foreach( $listHistory as $itemc )
                                        <tr>

                                            <td>{{$itemc->id}}</td>
                                            <td>@if($itemc['status'] == 1)<span
                                                        class="label label-success">Xong</span> @elseif($itemc['status'] == 2)
                                                    <span class="label label-danger">Thẻ lỗi</span> @elseif($itemc['status'] == 4)
                                                    <span class="label label-danger">Đã s.dụng</span> @else <span
                                                            class="label label-warning">Chờ</span> @endif</td>
                                            <td>{{$itemc->code}}</td>
                                            <td>{{$itemc->serial}}</td>
                                            <td>{{$itemc->telco}}</td>
                                            <td>{{number_format($itemc->value)}}</td>
                                            <td>{{$itemc->fees}}%</td>
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
    {{--<div id="dataRow" class="hidden">--}}
    {{--<div class="irow row row-group " data-row="{timestamp}" style="margin-bottom: 10px;">--}}
    {{--<div class="form-group select">--}}
    {{--<select class="telco form-control" name="telco[]" data-row="{timestamp}" required autofocus>--}}
    {{--@foreach( $lsTelco as $telco )--}}
    {{--<option value="{{ $telco->key }}">{{ $telco->name }}</option>--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input name="code[]" data-row="{timestamp}" class="form-control" type="text" placeholder="Mã thẻ"--}}
    {{--required autofocus>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input name="serial[]" data-row="{timestamp}" class="form-control" type="text" placeholder="Serial"--}}
    {{--required autofocus>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<button type="button" class="button-red act_del" data-row="{timestamp}">--}}
    {{--<i class="fa fa-trash-o" aria-hidden="true"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}


@endsection




@section('js-footer')

    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$(document).on('change', 'select.telco', function () {--}}
    {{--var rowID = $(this).attr('data-row');--}}
    {{--var defaultAmount = $('.defaultAmount[data-telco=' + $(this).val() + ']').attr('data-amount');--}}
    {{--var lsAmount = defaultAmount.split(',');--}}
    {{--var option = '';--}}
    {{--$.each(lsAmount, function (index, value) {--}}
    {{--option += '<option value="' + value + '">' + value + ' đ</option>';--}}
    {{--});--}}
    {{--$(".amount[data-row=" + rowID + "]").html(option);--}}
    {{--});--}}


    {{--$(document).on('click', '.act_del', function () {--}}
    {{--var id = $(this).attr('data-row');--}}
    {{--$(".irow[data-row=" + id + "]").remove();--}}
    {{--});--}}
    {{--$("#addRow").click(function () {--}}
    {{--if ($('#list-row > .irow').size() >= 10) {--}}
    {{--alert("Không được vượt quá 10 dòng!");--}}
    {{--} else {--}}
    {{--var dataRow = $("#dataRow").clone().html();--}}
    {{--dataRow = dataRow.replace(/{timestamp}/g, Date.now());--}}
    {{--$("#list-row").append(dataRow);--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}

@endsection
