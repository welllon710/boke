<?php
namespace app\admin\controller;
use app\BaseController;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Cate as CateModel;
use think\facade\Request;

class Article extends BaseController
{
    public function list(){
        $page = env('page.articlepage' );
        $data = ArticleModel::with('cate')->order('is_top','desc')->paginate($page);
        return view('',['data'=>$data]);
    }
    public function add(){
        if (request()->isAjax()){
           $data = [
               'title'=>input('post.title'),
               'desc'=>input('post.desc'),
               'tags'=>input('post.tags'),
               'content'=>input('post.content'),
               'is_top'=>input('is_top','0'),
               'cate_id'=>input('cate_id')
           ];
           $article = new \app\admin\model\Article();
           $res = $article->add($data);
           if ($res === 1){
               $this->success('添加成功','/think/admin/article/list');
           }else{
               $this->error($res);
           }
        }
        $data = CateModel::select();
        return view('',['data'=>$data]);
    }
    public function is_top(){
        if (\request()->isAjax()){
            $data = [
                'id'=>input('post.id'),
                'is_top'=>input('post.is_top') == '0'? '1':'0'
            ];
           $res = ArticleModel::find($data['id'])->save(['is_top'=>$data['is_top']]);
           if($res){
               $this->success('操作成功','/think/admin/article/list');
           }else{
               $this->error('操作失败');
           }
        }
    }
    public function edit(){
        if (\request()->isAjax()){
            $data = [
                'id'=>input('post.id'),
                'title'=>input('post.title'),
                'desc'=>input('post.desc'),
                'tags'=>input('post.tags'),
                'content'=>input('post.content'),
                'is_top'=>input('is_top','0'),
                'cate_id'=>input('cate_id')
            ];
            $article = new \app\admin\model\Article();
            $res = $article->edit($data);
            if ($res === 1){
                $this->success('修改成功','/think/admin/article/list');
            }else{
                $this->error($res);
            }
        }
        $user = ArticleModel::find(input('id'));
        $cate = CateModel::select();
        return view('',['user'=>$user,'cate'=>$cate]);
    }
    public function del(){
        if (\request()->isAjax()){
            $id = input('post.id');
            $res = ArticleModel::with('comment')->find($id);
            $result = $res->together(['comment'])->delete();
            if ($result){
                $this->success('删除成功','/think/admin/article/list');
            }else{
                $this->error('删除失败');
            }
        }
    }
}