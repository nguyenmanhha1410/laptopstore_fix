@extends('layout')
@section('content')
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
          {{-- <th>Tình trạng đơn hàng</th> --}}
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

              Đang xử lý
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

          <td>
            @if($ord->order_status==1 )
            <p>
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Hủy đơn
                hàng</button>
            </p>
            @endif
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <form>
                  @csrf
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                    </div>
                    <div class="modal-body">
                      <p><textarea class="lydohuydon" required rows="5"
                          placeholder="Lí do hủy đơn hàng....(bắt buộc)"></textarea>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                      <button type="button" id="{{ $ord->order_code }}" onclick="Huydonhang(this.id)"
                        class="btn btn-success ">Gửi</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <p>

              <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit"
                ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>Xem đơn hàng</a>
            </p>

            {{-- <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
              href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
            </a> --}}

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!!$getorder->links()!!}

</div>
@endsection