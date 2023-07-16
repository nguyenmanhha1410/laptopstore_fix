@extends('admin_layout')
@section('admin_content')
<div class="form-grids row widget-shadow" data-example-id="basic-forms">
    <div class="form-title">
        <h4>Thêm thương hiệu sản phẩm :</h4>
    </div>
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

    @php
    $message = Session::get('message');
    if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
    }
    @endphp

    <div class="form-body">
        <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Tên thương hiệu</label>
                <input type="text" name="brand_name" class="form-control" onkeyup="ChangeToSlug();" id="slug"
                    placeholder="Tên danh mục">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="brand_slug" class="form-control" id="convert_slug" placeholder="Slug">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc"
                    id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hiển thị</label>
                <select name="brand_product_status" class="form-control input-sm m-bot15">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>

                </select>
            </div>


            <button type="submit" name="add_category_product" class="btn btn-default">Thêm thương hiệu</button>
        </form>
    </div>
</div>
@endsection