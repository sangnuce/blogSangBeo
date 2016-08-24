@extends('backend.layouts.master')
@section('controller','Bài viết')
@section('action','Thêm mới')
@section('content')
    <div class="col-md-12">
        <form role="form" action="{{ route('admin.post.add') }}" method="POST" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Danh mục *</label>
                <select class="form-control" name="cate_id">
                    <option value="0">Chọn danh mục</option>
                    {!! show_cates(0,"",old('cate_id',0)) !!}
                </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề tin *</label>
                <input class="form-control" type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <input class="form-control" type="file" name="image" value="{{ old('image') }}">
            </div>
            <div class="form-group">
                <label>Từ khoá (cách nhau bởi dấu phẩy)</label>
                <input class="form-control" type="text" name="keywords" value="{{ old('keywords') }}">
            </div>
            <div class="form-group">
                <label>Mô tả *</label>
                <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Nội dung *</label>
                <textarea class="form-control ckeditor" name="body">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <label>Tags (cách nhau bởi dấu phẩy)</label>
                <input class="form-control" type="text" name="tags" value="{{ old('tags') }}">
            </div>
            <div class="form-group">
                <label>Hiển thị tin: </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="1"
                           @if (old('status',true) ==  true)
                           checked
                            @endif
                    > Hiện
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0"
                           @if (old('status',true) == false)
                           checked
                            @endif
                    > Ẩn
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng tin</button>
            <button type="reset" class="btn btn-default">Nhập lại</button>
        </form>
    </div>
@endsection

@section('before-custom-script')
    <script src="plugins/ckeditor/ckeditor.js"></script>
@endsection