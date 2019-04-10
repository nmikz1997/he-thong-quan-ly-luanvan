<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use App\User;

class UserController extends Controller
{

    public function login()
    {
        return view('admin.login.login');
    }


    public function check(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($data))
        {
            return redirect('dsdetai');
        }
        else
        {
            return redirect('login')->with('message', "Đăng nhập thất bại");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
