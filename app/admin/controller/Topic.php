<?php


namespace app\admin\controller;


use app\admin\model\Cate as CateModel;
use app\admin\model\Topic as TopicModel;
use app\BaseController;

class Topic extends BaseController
{
    public function list(){
        $page = env('page.catepage' );
        $list = TopicModel::with('problem')->paginate($page);
        return view('',['list'=>$list]);
    }
    public function add()
    {
        if (request()->isAjax()) {
           $data = request()->param(['topic']);
            $cate = new TopicModel();
            $res = $cate->add($data);
            if ($res === 1) {
                $this->success('添加成功', '/think/admin/topic/list');
            } else {
                $this->error($res);
            }
        }
        return view();
    }
    public function edit(){
        if (request()->isAjax()){
            $data = request()->param(['id','topic']);
            $cate = new TopicModel();
            $res = $cate->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/topic/list');
            }else{
                $this->error($res);
            }

        }
        $user = TopicModel::find(input('id'));
        return view('',['user'=>$user]);
    }
    public function del(){
        if (request()->isAjax()){
            $id = input('post.id');
            $result = TopicModel::find($id)->delete();
            if ($result){
                $this->success('已删除','/think/admin/topic/list');
            }else{
                $this->error('删除失败');
            }
        }
    }
}