<?php
namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Admin;
use think\Session;
use think\facade\Cache;
class Index extends BaseController
{
    public function index(){
        if (request()->isAjax()){
            $data = [
                'username' =>input('post.username'),
                'password' =>input('post.password'),
                'captcha'=>input('post.captcha')
            ];
            $admin = new Admin();
            $res = $admin->login($data);
            if ($res===1){
                $res =$admin->boutinc('tp_admin',$data['username']);
                $user = Admin::where('username',$data['username'])->find();
                cache('info',$user);
               $this->success('登录成功','/think/admin/index');
            }else{
                $this->error($res);
            }
        }
        return view();
    }  //登录
    public function forget(){
        if (request()->isAjax()){
            $code = mt_rand(1000,9999);
            cache('code',$code);
            $data = ['email'=>input('post.email')];
            $admin = new Admin();
            $res = $admin->forget($data);
            if ($res === 1){
                $result = emailto($data['email'],'天龙八部','你的邮箱验证码是'.$code);
                if ($result){
                    $this->success('发送成功','/think/reset');
                }else{
                    $this->error('发送失败');
                }
            }else{
                $this->error($res);
            }
        }
        return view();
    }
    public function reset(){
        if (request()->isAjax()){
            $data = [
                'emailcode'=>input('post.emailcode'),
                'password'=>input('post.password'),
                'confirm'=>input('post.confirm')
            ];
            $admin = new Admin();
            $res = $admin->reset($data);
            if ($res === 1){
                $this->success('修改成功','/think');
            }else{

                $this->error($res);
            }
        }
        return view();
    }
    public function register(){
        if (request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'confirm'=>input('post.confirm'),
                'nickname'=> input('post.nickname'),
                'email'=>input('email')
            ];

            $admin = new Admin();
            $res = $admin->register($data);
            if ($res===1){
//               emailto($data['email'],'验证码','你的验证码是123456');
                $this->success('注册成功','/think');
            }else{
                $this->error($res);
            }
        }
        return view();
    }
    public function leaveout(){
        $res =  Cache::delete('info');
        $res = Cache::get('info');
        if (request()->isAjax()){
            $del =  Cache::delete('info');
            if (Cache::has('info')){
                $this->error('退出失败');
            }else{
                $this->success('退出成功','/think');
            }
        }
        return view('',['user'=>$res]);

    }
}
