<?php


namespace app\admin\controller;


use app\admin\model\Read;
use app\BaseController;

class Wx extends BaseController
{
    public function list(){
        $page = env('page.adminpage' );
        $data =  \app\admin\model\Wx::order('create_time')->paginate($page);

        return view('',['data'=>$data]);
    }
    public function del(){
        $id = input('post.id');
        $user = \app\admin\model\Wx::with(['comment','article'])->find($id);
        $bool = $user->together(['comment','article'])->force()->delete();
        if ($bool){
            $this->success('删除成功','/think/admin/wx/list');
        }
    }
}