<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// 维护
Route::group(['middleware' => ['weihu']], function(){
// 主页
Route::get('/', 'home\TextController@Text');
// 帖子列表
Route::controller('/home/card', 'home\CardController');
// 用户
Route::controller('/home/user','home\UserController');

});

//登录执行的控制器
Route::controller('/adlogin','admin\LoginController');

Route::get('/error/weihu','home\TextController@weihu');

//后台路由组
Route::group(['middleware' => ['admin']], function(){
//后台主页路由
Route::get('/admin',function()
{
	return view('admin.index');
});
// 后台用户
Route::controller('/admin/user','admin\UserController');
// 后台会员
Route::controller('/admin/vip','admin\VipController');
// 后台板块
Route::controller('/admin/cate','admin\CateController');
//后台帖子
Route::controller('/admin/card','admin\CardController');
// 后台友情链接
Route::controller('/admin/friend','admin\FriendController');
// 后台广告
Route::controller('/admin/ad','admin\AdController');
// 后台配置
Route::controller('/admin/config','admin\ConfigController');
});

//版主管理组
Route::group(['middleware' => ['bz']], function(){

//版主首页
Route::get('/bz',function(){
	return view('bz.index');
});
//版主帖子也
Route::controller('/bz/card','bz\CardController');
});
