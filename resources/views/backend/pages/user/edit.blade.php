@extends('backend.layouts.master')
@section('controller','Người dùng')
@section('action','Cập nhật')
@section('content')
    <div class="col-md-12">
        <form action="{!! route('admin.user.edit',$user->id) !!}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" }>
            <div class="form-group">
                <label for="username">Tên đăng nhập: *</label>
                <input class="form-control" type="text" name="username" id="username"
                       value="{!! old('username',isset($user->username)?$user->username:null) !!}">
            </div>
            <div class="form-group">
                <label for="name">Họ tên: *</label>
                <input class="form-control" type="text" name="name" id="name"
                       value="{!! old('name',isset($user->name)?$user->name:null) !!}">
            </div>
            <div class="form-group">
                <label for="email">Email: *</label>
                <input class="form-control" type="text" name="email" id="email"
                       value="{!! old('email',isset($user->email)?$user->email:null) !!}">
            </div>
            @if(Auth::user()->isAdmin())
                <div class="form-group">
                    <label for="email">Cấp bậc: *</label>
                    <select class="form-control" name="level" id="level">
                        <option value="-1">Chọn cấp bậc</option>
                        <option value="0"
                                @if(old('level',isset($user->level)?$user->level:null) == 0)
                                selected
                                @endif
                        >Member
                        </option>
                        <option value="1"
                                @if(old('level',isset($user->level)?$user->level:null) == 1)
                                selected
                                @endif
                        >Mod
                        </option>
                        <option value="2"
                                @if(old('level',isset($user->level)?$user->level:null) == 2)
                                selected
                                @endif
                        >Admin
                        </option>
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label>Tình trạng: </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="1"
                           @if (old('status',$user->status) ==  true)
                           checked
                            @endif
                    > Đã kích hoạt
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0"
                           @if (old('status',$user->status) == false)
                           checked
                            @endif
                    > Chưa kích hoạt
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-default">Nhập lại</button>
            </div>
        </form>
    </div>
@endsection