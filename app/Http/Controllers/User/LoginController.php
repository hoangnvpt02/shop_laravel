<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function index() {
        if (Auth::check()) {
            return Helper::account();
        }

        return view("user.login", [
            'title' => 'Đăng nhập'
        ]);
    }

    public function create() {
        if (Auth::check()) {
            return Helper::account();
        }

        return view('user.register', [
            'title' => 'Đăng ký'
        ]);
    }

    public function createPost(Request $request) {
        $this->userServices->create($request);
        return redirect()->back();
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function store(Request $request) {
        $this -> validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => 2
        ])) {
            return redirect('/');
        }

        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => 1
        ])) {
            return redirect('/admin');
        }

        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => 3
        ])) {
            return redirect('/sale');
        }

        $request->session()->flash('error', 'Username hoặc Password không đúng');
        return redirect() -> back();
    }
}
