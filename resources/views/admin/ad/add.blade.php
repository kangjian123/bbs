@extends('admin.layout.index')
@section('title','广告添加')
@section('header','广告添加')
@section('path','广告添加')
@section('con')
	<br>
	<form action="/admin/ad/insert" method="post" enctype="multipart/form-data">
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
	              <h3 class="box-title"><i class="fa fa-fw fa-android"></i>广告添加 </h3>
	            </div>
	            <div class="box-body">
	              <div class="input-group" >
	                <span class="input-group-addon"><i class="fa fa-fw fa-heart"></i></span>
	                <input name="adname" class="form-control" placeholder="广告标题" type="text">
	              </div>
	              <br>
	              <div class="input-group" >
	                <span class="input-group-addon"><i class="fa fa-fw fa-heart"></i></span>
	                <input name="adlink" class="form-control" placeholder="广告地址" type="text">
	              </div>
	              <br>
	              <div class="input-group" >
	                <span class="input-group-addon"><i class="fa fa-fw fa-heart"></i></span>
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
	          {{ csrf_field() }}
	</form>
@endsection