@extends('admin_layout')
@section('admin_content')
<div class="tables">
  <h2 class="title1">Liệt kê mã giảm giá</h2>


  <div class="bs-example widget-shadow" data-example-id="hoverable-table">

    <h4>
      @php
      $message = Session::get('message');
      if($message){
      echo '<span class="text-alert">'.$message.'</span>';
      Session::put('message',null);
      }
      @endphp
    </h4>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Tên mã giảm giá</th>
          <th>Ngày bắt đầu</th>
          <th>Ngày kết thúc</th>
          <th>Mã giảm giá</th>
          <th>Số lượng giảm giá</th>
          <th>Điều kiện giảm giá</th>
          <th>Số giảm</th>
          <th>Hết hạn</th>
          <th>Quản lý</th>
          <th>Gửi mã </th>
        </tr>
      </thead>
      <tbody>
        @foreach($coupon as $key => $cou)
        <tr>
          <th scope="row">{{1 + $key++}}</th>
          <td>{{ $cou->coupon_name }}</td>
          <td>{{ $cou->coupon_date_start}}</td>
          <td>{{ $cou->coupon_date_end}}</td>
          <td>{{ $cou->coupon_code }}</td>
          <td>{{ $cou->coupon_time }}</td>
          <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
              Giảm theo %
              <?php
                 }else{
                ?>
              Giảm theo tiền
              <?php
               }
              ?>
            </span>
          </td>
          <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
              Giảm {{$cou->coupon_number}} %
              <?php
                 }else{
                ?>
              Giảm {{$cou->coupon_number}} k
              <?php
               }
              ?>
            </span></td>



          <td>

            @if($cou->coupon_date_end>=$today) <span style="color: green">Còn hạn</span>
            @else
            <span style="color: red">Đã hết hạn</span>
            @endif

          </td>
          <td>


            <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')"
              href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
            </a>
          </td>

          <td>
            {{-- <p><a href="{{url('/send-coupon-vip',[
            
            'coupon_time'=>$cou->coupon_time,
            'coupon_condition'=>$cou->coupon_condition,
            'coupon_number'=>$cou->coupon_number,
            'coupon_code'=>$cou->coupon_code
            ])}}" class="btn btn-primary">Gửi MGG cho khách VIP</a>
            </p>
            <br> --}}
            <p><a href="{{url('/send-coupon',[
             
              'coupon_time'=>$cou->coupon_time,
              'coupon_condition'=>$cou->coupon_condition,
              'coupon_number'=>$cou->coupon_number,
              'coupon_code'=>$cou->coupon_code
              ])}}" class="btn btn-success">Gửi MGG cho khách hàng</a></p>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!!$coupon->links()!!}

</div>
@endsection