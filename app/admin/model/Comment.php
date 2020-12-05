<?php
namespace app\admin\model;
use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    public function article(){
        return $this->belongsTo(Article::class,'article_id','id');
    }
    public function getNickNameAttr($value){
        return base64_decode($value);
    }
    public function getParentNameAttr($value){
        return base64_decode($value);
    }

}