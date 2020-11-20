<?php
namespace app\admin\model;
use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    use SoftDelete;
    public function article(){
        return $this->belongsTo(Article::class,'article_id','id');
    }
    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }


}