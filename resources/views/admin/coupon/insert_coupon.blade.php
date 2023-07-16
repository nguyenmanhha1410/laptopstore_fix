@extends('admin_layout')
@section('admin_content')
<div class="form-grids row widget-shadow" data-example-id="basic-forms">
    <div class="form-title">
        <h4>Thêm mã giảm giá :</h4>
    </div>

    @php
    $message = Session::get('message');
    if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
    }
    @endphp

    <div class="form-body">
        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày bắt đầu</label>
                <input type="text" name="coupon_date_start" class="form-control" id="start_coupon">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày kết thúc</label>
                <input type="text" name="coupon_date_end" class="form-control" id="end_coupon">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mã giảm giá</label>
                <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Số lượng mã</label>
                <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tính năng mã</label>
                <select name="coupon_condition" class="form-control input-sm m-bot15">
                    <option value="0">----Chọn-----</option>
                    <option value="1">Giảm theo phần trăm</option>
                    <option value="2">Giảm theo tiền</option>

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1">
            </div>


            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
        </form>
    </div>
</div>
@endsection