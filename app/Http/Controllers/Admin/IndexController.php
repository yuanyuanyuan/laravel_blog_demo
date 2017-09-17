<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    //
    public function login(){
        return '登录';
    }

    public function index(){
        $pdo =DB::connection()->getPdo();
        dd($pdo);
        return '主页';
    }
}
