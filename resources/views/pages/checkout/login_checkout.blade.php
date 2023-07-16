@extends('layout')
@section('content')

<section id="form">
	<!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">
				<div class="login-form">
					<!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					@php
					$message = Session::get('message');
					$error = Session::get('error');

					if($message){
					echo '<div class="alert alert-success">'.$message.'</div>';
					Session::put('message',null);}
					elseif($error){


					echo '<div class="alert alert-danger">'.$error.'</div>';
					Session::put('error',null);
					}





					@endphp





					{{--
					@if(session()->has('message'))
					<div class="alert alert-success">
						{!! session()->get('message') !!}
					</div>
					@elseif(session()->has('error'))
					<div class="alert alert-danger">
						{!! session()->get('error') !!}
					</div>
					@endif --}}
					<form action="{{URL::to('/login-customer')}}" method="POST">
						{{csrf_field()}}

						<input type="text" name="email_account" placeholder="Tài khoản" />
						<input type="password" name="password_account" placeholder="Password" />

						<span>
							<a href="{{url('/quen-mat-khau')}}">Quên mật khẩu?</a>
						</span>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>

					<style type="text/css">
						ul.list-login {
							margin: 10px;
							padding: 0;
						}

						ul.list-login li {
							display: inline;
							margin: 5px;
						}
					</style>
					<ul class="list-login">
						<li>
							<a href="{{url('login-customer-google')}}"><img src="{{asset('public/frontend/images/gg.png')}}"
									alt="Đăng nhập bằng tài khoản google" width="10%">
							</a>
						</li>
						{{-- <li>
							<a href="{{url('login-customer-google')}}"><img src="{{asset('public/frontend/images/gg')}}"
									alt="Đăng nhập bằng tài khoản google" width="100%"></a>
						</li> --}}
					</ul>
				</div>
				<!--/login form-->
			</div>
			<div class="col-sm-2">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-3">

				<div class="signup-form">
					<!--sign up form-->
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
					<h2>Đăng ký</h2>
					<form action="{{URL::to('/add-customer')}}" method="POST">
						{{ csrf_field() }}

						<input type="text" name="customer_name" placeholder="Họ và tên" />
						<input type="text" name="customer_email" placeholder="Địa chỉ email" />
						<input type="password" name="customer_password" placeholder="Mật khẩu" />
						<input type="text" name="customer_phone" placeholder="Phone" />
						<button type="submit" class="btn btn-default">Đăng ký</button>
					</form>
				</div>
				<!--/sign up form-->
			</div>

		</div>
	</div>
</section>
<!--/form-->

@endsection