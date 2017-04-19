@extends('admin.layout.index')
@section('title','主贴修改')
@section('header','主贴修改')
@section('path','主贴修改')
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
	<form action="/admin/card/doupdate" method="post">
		<div class="box-header with-border">
			<i class="fa fa-text-width"></i>

			<h3 class="box-title"><input type="text" name="ptitle" value="{{$info->ptitle}}"></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<small>用户ID：<cite title="Source Title">{{$info->nickname}}</cite></small>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<blockquote>
				<p><textarea name="pcontent" cols="50" rows="5" style="resize: none;">{{$info->pcontent}}</textarea></p>
			</blockquote>
			<hr>
				<!-- <div style="float:left;"><button>123</button></div>
				<div><button>123</button></div>
				<div><button>123</button></div> -->
				
				<input type="hidden" name='id' value='{{$info->id}}'>
		</div>

		  <div class="box-footer">
		  	<button type="button" class="btn btn-default"  onclick="javascript:window.history.back(-1);">返回</button>
		 		<button type="submit" class="btn btn-info pull-right">添 加</button>
			</div>
		{{ csrf_field() }}
	</form>
		<!-- /.box-body -->


</div>
@endsection
