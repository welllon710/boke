<?php


namespace app\admin\controller;


use app\BaseController;
use think\model\concern\SoftDelete;
use think\Request;
use app\admin\model\Cate as CateModel;
//use think\facade\Env;


class Cate extends BaseController
{
    use SoftDelete;
    protected $request;
    public function list(){
       $page = env('page.catepage' );
       $list = CateModel::with('article')->order('sort','asc')->paginate($page);
        return view('',['list'=>$list]);
    }
    public function add()
    {
        if (\request()->isAjax()) {
            $data = [
                'catename'=>input('post.catename'),
                'sort'=>input('post.sort')
            ];
            $cate = new CateModel();
            $res = $cate->add($data);
            if ($res === 1) {
                $this->success('添加成功', '/think/admin/cate/list');
            } else {
                $this->error($res);
            }
        }
        return view();
    }
    public function sort(){
        if (\request()->isAjax()){
            $data = [
                'id'=>input('post.id'),
                'sort'=>input('post.sort')
            ];
            $cate = new CateModel();
            $res = $cate->sort($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/cate/list');
            }else{
                $this->error($res);
            }
        }
    }
    public function edit(){
        if (\request()->isAjax()){
            $data = [
              'catename'=>input('post.catename'),
                'id'=>input('post.id')
            ];
            $cate = new CateModel();
            $res = $cate->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/cate/list');
            }else{
                $this->error($res);
            }

        }
       $user = CateModel::find(input('id'));
        return view('',['user'=>$user]);
    }
    public function del(){
        if (\request()->isAjax()){
            $data = [
                'id'=>input('post.id')
            ];
          $res = CateModel::with(['article','article.comment'])->find($data['id']);
          foreach ($res['article'] as $v=>$k){
              $k->together(['comment'])->delete();
          }
          $result = $res->together(['article'])->delete();
          if ($result){
              $this->success('已删除','/think/admin/cate/list');
          }else{
              $this->error('删除失败');
          }
        }
    }
}