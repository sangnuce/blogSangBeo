@extends('backend.layouts.master')
@section('controller','Danh mục')
@section('action','Cập nhật')
@section('content')
    <div class="col-md-12">
        <form role="form" action="{!! route('admin.cate.edit',$cate->id) !!}" method="POST">
            <input class="form-control" type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Danh mục cha</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Chọn danh mục</option>
                    {!! show_cates(0,"",old('parent_id',isset($cate->parent_id)?$cate->parent_id:0),$cate->id) !!}
                </select>
            </div>
            <div class="form-group">
                <label>Tên danh mục</label>
                <input class="form-control" type="text" name="name"
                       value="{!! old('name',isset($cate->name)?$cate->name:null) !!}">
            </div>
            <div class="form-group">
                <label>Từ khoá (cách nhau bởi dấu phẩy)</label>
                <input class="form-control" type="text" name="keywords" value="{!! old('keywords') !!}">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5">{!! old('description') !!}</textarea>
            </div>
            <div class="form-group">
                <label>Hiển thị danh mục: </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="1"
                           @if (old('status',$cate->status) ==  true)
                           checked
                            @endif
                    > Hiện
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0"
                           @if (old('status',$cate->status) == false)
                           checked
                            @endif
                    > Ẩn
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Nhập lại</button>
        </form>
    </div>
@endsection