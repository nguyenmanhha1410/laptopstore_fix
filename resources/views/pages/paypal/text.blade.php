<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Pay $100</title>
  <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</head>

<body>
  <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Pay $100</a>
  @if(\Session::has('error'))
  <div class="alert alert-danger">{{ \Session::get('error') }}</div>
  {{ \Session::forget('error') }}
  @endif
  @if(\Session::has('success'))
  <div class="alert alert-success">{{ \Session::get('success') }}</div>
  {{ \Session::forget('success') }}
  @endif
</body>

</html>



<table class="table table-condensed">
  <thead>
    <tr class="cart_menu">
      <td class="image">Hình ảnh</td>
      <td class="description">Tên sản phẩm</td>
      <td class="price">Giá sản phẩm</td>
      <td class="quantity">Số lượng</td>
      <td class="total">Thành tiền</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    @if(Session::get('cart')==true)
    @php
    $total = 0;
    @endphp
    @foreach(Session::get('cart') as $key => $cart)
    @php
    $subtotal = $cart['product_price']*$cart['product_qty'];
    $total+=$subtotal;
    @endphp

    <tr>
      <td class="cart_product">
        <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90"
          alt="{{$cart['product_name']}}" />
      </td>
      <td class="cart_description">

        <p style="width:150px;">{{$cart['product_name']}}</p>
      </td>
      <td class="cart_price">
        <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
      </td>
      <td class="cart_quantity">
        <div class="cart_quantity_button">


          <input class="cart_quantity" type="number" style="width:50px" @if(Session::get('success_paypal')==true)
            readonly @endif min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">


        </div>
      </td>
      <td class="cart_total">
        <p class="cart_total_price">
          {{number_format($subtotal,0,',','.')}}đ

        </p>
      </td>
      <td class="cart_delete">
        {{-- @if(!Session::get('success_paypal')==true) --}}
        <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i
            class="fa fa-times"></i></a>
        {{-- @endif --}}
      </td>
    </tr>

    @endforeach
    <tr>
      {{-- @if(!Session::get('success_paypal') == true) --}}
      <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm">
      </td>
      <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
      <td> <a class="btn btn-default m-3 check_out" href="{{ route('processTransaction') }}">Thanh toán

          bằng
          Paypal</a></td>
      <td>
        @if(Session::get('coupon'))
        <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
        @endif
      </td>
      {{-- @endif --}}

      <td colspan="2">
        <li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
        @if(Session::get('coupon'))
        <li>

          @foreach(Session::get('coupon') as $key => $cou)
          @if($cou['coupon_condition']==1)
          Mã giảm: {{$cou['coupon_number']}} %

          @php
          $total_coupon = ($total*$cou['coupon_number'])/100;

          @endphp


          @php
          $total_after_coupon = $total-$total_coupon;
          @endphp

          @elseif($cou['coupon_condition']==2)
          Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}}đ

          @php
          $total_coupon = $total - $cou['coupon_number'];

          @endphp

          @php
          $total_after_coupon = $total_coupon;
          @endphp
          @endif
          @endforeach



        </li>
        @endif

        @if(Session::get('fee'))
        <li>


          Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
          <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>

        </li>
        <?php $total_after_fee = $total + Session::get('fee'); ?>
        @endif
        <li style="font-weight:bold">Tổng còn:
          @php
          if(Session::get('fee') && !Session::get('coupon')){
          $total_after = $total_after_fee;
          echo number_format($total_after,0,',','.').'đ';
          }elseif(!Session::get('fee') && Session::get('coupon')){
          $total_after = $total_after_coupon;
          echo number_format($total_after,0,',','.').'đ';
          }elseif(Session::get('fee') && Session::get('coupon')){
          $total_after = $total_after_coupon;
          $total_after = $total_after + Session::get('fee');
          echo number_format($total_after,0,',','.').'đ';
          }elseif(!Session::get('fee') && !Session::get('coupon')){
          $total_after = $total;
          echo number_format($total_after,0,',','.').'đ';
          }

          @endphp
        </li>
        @php
        $vnd_to_usd = $total_after/23083;
        $total_paypal = round($vnd_to_usd,2);
        \Session::put('total_paypal',$total_paypal);
        @endphp
        <div class="col-md-12">
          {{-- <div id="paypal-button"></div> --}}

        </div>
      </td>

    </tr>
    @else
    <tr>
      <td colspan="5">
        <center>
          @php
          echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
          @endphp
        </center>
      </td>
    </tr>
    @endif
  </tbody>



  </form>
  @if(Session::get('cart'))
  <tr>
    {{-- @if(!Session::get('success_paypal')==true) --}}
    <td>
      <form method="POST" action="{{url('/check-coupon')}}">
        @csrf
        <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
        <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">

      </form>
      @endif

    </td>
    {{-- <td>
      <form action="{{url('/vnpay-payment')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="total_vnpay" value="{{$total_after}}">
        <button type="submit" class="btn btn-default check_out" name="redirect">Thanh toán
          VNPAY</button>
      </form>
      <form action="{{url('/momo-payment')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="total_momo" value="{{$total_after}}">
        <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán
          MOMO</button>
      </form>
    </td> --}}

  </tr>

  @endif

</table>