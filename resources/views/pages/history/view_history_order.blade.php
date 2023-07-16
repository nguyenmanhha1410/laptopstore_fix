@extends('layout')
@section('content')
<div class="tables">
  <h2 class="title1">Xem chi tiết đơn hàng [{{$order_code}}]</h2>


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
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$getcustomer->customer_name}}</td>
          <td>{{$getcustomer->customer_phone}}</td>
          <td>{{$getcustomer->customer_email}}</td>
        </tr>

      </tbody>
    </table>
  </div>

</div>
<br>
<div class="tables">
  <h2 class="title1">Thông tin vận chuyển hàng
  </h2>


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
          <th>Tên người vận chuyển</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Email</th>
          <th>Ghi chú</th>
          <th>Hình thức thanh toán</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$shipping->shipping_name}}</td>
          <td>{{$shipping->shipping_address}}</td>
          <td>{{$shipping->shipping_phone}}</td>
          <td>{{$shipping->shipping_email}}</td>
          <td>{{$shipping->shipping_notes}}</td>
          <td>@if($shipping->shipping_method=='chuyenkhoan') Chuyển khoản @elseif($shipping->shipping_method=='tienmat')
            Tiền mặt
            @else Paypal
            @endif</td>


        </tr>
      </tbody>
    </table>
  </div>


</div>

<br>
<div class="tables">
  <h2 class="title1">Liệt kê chi tiết đơn hàng
  </h2>


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
          <th>Tên sản phẩm</th>
          <th>Mã giảm giá</th>
          <th>Phí ship hàng</th>
          <th>Số lượng</th>
          <th>Giá bán</th>
          <th>Tổng tiền</th>
        </tr>
      </thead>
      <tbody>

        @php
        $total = 0;
        @endphp
        @foreach($order_details as $key => $details)
        @php
        $subtotal = $details->product_price*$details->product_sales_quantity;
        $total+=$subtotal;
        @endphp
        <tr class="color_qty_{{$details->product_id}}">

          <th scope="row">{{1 + $key++}}</th>
          <td>{{$details->product_name}}</td>
          <td>@if($details->product_coupon!='no')
            {{$details->product_coupon}}
            @else
            Không mã
            @endif
          </td>
          <td>{{number_format($details->product_feeship ,0,',','.')}}đ</td>
          <td>

            <input type="number" min="1" readonly {{$order_status==2 ? 'disabled' : '' }}
              class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}"
              name="product_sales_quantity">

            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}"
              value="{{$details->product->product_quantity}}">

            <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">



          </td>
          <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
          <td>{{number_format($subtotal ,0,',','.')}}đ</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="2">
            @php
            $total_coupon = 0;
            @endphp
            @if($coupon_condition==1)
            @php
            $total_after_coupon = ($total*$coupon_number)/100;
            echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').'</br>';
            $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
            @endphp
            @else
            @php
            echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').'đ'.'</br>';
            $total_coupon = $total + $details->product_feeship - $coupon_number ;

            @endphp
            @endif

            Phí ship: {{number_format($details->product_feeship,0,',','.')}}đ</br>
            Thanh toán: <b style="font-size:22px">{{number_format($total_coupon,0,',','.')}}đ</b>
          </td>

        </tr>

      </tbody>
    </table>


  </div>


</div>
@endsection