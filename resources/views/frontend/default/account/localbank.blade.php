@extends('frontend.'.$current_theme.'.common')
@section('breadcrumbs', Breadcrumbs::render('localbank'))
@section('content')
    @theme_include('errors.errors')
    <h4><span class="text-uppercase">Tài khoản ngân hàng</span></h4>
      <section class="main">

        <div class="blockContent">

            <table id="mytable" class="table table-bordred table-striped">

                <thead>

                <th>STT</th>
                <th>Ngân hàng</th>
                <th>Số tài khoản</th>
                <th>Chủ tài khoản</th>
                <th>Chi nhánh</th>
                <th>Trạng thái</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($listbanks as $key=>$listbank)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $listbank->name }}</td>
                    <td>{{ $listbank->acc_num }}</td>
                    <td>{{ $listbank->acc_name }}</td>
                    <td>{{ $listbank->branch }}</td>
                    <td>
                        @if($listbank->approved == 1)<span class="label label-success">Đã duyệt</span> @else <span class="label label-warning">Chưa duyệt</span> @endif
                    </td>
                    <td>

                        {{ Form::open(['route' => ['frontend.del.localbank.user', $listbank->id], 'method' => 'delete']) }}
                        <button type="submit" class="btn btn-danger btn-xs" value="delete">Xóa</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>

        </div>
<br><br>

        <h4><span class="text-uppercase">Thêm mới</span></h4>

        {!! Form::open(array('route' => 'user.localbank','method'=>'POST')) !!}
        <div class="card-body row">
            <div class="col-md-12">

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Ngân hàng</label>
                    <select name="code" class="form-control" style="padding: 0px">
                        <option>Chọn ngân hàng</option>
                        @foreach($listbanknames as $bname)
                        <option value="{{$bname->code}}">{{$bname->name}}</option>

                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="acc_num">Số tài khoản:</label>
                    <input name="acc_num" type="text" class="form-control" id="acc_num" placeholder="Số tài khoản" value="{{ old('acc_num') }}" >
                </div>
                <div class="form-group">
                    <label for="acc_name">Chủ tài khoản:</label>
                    <input name="acc_name" type="text" class="form-control" id="acc_name" placeholder="Chủ tài khoản" value="{{ old('acc_name') }}">
                </div>
                <div class="form-group">
                    <label for="branch">Chi nhánh:</label>
                    <input name="branch" type="text" class="form-control" id="branch" placeholder="Chi nhánh" value="{{ old('branch') }}">
                </div>


            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm ngân hàng</button>
        </div>
        {!! Form::close() !!}


    </section>

@endsection
