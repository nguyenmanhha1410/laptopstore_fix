@extends('layout')
@section('content_category')
<h2 class="title text-center" style="border-top: 1px solid;
padding-top: 10px;">Cập nhật thông tin tài khoản : {{Session::get('customer_name')}}</h2>

<form action="{{route('update-info-customer')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" readonly value="<?php echo($customer_info['customer_email']); ?>" required name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
     
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" required value="<?php echo($customer_info['customer_name'] );?>" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
       
      </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input type="text" class="form-control" name="phone" value="<?php echo($customer_info['customer_phone']); ?>" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone">
       
      </div>
   
    <div class="form-group">
        <label for="exampleInputPassword1">Password mới(nếu có)</label>
        <input type="password_new" class="form-control" id="exampleInputPassword1" name="new_password" placeholder="Password New">
      </div>
   
    <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
  </form>
<!--/recommended_items-->
@endsection