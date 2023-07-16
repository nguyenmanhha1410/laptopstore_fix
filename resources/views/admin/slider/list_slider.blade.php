@extends('admin_layout')
@section('admin_content')
<div class="tables">
  <h2 class="title1">Liệt kê Banner</h2>


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
          <th>Tên slide</th>
          <th>Hình ảnh</th>
          <th>Mô tả</th>
          <th>Tình trạng</th>

        </tr>
      </thead>
      <tbody>
        @foreach($all_slide as $key => $slide)
        <tr>
          <th scope="row">{{1 + $key++}}</th>
          <td>{{ $slide->slider_name }}</td>
          <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"></td>
          <td>{{ $slide->slider_desc }}</td>
          <td><span class="text-ellipsis">
              <?php
               if($slide->slider_status==1){
                ?>
              <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><i class="fa-solid fa-toggle-on"></i>
            </span></a>
            <?php
                 }else{
                ?>
            <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><i class="fa-solid fa-toggle-off"></i></a>
            <?php
               }
              ?>
            </span>
          </td>
          <td>

            <a onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')"
              href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
            </a>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {!!$all_slide->links()!!}


</div>
@endsection