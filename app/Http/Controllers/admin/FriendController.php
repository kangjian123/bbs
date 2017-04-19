<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\FriendUpdateRequest;
use App\Http\Requests\FriendAddRequest;
use App\Http\Controllers\Controller;

//汤健
class FriendController extends Controller
{
    /**
     *  后台友情链接主页
     *  $info   查询所有友情链接 并分10页
     *  $all    获取所有请求参数  
     *
     *  @return 解析模板 分配$info $all;
     */
    public function getIndex(Request $request){
    	if($request->input('keyword')){
    		$info = DB::table('friendlink')
    						->where('fname','like','%'.$request->input('keyword').'%')
    						->paginate(10);
    	}else{
			$info = DB::table('friendlink')->paginate(10);
		}

		$all = $request->all();

    	return view('admin.friend.index',['info'=>$info,'all'=>$all]);

    }

    /**
     *  获取要修改的具体友情链接
     *  $id     获取从页面传过来要修改的id
     *  $info   当前id的具体参数
     *
     *  @return 解析模板 分配$all
     */
    public function getUpdate(Request $request){
    	$id = $request->input('id');

    	$info = DB::table('friendlink')->where('id',$id)->first();
    	// dd($info);
    	return view('admin.friend.update',['info'=>$info]);
    }

     /**
     *  修改友情链接至数据库
     *  @data   接收页面传过来的所有要修改的信息
     *  @id     获取要修改信息的id
     *  @res    获取受影响行数 成功跳转至友情链接列表页，失败回到上一级重新修改
     *
     */
    public function postDoupdate(FriendUpdateRequest $request){
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('friendlink')
                    ->where('id',$id)
                    ->update($data);

        if($res==1){
            return redirect('admin/friend/index')->with('success','修改成功');
        }else{
            return back()->with('error','未进行修改');
        }
    }

     /**
     *  ajax删除友情链接
     *  @id     获取要删除的id
     *  @res    获取受影响行数
     *
     *  @echo   返回具体行数
     */
    public function postDel(Request $request)
    {   
        $id = $request->input('id');
        $res = DB::table('friendlink')->where('id',$id)->delete();
        echo $res;
    }

    /**
     *  ajax开启/关闭友情链接
     *  @id     获取要开启/关闭的id
     *  @res    获取受影响行数
     *
     *  @echo   返回受影响行数行数
     */
    public function postOpen(Request $request)
    {   
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('friendlink')->where('id',$id)->update($data);
        echo $res;
    }


    /**
     *  跳转至添加页
     *
     *  @return 解析模板
     *
     */
    public function getAdd(){
        return view ('admin.friend.add');
    }

     /**
     *  执行数据添加
     *  $data   获取要添加的数据
     *  $res    获取受影响行数
     *
     *  @return 成功重定向至友情链接首页 否则回到添加页
     */
    public function postInsert(FriendAddRequest $request){
    	$data = $request->except('_token');
    	$res = DB::table('friendlink')->insertGetId($data); 

    	//跳转到列表页
        if($res){
            return redirect('admin/friend/index')->with('success','友情链接添加成功');
        }else{
            return back()->withInput();
        }

    }
}
