<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\TextRequest;
use App\Http\Requests\EditorValueRequest;


class CardController extends Controller
{

  public function getOurs(){
    return view('home.card.ours');
  }
  /**
  *作者：yrz
  *时间：2017年4月14日20:00:04
  *参数：
  *@param   $pid    string  获取传过来的id
  *@param   $res            删除数据
  *@param   $uid    string  获取缓存中的id
  *@param   $resn   array   获取用户信息
  *@param   $resm   array   获取用户信息
  *@param   $post   array   获取帖子
  *@param   $postss string  获取帖子数量
  *@param   $reply   array  获取帖子
  *@param   $replyss string 获取帖子数量
  *@param   $pl     array   获取帖子
  *@param   $plss   string  获取帖子数量
  *@return  string/url      解析地址传送参数
  */
  public function getQxsc(Request $request){
    $pid=$request->all();
    $res=DB::table('cang')->where('pid','=',$pid['id'])->where('uid','=',session('uid')['id'])->delete();
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
            if($plss>5){
            return view('home.user.allsc',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count(),'postss'=>$postss,'replyss'=>$replyss,'plss'=>$plss]);

            }
            return view('home.user.userinfo',['resn'=>$resn,'resm'=>$resm,'post'=>$post,'reply'=>$reply,'pl'=>$pl,'posts'=>$post->count(),'replys'=>$reply->count(),'pls'=>$pl->count(),'postss'=>$postss,'replyss'=>$replyss,'plss'=>$plss]);
  }

  /**
  * 友情链接
  *作者：yrz
  *时间：2017年4月13日15:06:35
  *参数：
  *@param   $friend   array   搜索到的所有开启的友情链接
  *@param   $Numbercard   array   帖子总数
  *@param   $Numberuser   string   用户总数
  *@param   $Numberreply   string   回帖数量
  *@param   $configtitle   string   网站标题
  *@param   $type   array   板块
  *@param   $user   array   用户
  *@return  解析
  */
  public function getFriend(){
    $friend=DB::table('friendlink')
      ->select('friendlink.fname','friendlink.flink')
      ->where('friendlink.open','y')
      ->get();
    $Numbercard = DB::table('post')->count('id');
    // 查询用户数量
    $Numberuser = DB::table('user')->count('id');
    // 查询回帖数量
    $Numberreply = DB::table('reply')->count('id');
    //查询每用个户的头像
    // $photo = DB::table('userdetail')->all();
    // 查询网站标题
    $configtitle = DB::table('config')->get();

    $type = DB::table('type')->get();
    $user = DB::table('user')->get();
    return view('home.linkss.friend',['friend'=>$friend,'user'=>$user,'type'=>$type,'Numbercard'=>$Numbercard,'Numberuser'=>$Numberuser,'Numberreply'=>$Numberreply,'configtitle'=>$configtitle]);
  }
 
   
    //数据搜索
  /**
  *作者：yrz
  *时间：2017年4月5日10:40:24
  *参数：
  *@param   $request     array    接收到的数据
  *@param   $post        array    查询到的数据
  *@param   $all         array    接收到的所有数据
  *@param   $Number      string   查询到的数据的总条数
  *@return    url    跳转页面并携带数据
  */
    public function getSearch(Request $request){
      //获取所有的请求参数
      $all = $request->all();
      $num = DB::table('post')->where('ptitle','like','%'.$request->input('keyword').'%')->count('*');
      //判断用户是否搜索
      if($request->input('keyword')){
          $post = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->join('userdetail','post.uid','=','userdetail.uid')
              ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','userdetail.photo','post.elite','post.top','userdetail.uid')
              ->where('ptitle','like','%'.$request->input('keyword').'%')
              ->orderBy('top', 'desc')
              ->where('recycle','n')
              ->paginate(10);
      }else{
          $post = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->join('userdetail','post.uid','=','userdetail.uid')
              ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','userdetail.photo','post.elite','post.top','userdetail.uid')
              ->orderBy('top', 'desc')
              ->where('recycle','n')
              ->paginate(10);
        return view('home.card.cardsearch',['post'=>$post,'all'=>$all,'keyword'=>$all['keyword']]);
      }
      
      if($num!=0){
      //解析模板
      return view('home.card.cardsearch',['post'=>$post,'all'=>$all,'keyword'=>$all['keyword']]);
      }else{
        return view('home.card.nocard',['keyword'=>$all['keyword']]);
      }
    }
  
