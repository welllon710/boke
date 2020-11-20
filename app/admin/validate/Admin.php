<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username'=>'require',
        'password'=>'require',
        'captcha' => 'require|captcha',
        'email'=>'require|email',

        'confirm'=>'require|confirm:password',
        'emailcode'=>'require',
        'nickname'=>'require|unique:admin'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require'=>'账号不能为空',
        'password.require'=>'密码不能为空',
        'captcha.captcha'=>'验证码错误',
        'email.require' =>'邮箱不能为空',
        'confirm.confirm'=>'两次密码不一致',
        'nickname.unique'=>'该昵称已存在'
    ];
    protected $scene = [
        'login'=>['username','password','captcha'],//登录场景
        'forget'=>['email'], //发送邮件
        'reset'=>['password','confirm','emailcode'], //重置密码场景
        'add'=>['username','password','confirm','nickname','email'] //添加管理员场景
    ];
    public function sceneRegister(){ //注册场景
        return $this->only(['username','password','confirm','nickname','email'])
            ->append(['email'=>'unique:admin','username'=>'unique:admin']);
    }
    public function sceneEdit(){
        return $this->only(['username','password','email','nickname'])
            ->append(['newpassword'=>'require','confirm'=>'require|unique:newpassword',
            ]);
    }
}
