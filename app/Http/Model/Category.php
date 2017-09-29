<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    // 不使用时间戳
    public $timestamps=false;
    // 使用 guarded 属性设置为空，不限制保存的字段格式，使用 create方法保存数据
    protected $guarded=[];

    // true 方法其实是调用 getTree 方法
    public function tree()
    {
        $categorys = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }

    // getTree 是为了重新整理 category 的结构，使之成为树结构排列
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }

        return $arr;
    }

    //参数化之后不好看，所以还原参数化之前的
    // gerTree的原版提供参考
//    public function getTree($data){
//        $arr = [];
//        foreach ($data as $k => $v){
//            先判断pid,先放进去返回数组
//            if($v->cate_pid ==0){
//                $arr[]=$data[$k];
//                foreach ($data as $m=>$n){
//                    再判断pid等于id的会放在一起
//                    if($n->cate_pid == $v->cate_id){
//                        $arr[]=$data[$m];
//                    }
//                }
//            }
//        }
//        return $arr;
//    }
}