/**
*帖子列表页
* $id 登录者id
* $num 所有帖子数量
* $post 所有内容(包含分页)
* $user 查询用户的状态
* $typeid 当前板块的id
* $num 计数post
* $type 板块标题
* $Number 帖子数量
*@return 解析模版 分配以上数据
*/
    public function getCard(Request $request)
    {
      $id = session('uid');


      if(!empty($id)){
      $user = DB::table('user')->where('id',$id)->select('status')->first();
    }else{
      $user = (object) array('status' => '1');
      }
      // //获取用户进入的板块id
      $typeid = $request->input('id');

      $type = DB::table('type')->where('id',$typeid)->first();

      $num = DB::table('post')->where('tid',$typeid)->count('*');
   
      if($num!=0){
      // 查询该板块的帖子有分页(不在回收站)
      $post = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->join('userdetail','post.uid','=','userdetail.uid')
              ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','userdetail.photo','post.elite','post.top','userdetail.uid','type.tname','userdetail.nickname')
              ->where('post.tid',$typeid)
              ->orderBy('top', 'desc')
              ->where('recycle','n')
              ->orderBy('post.id','desc')
              ->paginate(10);
      // 查询帖子数量
      $Number = DB::table('post')->where('recycle','n')->count('id');

        return view('home.card.card',['post'=>$post,'Number'=>$Number,'typeid'=>$typeid,'user'=>$user,'type'=>$type]);
      }
      else{
      if(!empty($id)){
      $user = DB::table('user')->where('id',$id)->select('status')->first();
    }else{
      $user = (object) array('status' => '1');
      }
        return view('home.card.ncard',['typeid'=>$typeid,'user'=>$user]);
      }
    }


