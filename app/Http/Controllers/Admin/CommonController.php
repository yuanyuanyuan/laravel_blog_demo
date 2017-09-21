<?php

// commcontroller是继承controller的,并且是位于admin下的
// 所以需要use主controller,然后命名空间要写admin
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');
        // 通过isVaild方法可以校验图片
        if ($file->isValid()) {
            // 图片需要重新处理上传后的文件名和文件路径
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis') . mt_rand(100, 999) . '.' . $entension;
            $path = $file->move(base_path() . '/uploads', $newName);
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }
}
