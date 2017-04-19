@extends('admin.layout.index')
@section('title','友情链接添加')
@section('header','友情链接添加')
@section('path','友情链接添加')
@section('con')
<br>
<form action="/admin/friend/insert" method="post">
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
              <h3 class="box-title"><i class="fa fa-fw fa-android"></i>友情链接添加 </h3>
            </div>
            <div class="box-body">
              <div class="input-group" >
                <span class="input-group-addon"><i class="fa fa-fw fa-heart"></i></span>
                <input name="fname" class="form-control" placeholder="友情链接标题" type="text">
              </div>
              <br>
              <div class="input-group" >
                <span class="input-group-addon"><i class="fa fa-fw fa-heart"></i></span>
                <input name="flink" class="form-control" placeholder="友情链接地址" type="text">
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