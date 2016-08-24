@extends('frontend.layouts.master')
@section('title','Đăng ký tài khoản - Sáng Béo Blog')
@section('keywords','Đăng ký tài khoản, Sáng Béo Blog')
@section('description','Đăng ký tài khoản - Sáng Béo Blog')
@section('author','Sáng Béo')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                @include('backend.layouts.partials.notify')
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Đăng ký tài khoản</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{!! route('register') !!}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" }>
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập: *</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                           value="{!! old('username') !!}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu: *</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                           value="{!! old('password') !!}">
                                </div>
                                <div class="form-group">
                                    <label for="repassword">Xác nhận mật khẩu: *</label>
                                    <input class="form-control" type="password" name="repassword" id="repassword"
                                           value="{!! old('repassword') !!}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ tên: *</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                           value="{!! old('name') !!}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email: *</label>
                                    <input class="form-control" type="text" name="email" id="email"
                                           value="{!! old('email') !!}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                    <button type="reset" class="btn btn-default">Nhập lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection