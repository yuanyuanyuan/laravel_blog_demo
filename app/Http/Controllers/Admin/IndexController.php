<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController
{
    //
    public function login()
    {
        return '登录';
    }

    public function index()
    {
//        $pdo =DB::connection()->getPdo();
//        dd($pdo);
        return '主页';
    }

    public function pass()
    {
        if ($input = Input::all()) {

            // password字段跟form表单字段一样
            // confirmed 需要在form表单字段里面匹配_confirmation
            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required' => '新密码不能为空!',
                'password.between' => '新密码必须在6-20位之间!',
                'password.confirmed' => '新密码确认不正确'
            ];
            // Validator是laravel自带的校验类
            $validator = \Validator::make($input, $rules, $message);
            // 获取校验结果
            if ($validator->passes()) {
                $user = User::first();
                $_password = \Crypt::decrypt($user->user_pass);
                if ($input['password_o'] == $_password) {
                    $user->user_pass = \Crypt::encrypt($input['password']);
                    $user->save();
                    return back()->with('errors', '密码修改成功');
                } else {
                    // with方法传输的是一个字符串
                    return back()->with('errors', '原密码错误');
                }
            } else {
                // witherrors传输的是一个对象
                return back()->withErrors($validator);
            }
        } else {
            return view('admin.pass');
        }
    }
}
