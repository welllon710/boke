<?php
namespace app\admin\model;
use think\Model;
use app\admin\validate\Ariticle;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    public function cate(){
        return $this->belongsTo(Cate::class,'cate_id','id');
    }
    public function comment(){
        return $this->hasMany(Comment::class,'article_id','id');
    }
    public function add($data){
        $validate = new Ariticle();
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
        $validate = new Ariticle();
        if(!$validate->scene('add')->check($data)){
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