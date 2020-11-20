<?php
namespace app\admin\controller;
use app\BaseController;
use app\admin\model\Comment as CommentModel;
class Comment extends BaseController
{
    public function list(){
    $page = env('page.commentpage' );
    $user = CommentModel::with(['article','member'])->order('create_time','desc')->paginate($page);
    return view('',['user'=>$user]);
    }

    public function del(){
        if (request()->isAjax()){
            $id = input('post.id');
            $res = CommentModel::find($id)->delete();
            if ($res){
                $this->success('删除成功','/think/admin/comment/list');
            }else{
                $this->error('删除失败');
            }
        }
    }
}