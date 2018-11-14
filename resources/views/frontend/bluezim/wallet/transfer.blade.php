@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('transfer'))
@section('content')

    @theme_include('errors.errors')
    <section class="main">
        <div class="blockContent">
            <h4><span class="text-uppercase">Chuyển số dư</span></h4>
            <div class=" col-md-12">

                <form action="{{route('post.wallet.transfer')}}" method="POST" >
                    <div class="card-body row">
                        <table class="table table-bordered table-striped">

                            <tbody>

                            <tr>
                                <td>Chọn tài khoản nguồn:</td>
                                <td><select id="wallet-num" name="payer_wallet" class="form-control getWalletAjax" style="padding: 0px">
                                        @foreach($listWallet as $wallet)
                                        <option value="{{$wallet->number}}">Ví {{$wallet->number}} - {{number_format($wallet->balance_decode)}} {{$wallet->currency_code}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Tài khoản nhận:</td>
                                <td><input id="get-user-wallet" type="text" placeholder="Nhập email hoặc số điện thoại người nhận" class="form-control getWalletAjax" name="payee_info" value="" /></td>
                            </tr>

                            <tr>
                                <td>Tên người nhận:</td>
                                <td><input id="payee_name" type="text" class="form-control" name="payee_name" value="" readonly/></td>
                            </tr>

                            <tr>
                                <td>Số tiền:</td>
                                <td><input type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="đ"/></td>
                            </tr>

                            <tr>
                                <td>Ghi chú:</td>
                                <td>
                                    <textarea name="description" id="description" class="form-control" placeholder="Nội dung">{{ old('description') }}</textarea>
                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>

                                    <button type="submit" class="btn btn-primary">Chuyển tiền</button>

                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    {!! csrf_field() !!}

                </form>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#get-user-wallet").on('change', function (e) {
                var userinfo = $(this).val();

                $.ajax({
                    url : "{{url('transfer/ajax/get-user-name')}}",
                    method: "post",
                    data: {
                        payee_info: userinfo,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if(data){
                            $("#payee_name").attr('value', data);
                        }
                    }

                });

            });


        });

    </script>


@endsection
