@extends('backend.layouts.master')
@section('controller','Bình luận')
@section('action','Danh sách')
@section('content')
    <div class="col-md-12 alert">
        <table class="table table-responsive table-bordered table-hover table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Người gửi</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Bài viết</th>
                <th class="text-center">Thời gian gửi</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Duyệt</th>
                <th class="text-center">Xoá</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr data-id="{{ $comment->id }}">
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->username }}</td>
                    <td>{!! $comment->comment !!}</td>
                    <td><a href="{{route('post',$comment->post->id)}}">{{ $comment->post->title }}</a></td>
                    <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($comment->status == true)
                            Đã duyệt
                        @else
                            Chưa duyệt
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn
                        @if($comment->status == 1) btn-success @else btn-info @endif
                                approve-comment" data-id="{{ $comment->id }}"><i
                                    class="fa fa-check"></i></button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger delete-comment" data-id="{{ $comment->id }}"><i
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
            $(".approve-comment").click(function () {
                var btn = $(this);
                var id = $(this).attr('data-id');
                var status = 1;
                if (btn.hasClass('btn-success')) {
                    status = 0;
                }
                $.ajax({
                    url: 'ajax/comment/approve',
                    type: 'GET',
                    data: {
                        comment_id: id,
                        status: status
                    },
                    success: function (data) {
                        if (data.success == true) {
                            if (status == 1) {
                                btn.removeClass('btn-info');
                                btn.addClass('btn-success');
                                btn.parent().prev().text('Đã duyệt');
                            } else {
                                btn.removeClass('btn-success');
                                btn.addClass('btn-info');
                                btn.parent().prev().text('Chưa duyệt');
                            }
                        }
                        alert(data.message);
                    }
                });
            });
            $(".delete-comment").click(function () {
                var id = $(this).attr('data-id');
                if (confirm('Xác nhận xóa bình luận có ID = ' + id)) {
                    $.ajax({
                        url: 'ajax/comment/delete',
                        type: 'GET',
                        data: {
                            comment_id: id
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