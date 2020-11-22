<?php


namespace app\admin\controller;


use app\admin\model\Article as ArticleModel;
use app\admin\model\Cate as CateModel;
use app\BaseController;
use app\admin\model\Problem as ProblemModel;
class Problem extends BaseController
{
    public function list(){
        $page = env('page.catepage' );
        $data = ProblemModel::with('topic')->order('id','asc')->paginate($page);
        return view('',['data'=>$data]);
    }
    public function add(){
        if (request()->isAjax()){
          $data = request()->param(['problem','answer','topic_id']);
          $problem = new ProblemModel();
          $res = $problem->add($data);
            if ($res === 1){
                $this->success('添加成功','/think/admin/problem/list');
            }else{
                $this->error($res);
            }

        }
      $data = \app\admin\model\Topic::select();
        return view('',['data'=>$data]);
    }
    public function edit(){
        if (request()->isAjax()){
            $data = request()->param(['id','problem','answer','topic_id']);
            $problem = new ProblemModel();
            $res = $problem->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/problem/list');
            }else{
                $this->error($res);
            }
        }
        $user = ProblemModel::find(input('id'));
        $cate = \app\admin\model\Topic::select();
        return view('',['user'=>$user,'cate'=>$cate]);
    }
    public function del(){
       if (request()->isAjax()){
           $id = input('post.id');
           $res = ProblemModel::find($id)->delete();
           if ($res){
               $this->success('删除成功','/think/admin/problem/list');
           }else{
               $this->error('删除失败');
           }
       }
    }
}