/**
* 帖子详情页
* $sid 登录者id
* $photo 登录用户头像
* $status 是否被禁言
* $status1 用户是否被禁言
* $posts 发帖人的所有帖子
* $click 点击数+1
* $reply 回帖人的数据
* $id 接收板块id
* $replynum 回帖数量
* $typeid 获取当前板块
* $user 查询用户
* $typename 获取当前板块名称
* $a 帖子内容
* $post1 帖子是否可回复
* $person 查看当前帖子的关注者
* 
*@return 解析模版 分配以上数据
*/ 
    public function getDetails(Request $request)
    {
        $sid = session('uid');
        if(!empty($sid)){
          $photo = DB::table('userdetail')->where('uid',$sid)->first();
          $photo = $photo->photo;
        }else{
          $photo = 123;
        }

                 // 查询用户是否被禁言
         if(count($sid)=='0'){
            $sid = '0';
          }else{
            $sid = $sid['id'];
          }
        if(!empty($sid))
        {
          $status1 = DB::table('user')->where('id',$sid)->select('status')->first();
          $status = $status1->status;
          // dd($status);
         }else{
          $status = '1';
         }
       
        // 接收id
        $id = $request->input('id');
        // 获取当前的板块
        $typeid = DB::table('post')->where('id',$id)->select('tid')->first();
        $typename = DB::table('type')->where('id',$typeid->tid)->select('tname')->first();

        // 获取当前发帖人的所有帖子
        $posts = DB::table('post')->where('id',$id)->select('uid')->first();
        //判断当前用户是否进入自己的帖子
        if($sid == $posts->uid){
          $del = 1;
        }else{
          $del = 0;
        }





        $all = DB::table('post')->where('uid',$posts->uid)->limit(5)->get();
        // dd($all);

        //查询帖子
        $post = DB::table('post')
                ->join('userdetail','post.uid','=','userdetail.uid')
                ->where('post.id',$id)
                ->get();
        $post1 = DB::table('post')
                ->join('userdetail','post.uid','=','userdetail.uid')
                ->where('post.id',$id)
                ->select('post.creply')
                ->first(); 
        $post1 = $post1->creply;

        $posts = DB::table('post')
                ->join('userdetail','post.uid','=','userdetail.uid')
                ->select('post.id')
                ->where('post.id',$id)
                ->get();
        // //点击数+1
        $click = $post['0']->click;
        $click = $click+1;
        $click = DB::table('post')->where('post.id',$id)->update(['click'=>$click]);

        //查询回帖人数据
        $reply = DB::table('userdetail')
                  ->join('reply','reply.uid','=','userdetail.uid')
                  ->where('reply.pid',$id)
                  ->orderBy('rctime','asc')
                  ->paginate(20);

        // 查询回帖数量
        $replynum = DB::table('reply')->where('pid',$id)->count('id');

        //查询用户
        $user = DB::table('user')->where('id',$post['0']->uid)->get();

        //获取当前帖子的关注人
        $person = DB::table('cang')
                        ->leftjoin('userdetail','cang.uid','=','userdetail.uid')
                        ->where('pid',$id)
                        ->get();

        $a = $post['0']->pcontent;
      return view('home.card.details',['person'=>$person,'del'=>$del,'photo'=>$photo,'sid'=>$sid,'user'=>$user,'typename'=>$typename,'post'=>$post,'reply'=>$reply,'post1'=>$post1,'a'=>$a,'replynum'=>$replynum,'posts'=>$posts,'status'=>$status,'id'=>$id,'all'=>$all]);
    }

/** 
*   删除回帖
*   $id 获取当前回帖的id 
*   $del 删除用户要删除的回帖
*@return 返回
*/ 
   public function getDel(Request $request)
    {
      $id = $request['id'];
      $del = DB::table('reply')->where('id',$id)->delete();
      return back()->with('error','删除成功');
    }
/**
* 用户帖子删除
* $id 获取帖子的id
* $del 删除帖子
* $delr 删除回帖
*@return 返回
*/
    public function getDelpost(Request $request)
    {
      $id = $request['id'];
      $del = DB::table('post')->where('id',$id)->delete();
      $delr = DB::table('reply')->where('pid',$id)->delete();
      return back()->with('error','删除成功');
    }

/**
*
* 回复帖子
* $a 获取所有接受的数据
* $rid 回复人的数据
* $integral 回帖加积分
* $time 回帖时间
* $insertreply 插入回复内容
* 
*@return 回到回帖前的页面
*/
    //回复帖子
    public function postReply(TextRequest $request)
      {
        $a = $request->all();
       if(empty($a['body'])){

        return back();
       }

        // 获取回复人的数据(有帖子的id)
        $rid = session('uid');

        // 加积分
        $integral = DB::table('userdetail')->where('uid',$rid)->select('integral')->first();
        $jf = $integral->integral+5;
        $integral = DB::table('userdetail')->where('uid',$rid)->update(['integral'=>$jf]);

        // 获取回帖时间
        $time = time();

        $insertreply = DB::table('reply')->insert(['uid'=>$rid['id'],'rcontent'=>$request['body'],'pid'=>$request['id'],'rctime'=>$time]);

        return back();
      }


  
