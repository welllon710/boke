<?php


namespace app\admin\model;

use app\admin\validate\Home;
use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    use SoftDelete;
    public function article(){
        return $this->hasMany(Article::class,'cate_id','id');
    }
    public function add($data){
        $validate = new Home();
        if(!$validate->scene('cate')->check($data)){
            return $validate->getError();
        }
        $res = $this->save($data);
        if ($res){
            return 1;
        }else{
            return '添加失败';
        }
    }
    public function sort($data){
        $validate = new Home();
        if(!$validate->scene('sort')->check($data)){
            return $validate->getError();
        }
        $res = $this->find($data['id'])->save(['sort'=>$data['sort']]);
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }
    public function edit($data){
        $validate = new Home();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $res = $this->find($data['id'])->save(['catename'=>$data['catename']]);
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }

}