<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getRegister()
    {
        return view('frontend.pages.register');
    }

    public function postRegister(RegisterRequest $rq)
    {
        $user = new User();
        $user->username = $rq->username;
        $user->password = Hash::make($rq->password);
        $user->name = $rq->name;
        $user->email = $rq->email;
        $user->level = 0;
        $user->status = true;
        $rs = $user->save();
        if ($rs == false) {
            return redirect()->route('register')->withErrors('Có lỗi xảy ra!')->withInput($rq->toArray());
        }
        $login = array('username' => $rq->username, 'password' => $rq->password);
        if (Auth::attempt($login)) {
            return redirect()->route('home')->with(['flash_class' => 'alert-success', 'flash_message' => 'Đăng ký thành công!']);
        }
        return redirect()->route('login')->with(['flash_class' => 'alert-success', 'flash_message' => 'Đăng ký thành công!'])->withInput($rq->toArray());
    }

    public function getList()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('backend.pages.user.list', compact('users'));
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect(route('admin.user.list'))->withErrors('Không tồn tại người dùng có ID = ' . $id);
        }
        if (Auth::user()->isAdmin() || !$user->isAdmin()) {
            return view('backend.pages.user.edit', compact('user'));
        }
        return redirect(route('admin.user.list'))->withErrors('Bạn không được quyền thực hiện thao tác này với người dùng có cấp bậc cao hơn');
    }

    public function postEdit(Request $rq, $id)
    {
        $this->validate(
            $rq,
            [
                'username' => 'required|regex:/^[\w]+$/|unique:users,username,' . $id,
                'name' => 'required',
                'email' => 'required|email',
                'level' => 'sometimes|required|not_in:-1'
            ],
            [
                'username.required' => 'Bắt buộc nhập tên đăng nhập!',
                'username.unique' => 'Tên đăng nhập đã tồn tại!',
                'username.regex' => 'Tên đăng nhập chỉ được chứa dấu gạch dưới, các chữ số và các kí tự a-z, A-Z',
                'name.required' => 'Bắt buộc nhập họ tên!',
                'email.required' => 'Bắt buộc nhập email!',
                'email.email' => 'Email không đúng định dạng',
                'level.required' => 'Bắt buộc chọn cấp bậc!',
                'level.not_in' => 'Bắt buộc chọn cấp bậc!'
            ]
        );

        $user = User::find($id);
        $user->username = $rq->username;
        $user->name = $rq->name;
        $user->email = $rq->email;
        if ($rq->has('level')) {
            $user->level = $rq->level;
        }
        $user->status = $rq->status;
        $user->save();
        return redirect()->route('admin.user.list')->with(['flash_class' => 'alert-success', 'flash_message' => 'Cập nhật thành công!']);
    }

    public function viewUserPost($id)
    {
        $user = User::find($id);
        if(empty($user) || $user->status == 0) {
            return redirect()->route('home')->with(['flash_class' => 'alert-info', 'flash_message' => 'Người dùng không khả dụng!']);
        }
        return view('frontend.pages.user.post', ['user' => $user]);
    }

    public function getAccount()
    {
        $user = Auth::user();
        return view('frontend.pages.user.account', ['user' => $user]);
    }

    public function postAccount(Request $rq)
    {
        $this->validate(
            $rq,
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required_with:newpassword',
                'newpassword' => 'required_with:password',
                'newpassword_confirmation' => 'required_with:newpassword|same:newpassword'
            ],
            [
                'name.required' => 'Bắt buộc nhập họ tên!',
                'email.required' => 'Bắt buộc nhập email!',
                'email.email' => 'Email không đúng định dạng',
                'password.required_with' => 'Phải nhập mật khẩu hiện tại để đổi mật khẩu',
                'newpassword.required_with' => 'Phải nhập mật khẩu mới để đổi mật khẩu',
                'newpassword_confirmation.required_with' => 'Bạn chưa xác nhận mật khẩu mới',
                'newpassword_confirmation.same' => 'Mật khẩu xác nhận không trùng khớp'
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->name = $rq->name;
        $user->email = $rq->email;
        if ($rq->has('password')) {
            $account = ['username' => $user->username, 'password' => $rq->password];
            if (Auth::attempt($account)) {
                $user->password = Hash::make($rq->newpassword);
            } else {
                return redirect()->route('account')->withInput($rq->toArray())->withErrors('Mật khẩu hiện tại không chính xác');
            }
        }
        $user->save();
        return redirect()->route('account')->with(['flash_class' => 'alert-success', 'flash_message' => 'Cập nhật thông tin thành công']);
    }
}