<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        Helpers::setCurrentPage('login');
        return view('authentication.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password'  => $request->password
        ];
        if (Sentinel::authenticate($credentials, $request->remember)) {
            return redirect(url('/'));
        }
        return redirect()->back()->with('message', 'البريد الإلكتروني أو كلمة المرور غير صحيحة.')->withInput(['email']);
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect(url('login'));
    }
}
