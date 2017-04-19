<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Requests\CatePostRequest;
use App\Http\Requests\CateUpdateRequest;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
     /**
    * 板块列表页
    * $num :每页显示条数
    * $types :查询板块数据
    * @return types :返回版块的数据
    * @return all :返回获取所有的参数请求(分页搜索用)
    */
    public function getIndex(Request $request)
    {
        // //每页显示多少条
        $num =6;
        //判读是否搜索
         if($request->input('keyword')){
            $types = DB::table('type')
                ->where('tname','like','%'.$request->input('keyword').'%')
                ->paginate($num);
           
        }else{
        //查询板块数据
        $types = DB::table('type')->paginate($num);
         }
        //解析模板
        $all = $request->all();
        return view('admin.cate.index',['types'=>$types,'all'=>$all]);
    }

     /**
    * 板块添加页展示
    * @return void 
    */
    public function getAdd(){
        return view('admin.cate.add');
    }

     /**
    * 板块添加执行
    * $data :获取所有板块数据
    * $res :执行数据入库操作
    * @return void 
    */
    public function postInsert(CatePostRequest $request){
        $data = $request->except(['_token']);
        $data['tlogo'] = self::upload($request);
        if($data['tlogo']){
        $res = DB::table('type')->insert($data);
        return redirect('/admin/cate/index')->with('success','板块添加成功!');
        }else{
            return back()->with('error','图片格式不正确!!');
        }
    }

     /**
    * 处理logo上传
    * $name :将文件名存为一个MD5加密随机的名字
    * $suffix :获取文件后缀名
    * $arr :支持的图片文件格式
    * @return void 
    */
    static public function upload($request)
    {
        //判断是否有文件上传
        if($request->hasFile('tlogo')){
            //随机文件名
            $name = md5(time()+rand(1,999999));
            //获取文件的后缀名
            $suffix = $request->file('tlogo')->getClientOriginalExtension();
            \Log::info($suffix);
            $arr = ['png','jpeg','jpg'];
            if(!in_array($suffix,$arr)){
                return false;
            }
            $request->file('tlogo')->move('./uploads/logo/',$name.'.'.$suffix);
            //返回路径
            return '/uploads/logo/'.$name.'.'.$suffix;
         }else{
            return "/uploads/logo/default.jpeg";
        }
    }

     /**
    * 获取并执行板块删除
    * $id :获取要删除的板块的id
    * $res :执行指定板块删除操作
    * @return void 
    */
    public function getDel(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('type')
                ->join('post','type.id','=','post.tid')
                ->where('type.id',$id)
                ->first();
        if($res){
            return back()->with('error','板块中有内容,禁止删除!!');
        }else{
            $res = DB::table('type')->where('id',$id)->delete();
            return back()->with('success','删除成功!');
        }
    }

     /**
    * 获取要修改的版块信息
    * $id :获取要修改的版块id
    * $types :获取修改版块的value值
    * @return view :解析模板,带着type中的内容
    */
    public function getUpdate(Request $request){
        $id = $request->input('id');
        $types = DB::table('type')->where('id',$id)->first();
        $all = $request->all();
        return view('admin.cate.update',['types'=>$types,'all'=>$all]);
    }

     /**
    * 执行板块修改
    * $id :提取修改板块id
    * $data :执行数据入库操作
    * @return 重定向到主页
    */
    public function postUpdate(CateUpdateRequest $request)
    {
        //提取数据
        $id = $request->input('id');

        //执行数据入库操作
        $data = $request->except(['_token']);
        $data['tlogo'] = self::updateload($request);

        // 判断图片是否符合要求
        if($data['tlogo']){
        $res = DB::table('type')->where('id',$id)->update($data);
        return redirect('admin/cate/index')->with('success','板块修改成功');
        }else{
            return back()->with('error','图片格式不正确!!(只支持jpg,png,jpeg格式)');
        }
            

            
        //返回成功后的数据
    }

    static public function updateload($request)
    {
        //判断是否有文件上传
        if($request->hasFile('tlogo')){
            //随机文件名
            $name = md5(time()+rand(1,999999));
            //获取文件的后缀名
            $suffix = $request->file('tlogo')->getClientOriginalExtension();
            $arr = ['png','jpeg','jpg'];
            if(!in_array($suffix,$arr)){
                return false;
            }
            $request->file('tlogo')->move('./uploads/logo/',$name.'.'.$suffix);
            //返回路径
            return '/uploads/logo/'.$name.'.'.$suffix;
        }else{
            $id = $request->input('id');
            $res = DB::table('type')->where('id',$id)->first();
            return $res->tlogo;
        }
    }
    
}
