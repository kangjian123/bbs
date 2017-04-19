@extends('admin.layout.index')
@section('title','广告修改')
@section('header','广告修改')
@section('path','广告修改')
@section('con')
	<br>
	<form action="/admin/ad/doupdate" method="post" enctype="multipart/form-data">
			<div class="box box-info" style="width:50%;margin:0 auto;">
			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

	            <div class="box-header with-border">
	              <h3 class="box-title"><i class="fa fa-fw fa-android"></i>广告修改 </h3>
	            </div>
	            <div class="box-body">
	              <div class="input-group" >
	                <span class="input-group-addon">标题</span>
	                <input name="adname" class="form-control" value="{{$info->adname}}" placeholder="广告标题" type="text">
	              </div>
	              <br>
	              <div class="input-group" >
	                <span class="input-group-addon">地址</span>
	                <input name="adlink" class="form-control" value="{{$info->adlink}}" placeholder="广告地址" type="text">
	              </div>
	              <br>
	              <div>
	              	当前图片：<br>
	              	<img src="{{$info->adpic}}" alt="加载失败" width='350'>
	              </div>
	              <br>
	              <div class="input-group" >
	                <span class="input-group-addon">修改为：</span>
	                <input name="adpic" class="form-control" placeholder="广告图片" type="file">
	              </div>
	              <br>
	            </div>
	            <div class="box-footer">
	            	<button type="button" class="btn btn-default"  onclick="javascript:window.history.back(-1);">返回</button>
	           		<button type="submit" class="btn btn-info pull-right">添 加</button>
	          	</div>
	            <!-- /.box-body -->
	        </div>
	        <input type="hidden" name='id' value='{{$info->id}}'>
	          {{ csrf_field() }}
	</form>
@endsection