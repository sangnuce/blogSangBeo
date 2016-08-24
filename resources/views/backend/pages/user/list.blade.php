@extends('backend.layouts.master')
@section('controller','Người dùng')
@section('action','Danh sách')
@section('content')
    <div class="col-md-12 alert">
        <table class="table table-responsive table-bordered table-hover table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên đăng nhập</th>
                <th class="text-center">Tên người dùng</th>
                <th class="text-center">Email</th>
                <th class="text-center">Cấp bậc</th>
                <th class="text-center">Tình trạng</th>
                <th class="text-center">Sửa</th>
                <th class="text-center">Xoá</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr data-id="{{ $user->id }}">
                    <td>{!! $user->id !!}</td>
                    <td>{!! $user->username !!}</td>
                    <td>{!! $user->name !!}</td>
                    <td>{!! $user->email !!}</td>
                    <td>
                        @if($user->isAdmin())
                            Admin
                        @elseif($user->isMod())
                            Mod
                        @else
                            Member
                        @endif
                    </td>
                    <td>
                        @if($user->status == true)
                            Đã kích hoạt
                        @else
                            Chưa kích hoạt
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{!! route('admin.user.edit',$user->id) !!}" class="btn btn-info"><i
                                    class="fa fa-pencil"></i></a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger delete-user" data-id="{!! $user->id !!}"><i
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
            $(".delete-user").click(function () {
                var id = $(this).attr('data-id');
                if (confirm('Xác nhận xóa người dùng có ID = ' + id)) {
                    $.ajax({
                        url: 'ajax/user/delete',
                        type: 'GET',
                        data: {
                            user_id: id
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