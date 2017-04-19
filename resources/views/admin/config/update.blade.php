@extends('admin.layout.index')
@section('title','网站配置')
@section('header','网站配置')
@section('path','网站配置')
@section('con')
<br><br>
<div class="box box-solid" style="width:40%;margin:0 auto;">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form action="/admin/config/change" method="post">
		<div class="box-header with-border">
			<i class="fa fa-text-width"></i>

			<h3 class="box-title">配置修改</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<blockquote>
				<h3 class="box-title">标题：<input type="text" name="configtitle" value="{{$info->configtitle}}"></h3>
				当前状态：{{$info->open=='y'? '维护中' :'尚未进行维护'}}
				<br>
				<div class="form-group">
	                <label>维护状态：</label>
	                <select name="open" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
	                  <option value="y" {{$info->open=='y'? 'selected="selected"' : ''}}>维护中</option>
	                  <option value="n" {{$info->open=='n'? 'selected="selected"' : ''}}>尚未进行维护</option>
	                </select>
				</div>
			</blockquote>
		</div>

		  <div class="box-footer">
		  	<button type="button" class="btn btn-default"  onclick="javascript:window.history.back(-1);">返回</button>
		 		<button type="submit" class="btn btn-info pull-right">修 改</button>
			</div>
		{{ csrf_field() }}
	</form>
		<!-- /.box-body -->


</div>
@endsection