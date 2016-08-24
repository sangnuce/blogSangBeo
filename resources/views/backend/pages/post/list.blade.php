@extends('backend.layouts.master')
@section('controller','Bài viết')
@section('action','Danh sách')
@section('content')
    <div class="col-md-12 alert">
        <table class="table table-responsive table-bordered table-hover table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Người đăng</th>
                <th class="text-center">Tiêu đề</th>
                <th class="text-center">Tiêu đề không dấu</th>
                <th class="text-center">Từ khoá</th>
                <th class="text-center">Mô tả</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Danh mục</th>
                <th class="text-center">Hiển thị</th>
                <th class="text-center">Sửa</th>
                <th class="text-center">Xoá</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr data-id="{{ $post->id }}">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>
                        {{ $post->title }}
                        @if($post->image != "")
                            <br>
                            <img src="uploads/images/{{$post->image}}" class="preview-image" alt="{{ $post->title }}">
                        @endif
                    </td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->keywords }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->tags }}</td>
                    <td>{{ getCateName($post->cate_id) }}</td>
                    <td>
                        @if($post->status == true)
                            Hiện
                        @else
                            Ẩn
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-info"><i
                                    class="fa fa-pencil"></i></a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger delete-post" data-id="{{ $post->id }}"><i
                                    class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('before-custom-style')
    <link rel="stylesheet" href="plugins/datatables/media/css/dataTables.bootstrap.min.css">
@endsection

@section('before-custom-script')
    <script src="plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="plugins/datatables/media/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('after-custom-script')
    <script>
        $(function () {
            $(".datatable").DataTable({
                "aaSorting": []
            });
            $(".delete-post").click(function () {
                var id = $(this).attr('data-id');
                if (confirm('Xác nhận xóa bài viết có ID = ' + id)) {
                    $.ajax({
                        url: 'ajax/post/delete',
                        type: 'GET',
                        data: {
                            post_id: id
                        },
                        success: function (data) {
                            if (data.success == true) {
                                $("tr[data-id=" + id + "]").slideUp('slow');
                            }
                            alert(data.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection