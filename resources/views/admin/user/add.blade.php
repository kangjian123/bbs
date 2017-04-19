@extends('admin.layout.index')
@section('title','用户添加')
@section('path','用户添加')
@section('con')
<div class="box box-primary" style="width:80%;margin:0 auto">
    <div class="box-header with-border">
    <h3 class="box-title"> <b>用户添加</b> </h3>
</div>

    <!-- 操作提示信息 -->
@if (count($errors) > 0)
<div class="alert alert-info alert-dismissible">
    @foreach ($errors->all() as $error)
    <h4><i class="icon fa fa-ban"></i>{{ $error }}</h4>
    @endforeach
</div>
@endif
    <!-- 用户添加 -->
<form role="form" method="post" action="{{url('/admin/user/insert')}}" enctype="multipart/form-data">
  <div class="box-body">

  	<!-- 用户名 -->
    <div class="form-group">
        <label for="exampleInputEmail1">用户名</label>
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input class="form-control" id="exampleInputEmail1" placeholder="请输入用户名" type="text" name="username" value="{{old('username')}}">
    </div>
    <br>

    <!-- 用户密码 -->
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <span class="input-group-addon"><i class="fa fa-key"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入密码" type="password" name="password" value="{{old('password')}}">
    </div>
	<br>

    <!-- 用户昵称 -->
    <div class="form-group">
        <label for="exampleInputPassword1">昵称</label>
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入昵称" type="text" name="nickname" value="{{old('nickname')}}">
    </div>
	<br>

    <!-- 用户邮箱 -->
    <div class="form-group">
        <label for="exampleInputPassword1">邮箱</label>
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入邮箱" type="text" name="email" value="{{old('email')}}">
    </div>
	<br>

    <!-- 用户QQ -->
    <div class="form-group">
        <label for="exampleInputPassword1">QQ</label>
        <span class="input-group-addon"><i class="fa fa-qq"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入您的QQ" type="text" name="qq" value="{{old('qq')}}">
    </div>
    <br>


    <!-- 用户性别 -->
    <div class="form-group">
        <label>性别</label>
        <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
        <select class="form-control" name="sex">
            <option value="m">男</option>
            <option value="w">女</option>
      </select>
    </div>
    <br>

    <!-- 个人简介 -->
    <div class="form-group">
        <label for="exampleInputPassword1">个人简介</label>
        <span class="input-group-addon"><i class="fa fa-life-bouy"></i></span>
        <textarea class="form-control" rowspan="200px" id="exampleInputPassword1" placeholder="请输入您的个人简介"  name="content" value="{{old('content')}}"></textarea>
    </div>
	<br>

    <!-- 用户权限管理 -->
	<div class="form-group">
        <label>用户权限</label>
        <span class="input-group-addon"><i class="fa fa-group"></i></span>
        <select class="form-control" name="auth">
       		<option value="y">管理员</option>
        	<option value="n">普通用户</option>
      </select>
    </div>
	<br>

	<!-- 用户头像 -->
    <div class="form-group">
      <label for="exampleInputFile">头像</label>
      <input id="exampleInputFile" type="file" name="photo">
    </div>
	<br>
    <!-- 防跨站攻击 -->
    {{ csrf_field() }}

    <div class="box-footer">
    	<button type="submit" class="btn btn-primary">注册</button>
    	<button type="reset" class="btn btn-primary">重置</button>
    </div>
   </form>  
  </div>  
@endsection
