<?php
namespace App\Http\Controllers\bz;

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
	 *	版主帖子列表页
	 *	$tid 	获取要查询的板块id
	 *	$card 	所有帖子信息
	 *	$tname 	在某板块下的所有帖子
	 *	$type 	获取板块名
	 *
	 * 	@return 解析模板 分配$card,$type,$tname
	 */
	public function getIndex(Request $request){

		//获取要查询的板块
		$tid = $request->input('tid');

		//判断是否搜索
    	if($request->input('tid')||$request->input('keyword')){

    		if(empty($tid)){
    			$card = DB::table('userdetail')
    		            ->leftJoin('post','post.uid','=','userdetail.id')
    		            ->where('recycle','n')
    		            ->where('ptitle','like','%'.$request->input('keyword').'%')
    		            ->paginate(10);
    		}else{
    			$card = DB::table('userdetail')
    		            ->leftJoin('post','post.uid','=','userdetail.id')
    		            ->where('post.tid',$tid)
    		            ->where('recycle','n')
    		            ->where('ptitle','like','%'.$request->input('keyword').'%')
    		            ->paginate(10);
    		}
    		

    		$tname = DB::table('post')
						->leftjoin('type','type.id','=','post.tid')
						->where('recycle','n')
						->where('ptitle','like','%'.$request->input('keyword').'%')
						->get();
    	}else{
    		$card = DB::table('userdetail')
    		             ->leftJoin('post','post.uid','=','userdetail.id')
    		             ->where('recycle','n')
    		             ->paginate(10);

    		$tname = DB::table('post')
						->leftjoin('type','type.id','=','post.tid')
						->where('recycle','n')
						->get();
    	}
		
		$type = DB::table('type')->get();
		$all = $request->all();
		
		return view('bz.card.index',['card'=>$card,'type'=>$type,'tname'=>$tname,'all'=>$all]);
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
	                // dd($reply);
	    
	    return view('bz.card.info',['reply'=>$reply,'card'=>$card]);
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
}