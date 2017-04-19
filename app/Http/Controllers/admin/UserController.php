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

class UserController extends Controller
{   
        
     /**
    * 用户列表页展示
    * $num :每页显示条数
    * $users :查询到的用户数据(user表和userdetail表)
    * $all :获取所有的参数请求(分页搜索用)
    * @return users :返回用户信息
    * @return all :返回获取所有的参数请求(分页搜索用)
    */
    public function getIndex(Request $request)
    {

        //每页显示多少条
        $num =6;

        //判读用户是否搜索
        if($request->input('keyword')){
            $users = DB::table('user')
                ->join('userdetail', 'user.id', '=', 'userdetail.uid')
                ->where('username','like','%'.$request->input('keyword').'%')
                ->paginate($num);
           
        }else{
        //查询用户数据
        $users = DB::table('user')
            ->join('userdetail', 'user.id', '=', 'userdetail.uid')->paginate($num);
         }

        //解析模板
        $all = $request->all();
        return view('admin.user.index',['users'=>$users,'all'=>$all]);
    }

     /**
    * 用户添加页展示
    * @return void 
    */
    public function getAdd()
    {
        //显示用户添加表单
        return view('admin.user.add');
    }

     /**
    * 执行用户的添加
    * $data :提取获取到的数据
    * $res :执行用户插入后返回插入后的id
    * @return void 
    */
    public function postInsert(UserPostRequest $request)
    {
        //提取数据
        $data = $request->except(['_token']);
        
        //进行头像上传
        $data['photo'] = self::upload($request);
        
        //判断头像是否符合条件
        if($data['photo']){
        
        //开始进行sql操作,将数据插入主表
         $res = DB::table('user')->insertGetId(['username'=>$data['username'],'password'=>$data['password'],
                                                'auth'=>$data['auth']]); 
            //插入成功后将其他数据插入附表
            DB::table('userdetail')->insert(['uid'=>$res,'nickname'=>$data['nickname'],'email'=>$data['email'],'sex'=>$data['sex'],
                                            'qq'=>$data['qq'],'photo'=>$data['photo'],'content'=>$data['content']]);
            return redirect('admin/user/index')->with('success','用户添加成功');
        }else{
            return back()->with('error','图片格式不正确!!')->withInput();
        }
    }

     /**
    * 处理头像上传
    * $name :将文件名存为一个MD5加密随机的名字
    * $suffix :获取文件后缀名
    * $arr :支持的图片文件格式
    * @return void 
    */
    static public function upload($request)
    {
        //判断是否有文件上传
        if($request->hasFile('photo')){

            //随机文件名
            $name = md5(time()+rand(1,999999));

            //获取文件的后缀名
            $suffix = $request->file('photo')->getClientOriginalExtension();
            $arr = ['png','jpeg','jpg','gif'];
            if(!in_array($suffix,$arr)){
                return false;
            }
            $request->file('photo')->move('./uploads/user/',$name.'.'.$suffix);

            //返回路径
            return '/uploads/user/'.$name.'.'.$suffix;
        }else{
            return "/uploads/user/default.jpg";
        }
    }

     /**
    * 使用ajax技术实现无刷新删除操作
    * $id :获取要删除的用户的id
    * $res :执行指定用户删除操作
    * @return void 
    */
    public function postDelete(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('userdetail')->where('uid',$id)->delete();

        //判断上条语句是否删除成功,如果成功则将user表中对应数据删除
        if($res)
        {
            DB::table('user')->where('id',$id)->delete();
        }
        echo $res;
    }

     /**
    * 使用ajax技术实现无刷新权限操作
    * $id :获取要修改的用户的id
    * $res :执行指定用户权限
    * @return void 
    */
    public function postAuth(Request $request)
    {
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('user')->where('id',$id)->update($data);
        echo $res;
    }

