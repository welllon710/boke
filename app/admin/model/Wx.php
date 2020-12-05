<?php


namespace app\admin\model;


use app\model\Article;
use app\model\Read;
use think\model\concern\SoftDelete;

class Wx extends Model
{
    use SoftDelete;
    public function article(){
        return $this->belongsToMany(Article::class,Read::class);
    }


}