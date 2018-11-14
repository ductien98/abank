@extends('master')

@section('css')
    <style type="text/css">
        .users-list-name {
            display: inline-block;
            font-size: 16px !important;
            color: #007bff !important;
            font-weight: bold;
            line-height: 16px;
            float: left;
        }

        span.users-list-date {
            display: inline-block;
            float: right;
            line-height: 16px;
        }

        span.users-list-email, .users-list-phone {
            clear: both;
            display: block;
            font-size: 14px;
            padding: 5px 0;
        }

        span.users-list-email i.fa, .users-list-phone i.fa {
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            @include('layouts.errors')

            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nạp chậm trong ngày</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tẩy thẻ trong ngày</span>
                            <span class="info-box-number">{{ number_format($sum_today_charging) }} đ</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Số dư thành viên</span>
                            <span class="info-box-number">{{ number_format($sodu,0,'.','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Thành viên</span>
                            <span class="info-box-number">{{ $count_all_user }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">


                    <!-- /.card -->
                    <div class="row">
                        <div class="col-md-4">
                            <!-- PRODUCT LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Đơn nạp tiền</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">

                                        @if($list_deposit)
                                        @foreach($list_deposit as $udeposit)
                                            <li class="item">
                                                <i class="fa fa-angle-right nav-icon"></i><span
                                                        class="text-primary"><strong> {{$udeposit->order_code}}</strong> <small class="text-success">({{$udeposit->status}})</small></span>
                                                <span class="badge badge-warning float-right">+{{number_format($udeposit->net_amount)}} {{$udeposit->currency_code}}</span>
                                                <span class="product-description">
                                                    {{$udeposit->description}}
                                                </span>
                                                <small class="text-muted">{{date('d-m-Y H:i', strtotime($udeposit->created_at))}}</small>

                                            </li>
                                        @endforeach
                                            @endif
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{url($backendUrl)}}/wallet/orderdeposit" class="uppercase">Xem tất cả</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">

                            <!-- PRODUCT LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Đơn rút tiền</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        @if($list_withdraw)
                                        @foreach($list_withdraw as $uwithdraw)
                                            <li class="item">
                                                <i class="fa fa-angle-right nav-icon"></i><span
                                                        class="text-primary"><strong> {{$uwithdraw->order_code}}</strong> <small class="text-success">({{$uwithdraw->status}})</small></span>
                                                <span class="badge badge-warning float-right">-{{number_format($uwithdraw->net_amount)}} {{$uwithdraw->currency_code}}</span>
                                                <span class="product-description">
                                                    {{$uwithdraw->description}}
                                                </span>
                                                <small class="text-muted">{{date('d-m-Y H:i', strtotime($uwithdraw->created_at))}}</small>

                                            </li>
                                        @endforeach
                                            @endif
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{url($backendUrl)}}/wallet/orderwithdraw" class="uppercase">Xem tất cả</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->


                        <div class="col-md-4">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Thành viên</h3>

                                    <div class="card-tools">
                                        <span class="badge badge-success">{{ $count_today_user }} Today</span>
                                        <span class="badge badge-primary">{{ $count_all_user }} New Members</span>

                                        <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        @foreach($lsUser as $user)
                                            <li class="item">
                                                <a class="users-list-name"
                                                   href="./users/{{$user->id}}/edit">{{ $user->name }}</a>
                                                <span class="users-list-date">{{ $user->created_at }}</span>
                                                @if($user->email)<span class="users-list-email"><i
                                                            class="fa fa-envelope"></i><span>{{ $user->email }}</span></span>@endif
                                                @if($user->phone)<span class="users-list-phone"><i
                                                            class="fa fa-phone"></i><span>{{ $user->phone }}</span></span>@endif
                                            </li>
                                        @endforeach

                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{ './users' }}">Xem tất cả</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Danh sách đơn hàng</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Khách hàng</th>
                                        <th>Số tiền</th>
                                        <th>Sản phẩm</th>
                                        <th>Thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orders->count())
                                        @foreach( $orders as $order )
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{!! App\User::getUserInfo($order->payer_id) !!}</td>
                                                <td>{{ number_format($order->pay_amount).' '.$order->currency_code }}</td>
                                                <td>
                                                   {!! App\Modules\Order\Models\Order::getlistproduct($order) !!}
                                                </td>
                                                <td>

                                                    @if($order->payment == 'paid')
                                                        <label class="badge badge-success">ĐÃ THANH TOÁN</label>
                                                    @elseif($order->payment == 'unpaid')
                                                        <label class="badge badge-warning">CHƯA THANH TOÁN</label>
                                                    @elseif($order->payment == 'none')
                                                        <label class="badge badge-secondary">NHÁP</label>
                                                    @elseif($order->payment == 'refunded')
                                                        <label class="badge badge-primary">ĐÃ HOÀN TIỀN</label>
                                                    @elseif($order->payment == 'canceled')
                                                        <label class="badge badge-danger">ĐÃ HỦY</label>
                                                    @else
                                                        <label class="badge badge-dark">CHƯA RÕ</label>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($order->status == 'completed')
                                                        <label class="badge badge-success">HOÀN THÀNH</label>
                                                    @elseif($order->status == 'pending')
                                                        <label class="badge badge-warning">ĐANG XỬ LÝ</label>
                                                    @elseif($order->status == 'none')
                                                        <label class="badge badge-secondary">NHÁP</label>
                                                    @elseif($order->status == 'wrong')
                                                        <label class="badge badge-danger">SAI M.GIÁ</label>
                                                    @elseif($order->status == 'canceled')
                                                        <label class="badge badge-danger">HỦY BỎ</label>
                                                    @else
                                                        <label class="badge badge-dark">CHƯA RÕ</label>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <p class="alert text-center">Chưa có giao dịch</p>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{ './orders' }}" class="btn btn-sm btn-primary float-right">Xem tất cả</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

@endsection
