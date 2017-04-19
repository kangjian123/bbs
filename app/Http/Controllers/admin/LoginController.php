<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{   
     /**
    * 后台登录页面
    * @return 登录页面
    */    
    public function getLogin()
    {
        return view('adlogin.login');
    }

     /**
    * 后台登录操作
    * $data :获取用户输入的信息
    * $res :查询匹配到的用户数据
    * $all :获取所有的参数请求(分页搜索用)
    * @return void
    */
    public function postDologin(UserLoginRequest $request)
    {
        $data = $request->except(['_token']);

        $res = DB::table('user')
        ->where('username',$data['username'])
        ->where('password',$data['password'])
        ->first();
        //判断用户是否为超级管理员
        if($res && $res->auth=='y')
        {
            //开启SESSION
            session_start();
            $_SESSION['username']=$res->username;
    
            //用户最后登录时间
            DB::table('user')->where('username',$_SESSION['username'])->update(['lastlogin'=>$data['lastlogin']]);
            return redirect('/admin')->with('success','登陆成功,欢迎你,超级管理员');
            //判断用户是否为版主
        }else if($res && $res->auth!='y' && $res->moderator=='y'){
            session_start();
            $_SESSION['username']=$res->username;

            //用户最后登录时间
            DB::table('user')->where('username',$_SESSION['username'])->update(['lastlogin'=>$data['lastlogin']]);
            return redirect('/bz')->with('success','登陆成功');
            //用户没有权限?
        }else if($res && $res->auth!='y' && $res->moderator=='n'){
            return back()->with('error','用户没有权限!');
            //用户名密码错误?!
        }else{
            return back()->with('error','用户名或密码错误!');
        }
    }
     /**
    * 后台退出操作
    * @return 重定向到登录界面
    */
    public function getLogout(Request $request)//(-_>-)
    {
        // 执行清除session操作
        session_start();
        // 销毁session文件
        session_destroy();
        // 销毁session信息
        unset($_SESSION);
        // 销毁cookie信息
        setcookie('PHPSESSID','',time()-1,"/");
        return redirect('/adlogin/login')->with('success','退出成功!');

    }
    
 
}
