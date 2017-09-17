<?php

// commcontroller是继承controller的,并且是位于admin下的
// 所以需要use主controller,然后命名空间要写admin
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //
}
