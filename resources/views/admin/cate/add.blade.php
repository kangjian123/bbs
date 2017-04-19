@extends('admin.layout.index')
@section('title', '后台板块')
@section('path', '板块添加')
@section('con')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"> <b>板块添加</b> </h3>
    </div>
        <!-- 操作提示信息 -->
@if (count($errors) > 0)
<div class="alert alert-info alert-dismissible">
    @foreach ($errors->all() as $error)
    <h4><i class="icon fa fa-ban"></i>{{ $error }}</h4>
    @endforeach
</div>
@endif

<div class="box-body">
    <!-- 添加板块名 -->
    <form action="{{url('/admin/cate/insert')}}" method="post" enctype="multipart/form-data" id='article-create-form'>
    <div class="form-group">
      <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>板块名</label>
      <input class="form-control" id="article-title" placeholder="请输入板块名" type="text" name="tname">
    </div>
    <br>
    <!-- 添加板块介绍 -->
	<div class="form-group">
      <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i>板块介绍</label>
      <input class="form-control" id="inputWarning" placeholder="请输入版块介绍" type="text" name="tcontent">
    </div>
    <br>
    <!-- 板块logo -->
    <div class="form-group">
    <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i>板块logo</label>
    <input id="exampleInputFile" type="file" name="tlogo"/>
    </div>
    <br>

    <!-- 防跨站攻击 -->
    {{ csrf_field() }}

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">添加</button>
        <button type="reset" class="btn btn-primary">重置</button>
    </div>
    </form>
</div>
@endsection