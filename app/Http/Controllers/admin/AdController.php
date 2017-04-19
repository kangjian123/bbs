<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Requests\AdAddRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Http\Requests\UserPostRequest;
use App\Http\Controllers\Controller;

//汤健
class AdController extends Controller
{	
   /**
	* 	广告列表页
    *   $info   查询到的广告所有信息
    *   $all    获取所有请求参数 为分页做准备
	*
	* @return  解析模板 分配$info,$all
	*/
    public function getIndex(Request $request){
    	if($request->input('keyword')){
    		$info = DB::table('ad')
    						->where('adname','like','%'.$request->input('keyword').'%')
    						->paginate(10);
    	}else{
			$info = DB::table('ad')->paginate(10);
		}

		$all = $request->all();

		return view('admin.ad.index',['info'=>$info,'all'=>$all]);
    }

    /**
     * 跳转到广告添加页
     *
     */
    public function getAdd(){
        return view ('admin.ad.add');
    }

    /**
     * 执行广告添加
     * $data 获取除_token外所有添加参数
     * $res  插入数据后受影响行数
     *
     * @return  成功重定向至广告列表页，否则返回上级页面
     */
    public function postInsert(AdAddRequest $request){
    	$data = $request->except('_token');
    	$data['adpic'] = self::upload($request);
    	$res = DB::table('ad')->insertGetId($data); 

    	//跳转到列表页
        if($res){
            return redirect('admin/ad/index')->with('success','广告添加成功');
        }else{
            return back()->withInput();
        }

    }

    /**
     * 执行图片上传(广告添加)
     * $name    随机后的文件名
     * $suffix  获取文件的后缀名
     * $arr     限制文件上传的格式
     *
     * @return  成功返回文件名，为空显示默认名，格式错误返回上一级
     */
    static public function upload($request)
    {
        //判断是否有文件上传
        if($request->hasFile('adpic')){
            //随机文件名
            $name = md5(time()+rand(1,999999));
            //获取文件的后缀名
            $suffix = $request->file('adpic')->getClientOriginalExtension();
            $arr = ['png','jpeg','gif','jpg'];
            if(!in_array($suffix,$arr)){
                return back()->with('error','上传文件格式不正确');
            }
            $request->file('adpic')->move('./uploads/ad/',$name.'.'.$suffix);
            //返回路径
            return '/uploads/ad/'.$name.'.'.$suffix;
        }else{
            return "/uploads/ad/default.jpeg";
        }
    }

    /**
     * 图像上传（修改时）
     *
     * $a   根据广告id查询当前图片路径
     * $b   获取格式为string的路径信息
     *
     * @return  返回详细路径信息
     */
    public function asd($request){
    	$a = DB::select('select adpic from ad where id = '.$request);
    	$b = $a[0]->adpic;
    	return $b;
    }

    /**
     * ajax删除帖子
     *
     * $id  前台页面传送的要删除的广告id
     * $res 删除后的受影响行数
     *
     * @return  返回受影响行数
     */
    public function postDelad(Request $request)
    {   
        $id = $request->input('id');
        $res = DB::table('ad')->where('id',$id)->delete();
        echo $res;
    }

    /**
     * 携带id跳转至修改页
     *
     * $id  获取要修改的广告id
     * $info    当前id下广告的详细信息
     *
     * @reutnr  解析模板 分配$info
     */
    public function getUpdate(Request $request){
    	$id = $request->input('id');

    	$info = DB::table('ad')->where('id',$id)->first();
    	// dd($info);
    	return view('admin.ad.update',['info'=>$info]);
    }

    /**
     * 执行修改
     *
     * $data    获取除_token外页面传过来要修改的参数
     * $id      要执行修改的广告id
     * $res     执行修改后的受影响行数
     *
     * @return  为真重定向至广告列表页，否则返回上一级
     */
    public function postDoupdate(AdUpdateRequest $request){
        $data = $request->except('_token');
        $id = $request->input('id');
        if(!empty($data['adpic'])){
			$data['adpic'] = self::upload($request);
		}else{
        	$data['adpic'] = $this->asd($id);
    	}
        $res = DB::table('ad')
                    ->where('id',$id)
                    ->update($data);

        if($res==1){
            return redirect('admin/ad/index')->with('success','修改成功');
        }else{
            return back()->with('error','未进行修改');
        }
    }
}
