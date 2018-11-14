@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('wallet'))

@section('content')
    <h4><span class="text-uppercase">Các ví điện tử</span></h4>
    <section class="main">

     <div class="blockContent">

         <table class="table table-striped table-condensed">
             <thead>
             <tr>
                 <th>Loại ví</th>
                 <th>Địa chỉ ví</th>
                 <th>Số dư khả dụng</th>
                 <th>Số dư tạm giữ</th>
                 <th>Trạng thái</th>
             </tr>
             </thead>
             <tbody>
             @foreach($wallets as $wallet)
             <tr>
                 <td>{{$wallet['currency_code']}}</td>
                 <td><b>{{$wallet['number']}}</b></td>
                 <td><span class="text-success"><b>{{$wallet['balance']}} {{strtolower($wallet['currency_code'])}}</b></span></td>
                 <td><span class="text-danger"><i>{{$wallet['pending_balance']}} {{strtolower($wallet['currency_code'])}}</i></span></td>
                 <td>@if($wallet['status'] == 1)<span class="label label-success">Hoạt động</span> @else <span class="label label-danger">Bị khóa</span> @endif
                 </td>
             </tr>
             @endforeach

             </tbody>
         </table>

      </div>


    </section>
@endsection
