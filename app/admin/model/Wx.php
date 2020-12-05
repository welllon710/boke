<?php


namespace app\admin\model;


use app\admin\model\Article;
use app\admin\model\Read;
use app\admin\model\Comment;
use think\Model;
use think\model\concern\SoftDelete;

class Wx extends Model
{
    use SoftDelete;
    public function article(){
        return $this->belongsToMany(Article::class,Read::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class,'wx_id','id');
    }
      public function getNickNameAttr($value){
          return base64_decode($value);
      }

}