@extends('admin_layout')
@section('admin_content')
<div class="form-grids row widget-shadow" data-example-id="basic-forms">
    <div class="form-title">
        <h4>Thêm danh mục sản phẩm :</h4>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @php
    $message = Session::get('message');
    if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
    }
    @endphp
    <div class="form-body">
        <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Tên danh mục</label>
                <input type="text" class="form-control" onkeyup="ChangeToSlug();" name="category_name" id="slug"
                    placeholder="Điền tên danh mục" />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="slug_category_product" class="form-control" id="convert_slug"
                    placeholder="Dien-ten-danh-muc">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả danh mục</label>
                <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc"
                    id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Từ khóa danh mục</label>
                <textarea style="resize: none" rows="8" class="form-control" name="category_product_keywords"
                    id="exampleInputPassword1" placeholder="Từ khóa danh mục"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Thuộc danh mục</label>
                <select name="category_parent" class="form-control input-sm m-bot15">
                    <option value="1">---Danh mục cha---</option>
                    @foreach($category as $key => $val)

                    <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hiển thị</label>
                <select name="category_product_status" class="form-control input-sm m-bot15">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>

                </select>
            </div>

            <button type="submit" name="add_category_product" class="btn btn-default">Thêm danh mục</button>
        </form>
    </div>
</div>
@endsection