@extends('layout')
@section('content_cart')

<section id="cart_items">
	<div class="container" style="width:900px">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Giỏ hàng của bạn</li>
			</ol>
		</div>
		@if(session()->has('message'))
		<div class="alert alert-success">
			{!! session()->get('message') !!}
		</div>
		@elseif(session()->has('error'))
		<div class="alert alert-danger">
			{!! session()->get('error') !!}
		</div>
		@endif
		<div class="table-responsive cart_info">

			<form action="{{url('/update-cart')}}" method="POST">
				@csrf
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


									<input class="cart_quantity" style="width:50px" type="number"
										@if(Session::get('success_paypal')==true) readonly @endif min="1"
										name="cart_qty[{{$cart['session_id']}}]" size="10" value="{{$cart['product_qty']}}">


								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}}đ

								</p>
							</td>
							@if(!Session::get('success_paypal')==true)

							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i
										class="fa fa-times"></i></a>
							</td>
							@endif
						</tr>

						@endforeach
						<tr>
							@if(!Session::get('success_paypal')==true)
							<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
									class="check_out btn btn-default btn-sm"></td>
							<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
							@endif

							<td>
								@if(Session::get('customer_id'))
								<a class="btn btn-success" style="margin-top:16px" href=" {{url('/checkout')}}">
									Đến bước Đặt hàng
									@else
									<a class="btn btn-success" style="margin-top:16px" href=" {{url('/dang-nhap')}}">Đến bước Đặt hàng</a>
									@endif
							</td>


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
								<li>Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
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
			@if(!Session::get('success_paypal')==true)
			@if(Session::get('cart'))
			<tr>
				<td>

					<form method="POST" action="{{url('/check-coupon')}}">
						@csrf
						<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>

						<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">





					</form>
				</td>
				<td>
					@if(Session::get('coupon'))
					<a class="btn btn-default check_out" style="
						margin-bottom: 70px;
				" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
					@endif
				</td>
			</tr>
			@endif
			@endif

			</table>

		</div>
	</div>
</section>
<!--/#cart_items-->



@endsection