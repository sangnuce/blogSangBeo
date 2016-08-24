<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">Sáng Béo Blog</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li>
            <a href="{{route('account')}}"><i class="fa fa-user"></i> {{Auth::user()->name}} ({{Auth::user()->username}})</a>
        </li>
        <li>
            <a href="{{ route('admin') }}"><i class="fa fa-gears"></i> Trang quản lý</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
        </li>
    </ul>
    @include('backend.layouts.partials.sidebar')
</nav>