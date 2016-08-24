@extends('backend.layouts.master')
@section('controller','Danh mục')
@section('action','Danh sách')
@section('content')
    <div class="col-md-12 alert">
        <table class="table table-responsive table-bordered table-hover table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên danh mục</th>
                <th class="text-center">Tên không dấu</th>
                <th class="text-center">Danh mục cha</th>
                <th class="text-center">Hiển thị</th>
                <th class="text-center">Sửa</th>
                <th class="text-center">Xoá</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cates as $cate)
                <tr data-id="{{ $cate->id }}">
                    <td>{!! $cate->id !!}</td>
                    <td>{!! $cate->name !!}</td>
                    <td>{!! $cate->slug !!}</td>
                    <td>{!! getCateName($cate->parent_id) !!}</td>
                    <td>
                        @if($cate->status == true)
                            Hiện
                        @else
                            Ẩn
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{!! route('admin.cate.edit',$cate->id) !!}" class="btn btn-info"><i
                                    class="fa fa-pencil"></i></a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger delete-cate" data-id="{!! $cate->id !!}"><i
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
            $(".delete-cate").click(function () {
                var id = $(this).attr('data-id');
                if (confirm('Xác nhận xóa danh mục có ID = ' + id)) {
                    $.ajax({
                        url: 'ajax/cate/delete',
                        type: 'GET',
                        data: {
                            cate_id: id
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