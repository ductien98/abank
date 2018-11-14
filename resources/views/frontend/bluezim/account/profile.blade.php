@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('userpanel'))
@section('content')
 <h4><span class="text-uppercase">Thông tin tài khoản</span></h4>
 @theme_include('errors.errors')
 <div class="blockContent">
 <div class="row">
        <div class=" col-md-12">
         <table class="table">
          <tbody>
          <tr>
           <td>Họ và tên:</td>
           <td>{{ $user->name }}</td>
          </tr>
          <tr>
           <td>Email:</td>
           <td>{{ $user->email }}</td>
          </tr>
          <tr>
           <td>Điện thoại:</td>
           <td>{{ $user->phone }}</td>
          </tr>
          <tr>
           <td>Nhóm:</td>
           <td>{{$userGroup->name}}</td>
          </tr>
          <tr>
           <td>Ngày đăng ký:</td>
           <td>{{ $user->created_at }}</td>
          </tr>
          <tr>
          <td>Ví điện tử:</td>
          <td>
           @foreach($wallets as $wallet)
           {{$wallet['number']}} (<span class="text-success"><b>{{$wallet['balance']}} {{$wallet['currency_code']}}</b></span>)<br>

            @endforeach
          </td>

          </tr>

          </tbody>
         </table>

         <a href="{{route('edit.profile')}}" class="btn btn-success">Sửa thông tin</a>
         <a href="{{url('change-password')}}" class="btn btn-danger">Đổi mật khẩu</a>
        </div>
       </div>
 </div>

@endsection
