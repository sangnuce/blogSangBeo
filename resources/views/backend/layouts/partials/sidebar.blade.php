<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{!! route('admin') !!}"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-folder fa-fw"></i> Danh mục<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.cate.add') !!}">Thêm mới</a>
                    </li>
                    <li>
                        <a href="{!! route('admin.cate.list') !!}">Danh sách</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-list-alt fa-fw"></i> Bài viết<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.post.add') !!}">Thêm mới</a>
                    </li>
                    <li>
                        <a href="{!! route('admin.post.list') !!}">Danh sách</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-comment fa-fw"></i> Bình luận<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.comment.list') !!}">Danh sách</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Người dùng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.user') !!}">Danh sách</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>