     /**
    * 使用ajax技术实现无刷新会员操作
    * $id :获取要修改的用户的id
    * $res :执行指定用户权限
    * @return void 
    */
    public function postQvip(Request $request)
    {
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('userdetail')->where('uid',$id)->update($data);
        echo $res;
    }

     /**
    * 获取用户信息
    * $id :获取要修改的用户id
    * $users :获取修改用户的value值
    * @return users :返回用户信息
    */
    public function getUpdate(Request $request)
    {
        //获取用户id
        $id = $request->input('id');
        $users = DB::table('user')
                ->join('userdetail', 'user.id', '=', 'userdetail.uid')
                ->where('user.id',$id)
                ->first();
        //解析模板
        return view('admin.user.update',['users'=>$users]);
    }

     /**
    * 执行用户修改
    * $id :提取修改用户id
    * $data :执行数据入库操作
    * @return void
    */
    public function postUpdate(UserUpdateRequest $request)
    {
        //提取数据
        $id = $request->input('id');

        //执行数据入库操作
        $data = $request->except(['_token']);
        $data['photo'] = self::updateload($request);

        //判断图片是否符合要求
        if($data['photo']){
        $res = DB::table('user')
            ->join('userdetail', 'user.id', '=', 'userdetail.uid')
            ->where('userdetail.id',$id)
            ->update(['password'=>$data['password'],
                    'auth'=>$data['auth'],'nickname'=>$data['nickname'],
                    'email'=>$data['email'],'sex'=>$data['sex'],
                    'qq'=>$data['qq'],'photo'=>$data['photo'],'content'=>$data['content']]);
        //返回结果
        return redirect('admin/user/index')->with('success','用户修改成功');
            
        }else{
            return back()->with('error','图片格式不正确!!')->withInput();
        }
    }

    /**
    * 执行用户修改时的头像操作
    * $id :提取修改用户id
    * $data :执行数据入库操作
    * @return void
    */   
    static public function updateload($request)
    {
        //判断是否有文件上传
        if($request->hasFile('photo')){

            //随机文件名
            $name = md5(time()+rand(1,999999));

            //获取文件的后缀名
            $suffix = $request->file('photo')->getClientOriginalExtension();
            $arr = ['png','jpeg','gif','jpg'];
            if(!in_array($suffix,$arr)){
                return false;
            }
            $request->file('photo')->move('./uploads/user/',$name.'.'.$suffix);

            //返回路径
            return '/uploads/user/'.$name.'.'.$suffix;
        }else{
            $id = $request->input('id');
            $res = DB::table('userdetail')->where('id',$id)->first();
            return $res->photo;
        }
    }

     /**
    * 后台管理员申请界面展示
    * $num :每页显示数据的条数
    * $users :从数据库中提取配的用户
    * $all :获取所有的参数请求(分页搜索用)
    * @return 解析申请页的模板
    */
    public function getShenqing(Request $request)
    {
         //每页显示多少条
        $num =10;

        //判读用户是否搜索
        if($request->input('keyword')){
            $users = DB::table('user')
                ->join('userdetail', 'user.id', '=', 'userdetail.uid')
                ->where('username','like','%'.$request->input('keyword').'%')
                ->where('user.shenqing','=','y')
                ->paginate($num);
           
        }else{
        //查询用户数据
        $users = DB::table('user')
            ->join('userdetail', 'user.id', '=', 'userdetail.uid')
            ->where('user.shenqing','=','y')
            ->paginate($num);
         }

        //解析模板
        $all = $request->all();
        return view('admin.user.shenqing',['users'=>$users,'all'=>$all]);
    }
    
     /**
    * ajax同意申请成为管理
    * $data :获取用户的信息
    * $res :查询匹配到的用户数据
    * @return void
    */
     public function postAgree(Request $request)
    {
        $data = $request->except('_token');
        $id = $request->input('id');
        $res = DB::table('user')->where('id',$id)->update($data);
        echo $res;
    }
}
