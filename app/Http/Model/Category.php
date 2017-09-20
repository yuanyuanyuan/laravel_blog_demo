<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;

    // 数据相关的逻辑放到数据model里面,是为了更加逻辑化
    public function tree()
    {
        // 将分类查询进行orderby排序后,再进行过滤
        $categorys = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }

//    public static function tree()
//    {
//        $categorys = Category::all();
//        return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid');
//    }

    // 将函数进行参数化,方便移植
    // 不过参数化之后会比较难看,需要做一定的注释
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
