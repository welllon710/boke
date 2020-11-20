<?php
use think\facade\Route;

Route::group(function (){
    Route::rule('/','index/index','get|post');//登录界面
    Route::rule('forget','index/forget','get|post');//发送邮件
    Route::rule('reset','index/reset','get|post');//重置密码
    Route::rule('register','index/register','get|post');//注册
    Route::rule('leaveout','index/leaveout','get|post');//退出登录
});
Route::group('admin',function (){
    Route::rule('index','home/index','get');//首页
    Route::rule('cate/list','cate/list','get'); //栏目列表
    Route::rule('cate/add','cate/add','get|post');//栏目添加
    Route::rule('cate/sort','cate/sort','post');//栏目排序修改
    Route::rule('cate/edit/[:id]','cate/edit','get|post');//栏目修改
    Route::rule('cate/del/[:id]','cate/del','post');//栏目删除
    Route::rule('article/list','article/list','get');//文章列表
    Route::rule('article/add','article/add','get|post');//文章添加
    Route::rule('article/edit/[:id]','article/edit','get|post');//文章修改
    Route::rule('article/del/[:id]','article/del','post');//文章删除
    Route::rule('article/is_top','article/is_top','post');//文章推荐
    Route::rule('member/list','member/list','get');//用户列表
    Route::rule('member/add','member/add','get|post');//添加用户
    Route::rule('member/edit/[:id]','member/edit','get|post');//修改用户
    Route::rule('member/del','member/del','post');//删除用户

    Route::rule('manager/list','admin/list','get');//管理员列表
    Route::rule('manager/add','admin/add','get|post');//管理员添加
    Route::rule('manager/edit/[:id]','admin/edit','get|post');//管理修改
    //  Route::rule('manager/del','admin/del','post');//管理员删除

    Route::rule('user/edit','user/edit','get|post');//个人信息修改

    Route::rule('manager/status','admin/status','post');//状态设置
    Route::rule('error','error/index','get');//无权限页面
    Route::rule('comment/list','comment/list','get');//评论列表
    Route::rule('comment/del','comment/del','post');//删除评论
})->middleware(\app\middleware\Auth::class);
