@extends('frontend.'.$current_theme.'.app')
@section('breadcrumbs', Breadcrumbs::render('wtransaction'))
@section('content')
    <h4><span class="text-uppercase">Lịch sử ví</span></h4>
    <div class="blockContent">
        <div class="row">
            <div class=" col-md-12">

<div class="card">

    <form action="{{ url('/user/actions') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="card-body" style="padding-top: 0;">
            <div class="row"><div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th class="center sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" id="checkall">
                                    <span class="lbl"></span> </label>
                            </th>
                            <th>Mã giao dịch</th>
                            <th>Ví</th>
                            <th>Trước GD</th>
                            <th>Số tiền</th>
                            <th>Sau GD</th>
                            <th>Tiền tệ</th>
                            <th>Ngày tạo</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $trans as $tran )
                            <tr>
                                <td class="center"><label class="pos-rel">
                                        <input type="checkbox" class="ace mycheckbox" value="1" name="check[]">
                                        <span class="lbl"></span> </label>
                                </td>
                                <td>{{$tran->order_code}}</td>
                                <td>{{$tran->wallet_number}}</td>
                                <td>{{number_format($tran->before_balance)}} {{$tran->currency_code}}</td>
                                <td><span class="text-success"><b>{{$tran->operation}}{{number_format($tran->pay_amount)}} {{$tran->currency_code}}</b></span></td>
                                <td>{{number_format($tran->after_balance)}} {{$tran->currency_code}}</td>
                                <td>{{$tran->currency_code}}</td>
                                <td>{{date('d-m-Y H:i', strtotime($tran->created_at))}}</td>
                                <td>{{$tran->description}}</td>

                                <td>
                                    <span class="label label-success">Hoàn thành</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>


                    </table>

                    {{ $trans->links() }}
                </div></div>

        </div></form>


    <!-- Delete form -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".deleteClick").click(function(){
                var link = $(this).attr('link');
                var name = $(this).attr('name');
                $("#deleteForm").attr('action',link);
                $("#deleteMes").html("Delete : "+name+" ?");
            });
        });
    </script>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteForm" action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="deleteMes" class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" name="_method" value="delete" />
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>


</div>
</div>
</div>

@endsection