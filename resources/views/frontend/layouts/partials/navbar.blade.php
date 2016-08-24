<nav class="navbar navbar-default navbar-static-top navbar-fixed-top" id="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{!! route('home') !!}" class="navbar-brand">Sáng Béo Blog</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            @if (Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{route('account')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}
                            ({{Auth::user()->username}})</a>
                    </li>
                    @if(Auth::user()->isAdmin() || Auth::user()->isMod())
                        <li><a href="{{ route('admin') }}"><i class="fa fa-gears"></i> Trang quản lý</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                </ul>
            @else
                <div class="nav navbar-nav navbar-right">
                    <a href="{!! route('register') !!}" class="btn btn-danger navbar-btn">Register</a>
                    <a href="{!! route('login') !!}" class="btn btn-primary navbar-btn">Login</a>
                </div>
            @endif
        </div>
    </div>
</nav>