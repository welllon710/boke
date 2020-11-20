<?php
namespace app\admin\controller;
use app\BaseController;
use http\Client\Request;
use think\facade\Cache;
use think\facade\Route;
use app\admin\model\Admin as AdminModel;
class Admin extends BaseController
{
    protected $middleware = [
        'Check'=>['except'=>['edit']]
    ];
    public function list(){
        $page = env('page.adminpage' );
        $user = AdminModel::order('is_super','desc')->paginate($page);
        return view('',['user'=>$user]);
    }
    public function status(){
        if (request()->isAjax()){
            $data = [
                'id' =>input('post.id'),
                'status'=>input('post.status') === '1'?'0':'1',
            ];
            $res = AdminModel::find($data['id'])->save(['status'=>$data['status']]);
            if ($res){
                $this->success('操作成功','/think/admin/manager/list');
            }else{
                $this->error('操作失败');
            }
        }
    }
    public function add(){
        if (\request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'email'=>input('post.email'),
                'confirm'=>input('post.confirm'),
                'nickname'=>input('post.nickname'),
                'status'=>input('post.status')? '0':'1',
                'is_super'=>input('post.is_super','0'),
            ];
            $admin = new AdminModel();
            $res =  $admin->add($data);
            if ($res === 1){
                $this->success('添加管理员成功','/think/admin/manager/list');
            }else{
                $this->error($res);
            }


        }
        return view();
    }
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
                'status'=>input('post.status','0'),
                'is_super'=>input('post.is_super','0'),
            ];

            $admin = new AdminModel();
            $res = $admin->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/manager/list');
            }else{
                $this->error($res);
            }
        }
        $user = AdminModel::find(input('id'));
        return view('',['user'=>$user]);
    }
}