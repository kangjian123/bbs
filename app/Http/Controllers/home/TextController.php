<?php
namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests\UserPostRequest;

class TextController extends Controller
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
     public function Text()
     {
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
        $post = DB::table('post')->join('userdetail','post.uid','=','userdetail.uid')->select('post.click','post.top','userdetail.photo','post.elite','post.ptitle','userdetail.nickname','post.id','userdetail.uid')->where('elite',"y")->where('recycle','n')->limit(10)->get();
        return view('welcome',['user'=>$user,'type'=>$type,'post'=>$post,'Numbercard'=>$Numbercard,'configtitle'=>$configtitle,'Numberuser'=>$Numberuser,'Numberreply'=>$Numberreply,'configtitle'=>$configtitle]);
    }

    public function weihu()
    {
        return view('errors.weihu');
    }

}
