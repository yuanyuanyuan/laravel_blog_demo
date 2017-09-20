<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

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
        // 排除掉token信息
        $input = Input::except('_token');
        $rules = [
            'cate_name'=>'required',
        ];

        $message = [
            'cate_name.required'=>'分类名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            // create方法会将所有数据写入数据库,但是要注意fillable和guarded的区别
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }


    //get.admin/category/create   添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }

    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

    //delete.admin/category/{category}   删除单个分类
    public function destroy($cate_id)
    {
        // 删除父分类之后需要处理子分类的pid
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //put.admin/category/{category}    更新分类
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        // $cate_id的传入是resource资源路由的处理
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','分类信息更新失败，请稍后重试！');
        }
    }

    //get.admin/category/{category}/edit  编辑分类
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->save();

        if($re){
            $data = [
                'status'=>1,
                'msg'=> '分类排序更新成功!'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=> '分类排序更新失败!'
            ];
        }
        return $data;
    }
}
