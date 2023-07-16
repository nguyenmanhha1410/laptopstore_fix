@extends('admin_layout')
@section('admin_content')
<div class="form-grids row widget-shadow" data-example-id="basic-forms">
    <div class="form-title">
        <h4>Thêm user :</h4>
    </div>
    {{-- Error nếu chưa điền đủ validation --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- Error nếu chưa điền đủ validation --}}
    @php
    $message = Session::get('message');
    if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
    }
    @endphp

    <div class="form-body">
        <form role="form" action="{{URL::to('store-users')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Họ và tên</label>
                <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1"
                    placeholder="Điền tên của ban">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1"
                    placeholder="Số điền thoại...">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="text" name="admin_password" class="form-control" id="exampleInputEmail1"
                    placeholder="Mật khẩu...">
            </div>

            <button type="submit" name="add_category_product" class="btn btn-info">Thêm users</button>
        </form>
    </div>
</div>
@endsection