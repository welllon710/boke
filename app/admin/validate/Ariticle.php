<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Ariticle extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'title'=>'require',
        'desc'=>'require',
        'tags'=>'require',
        'content'=>'require',
        'is_top'=>'require',
        'cate_id'=>'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
    protected $scene = [
      'add'=>['title','desc','tags','content','is_top','cate_id'],
         'edit'=>['title','desc','tags','content','is_top','cate_id']
    ];
}
