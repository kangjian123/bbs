@extends('admin.layout.index')
@section('title','用户修改')
@section('path','用户修改')
@section('con')
<div class="box box-primary" style="width:80%;margin:0 auto">
    <div class="box-header with-border">
    <h3 class="box-title"> <b>用户修改</b> </h3>
</div>
    <!-- 操作提示信息 -->
@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible">
    @foreach ($errors->all() as $error)
    <h4><i class="icon fa fa-ban"></i>{{ $error }}</h4>
    @endforeach
</div>
@endif

    <!-- 用户修改 -->
<form role="form" method="post" action="{{url('/admin/user/update')}}" enctype="multipart/form-data">
  <div class="box-body">

    <!-- 用户昵称 -->
        <label for="exampleInputPassword1">昵称</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入昵称" type="text" name="nickname" value="{{$users->nickname}}">
    </div>
    <br>

    <!-- 用户密码 -->
        <label for="exampleInputPassword1">密码</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-key"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入密码" type="password" name="password" value="{{$users->password}}">
    </div>
    <br>


    <!-- 用户邮箱 -->
        <label for="exampleInputPassword1">邮箱</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入邮箱" type="text" name="email" value="{{$users->email}}">
    </div>
    <br>

    <!-- 用户QQ -->
        <label for="exampleInputPassword1">QQ</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-qq"></i></span>
        <input class="form-control" id="exampleInputPassword1" placeholder="请输入您的QQ" type="text" name="qq" value="{{$users->qq}}">
    </div>
    <br>

    <!-- 用户性别 -->
        <label>性别</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
        <select class="form-control" name="sex">
            <option value="m" {{($users->sex)=='m'?'selected':''}}>男</option>
            <option value="w" {{($users->sex)=='w'?'selected':''}}>女</option>
      </select>

    </div>
    <br>

    <!-- 用户权限管理 -->
        <label>用户权限</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-group"></i></span>
        <select class="form-control" name="auth">
            <option value="y" {{($users->auth)=='y'?'selected':''}}>管理员</option>
            <option value="n" {{($users->auth)=='n'?'selected':''}}>普通用户</option>
      </select>
    </div>
    <br>

    <!-- 个人简介 -->
        <label for="exampleInputPassword1">个人简介</label>
    <div class="input-group" >
        <span class="input-group-addon"><i class="fa fa-life-bouy"></i></span>
        <input class="form-control" rowspan="200px" id="exampleInputPassword1" placeholder="请输入您的个人简介" value="{{$users->content}}"  name="content" ></textarea>
    </div>
    <br>

    <!-- 用户头像 -->
      <label for="exampleInputFile">头像</label>
    <div class="input-group">
      <img src="{{$users->photo}}" width='300px'>
      <input id="exampleInputFile" type="file" name="photo" >
      <input type="hidden" name="id" value="{{$users->id}}">
    </div>
    <br>
    <!-- 防跨站攻击 -->
    {{ csrf_field() }}

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">修改</button>
        <button type="reset" class="btn btn-primary">重置</button>
    </div>
   </form>  
  </div>  
@endsection