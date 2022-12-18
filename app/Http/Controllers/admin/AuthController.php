<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Login a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $data = $request->only('email','password');

        $validator = Validator::make($data, [
            'email' => ['required'],
            'password' => ['required']
        ]);

        if($validator->fails()) {
            return redirect('admin/dang-nhap');
        }
        $credentials = $data;
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/trang-chu')
                ->withSuccess('Đăng nhập thành công');
        }

        return redirect("admin/dang-nhap")->withSuccess('Tài khoản hoặc mật khẩu không đúng');
    }

    /**
     * Register the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.register');
    }

    /**
     * Register the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $data = $request->only('name','email','password');

        $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required','email'],
            'password' => ['required','min:6'],
            //'password_confirmation' => ['required','confirmed','min:6']
        ]);

        if($validator->fails()) {
            return redirect('admin/dang-ki');
        }

        $data['level'] = 0;
        $data['status'] = 1;

        $register = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
            'status' => $data['status']
        ]);
        return redirect("admin/dang-nhap");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('admin/dang-nhap');
    }
}
