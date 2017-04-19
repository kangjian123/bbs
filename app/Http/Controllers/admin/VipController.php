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

class VipController extends Controller
{   
        
     /**
    * 会员列表页展示
    * $num :每页显示条数
    * $users :查询到的用户数据(user表和userdetail表)
    * $all :获取所有的参数请求(分页搜索用)
    * @return view :解析会员用户模板
    * @return all :返回获取所有的参数请求(分页搜索用)
    */
    public function getIndex(Request $request)
    {

        //每页显示多少条
        $num =10;

        //判读用户是否搜索
        if($request->input('keyword')){
            $users = DB::table('user')
                ->join('userdetail', 'user.id', '=', 'userdetail.uid')
                ->where('username','like','%'.$request->input('keyword').'%')
                ->where('userdetail.vip','y')
                ->paginate($num);
           
        }else{
        //查询用户数据
        $users = DB::table('user')
            ->join('userdetail', 'user.id', '=', 'userdetail.uid')
            ->where('userdetail.vip','y')
            ->paginate($num);
         }

        //解析模板
        $all = $request->all();
        return view('admin.vip.index',['users'=>$users,'all'=>$all]);
    }

     /**
    * ajax取消会员
    * $data :获取传递过来的ajax信息
    * $res :更新数据库中的vip字段内容
    * @return void
    */
    public function postQvip(Request $request)
    {
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('userdetail')->where('uid',$id)->update($data);
        echo $res;
    }
}
