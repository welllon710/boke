<?php


namespace app\admin\controller;


use app\admin\model\Admin as AdminModel;
use app\BaseController;
use think\facade\Cache;
class User extends BaseController
{
    public function edit(){
        if (\request()->isAjax()){
            $data = [
                'id'=>input('post.id'),
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'newpassword'=>input('post.newpassword'),
                'confirm'=>input('post.confirm'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];

            $admin = new AdminModel();
            $res = $admin->edit($data);
            if ($res === 1){
                Cache::delete('info');
                Cache::set('info',AdminModel::find($data['id']));
                $this->success('修改成功','/think');
            }else{
                $this->error($res);
            }
        }
        $user = cache('info');
        return view('',['user'=>$user]);
    }
}