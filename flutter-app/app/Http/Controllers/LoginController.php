<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('backend.login');
    }
    public function showLoginForm()
    {
        return view('backend.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        // print_r($credentials);
        if (Auth::attempt($credentials)) {
            //lưu ngày giờ đăng nhập
            // $user=Auth::user();
            // $user->last_login_at=now();
            // $user->save();
            // Nếu đăng nhập thành công, chuyển hướng đến trang quản lý của admin
            // $this->middleware('admin');
            return redirect()->action([AdminController::class, 'index']);
            // return redirect()->route('events.index');
            // return view('backend.index');
        }
        // Nếu đăng nhập thất bại, quay lại trang đăng nhập
        Session::put("message", "Incorrect Username or Password❗");
        return redirect()->back()->withInput($request->only('username'));
    }
    
public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}
}