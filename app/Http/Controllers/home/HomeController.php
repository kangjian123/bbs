<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests\UserPostRequest;

class HomeController extends Controller
{

/**
*   主页
* $Numbercard 查询帖子数量
* $Numberuser 查询用户数量
* $Numberreply 查询回帖数量
* $configtitle 查询网站标题
* $type 查询回帖表
* $user 查询用户表
* $post 查询帖子表(按条件)
*@return 解析主页 将以上数据传过去
*/
  public function getIndex(){
    // 查询帖子数量
    $Numbercard = DB::table('post')->count('id');
    // 查询用户数量
    $Numberuser = DB::table('user')->count('id');
    // 查询回帖数量
    $Numberreply = DB::table('reply')->count('id');
    // 查询网站标题
    $configtitle = DB::table('config')->get();

    $type = DB::table('type')->get();
    $user = DB::table('user')->get();
    // 按条件查询帖子且只显示10条
    $post = DB::table('post')
                ->join('userdetail','post.uid','=','userdetail.uid')
                ->select('post.*','userdetail.photo')
                ->where('elite',"y")
                ->where('recycle','n')
                ->limit(10);

    return view('welcome',['user'=>$user,'type'=>$type,'post'=>$post,'Numbercard'=>$Numbercard,'Numberuser'=>$Numberuser,'Numberreply'=>$Numberreply,'configtitle'=>$configtitle]);
}

 


/**
*   底部
* $Numbercard 查询帖子数量
* $Numberuser 查询用户数量
* $Numberreply 查询回帖数量
*@return 解析模版 将以上数据传过去
*/

    public static function foot()
    {

    $Numbercard = DB::table('post')->count('id');
    // 查询用户数量
    $Numberuser = DB::table('user')->count('id');
    // 查询回帖数量
    $Numberreply = DB::table('reply')->count('id');
    return view('home.layout.foot',['Numbercard'=>$Numbercard,'Numberuser'=>$Numberuser,'Numberreply'=>$Numberreply]);


    }

    /**
    *作者：yrz
    *时间：2017年4月10日11:44:38
    *参数：
    *@param     array   $hot    点击量最多的三个帖子
    *@param     array   $new    最新发布的三个帖子
    *@param     array   $ad     广告
    *@return    url             携带数据跳转到页面
    */
    public static function ad(){
        $hot = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->select('post.ptitle','post.top','post.id')
              ->orderBy('click', 'desc')
              ->where('recycle','n')
              ->paginate(3);
        $new = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->select('post.ptitle','post.top','post.id')
              ->orderBy('pctime', 'desc')
              ->where('recycle','n')
              ->paginate(3);
        $ad = DB::table('ad')
              ->select('ad.adname','ad.adlink','ad.adpic')->get();
        return view('home.layout.ad',['hot'=>$hot,'new'=>$new,'ad'=>$ad]);
    }



}
