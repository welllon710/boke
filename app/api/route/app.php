<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

//Route::get('think', function () {
//    return 'hello,ThinkPHP6!';
//});
//
//Route::get('hello/:name', 'index/hello');
Route::resource('api','index');
Route::get('/','Index/index');
Route::get('code','Code/index');//生成验证码
Route::post('register','Code/save');

//
Route::get('test','Test/test');
Route::get('captchacode','Test/captchacode');