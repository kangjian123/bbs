<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\RegistPostRequest;
use App\Http\Requests\UpPostRequest;
use App\Http\Requests\PicPostRequest;
use App\Http\Requests\QtUpdatePostRequest;
use App\Http\Requests\QtpassPostRequest;


class UserController extends Controller
{
    /**
    *作者：yrz
    *时间：2017年4月5日16:17:31
    *参数：
    *@param     $resn  array    user表中找到的和uid相关的数据
    *@param     $resm  array    userdetail表中找到的和uid相关的数据
    *@return    string/url      跳转页面
    */
    public static function hea(){
        if(session('uid')){
            $resn=DB::table('user')->where('id','=',session('uid')['id'])->get();
            $resm=DB::table('userdetail')->where('uid','=',session('uid')['id'])->get();
        }else{
            $resn='';$resm='';
        }
        return view('home.user.hea',['resn'=>$resn,'resm'=>$resm]);
    }
    // 个人资料
    /**
    *作者：yrz
    *时间：2017年4月5日09:24:43
    *参数：
    *@param     $uid   array    获取到的存入缓存当中的id
    *@param     $resn  array    user表中找到的和uid相关的数据
    *@param     $resm  array    userdetail表中找到的和uid相关的数据
    *@return    string/url      跳转页面并提示相关信息
    */  
    public function getInformation(){
        $uid = session('uid');
        if($uid){
            $resn=DB::table('user')->where('id','=',$uid['id'])->get();
            $resm=DB::table('userdetail')->where('uid','=',$uid['id'])->get();
            return view('home.user.information',['resn'=>$resn,'resm'=>$resm]); 
        }else{
            return redirect('/home/user/login')->with('error','请登录');
        }
    }
    //用户中心
    /**
    *作者：yrz
    *时间：2017年4月5日09:28:25
    *参数：
    *@param     $uid   array    获取到的存入缓存当中的id
    *@param     $resn  array    user表中找到的和uid相关的数据
    *@param     $resm  array    userdetail表中找到的和uid相关的数据
    *@param     $post   array   获取帖子
    *@param     $postss string  获取帖子数量
    *@param     $reply   array  获取帖子
    *@param     $replyss string 获取帖子数量
    *@param     $pl     array   获取帖子
    *@param     $plss   string  获取帖子数量
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getUserinfo(){
        $uid = session('uid');
        if($uid){
            $resn=DB::table('user')->where('id','=',$uid['id'])->get();
            $resm=DB::table('userdetail')->where('uid','=',$uid['id'])->get();
            $post = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])
                  ->paginate(5);
                  $postss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])->count();
                $reply = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])
                  ->paginate(5);
                  $replyss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])->count();
                 $pl = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])
                  ->paginate(5);
                  $plss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])->count();
            return view('home.user.userinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count(),'postss'=>$postss,'replyss'=>$replyss,'plss'=>$plss]);
        }else{
            return redirect('/home/user/login')->with('error','请登录');
        }
    }
    /**
    *作者：yrz
    *时间：2017年4月14日20:07:58
    *参数：
    *@param     $uid    string    获取缓存中的id
    *@param     $resn   array    user表中找到的和uid相关的数据
    *@param     $resm   array    userdetail表中找到的和uid相关的数据
    *@param     $post   array     获取所有发帖
    *@return    解析地址携带参数
    */
    public function getAllft(){
      $uid = session('uid');
      $resn=DB::table('user')->where('id','=',$uid['id'])->get();
      $resm=DB::table('userdetail')->where('uid','=',$uid['id'])->get();
      $post = DB::table('post')
        ->join('type','post.tid','=','type.id')
        ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
        ->orderBy('top', 'desc')
        ->where('recycle','n')
        ->where('post.uid',$uid['id'])
        ->paginate(5);
        return view('/home/user/allft',['resn'=>$resn,'resm'=>$resm,'post'=>$post]);
    }
    /**
    * 所有的回帖
    *作者：yrz
    *时间：2017年4月14日20:07:58
    *参数：
    *@param     $uid    string    获取缓存中的id
    *@param     $resn   array    user表中找到的和uid相关的数据
    *@param     $resm   array    userdetail表中找到的和uid相关的数据
    *@param     $reply  array     获取所有发帖
    *@return    解析地址携带参数
    */
    public function getAllht(){
      $uid = session('uid');
      $resn=DB::table('user')->where('id','=',$uid['id'])->get();
      $resm=DB::table('userdetail')->where('uid','=',$uid['id'])->get();
      $reply = DB::table('post')
        ->join('type','post.tid','=','type.id')
        ->join('reply','post.id','=','reply.pid')
        ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
        ->orderBy('top', 'desc')
        ->where('recycle','n')
        ->where('reply.uid',$uid['id'])
        ->paginate(5);
        return view('/home/user/allht',['resn'=>$resn,'resm'=>$resm,'reply'=>$reply]);
    }
    /**
    *  所有收藏
    *作者：yrz
    *时间：2017年4月14日20:07:58
    *参数：
    *@param     $uid    string    获取缓存中的id
    *@param     $resn   array    user表中找到的和uid相关的数据
    *@param     $resm   array    userdetail表中找到的和uid相关的数据
    *@param     $sc     array     获取所有发帖
    *@return    解析地址携带参数
    */
    public function getAllsc(){
      $uid = session('uid');
      $resn=DB::table('user')->where('id','=',$uid['id'])->get();
      $resm=DB::table('userdetail')->where('uid','=',$uid['id'])->get();
      $sc = DB::table('post')
        ->join('type','post.tid','=','type.id')
        ->join('cang','cang.pid','=','post.id')
        ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
        ->where('recycle','n')
        ->where('cang.uid',$uid['id'])
        ->paginate(5);
        return view('/home/user/allsc',['resn'=>$resn,'resm'=>$resm,'pl'=>$sc]);
    }
    /**
    * 他人详情
    *作者：yrz
    *时间：2017年4月5日09:28:25
    *参数：
    *@param     $uid   array    获取到的存入缓存当中的id
    *@param     $resn  array    user表中找到的和uid相关的数据
    *@param     $resm  array    userdetail表中找到的和uid相关的数据
    *@param     $post   array   获取帖子
    *@param     $postss string  获取帖子数量
    *@param     $reply   array  获取帖子
    *@param     $replyss string 获取帖子数量
    *@param     $pl     array   获取帖子
    *@param     $plss   string  获取帖子数量
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getOtheruserinfo(Request $request){
        $uid=$request->all();
        if(empty($uid['page'])){
          session(['otherid.id'=>$uid['id']]);
        }
        if(empty(session('uid')['id'])){
          $resn=DB::table('user')->where('id','=',session('otherid')['id'])->get();
          $resm=DB::table('userdetail')->where('uid','=',session('otherid')['id'])->get();
          $post = DB::table('post')
                    ->join('type','post.tid','=','type.id')
                    ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                    ->orderBy('top', 'desc')
                    ->where('recycle','n')
                    ->where('post.uid',session('otherid')['id'])
                    ->paginate(5);
                  $reply = DB::table('post')
                    ->join('type','post.tid','=','type.id')
                    ->join('reply','post.id','=','reply.pid')
                    ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                    ->orderBy('top', 'desc')
                    ->where('recycle','n')
                    ->where('reply.uid',session('otherid')['id'])
                    ->paginate(5);
                   $pl = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',session('otherid')['id'])
                  ->paginate(5);
            return view('home.user.otheruserinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count()]);
        }
        if(session('otherid')['id']==session('uid')['id']){
            $post = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])
                  ->paginate(5);
                  $postss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])->count();
                $reply = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])
                  ->paginate(5);
                  $replyss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])->count();
                 $pl = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])
                  ->paginate(5);
                  $plss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])->count();
            $resn=DB::table('user')->where('id','=',session('uid')['id'])->get();
            $resm=DB::table('userdetail')->where('uid','=',session('uid')['id'])->get();
            return view('home.user.userinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count(),'postss'=>$postss,'replyss'=>$replyss,'plss'=>$plss]);
        }else{
        $resn=DB::table('user')->where('id','=',session('otherid')['id'])->get();
        $resm=DB::table('userdetail')->where('uid','=',session('otherid')['id'])->get();
        $post = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',session('otherid')['id'])
                  ->paginate(5);
                $reply = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',session('otherid')['id'])
                  ->paginate(5);
                 $pl = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',session('otherid')['id'])
                  ->paginate(5);
          return view('home.user.otheruserinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count()]);
        }
    }
    // 用户登录
    /**
    *作者：yrz
    *时间：2017年4月5日09:29:44
    *参数：
    *@param     array   session('uid')  判断是否有缓存id存在
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getLogin(){
        if(session('uid')){
            return redirect('/home/user/userinfo')->with('error','您已登录');
        }else{
        	return view('home.user.login');
        }
    }
    //用户注册
    /**
    *作者：yrz
    *时间：2017年4月5日09:24:43
    *参数：
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getRegister(){
    	if(session('uid')){
            return redirect('/home/user/userinfo')->with('error','您已登录');
        }else{
          return view('home.user.register');
        }
    }
    //修改密码
    /**
    *作者：yrz
    *时间：2017年4月5日09:29:44
    *参数：
    *@param     array   session('uid')  判断是否有缓存id存在
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getChangepass(){
    	if(session('uid')){
            return view('home.user.changepass');
        }else{
            return redirect('/home/user/login')->with('error','请登录');
        }
    }
    //修改头像
    /**
    *作者：yrz
    *时间：2017年4月5日09:29:44
    *参数：
    *@param     array   session('uid')  判断是否有缓存id存在
    *@return    string/url      跳转页面并提示相关信息
    */
    public function getChangephoto(){
    	if(session('uid')){
            return view('home.user.changephoto');
        }else{
            return redirect('/home/user/login')->with('error','请登录');
        }
    }

