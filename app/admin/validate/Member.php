<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Member extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username'=>'require|unique:member',
        'password'=>'require',
        'nickname'=>'require|unique:member',
        'email'=>'require|unique:member',
        'newpassword'=>'require',

    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
    protected $scene = [
        'add'=>['username','password','nickname','email'],
        'edit'=>['newpassword','password','nickname','email']
    ];
}
