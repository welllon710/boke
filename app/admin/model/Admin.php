<?php


namespace app\admin\model;
use think\facade\Cache;
use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;
use think\facade\Request;

class Admin extends Model
{
    use SoftDelete;
    public function setPasswordAttr($value){
        return openssl_encrypt($value,'DES-ECB','123456','0','');
    }
//    public function setNewpasswordAttr($value){
//        return openssl_encrypt($value,'DES-ECB','123456','0','');
//    }
    public function boutinc($table,$value){
        $res =  Db::table($table)->where('username',$value)->inc('bout',1)
            ->update();
        return $res;
    }
    public function login($data)
    {
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $res = $this->where('username',$data['username'])->find();
        $term = $res->password;
        $pwd = openssl_decrypt($term,'DES-ECB','123456','0','');
        if ($res && $pwd === $data['password']){
            if ($res['status']!=='1'){
                return  '账号被封禁';
            }
            return 1;
        }else{
            return '账号或者密码错误';
        }
    }
    public function forget($data){
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('forget')->check($data)){
            return $validate->getError();
        }
        $userId = $this->where('email',$data['email'])->value('id');
        cache('userid',$userId);
        if ($userId){
            return 1;
        }else{
            return '邮箱错误';
        }
    }
    public function reset($data)
    {
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('reset')->check($data)){
            return $validate->getError();
        }
        if($data['emailcode'] !== cache('code')){
            return '验证码错误';
        }
        $id = cache('userid');
        $res = $this->where('id',$id)->save(['password'=>$data['password']]);
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }
    public function register($data){
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $res = $this->save($data);
        if ($res){
            return 1;
        }else{
            return '注册失败';
        }
    }
    public function add($data){
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $res = $this->save($data);
        if ($res){
            return 1;
        }else{
            return '添加失败';
        }
    }
    public function edit($data){
        $validate = new \app\admin\validate\Admin();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $pwd = Cache::get('info')->password;
        $pwd1 = openssl_decrypt($pwd,'DES-ECB','123456','0','');
        if ($pwd1 !== $data['password']){
            return '原密码错误';
        }
        //$da= openssl_encrypt($data['newpassword'],'DES-ECB','123456','0','');
//        dd(Request::controller());
        if (Request::controller() === 'Admin'){
            $params = [
                'username'=>$data['username'],
                'password'=>$data['newpassword'],
                'nickname'=>$data['nickname'],
                'email'=>$data['email'],
                'status'=>$data['status'],
                'is_super'=>$data['is_super']
            ];
        } elseif (Request::controller() === 'User'){
            $params = [
                'username'=>$data['username'],
                'password'=>$data['newpassword'],
                'nickname'=>$data['nickname'],
                'email'=>$data['email'],
            ];
        }
        $res = $this->find($data['id'])->save($params);
        if ($res){
            //更新缓存
            return 1;
        }else{
            return '修改失败';
        }
    }
}