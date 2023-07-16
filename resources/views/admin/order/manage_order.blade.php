@extends('admin_layout')
@section('admin_content')
<div class="tables">
  <h2 class="title1">Liệt kê đơn hàng</h2>


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
          <th>Mã đơn hàng</th>
          <th>Ngày đặt</th>
          <th>Tình trạng đơn hàng</th>
          <th>Lý do hủy</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach($getorder as $key => $ord)

        <tr>
          <th scope="row">{{1 + $key++}}</th>
          <td>{{ $ord->order_code }}</td>
          <td>{{ $ord->created_at }}</td>

          <td>@if($ord->order_status==1)
            <span class="text text-success">

              Đơn hàng mới
            </span>
            @elseif($ord->order_status==2)
            <span class="text text-primary">

              Đã xử lý - đã giao hàng
            </span>
            @else

            <span class="text text-danger">

              Đơn hàng đã bị hủy
            </span>
            @endif
          </td>
          <td>{{$ord->order_destroy}}</td>


          <td>
            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-eye text-success text-active"></i></a>

            <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
              href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
            </a>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!!$getorder->links()!!}

</div>
@endsection