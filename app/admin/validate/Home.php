<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Home extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'catename'=>'require|unique:cate',
        'sort'=>'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'catename.unique'=>'该栏目已经存在',
        'sort.require'=>'排序不能为空',
    ];
    protected $scene = [
        'cate'=>['catename','sort'],//添加栏目
        'sort'=>['sort'], //排序场 景
        'edit'=>['catename'],//修改场景
    ];
//    public function sceneEdit(){
//        return $this->only(['catename'])->append('catename','unique:cate');
//    }
}
