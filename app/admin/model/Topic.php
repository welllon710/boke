<?php


namespace app\admin\model;


use app\admin\validate\Home;
use think\Model;
use app\admin\model\Problem as ProblemModel;
class Topic extends Model
{
    public function problem(){
        return $this->hasMany(ProblemModel::class,'topic_id','id');
    }
    public function add($data){
        $validate = new \app\admin\validate\Topic();
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
        $validate = new \app\admin\validate\Topic();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $res = $this->find($data['id'])->save(['topic'=>$data['topic']]);
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }
}