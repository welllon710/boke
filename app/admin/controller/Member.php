<?php


namespace app\admin\controller;


use app\BaseController;
use think\facade\Request;
use app\admin\model\Member as MemberModel;
class Member extends BaseController
{
    public function list(){
        $page = env('page.memberpage' );
        $user = MemberModel::order('create_time','asc')->paginate($page);
        return view('',['user'=>$user]);
    }
    public function add(){
        if (request()->isAjax()){
           $data = Request::param();
           $member = new MemberModel();
           $res = $member->add($data);
           if ($res === 1){
               $this->success('添加成功','/think/admin/member/list');
           }else{
               $this->error($res);
           }
        }
        return view();
    }
    public function edit(){
        if (\request()->isAjax()){
           $data = Request::only(['password','newpassword','nickname','email','id']);
            $member = new MemberModel();
            $res = $member->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/member/list');
            }else{
                $this->error($res);
            }
        }
        $id = input('id');
        $user = MemberModel::find($id);
        return view('',['user'=>$user]);
    }
    public function del(){
        if (\request()->isAjax()){
            $id = input('post.id');
            $res = MemberModel::find($id)->together(['comment'])->delete();
            if ($res){
                $this->success('删除成功','/think/admin/member/list');
            }else{
                $this->error('删除失败');
            }
        }
    }
}