<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Requests\UserPostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardUpdateRequest;

//汤健
class CardController extends Controller
{	
	
    /**
    *   帖子列表页
    *   $num    每页显示几条
    *   $card   userdetail，post表信息
    *   $all    获取所有的参数请求
    *
    *   @return 解析模板 分配$card,$all    
    */
    public function getIndex(Request $request){
    	
    	//每页显示几条
    	$num = $request->input('num',10);
    	//判断是否搜索
    	if($request->input('keyword')){

            $card = DB::table('userdetail')
                        ->leftJoin('post','post.uid','=','userdetail.id')
                        ->where('recycle','n')
                        ->where('ptitle','like','%'.$request->input('keyword').'%')
                        ->paginate($num);

        }else{
            // $card = DB::table('post')->where('recycle','n')->paginate($num);

           $card = DB::table('userdetail')
                        ->leftJoin('post','post.uid','=','userdetail.id')
                        ->where('recycle','n')
                        ->paginate($num);



        }
        //获取所有的参数请求
        $all = $request->all();
        
        //解析模板
        return view('admin.card.index',['card'=>$card,'all'=>$all]);
    }


    /**
     *  帖子详情页
     *
     *  $id     要查询的帖子id
     *  $card   单条帖子详细信息
     *  $reply  当前帖子中所有回帖
     *
     *  @return 解析模板 分配$reply,$card
     */
    public function getInfo(Request $request){
        $id = $request->input('id');

        //获取帖子
        $card = DB::table('post')
                    ->leftJoin('userdetail','post.uid','=','userdetail.id')
                    ->leftJoin('type','type.id','=','post.tid')
                    ->where('post.id',$id)
                    ->get();

        //获取回帖
        $reply = DB::table('userdetail')
                    ->leftJoin('reply','reply.uid','=','userdetail.id')
                    ->where('pid',$id)
                    ->get();
        
        return view('admin.card.info',['reply'=>$reply,'card'=>$card]);
    }

    /**
     *  ajax删除回帖
     *
     *  $id     要删除的回帖id
     *  $res    受受影响函数
     *
     *  @return 受影响行数
     */
    public function postDelreply(Request $request)
    {   
        $id = $request->input('id');
        $res = DB::table('reply')->where('id',$id)->delete();
        echo $res;
    }

    /**
     *  ajax加入回收站
     *  $data 获取所有要修改的参数 
     *  $id   获取要加入回收站帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数 
     */
    public function postDorecycle(Request $request)
    {   
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')->where('id',$id)->update($data);
        echo $res;
    }

    /**
     *  ajax加精/取消加精
     *  $data 获取要修改的参数
     *  $id   获取要修改帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数
     */
    public function postElite(Request $request)
    {   
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')->where('id',$id)->update($data);
        echo $res;
    }

    /**
     *  ajax置顶/取消置顶
     *  $data 获取要修改的参数
     *  $id   获取要修改帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数
     */
    public function postTop(Request $request)
    {   
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')->where('id',$id)->update($data);
        echo $res;
    }

    /**
     *  ajax禁止回复/允许回复
     *  $data 获取要修改的参数
     *  $id   获取要修改帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数
     */
    public function postReply(Request $request)
    {   
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')->where('id',$id)->update($data);
        echo $res;
    }

    /**
     *  ajax在回收站回复帖子
     *  $data 获取要修改的参数
     *  $id   获取要修改帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数
     */
    public function postHuifu(Request $request){
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')->where('id',$id)->update($data);
        echo $res;
    }

    /**
     *  ajax删除帖子
     *  $id   获取要删除帖子的id
     *  $res  受影响行数
     *
     *  @return 受影响行数
     */
    public function postDel(Request $request){
        $id = $request->input('id');

        $res = DB::table('post')->where('id',$id)->delete();
        echo $res;
    }

    /**
     *  修改主贴
     *  $id   获取要修改帖子的id
     *  $info 当前id下的具体帖子信息
     *  
     *
     *  @return 解析模板 分配$info
     */
    public function getUpdate(Request $request){

            $id = $request->input('id');
            // dd($id);
            $info = DB::table('userdetail')
                        ->leftJoin('post','post.uid','=','userdetail.id')
                        ->where('post.id',$id)
                        ->first();

            return view('admin.card.update',['info'=>$info]);
    }

    //修改主贴 传入数据库
    /**
     *  修改主贴 传入数据库
     *  $data 修改后的所有参数
     *  $id   获取要修改帖子的id
     *  $res  受影响行数
     *  
     *
     *  @return 成功重定向回回收站页，否则回到修改页
     */
    public function postDoupdate(CardUpdateRequest $request){
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('post')
                    ->where('id',$id)
                    ->update($data);

        if($res==1){
            return redirect('admin/card/recycle')->with('success','修改成功');
        }else{
            return back()->with('error','未进行修改');
        }
    }

    //回收站页
    /**
     *  回收站页
     *  $num  每页显示几条数据
     *  $card 查询帖子中的具体信息
     *  all   所有的参数请求
     *
     *  @return 解析模板 分配$card,$all
     */
    public function getRecycle(Request $request){
            //每页显示几条
            $num = $request->input('num',10);

            //判断是否搜索
            if($request->input('keyword')){

                $card = DB::table('userdetail')
                    ->leftJoin('post','post.uid','=','userdetail.id')
                    ->where('recycle','y')
                    ->where('ptitle','like','%'.$request->input('keyword').'%')
                    ->paginate($num);

            }else{
               $card = DB::table('userdetail')
                   ->leftJoin('post','post.uid','=','userdetail.id')
                   ->where('recycle','y')
                   ->paginate($num);



            }
            //获取所有的参数请求
            $all = $request->all();
            //解析模板
            return view('admin.card.recycle',['card'=>$card,'all'=>$all]);
           
    }

}