<?php


namespace app\admin\model;


use app\admin\validate\Ariticle;
use think\Model;
use app\admin\model\Topic;
class Problem extends Model
{
    public function topic(){
        return $this->belongsTo(Topic::class,'topic_id','id');
    }
    public function add($data){
        $validate = new \app\admin\validate\Problem();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $res = $this->save($data);
        if ($res){
            return 1;
        }else{
            return '添加失败';
        }
    }
    public function edit($data){
        $validate = new \app\admin\validate\Problem();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $res = $this->find($data['id'])->save($data);
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }
}