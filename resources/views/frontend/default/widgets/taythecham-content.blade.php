<section class="main">
    <div class="blockContent">
        <div class=" right-seperate">
            <div class="card-game-panel">
                <h3 class="panel-title">Đổi thẻ chậm</h3>

                <div class="row">
                    <div class="col-sm-5 col-xs-12">
                        <div class="clearfix" style="margin-bottom: 15px">
                            <div class="div-table">
                                <div class="thead">
                                    <div class="thead-item"><span>Nhà mạng</span></div>
                                    <div class="thead-item"><span>Trạng thái</span></div>
                                </div>
                                <div class="tbody">
                                    @if(count($lsTelcoStatus) > 0)
                                        @foreach($lsTelcoStatus as $TelcoStatus)
                                            <div class="trow">
                                                <div class="tbody-item"><span>{{$TelcoStatus->name}}</span></div>
                                                @if($TelcoStatus->status == 1)
                                                    <div class="tbody-item"><span><span class="status on">Hoạt động</span></span></div>
                                                @else
                                                    <div class="tbody-item"><span><span class="status off">Tạm ngừng</span></span></div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                        <div class="alert alert-danger" align="justify" role="alert"><span>{!! $servicedesc->description !!}</span></div>
                    </div>
                </div><br/>
                <div class="clearfix"></div>

                <div class="form-frontpage form-sm" style="margin-top: 10px;">
                    <h4 style="margin-bottom: 20px;">Gửi mã thẻ</h4>
                    <div class="row-group">

                        <form action="{{ route('frontend.charging.postCharging')  }}" method="POST" >
                            <div id="tt-list-row">
                                <div class="irow row row-group" style="margin-bottom: 10px;">
                                    <div class="col-sm-2 select">
                                        <select class="telco form-control" name="telco[]" data-row-tt="1" required autofocus>
                                            @foreach( $lsTelco as $telco )
                                                <option value="{{ $telco->key }}">{{ $telco->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="code[]" data-row-tt="1" class="form-control" type="text" placeholder="Mã thẻ" required autofocus>
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="serial[]" data-row-tt="1" class="form-control" type="text" placeholder="Serial" required autofocus>
                                    </div>
                                    <div class="col-sm-2">
                                        @foreach( $lsTelco as $telco )
                                            <input type="hidden" class="defaultAmount" data-telco="{{ $telco->key }}" data-amount="{{$telco->value}}" >
                                        @endforeach
                                        <select id="lsAmount" name="amount[]" data-row-tt="1" class="amount form-control" required autofocus>
                                            @foreach($lsAmount as $amount)
                                                <option value="{{$amount}}">{{ $amount }} đ</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="position: absolute;"><button type="button" id="taythe-addRow" class="btn btn-success " style="float:left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm</button></div>
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
                    <div class="clearfix"></div><br>
                </div>
                @if($lsTelco->count())
                    <h4>Bảng phí tẩy thẻ</h4>
                    @php $firstClass="active"; @endphp
                    <ul class="nav nav-tabs section-title-wrapper heading-normal">
                        @foreach( $lsTelco as $telco )
                            <li class="{{$firstClass}}">
                                <a class="subtitle" data-toggle="tab"  href="#discount-{{$telco->id}}">
                                    {{ $telco->name }}
                                </a>
                            </li>
                            @php $firstClass=""; @endphp
                        @endforeach
                    </ul>
                    @php $firstClass="in active"; @endphp
                    <div class="tab-content">
                        @foreach( $lsTelco as $telco )
                            @if( strpos($telco->value,',') && count(explode(',',$telco->value)) )
                                <div class="table-responsive card-game-panel tab-pane fade in {{$firstClass}}" id="discount-{{$telco->id}}">
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
<div id="taythe-dataRow" class="hidden">
    <div class="irow row row-group " data-row-tt="{timestamp}"  style="margin-bottom:10px;">
        <div class="col-sm-2 select">
            <select class="telco form-control" name="telco[]"  data-row-tt="{timestamp}" required autofocus>
                @foreach( $lsTelco as $telco )
                    <option value="{{ $telco->key }}">{{ $telco->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <input name="code[]"  data-row-tt="{timestamp}" class="form-control" type="text" placeholder="Mã thẻ" required autofocus>
        </div>
        <div class="col-sm-3">
            <input name="serial[]"  data-row-tt="{timestamp}" class="form-control" type="text" placeholder="Serial" required autofocus>
        </div>
        <div class="col-sm-2">
            <select name="amount[]"  data-row-tt="{timestamp}" class="amount form-control" required autofocus>
                @foreach($lsAmount as $amount)
                    <option value="{{$amount}}">{{ $amount }} đ</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <button type="button" class="button-red taythe-act_del" data-row-tt="{timestamp}">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>
