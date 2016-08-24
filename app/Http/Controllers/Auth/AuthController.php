<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin()
    {
        return view('frontend.pages.login');
    }

    public function postLogin(LoginRequest $rq)
    {
        $user = array(
            'username' => $rq->username,
            'password' => $rq->password
        );
        $remember = isset($rq->chk_remember) && $rq->chk_remember == 'on' ? true : false;
        if (Auth::attempt($user, $remember)) {
            return redirect()->route('home')->with(['flash_class' => 'alert-success', 'flash_message' => 'Đăng nhập thành công!']);
        } else {
            return redirect()->route('login')->withErrors('Thông tin đăng nhập không chính xác!')->withInput($rq->toArray());
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login')->with(['flash_class' => 'alert-info', 'flash_message' => 'Bạn vừa đăng xuất khỏi hệ thống!']);
    }
}
