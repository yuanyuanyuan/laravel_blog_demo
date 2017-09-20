<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        // 静态方法会丢失this指向,丢失了之后,如果要调用他的方法就要重新实例化
        // 直接实例化category实例调用方法
        // 将数据的处理逻辑放到数据model里面(tree,gettree)
//        $categorys = Category::tree();
        $categorys = (new Category)->tree();
        return view('admin.category.index')->with('data',$categorys);
    }

    //post.admin/category
    public function store()
    {

    }


    //get.admin/category/create   添加分类
    public function create()
    {

    }

    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

    //delete.admin/category/{category}   删除单个分类
    public function destroy()
    {

    }

    //put.admin/category/{category}    更新分类
    public function update()
    {

    }

    //get.admin/category/{category}/edit  编辑分类
    public function edit()
    {

    }
}
