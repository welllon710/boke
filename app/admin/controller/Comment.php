<?php
namespace app\admin\controller;
use app\BaseController;
use app\admin\model\Comment as CommentModel;
class Comment extends BaseController
{
    public function list(){
    $page = env('page.commentpage' );
    $user = CommentModel::withTrashed()->with(['article'])
        ->order(['delete_time'=>'asc','create_time'=>'desc'])->paginate($page);
    return view('',['user'=>$user]);
    }

    public function del(){
        if (request()->isAjax()){
            $id = input('post.id');
            $status = input('post.status');
            if ($status == '1'){
                $res = CommentModel::find($id)->delete();
                if ($res){
                    $this->success('删除成功','/think/admin/comment/list');
                }else{
                    $this->error('删除失败');
                }
            }else{
                $res = CommentModel::onlyTrashed()->find($id);
                $bool = $res->restore();
                if ($bool){
                    $this->success('恢复成功','/think/admin/comment/list');
                }
            }


        }
    }

}