<?php

// 继承commoncontroller,并且因为他是位于admin下,命名空间需要明确是在Admin下
namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Lib\code\Code;

class LoginController extends CommonController
{
    //
    public function login()
    {
        if ($input = Input::all()) {
            $code = new Code;
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code) {
                return back()->with('msg', '验证码错误');
            }
            $user = User::first();
//            if ($user->user_name != $input['user_name']
//                || \Crypt::decrypt($user->user_pass) != $input['user_pass']) {
//                return back()->with('msg','用户名或者密码错误');
//            }
            session(['user'=>$user]);
            return 'ok';
        } else {
//            $user = User::all();
//            dd($user);
            return view('admin.login');
        }

    }

    public function code()
    {
        $code = new Code;
        $code->make();
    }

    public function getcode()
    {
        $code = new Code;
        $test = $code->get();
        echo $test;
    }

    public function logout(){
        session(['user'=>null]);
        return redirect('admin.login');
    }
}
