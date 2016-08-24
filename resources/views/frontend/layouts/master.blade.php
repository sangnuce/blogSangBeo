<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">
    <title>@yield('title')</title>
    <base href="{{ asset('') }}">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    @yield('before-custom-style')
    <link rel="stylesheet" href="css/style.css">
    @yield('after-custom-style')
</head>
<body>
<div class="wrapper">
    <header>
        @include('frontend.layouts.partials.navbar')
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-lg-9">
                @yield('content')
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="row">
                    @include('frontend.layouts.partials.search')
                    @include('frontend.layouts.partials.categories')
                </div>
                <div class="row">
                    @include('frontend.layouts.partials.topviewposts')
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.partials.footer')
</div>

<script src="plugins/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

@yield('before-custom-script')
<script src="js/myscript.js"></script>
@yield('after-custom-script')
</body>
</html>