/**
*帖子添加
* $id 登录者id
* $integral 发帖加积分
* $data 获取用户写的内容
* $time 获取用户发帖时间
* $bool 插入表
*@return 重定向 
*/
    public function postPosted(editorValueRequest $request)
    {
        // 获取当前登录的人
        $id = session('uid');
        // 当前发帖人加积分
        $integral = DB::table('userdetail')->where('uid',$id)->select('integral')->first();
        $jf = $integral->integral+10;
        $integral = DB::table('userdetail')->where('uid',$id)->update(['integral'=>$jf]);

        // 获取用户写的标题 内容 选择的板块
          $data = $request->all();
          // dd($data['creply']);
          // 获取用户提交时间
          $time = time();

          $a=$data['editorValue'];

          $bool=DB::table("post")->insert(['tid'=>$data['types'],'uid'=>$id['id'],'ptitle'=>$data['title'],'pcontent'=>$a,'pctime'=>$time]); 

         return redirect('/home/user/userinfo');
    }

/**
*帖子添加页
* $type 所有版块
* $id 当前登录的id
* $typeid 进入板块的id
* $user 当前登录的权限
*@return 解析模版 分配版块 
*/
    public function getPosted(Request $request)
    {
      //进入板块的id
       $typeid = $request['id'];
       if(empty($typeid)){
        $typeid=1;
       }
        //获取当前登录的id
        $id = session('uid');
        //判断当前是否有人登录
        if(empty($id)){
          return redirect('/home/user/login')->with('error','请登录');
        }
        // 获取当前登录的权限
        $user = DB::table('user')->where('id',$id)->select('status')->first();
        //禁言or未禁言
          if($user->status == 1){
            return back()->with('error','您已被禁言,请联系客服');
          }
        //查询所有版块
        $type = DB::table('type')->get();
      
        return view('home.card.posted',['type'=>$type,'typeid'=>$typeid]);
     
    }

/**
* 
*精华帖
* $post 查询精华帖
* $Number 所有精华帖数量
*@return 解析模版 分配数据
*/
    public function getElite(Request $request)
    {
      // 查询精华帖
      $num = DB::table('post')->where('elite','y')->count();
         

      // 按条件查帖子
      $post = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->join('userdetail','post.uid','=','userdetail.uid')
              ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','userdetail.photo','post.elite','post.top','userdetail.uid','userdetail.nickname')
              ->orderBy('top', 'desc')
              ->where('elite','y')
              ->where('recycle','n')
              ->paginate(10);
              // dd($post);
        // 查询帖子数量
        $Number = DB::table('post')->where('recycle','n')->count('id');

        return view('home.card.elite',['post'=>$post,'Number'=>$Number,'num'=>$num]);

    }


      // 无人文件的帖子
/**
*  $num 计数点击量为0的帖子
*  $post 查询点击量为0的帖子
*@return 解析模版 传输数据
*/
    public function getZero()
    { 
        //查询点击量为0的
        $num = DB::table('post')->where('click','0')->count();
           // dd($num);
        $post = DB::table('post')
              ->join('type','post.tid','=','type.id')
              ->join('userdetail','post.uid','=','userdetail.uid')
              ->select('post.ptitle','post.pcontent','post.click','post.id','post.pctime','userdetail.photo','post.elite','post.top','userdetail.uid','userdetail.nickname')
              ->orderBy('top', 'desc')
              ->where('click','0')
              ->paginate(10);
              // dd($post);
        return view('home.card.zero',['post'=>$post,'num'=>$num]);
    }


/**
* 
* $post 查询帖子表中数据
*
*/
    public static function a()
    {
         $post = DB::table('post')->where('post.id',$id)->get();
    }



/**   
*  收藏
* $uid 收藏人id
* $pid  帖子id
* $res 计数收藏
* $insert 插入返回 id 
*@echo 返回所需参数
*/ 
    public function postCang(Request $request){

      $uid = $request->input('uid');
      $pid = $request->input('pid');
      $data = $request->except('_token');

      $res = DB::table('cang')
                ->where('uid',$uid)
                ->where('pid',$pid)
                ->count();
      if($res==0){
        //没收藏过 执行添加
        $insert = DB::table('cang')
                ->insertGetId(['uid'=>$uid,'pid'=>$pid]); 
        echo $insert;
      }else{
        //!=0为收藏过
        echo 'repeat';
      }

    }

}
