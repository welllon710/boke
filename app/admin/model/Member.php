<?php
namespace app\admin\model;
use app\admin\validate\Member as MemberValidate;
use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    use SoftDelete;
    protected $readonly = ['username'];
    public function comment(){
        return $this->hasMany(Comment::class,'member_id','id');
    }
    public function setPasswordAttr($value){
        return openssl_encrypt($value,'DES-ECB','123456','0','');
    }
    public function add($data){
        $validate = new MemberValidate();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $res = $this->save($data);
        if($res){
            return 1;
        }else{
            return '添加失败';
        }
    }
    public function edit($data){
        $validate = new MemberValidate();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $info = $this->find($data['id']);
        $m = $info->password;
        $pwd = openssl_decrypt($m,'DES-ECB','123456','0','');
        if ($data['password'] !== $pwd){
           return '原密码错误';
        }
        $info->password = $data['newpassword'];
        $info->nickname = $data['nickname'];
        $info->email = $data['email'];
        $res = $info->save();
        if ($res){
            return 1;
        }else{
            return '修改失败';
        }
    }
}