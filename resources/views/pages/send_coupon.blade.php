<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Gửi mã khuyến mãi cho khách hàng </title>
</head>

<body>
	<div class="coupon">
		<div class="container">
			<h3>Mã khuyến mãi từ Shop <a target="_blank" href="http://laptopstore.com/LaptopStore/">LapTop Store
				</a></h3>

		</div>
		<div class="container">
			<h2 class="note">
				@if($coupon['coupon_condition'] == 1)
				Giảm {{$coupon['coupon_number']}}%
				@else
				Giảm {{number_format($coupon['coupon_number'],0,',','.')}}k
				@endif
				cho tổng đơn hàng đặt mua
			</h2>
		</div>
		<div class="container">
			<p class="code">Sử dụng Code sau: <span class="promo"><b>{{$coupon['coupon_code']}}</b></span> với chỉ
				{{$coupon['coupon_time']}} mã giảm giá, nhanh tay lên nào!
			</p>
			<p class="expire">Ngày bắt đầu: {{$coupon['start_coupon']}} - Ngày hết hạn:{{$coupon['end_coupon']}} </p>
		</div>
	</div>

</body>

</html>