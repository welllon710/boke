<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Admin;
use think\facade\Validate;
use think\Request;
use think\Response;

/**
 * Class Index
 * @package app\api\controller
 */
class Index extends Base
{
    /**
     * Index constructor.
     */

    /**
     * 显示资源列表
     *
     * @return array|Response
     */
    public function index()
    {
//       //return Admin::select();
//        $data = Admin::field('username')->page($this->page,$this->pageSize)->select();
//        return $this->create($data,200);
//        //return  ['time'=>$this->time];
        echo 'welcome thinkphp6';
        return Response::create([1,2,3],'json');
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = Admin::find($id);
        //echo dd(is_numeric($id));
        if (!is_numeric($id)){
          return  $this->create([],404,'id参数错误');
        }
        if (empty($data)){
            return $this->create([],400,'无数据');
        }else{
            return $this->create($data,400,'数据有了');
        }
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
