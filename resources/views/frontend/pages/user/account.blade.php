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
                            <h3 class="panel-title text-center">Thông tin tài khoản</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{!! route('account') !!}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" }>
                                <div class="form-group">
                                    <label for="name">Họ tên: *</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                           value="{!! old('name', isset($user->name)?$user->name:null) !!}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email: *</label>
                                    <input class="form-control" type="text" name="email" id="email"
                                           value="{!! old('email', isset($user->email)?$user->email:null) !!}">
                                </div>
                                <div class="well">
                                    <fieldset>
                                        <legend>Đổi mật khẩu (để trống nếu giữ nguyên)</legend>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu hiện tại:</label>
                                            <input class="form-control" type="password" name="password" id="password"
                                                   value="{!! old('password') !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu mới:</label>
                                            <input class="form-control" type="password" name="newpassword"
                                                   id="newpassword"
                                                   value="{!! old('newpassword') !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="repassword">Xác nhận mật khẩu mới:</label>
                                            <input class="form-control" type="password" name="newpassword_confirmation"
                                                   id="newpassword_confirmation"
                                                   value="{!! old('newpassword_confirmation') !!}">
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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