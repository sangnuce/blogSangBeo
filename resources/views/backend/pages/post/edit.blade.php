@extends('backend.layouts.master')
@section('controller','Bài viết')
@section('action','Cập nhật')
@section('content')
    <div class="col-md-12">
        <form role="form" action="{{ route('admin.post.edit', $post->id) }}" method="POST"
              enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Danh mục *</label>
                <select class="form-control" name="cate_id">
                    <option value="0">Chọn danh mục</option>
                    {!! show_cates(0,"",old('cate_id',isset($post->cate_id)?$post->cate_id:0)) !!}
                </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề tin *</label>
                <input class="form-control" type="text" name="title"
                       value="{{ old('title',isset($post->title)?$post->title:null) }}">
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                @if($post->image != "")
                <div class="edit-preview-image">
                    <img src="uploads/images/{{$post->image}}" alt="{{$post->title}}">
                    <button type="button" class="btn btn-danger remove-image" data-id="{{$post->id}}">Loại bỏ</button>
                </div>
                @endif
                <input class="form-control" type="file" name="image" value="{{ old('image') }}">
            </div>
            <div class="form-group">
                <label>Từ khoá (cách nhau bởi dấu phẩy)</label>
                <input class="form-control" type="text" name="keywords"
                       value="{{ old('keywords',isset($post->keywords)?$post->keywords:null) }}">
            </div>
            <div class="form-group">
                <label>Mô tả *</label>
                <textarea class="form-control" name="description"
                          rows="5">{{ old('description',isset($post->description)?$post->description:null) }}</textarea>
            </div>
            <div class="form-group">
                <label>Nội dung *</label>
                <textarea class="form-control ckeditor"
                          name="body">{{ old('body',isset($post->body)?$post->body:null) }}</textarea>
            </div>
            <div class="form-group">
                <label>Tags (cách nhau bởi dấu phẩy)</label>
                <input class="form-control" type="text" name="tags"
                       value="{{ old('tags',isset($post->tags)?$post->tags:null) }}">
            </div>
            <div class="form-group">
                <label>Hiển thị tin: </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="1"
                           @if (old('status',$post->status) ==  true)
                           checked
                            @endif
                    > Hiện
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0"
                           @if (old('status',$post->status) == false)
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

@section('before-custom-script')
    <script src="plugins/ckeditor/ckeditor.js"></script>
@endsection

@section('after-custom-script')
    <script>
        $(function(){
            $(".remove-image").click(function(){
                if(confirm('Xác nhận xoá hình ảnh?')){
                    var post_id = $(this).attr("data-id");
                    $.ajax({
                        url: 'ajax/post/remove-image',
                        type: 'GET',
                        data: {
                            post_id: post_id
                        },
                        success: function (data) {
                            if (data.success == true) {
                                $(".edit-preview-image").slideUp('slow');
                            }
                            alert(data.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection