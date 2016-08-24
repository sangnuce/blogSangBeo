<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel - SangBeo Blog</title>

    <base href="{{ asset('') }}">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="plugins/metisMenu/dist/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    @yield('before-custom-style')
    <link href="backend/dist/css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <link href="backend/dist/css/style.css" rel="stylesheet" type="text/css">
    @yield('after-custom-style')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">
    @include('backend.layouts.partials.navbar')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">@yield('controller') <span class="small">@yield('action')</span></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('backend.layouts.partials.notify')
            @yield('content')
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<script src="plugins/jquery/dist/jquery.min.js"></script>
<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/metisMenu/dist/metisMenu.min.js"></script>

@yield('before-custom-script')
<script src="backend/dist/js/sb-admin-2.js"></script>
<script src="backend/js/myscript.js"></script>
@yield('after-custom-script')
</body>
</html>