    /**
    * 用户登录
    *作者：yrz
    *时间：2017年3月30日16:15:56
    *参数
    *@param     array       $data   保存所有接收到的信息
    *@param     array       $res    保存根据用户名查找到的用户有关的数据
    *@param     array       $resq   登录时将时间戳写入数据库
    *@return    string/url          跳转页面并提示用户相关信息
    *
    *
    */
    //用户登录
    public function postUserinfo(UpPostRequest $request)
    {
        //提取数据
        $data = $request->except(['_token','code']);
        session_start();
        if($_SESSION['code']!=$request['code']){
          unset($_SESSION['code']);
          return back()->with('error','验证码错误')->withInput();
        }
        $res=DB::table('user')-> where('username','=',$data['username'])->get();
        //跳转到用户主页
        if($res){
            if($res['0']->password==$data['password']){
                $resq=DB::table('user')
                        ->where('id',$res['0']->id)
                        ->update(['lastlogin'=>time()]);
                session(['uid.id'=>$res['0']->id]);
                $uid = session('uid');
                $resn=DB::table('user')->where('id','=',$res['0']->id)->get();
                $resm=DB::table('userdetail')->where('uid','=',$res['0']->id)->get();
                $post = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])
                  ->paginate(5);
                  $postss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('post.uid',$uid['id'])->count();
                $reply = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])
                  ->paginate(5);
                  $replyss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('reply','post.id','=','reply.pid')
                  ->select('post.ptitle','post.click','post.id','post.pctime','post.elite','post.top','reply.uid','reply.rcontent')
                  ->orderBy('top', 'desc')
                  ->where('recycle','n')
                  ->where('reply.uid',$uid['id'])->count();
                 $pl = DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])
                  ->paginate(5);
                  $plss=DB::table('post')
                  ->join('type','post.tid','=','type.id')
                  ->join('cang','cang.pid','=','post.id')
                  ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','post.elite','post.top')
                  ->where('recycle','n')
                  ->where('cang.uid',$uid['id'])->count();
                $beginTime=mktime(0,0,0,date('m'),date('d'),date('Y'));
                //每日登陆加积分
                if($beginTime>$res['0']->lastlogin){
                    $integral=DB::table('userdetail')
                        ->where('uid',$res['0']->id)
                        ->update(['integral'=>$resm['0']->integral+20]);
                }
                return view('/home/user/userinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count(),'postss'=>$postss,'replyss'=>$replyss,'plss'=>$plss]);
            }else{
                return back()->with('error','密码错误')->withInput();
            }
        }else{
            return back()->with('error','用户名或密码错误')->withInput();
        }
    }

    //注册
    /**
    *作者：yrz
    *时间：2017年3月30日17:15:18
    *参数：
    *@param     array       $data   保存所有接收到的数据
    *@return    string/url          返回跳转页面和提示信息
    */
    public function postRegist(RegistPostRequest $request)
    {
        session_start();
        //提取数据
        $data = $request->except(['_token']);
        if($data['password']!=$data['surepassword']){
            return back()->with('error','密码和确认密码不一致')->withInput();
        }
        if($_SESSION['code']!=$data['code']){
          unset($_SESSION['code']);
          return back()->with('error','验证码错误')->withInput();
        }
        //提取数据
        $res = DB::table('user')->insertGetId(['username'=>$data['username'],'password'=>$data['password']]); 
        //插入成功后将其他数据插入附表
        DB::table('userdetail')->insert(['uid'=>$res,'email'=>$data['email']]);
        return redirect('/home/user/login')->with('success','注册成功,请登录');
    }

    //处理头像上传
    /**
    *作者：yrz
    *事件：2017年3月31日14:07:25
    *参数：
    *@param     array   $request   接收到的数据
    *@param     string  $suffix    获取文件后缀名
    *@param     array   $arr       允许的后缀名
    *@param     string  $name      随机产生的名字
    *@return    string/url         跳转页面并提示信息
    */
    public function postChangephoto(PicPostRequest $request)
    {
        //判断是否有文件上传
        if($request->hasFile('photo')){
            //获取文件的后缀名
            $suffix = $request->file('photo')->getClientOriginalExtension();
            $vip=DB::table('userdetail')->where('uid',session('uid')['id'])->first();
            if(($vip->vip)=='n'&&$suffix=='gif'){
                return back()->with('error','动态图片是会员专享');
            }
            $arr = ['png','jpeg','gif','jpg'];
            if(!in_array($suffix,$arr)){
                return back()->with('error','上传文件格式不正确');
            }
            //随机文件名
            $name = md5(time()+rand(1,999999));
            $request->file('photo')->move('./uploads/user/',$name.'.'.$suffix);
            //执行数据入库操作
            $res=DB::table('userdetail')
                    ->where('uid',session('uid')['id'])
                    ->update(['photo' => '/uploads/user/'.$name.'.'.$suffix]);
            if($res){
                return redirect('/home/user/changephoto')->with('success','头像修改成功');
            }else{
                return back()->with('error','修改失败，请重试')->withInput();
            }
        }else{
            return back()->with('error','请选择图片')->withInput();
        }
    }
    //用户修改资料
    /**
    *作者：yrz
    *时间：2017年3月31日15:30:43
    *参数:
    *@param     array       $data       接受到的需要更新的数据
    *@param     bool        $res        数据提交更新
    *@return    string/url              跳转页面并提示相关信息
    */
    public function postUpinformation(QtupdatePostRequest $request){
        $data=$request->except(['_token']);
        $res=DB::table('userdetail')
                ->where('uid',session('uid')['id'])
                ->update(['nickname' =>$data['nickname'] ,
                    'email'=>$data['email'],
                    'sex'=>$data['sex'],
                    'qq'=>$data['qq'],
                    'content'=>$data['content']]);
        if($res){
            return back()->with('success','资料修改成功')->withInput();
        }else{
            return back()->with('error','资料无变更')->withInput();
        }
    }
    //修改密码
    /**
    *作者：yrz
    *事件：2017年4月5日09:20:32
    *参数：
    *@param     $data       array       接收到的数据信息
    *@param     $res        bool        返回执行数据更改的结果
    *@return    string/url              跳转页面并提示相关信息
    */
    public function postChangepass(QtpassPostRequest $request){
        $data=$request->except(['_token']);
        $ress=DB::table('user')->where('id','=',session('uid')['id'])->get();
        if($data['ypass']!=$ress['0']->password){
            return back()->with('error','原密码不正确')->withInput();
        }
        if($data['ypass']==$data['password']){
            return back()->with('error','原密码与新密码一致')->withInput();
        }
        if($data['password']!=$data['surepassword']){
            return back()->with('error','新密码与确认密码不一致')->withInput();
        }
        $res=DB::table('user')
                ->where('id',session('uid')['id'])
                ->update(['password' =>$data['password']]);
        if($res){
            session()->forget('uid.id');
            return redirect('/home/user/login')->with('success','密码修改成功,请重新登录');
        }else{
            return back()->with('error','密码修改失败')->withInput();
        }
    }
    //用户退出
    /**
    *作者：yrz
    *时间：2017年4月6日15:30:19
    *参数：
    *@return    string/url      跳转地址并提示相关信息
    */
    public function getExit(){
        session()->forget('uid.id');
        return redirect('/')->with('success','退出成功');
    }
    
    
    /**
     *  成为会员
     *
     *  @return     跳转至支付页
     */
    public function getVip(){
        return view('home.vip.index');
    }

    /**
    *   申请成为管理员
    *
    *   $id 获取当前用户的id
    *   $a  获取当前用户的所有信息
    *   $integral   获取当前用户的积分
    *
    *   @return 积分满足则跳转至申请页，否则跳转回上一级
    */
    public function getBz(Request $request){
        //获取当前登录用户id
        $id = session('uid');

        //查询当前用户积分
        $a = DB::table('userdetail')
                    ->where('uid',$id)
                    ->get();
        $integral = $a[0]->integral;

        if($integral>5000){
            return view('home.user.shenqing',['integral'=>$integral]);
        }else{
            return back()->with('error','积分为5000时方可申请为管理员');
        }
    }

    /**
    *   申请成为会员
    *   $id   当前登录的用户id
    *   $res  修改用户申请状态，查看受影响行数
    *
    *   @return 成功跳转至用户详情页，否则回到上一级
    */
    public function getShenqing(Request $request){
        $id = session('uid');
        $res=DB::table('user')
                ->where('id',$id)
                ->update(['shenqing' =>'y']);
        if($res){
            return redirect('/home/user/userinfo')->with('success','申请成功，请等待管理员确认');
        }else{
            return back()->with('error','申请正在受理，请勿重复申请！');
        }
    }
}
