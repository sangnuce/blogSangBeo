@extends('frontend.layouts.master')
@section('title','Đăng nhập - Sáng Béo Blog')
@section('keywords','Đăng nhập, Sáng Béo Blog')
@section('description','Đăng nhập - Sáng Béo Blog')
@section('author','Sáng Béo')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                @include('backend.layouts.partials.notify')
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Đăng nhập</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{!! route('login') !!}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" }>
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập: *</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                           value="{!! old('username') !!}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu: *</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                           value="{!! old('password') !!}" required>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="chk_remember"> Ghi nhớ?
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                    <a href="#" class="btn btn-default">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection