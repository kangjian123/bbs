<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\ConfigUpdateRequest;
use App\Http\Controllers\Controller;

//汤健
class ConfigController extends Controller
{	
    /**
     *  获取配置信息
     *  $info 当前网站配置信息
     *  
     *
     *  @return 解析模板 分配$info
     */
    public function getUpdate(){

    	$info = DB::table('config')->first();

        return view ('admin.config.update',['info'=>$info]);
    }

    /**
     *  修改配置信息
     *  $data 修改后接收到的所有信息
     *  $res  受影响行数
     *  
     *
     *  @return 成功重定向至配置修改页,并携带提示信息。否则回到上一页，携带提示信息
     */
    public function postChange(ConfigUpdateRequest $request){
    	$data = $request->except('_token');

    	$res = DB::table('config')->update($data);

    	if($res==1){
    		return redirect('admin/config/update')->with('success','网站配置修改成功');
    	}else{
    	    return back()->with('error','未进行修改');
    	}
    }
}
